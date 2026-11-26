<?php
declare(strict_types=1);
require __DIR__ . '/includes/functions.php';
header('Content-Type: application/xml; charset=UTF-8');
$base  = base_url();
$pages = ['/' => __DIR__ . '/index.php', '/privacy' => __DIR__ . '/privacy.php'];
echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php foreach ($pages as $path => $file): ?>
  <url>
    <loc><?= e($base . $path) ?></loc>
    <lastmod><?= date('Y-m-d', max((int) @filemtime($file), (int) @filemtime(__DIR__ . '/includes/config.php'))) ?></lastmod>
<?php if ($path === '/'): ?>
    <image:image><image:loc><?= e($base) ?>/images/hero.webp</image:loc></image:image>
<?php endif; ?>
  </url>
<?php endforeach; ?>
</urlset>
