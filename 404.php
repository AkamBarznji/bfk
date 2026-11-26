<?php
declare(strict_types=1);
require __DIR__ . '/includes/functions.php';
http_response_code(404);
$pageTitle = 'Page not found | ' . $site['name'];
$bodyClass = 'page';
$noindex = true;
require __DIR__ . '/includes/header.php';
?>
<main id="main" class="page-main">
  <div class="wrap not-found">
    <p class="not-found-code" aria-hidden="true">404</p>
    <h1>This page doesn't exist.</h1>
    <p>Check the address, or head back to the homepage.</p>
    <div class="actions"><a class="button" href="/">Back to homepage</a></div>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
