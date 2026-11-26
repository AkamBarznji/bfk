<?php
declare(strict_types=1);

date_default_timezone_set('Europe/London');

$site = require __DIR__ . '/config.php';

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function full_address(array $site): string
{
    return $site['street'] . ', ' . $site['city'] . ' ' . $site['postcode'];
}

function has_hours(array $site): bool
{
    foreach ($site['hours'] as $time) {
        if (trim($time) !== '') {
            return true;
        }
    }
    return false;
}

function tel_link(string $phone): string
{
    return 'tel:' . preg_replace('/[^0-9+]/', '', $phone);
}

function map_embed_url(array $site): string
{
    $q = rawurlencode($site['name'] . ', ' . full_address($site));
    return "https://www.google.com/maps?q={$q}&z=16&output=embed";
}

function start_session(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_set_cookie_params([
            'httponly' => true,
            'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'samesite' => 'Lax',
        ]);
        session_start();
    }
}

function csrf_token(): string
{
    start_session();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

/**
 * Handle the contact form. Returns ['ok' => bool, 'errors' => [], 'old' => []].
 */
function handle_contact(array $site): array
{
    $result = ['ok' => false, 'errors' => [], 'old' => []];
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_POST['form'] ?? '') !== 'contact') {
        return $result;
    }
    start_session();

    $name    = trim((string) ($_POST['name'] ?? ''));
    $email   = trim((string) ($_POST['email'] ?? ''));
    $phone   = trim((string) ($_POST['phone'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));
    $result['old'] = compact('name', 'email', 'phone', 'message');

    // Spam checks: hidden field must stay empty, token must match, one message per minute.
    if (($_POST['website'] ?? '') !== '') {
        $result['ok'] = true; // pretend success to bots
        return $result;
    }
    if (!hash_equals($_SESSION['csrf'] ?? '', (string) ($_POST['csrf'] ?? ''))) {
        $result['errors']['form'] = 'Your session expired. Please send the form again.';
        return $result;
    }
    if (isset($_SESSION['last_sent']) && time() - $_SESSION['last_sent'] < 60) {
        $result['errors']['form'] = 'Please wait a minute before sending another message.';
        return $result;
    }

    if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
        $result['errors']['name'] = 'Enter your name.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 254) {
        $result['errors']['email'] = 'Enter a valid email address.';
    }
    if ($phone !== '' && !preg_match('/^[0-9 +()\-]{7,20}$/', $phone)) {
        $result['errors']['phone'] = 'Enter a valid phone number, or leave it empty.';
    }
    if (mb_strlen($message) < 5 || mb_strlen($message) > 3000) {
        $result['errors']['message'] = 'Write a message between 5 and 3,000 characters.';
    }
    if ($result['errors']) {
        return $result;
    }

    $clean = static fn (string $v): string => str_replace(["\r", "\n"], ' ', $v);
    $host  = preg_replace('/[^a-z0-9.\-]/i', '', $_SERVER['HTTP_HOST'] ?? 'localhost');
    $subject = 'Website message from ' . $clean($name);
    $body = "Name: {$name}\nEmail: {$email}\nPhone: " . ($phone ?: '-') . "\n\n{$message}\n";
    $headers = [
        'From: ' . $site['name'] . ' website <no-reply@' . $host . '>',
        'Reply-To: ' . $clean($email),
        'Content-Type: text/plain; charset=UTF-8',
    ];

    if (@mail($site['email'], '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, implode("\r\n", $headers))) {
        $_SESSION['last_sent'] = time();
        $result['ok'] = true;
        $result['old'] = [];
    } else {
        $result['errors']['form'] = 'The message could not be sent. Please call or visit the shop instead.';
    }
    return $result;
}

/** Base URL of the current site, e.g. https://example.com (no trailing slash). */
function base_url(): string
{
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
    $host = preg_replace('/[^a-z0-9.\-:]/i', '', $_SERVER['HTTP_HOST'] ?? 'localhost');
    return ($https ? 'https' : 'http') . '://' . $host;
}

/** Parse '9:00 – 20:00' into ['09:00', '20:00'], or null if closed/empty. */
function parse_hours(string $value): ?array
{
    if (!preg_match('/(\d{1,2}):(\d{2})\s*[–\-]\s*(\d{1,2}):(\d{2})/u', $value, $m)) {
        return null;
    }
    return [sprintf('%02d:%s', $m[1], $m[2]), sprintf('%02d:%s', $m[3], $m[4])];
}

/** Schema.org openingHoursSpecification entries from config hours. */
function opening_hours_schema(array $site): array
{
    $spec = [];
    foreach ($site['hours'] as $day => $value) {
        if ($range = parse_hours($value)) {
            $spec[] = ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => $day, 'opens' => $range[0], 'closes' => $range[1]];
        }
    }
    return $spec;
}

/** Open/closed status for right now (London time), or null if hours unknown. */
function open_status(array $site): ?array
{
    if (!has_hours($site)) {
        return null;
    }
    $now   = new DateTimeImmutable('now');
    $today = $site['hours'][$now->format('l')] ?? '';
    $range = parse_hours($today);
    $time  = $now->format('H:i');
    if ($range && $time >= $range[0] && $time < $range[1]) {
        return ['open' => true, 'text' => 'Open now until ' . ltrim($range[1], '0')];
    }
    // Find the next opening time.
    for ($i = ($range && $time < $range[0]) ? 0 : 1; $i <= 7; $i++) {
        $day = $now->modify("+{$i} day");
        if ($next = parse_hours($site['hours'][$day->format('l')] ?? '')) {
            $when = $i === 0 ? 'today' : ($i === 1 ? 'tomorrow' : $day->format('l'));
            return ['open' => false, 'text' => 'Closed, opens ' . $when . ' at ' . ltrim($next[0], '0')];
        }
    }
    return ['open' => false, 'text' => 'Closed'];
}

/** width/height attributes for a local image, to prevent layout shift. */
function img_size(string $path): string
{
    $file = __DIR__ . '/..' . $path;
    $size = is_file($file) ? @getimagesize($file) : false;
    return $size ? sprintf(' width="%d" height="%d"', $size[0], $size[1]) : '';
}
