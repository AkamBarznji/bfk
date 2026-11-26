<?php
declare(strict_types=1);
require __DIR__ . '/includes/functions.php';
$pageTitle = 'Privacy notice | ' . $site['name'];
$pageDescription = 'How ' . $site['name'] . ' uses information sent through this website.';
$bodyClass = 'page';
require __DIR__ . '/includes/header.php';
?>
<main id="main" class="page-main">
  <div class="wrap prose">
    <h1>Privacy notice</h1>
    <p>This notice explains how <?= e($site['name']) ?>, <?= e(full_address($site)) ?>, uses information sent through this website.</p>
    <h2>What we collect</h2>
    <p>If you use the contact form, we receive your name, email address, phone number if you give it, and your message. We use these only to reply to you.</p>
    <h2>How long we keep it</h2>
    <p>Messages are kept in our email inbox for as long as needed to deal with your enquiry, and then deleted.</p>
    <h2>Other services</h2>
    <p>The map on this site is provided by Google Maps, which may set cookies when it loads. This site uses no analytics or advertising trackers. A session cookie protects the contact form from spam.</p>
    <h2>Your rights</h2>
    <p>You can ask us what information we hold about you, or ask us to delete it, by contacting the shop<?= $site['phone'] !== '' ? ' on ' . e($site['phone']) : '' ?> or visiting us at <?= e($site['street']) ?>.</p>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
