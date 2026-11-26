<?php
/** @var array $site @var string $pageTitle @var string $pageDescription @var string $bodyClass */
$pageTitle       = $pageTitle ?? $site['name'] . ' | Barber shop in ' . $site['area'] . ', ' . $site['postcode'];
$pageDescription = $pageDescription ?? $site['name'] . ' is a men\'s barber shop at ' . full_address($site) . '. Haircuts, skin fades and beard trims in ' . $site['area'] . '.';
$bodyClass       = $bodyClass ?? '';
$schema = [
    '@context' => 'https://schema.org',
    '@type'    => 'BarberShop',
    'name'     => $site['name'],
    'image'    => '/images/hero.webp',
    'address'  => [
        '@type' => 'PostalAddress',
        'streetAddress'   => $site['street'],
        'addressLocality' => $site['city'],
        'postalCode'      => $site['postcode'],
        'addressCountry'  => 'GB',
    ],
    'geo'    => ['@type' => 'GeoCoordinates', 'latitude' => $site['lat'], 'longitude' => $site['lng']],
    'hasMap' => $site['maps_url'],
];
if ($site['phone'] !== '') { $schema['telephone'] = $site['phone']; }
?>
<!doctype html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDescription) ?>">
<meta name="theme-color" content="#16181b">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($site['name'] . ', ' . $site['area']) ?>">
<meta property="og:description" content="<?= e($pageDescription) ?>">
<meta property="og:image" content="/images/hero.webp">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="preload" href="/fonts/archivo.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="/styles.css?v=<?= e((string) @filemtime(__DIR__ . '/../styles.css')) ?>">
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
</head>
<body class="<?= e($bodyClass) ?>">
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" data-header>
  <div class="wrap header-inner">
    <a class="brand" href="/" aria-label="<?= e($site['name']) ?> home">
      <span class="brand-mark" aria-hidden="true">iS</span>
      <span class="brand-name"><?= e($site['name']) ?></span>
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
