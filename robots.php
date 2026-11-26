<?php
declare(strict_types=1);
require __DIR__ . '/includes/functions.php';
header('Content-Type: text/plain; charset=UTF-8');
echo "User-agent: *\nAllow: /\nDisallow: /includes/\n\nSitemap: " . base_url() . "/sitemap.xml\n";
