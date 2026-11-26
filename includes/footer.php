<?php /** @var array $site */ ?>
<footer class="site-footer">
  <div class="wrap">
    <p class="footer-wordmark" aria-hidden="true"><?= e($site['name']) ?></p>
    <div class="footer-grid">
      <div>
        <h2>Visit</h2>
        <p><?= e($site['street']) ?><br><?= e($site['city'] . ' ' . $site['postcode']) ?></p>
        <p><a href="<?= e($site['maps_url']) ?>" rel="noopener">Get directions</a></p>
      </div>
      <?php if ($site['phone'] !== '' || $site['email'] !== ''): ?>
      <div>
        <h2>Contact</h2>
        <?php if ($site['phone'] !== ''): ?><p><a href="<?= e(tel_link($site['phone'])) ?>"><?= e($site['phone']) ?></a></p><?php endif; ?>
        <?php if ($site['email'] !== ''): ?><p><a href="/#contact">Send a message</a></p><?php endif; ?>
      </div>
      <?php endif; ?>
      <?php if ($site['instagram'] !== '' || $site['tiktok'] !== '' || ($site['facebook'] ?? '') !== ''): ?>
      <div>
        <h2>Follow</h2>
        <?php if ($site['instagram'] !== ''): ?><p><a href="<?= e($site['instagram']) ?>" rel="noopener">Instagram</a></p><?php endif; ?>
        <?php if (($site['facebook'] ?? '') !== ''): ?><p><a href="<?= e($site['facebook']) ?>" rel="noopener">Facebook</a></p><?php endif; ?>
        <?php if ($site['tiktok'] !== ''): ?><p><a href="<?= e($site['tiktok']) ?>" rel="noopener">TikTok</a></p><?php endif; ?>
      </div>
      <?php endif; ?>
      <div>
        <h2>Explore</h2>
        <p><a href="/#services">Services</a></p>
        <p><a href="/#gallery">Gallery</a></p>
        <p><a href="/privacy">Privacy</a></p>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© <?= date('Y') ?> <?= e($site['name']) ?></p>
    </div>
  </div>
</footer>

<?php if ($site['phone'] !== ''): ?>
<nav class="action-bar" aria-label="Quick actions">
  <a class="action-call" href="<?= e(tel_link($site['phone'])) ?>">Call</a>
  <a class="action-map" href="<?= e($site['maps_url']) ?>" rel="noopener">Directions</a>
</nav>
<?php endif; ?>

<dialog class="lightbox" data-lightbox aria-label="Photo">
  <button class="lightbox-close" type="button" data-lightbox-close aria-label="Close photo">×</button>
  <img src="" alt="" data-lightbox-img>
</dialog>
<script src="/site.js?v=<?= e((string) @filemtime(__DIR__ . '/../site.js')) ?>" defer></script>
</body>
</html>
