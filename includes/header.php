<?php
/** @var array $site @var string $pageTitle @var string $pageDescription @var string $bodyClass */
$base            = base_url();
$path            = strtok($_SERVER['REQUEST_URI'] ?? '/', '?#') ?: '/';
$canonical       = $base . ($path === '/index.php' ? '/' : $path);
$pageTitle       = $pageTitle ?? $site['name'] . ' | Barber in ' . $site['area'] . ', London ' . explode(' ', $site['postcode'])[0];
$pageDescription = $pageDescription ?? $site['name'] . ' is a men\'s barber shop at ' . full_address($site) . '. Haircuts, skin fades, beard trims, head shaves and hot towel shaves in ' . $site['area'] . '.' . ($site['phone'] !== '' ? ' Call ' . $site['phone'] . '.' : '');
$bodyClass       = $bodyClass ?? '';
$noindex         = $noindex ?? false;
$sameAs = array_values(array_filter([$site['instagram'], $site['tiktok'], $site['facebook'] ?? '']));
$schema = [
    '@context'  => 'https://schema.org',
    '@type'     => 'BarberShop',
    '@id'       => $base . '/#shop',
    'name'      => $site['name'],
    'url'       => $base . '/',
    'logo'      => $base . '/images/logo-dark.png',
    'image'     => [$base . '/images/hero.webp', $base . '/images/chair.webp'],
    'description' => $site['name'] . ' is a men\'s barber shop on Streatham High Road in ' . $site['area'] . ', south London.',
    'address'   => [
        '@type' => 'PostalAddress',
        'streetAddress'   => $site['street'],
        'addressLocality' => $site['city'],
        'addressRegion'   => 'Greater London',
        'postalCode'      => $site['postcode'],
        'addressCountry'  => 'GB',
    ],
    'geo'        => ['@type' => 'GeoCoordinates', 'latitude' => $site['lat'], 'longitude' => $site['lng']],
    'hasMap'     => $site['maps_url'],
    'areaServed' => [$site['area'], 'Streatham Hill', 'Brixton', 'Tooting', 'Norbury', 'Balham'],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name'  => 'Barber services',
        'itemListElement' => array_map(static fn ($s) => array_filter([
            '@type' => 'Offer',
            'itemOffered' => ['@type' => 'Service', 'name' => $s['name'], 'description' => $s['text']],
            'price' => $s['price'] !== '' ? preg_replace('/[^0-9.]/', '', $s['price']) : null,
            'priceCurrency' => $s['price'] !== '' ? 'GBP' : null,
        ]), $site['services']),
    ],
];
if ($site['phone'] !== '') { $schema['telephone'] = '+44' . ltrim(preg_replace('/\D/', '', $site['phone']), '0'); }
if ($hoursSchema = opening_hours_schema($site)) { $schema['openingHoursSpecification'] = $hoursSchema; }
if ($sameAs) { $schema['sameAs'] = $sameAs; }
?>
<!doctype html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDescription) ?>">
<?php if ($noindex): ?><meta name="robots" content="noindex"><?php else: ?><meta name="robots" content="index, follow, max-image-preview:large"><?php endif; ?>
<link rel="canonical" href="<?= e($canonical) ?>">
<meta name="theme-color" content="#16181b">
<meta name="geo.region" content="GB-LBH">
<meta name="geo.placename" content="<?= e($site['area'] . ', London') ?>">
<meta name="geo.position" content="<?= e($site['lat'] . ';' . $site['lng']) ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e($site['name']) ?>">
<meta property="og:locale" content="en_GB">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e($pageDescription) ?>">
<meta property="og:image" content="<?= e($base) ?>/images/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="/favicon.png?v=2" type="image/png" sizes="192x192">
<link rel="shortcut icon" href="/favicon.ico?v=2">
<link rel="apple-touch-icon" href="/apple-touch-icon.png?v=2">
<link rel="preload" href="/fonts/archivo.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="/styles.css?v=<?= e((string) @filemtime(__DIR__ . '/../styles.css')) ?>">
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
</head>
<body class="<?= e($bodyClass) ?>">
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" data-header>
  <div class="wrap header-inner">
    <a class="brand" href="/" aria-label="<?= e($site['name']) ?> home">
      <img class="brand-logo" src="/images/logo-white-sm.png" width="320" height="277" alt="<?= e($site['name']) ?>, hair for men">
    </a>
    <nav class="nav" id="site-nav" aria-label="Main">
      <a href="/#services">Services</a>
      <a href="/#gallery">Gallery</a>
      <a href="/#visit">Visit</a>
      <?php if ($site['email'] !== ''): ?><a href="/#contact">Contact</a><?php endif; ?>
      <?php if ($site['booking_url'] !== ''): ?>
        <a class="nav-cta" href="<?= e($site['booking_url']) ?>" rel="noopener">Book now</a>
      <?php elseif ($site['phone'] !== ''): ?>
        <a class="nav-cta" href="<?= e(tel_link($site['phone'])) ?>">Call <?= e($site['phone']) ?></a>
      <?php else: ?>
        <a class="nav-cta" href="<?= e($site['maps_url']) ?>" rel="noopener">Directions</a>
      <?php endif; ?>
    </nav>
    <button class="menu-toggle" type="button" aria-controls="site-nav" aria-expanded="false" data-menu-toggle>
      <span class="menu-lines" aria-hidden="true"></span><span class="sr-only">Menu</span>
    </button>
  </div>
</header>
