<?php
declare(strict_types=1);
require __DIR__ . '/includes/functions.php';

$contact = ['ok' => false, 'errors' => [], 'old' => []];
if ($site['email'] !== '') {
    start_session(); // must run before any output so the session cookie is sent
    $contact = handle_contact($site);
    if ($contact['ok']) {
        header('Location: /?sent=1#contact', true, 303);
        exit;
    }
}
$sent = isset($_GET['sent']);
$bodyClass = 'home';
require __DIR__ . '/includes/header.php';
$old = $contact['old'];
$err = $contact['errors'];
?>
<main id="main">

  <section class="hero" aria-labelledby="hero-title">
    <picture class="hero-photo">
      <source media="(max-width: 700px)" srcset="/images/hero-sm.webp">
      <img src="/images/hero.webp" width="2400" height="1600" alt="" fetchpriority="high">
    </picture>
    <div class="wrap hero-inner">
      <p class="hero-place"><?= e($site['street']) ?>, <?= e($site['area']) ?></p>
      <?php if ($status = open_status($site)): ?>
        <p class="open-status <?= $status['open'] ? 'is-open' : 'is-closed' ?>"><span class="open-dot" aria-hidden="true"></span><?= e($status['text']) ?></p>
      <?php endif; ?>
      <h1 id="hero-title" class="hero-title">
        <span class="hero-line">iStyle</span>
        <span class="hero-line">Barbers</span>
      </h1>
      <p class="hero-lede">Barber in Streatham, south London. Sharp cuts, clean fades and proper beard work on Streatham High Road.</p>
      <div class="actions">
        <?php if ($site['booking_url'] !== ''): ?>
          <a class="button" href="<?= e($site['booking_url']) ?>" rel="noopener">Book an appointment</a>
        <?php elseif ($site['phone'] !== ''): ?>
          <a class="button" href="<?= e(tel_link($site['phone'])) ?>">Call the shop</a>
        <?php else: ?>
          <a class="button" href="<?= e($site['maps_url']) ?>" rel="noopener">Get directions</a>
        <?php endif; ?>
        <a class="button outline-light" href="#services">See services</a>
      </div>
    </div>

    <div class="street-sign" aria-hidden="true">
      <span class="street-borough"><?= e($site['borough']) ?></span>
      <span class="street-name">Streatham High Road</span>
      <span class="street-district">SW16</span>
      <span class="street-number">71</span>
    </div>
  </section>

  <section class="quick-info" aria-label="Opening hours, phone and address">
    <div class="wrap quick-grid">
      <?php if (has_hours($site)): ?>
      <a class="quick-item" href="#visit">
        <span class="quick-label">Opening hours</span>
        <?php foreach (hours_summary($site) as $line): ?><span class="quick-value"><?= e($line) ?></span><?php endforeach; ?>
      </a>
      <?php endif; ?>
      <?php if ($site['phone'] !== ''): ?>
      <a class="quick-item" href="<?= e(tel_link($site['phone'])) ?>">
        <span class="quick-label">Call the shop</span>
        <span class="quick-value big"><?= e($site['phone']) ?></span>
      </a>
      <?php endif; ?>
      <a class="quick-item" href="<?= e($site['maps_url']) ?>" rel="noopener">
        <span class="quick-label">Find us</span>
        <span class="quick-value"><?= e($site['street']) ?></span>
        <span class="quick-value"><?= e($site['city'] . ' ' . $site['postcode']) ?></span>
      </a>
    </div>
  </section>

  <section class="intro" aria-labelledby="intro-title">
    <div class="wrap intro-inner">
      <figure class="intro-photo">
        <img src="/images/g1.webp" width="1000" height="1330" alt="Barber shaping a fade with clippers" loading="lazy">
      </figure>
      <div class="intro-copy">
        <h2 id="intro-title">Your barber on the High Road.</h2>
        <p>Walk down Streatham High Road and you'll find us at number 71. We cut men's and boys' hair with care, from a quick line-up to a full skin fade and beard shape.</p>
        <div class="actions intro-actions">
          <a class="button dark" href="#services">See our services</a>
          <a class="text-link" href="#gallery">View the gallery</a>
        </div>
      </div>
    </div>
  </section>

  <section id="services" class="services" aria-labelledby="services-title">
    <div class="wrap">
      <div class="section-head">
        <div>
          <h2 id="services-title">Services</h2>
          <p class="services-intro">Men's and boys' haircuts, fades, beard trims and shaves at 71 Streatham High Road.</p>
        </div>
        <?php if (!array_filter(array_column($site['services'], 'price'))): ?>
          <p>Ask in the shop for today's prices.</p>
        <?php endif; ?>
      </div>
      <ul class="service-grid">
        <?php foreach ($site['services'] as $service): ?>
          <li class="service-card">
            <img src="/images/<?= e($service['image']) ?>.webp"<?= img_size('/images/' . $service['image'] . '.webp') ?> alt="<?= e($service['name']) ?> at a barber shop" loading="lazy">
            <div class="service-body">
              <div class="service-top">
                <h3><?= e($service['name']) ?></h3>
                <?php if ($service['price'] !== ''): ?><span class="service-price"><?= e($service['price']) ?></span><?php endif; ?>
              </div>
              <p><?= e($service['text']) ?></p>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section id="gallery" class="gallery" aria-labelledby="gallery-title">
    <div class="wrap">
      <div class="section-head">
        <h2 id="gallery-title">Gallery</h2>
        <p>Tap a photo to see it larger.</p>
      </div>
      <div class="gallery-grid">
        <?php foreach ($site['gallery'] as $i => $photo): ?>
          <button class="gallery-item" type="button" data-full="/images/<?= e($photo) ?>.webp" aria-label="Open photo <?= $i + 1 ?>">
            <img src="/images/<?= e($photo) ?>.webp"<?= img_size('/images/' . $photo . '.webp') ?> alt="" loading="lazy">
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section id="visit" class="visit" aria-labelledby="visit-title">
    <div class="wrap visit-inner">
      <div class="visit-copy">
        <h2 id="visit-title">Visit the shop</h2>
        <address>
          <?= e($site['name']) ?><br>
          <?= e($site['street']) ?><br>
          <?= e($site['city'] . ' ' . $site['postcode']) ?>
        </address>
        <?php if ($site['phone'] !== ''): ?>
          <p class="visit-phone"><a href="<?= e(tel_link($site['phone'])) ?>"><?= e($site['phone']) ?></a></p>
        <?php endif; ?>
        <?php if (has_hours($site)): ?>
          <table class="hours">
            <caption>Opening hours</caption>
            <?php $today = date('l'); foreach ($site['hours'] as $day => $time): ?>
              <tr<?= $day === $today ? ' class="is-today"' : '' ?>><th scope="row"><?= e($day) ?></th><td><?= e($time !== '' ? $time : '—') ?></td></tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
        <a class="button" href="<?= e($site['maps_url']) ?>" rel="noopener">Get directions</a>
      </div>
      <div class="map">
        <iframe title="Map showing <?= e($site['name']) ?> at <?= e(full_address($site)) ?>" src="<?= e(map_embed_url($site)) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

  <?php if ($site['email'] !== ''): ?>
  <section id="contact" class="contact" aria-labelledby="contact-title">
    <div class="wrap contact-inner">
      <div>
        <h2 id="contact-title">Send us a message</h2>
        <p>Questions about a cut or group booking? Write to us and we'll reply by email.</p>
      </div>
      <form class="contact-form" method="post" action="/#contact" novalidate>
        <?php if ($sent): ?><p class="form-status ok" role="status">Message sent. We'll reply by email.</p><?php endif; ?>
        <?php if (isset($err['form'])): ?><p class="form-status error" role="alert"><?= e($err['form']) ?></p><?php endif; ?>
        <input type="hidden" name="form" value="contact">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <div class="hp" aria-hidden="true"><label for="website">Website</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>
        <div class="field-row">
          <div class="field">
            <label for="name">Name</label>
            <input id="name" name="name" autocomplete="name" maxlength="100" required value="<?= e($old['name'] ?? '') ?>"<?= isset($err['name']) ? ' aria-invalid="true" aria-describedby="name-err"' : '' ?>>
            <?php if (isset($err['name'])): ?><p class="field-error" id="name-err"><?= e($err['name']) ?></p><?php endif; ?>
          </div>
          <div class="field">
            <label for="phone">Phone <span>(optional)</span></label>
            <input id="phone" name="phone" type="tel" autocomplete="tel" maxlength="20" value="<?= e($old['phone'] ?? '') ?>"<?= isset($err['phone']) ? ' aria-invalid="true" aria-describedby="phone-err"' : '' ?>>
            <?php if (isset($err['phone'])): ?><p class="field-error" id="phone-err"><?= e($err['phone']) ?></p><?php endif; ?>
          </div>
        </div>
        <div class="field">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" autocomplete="email" maxlength="254" required value="<?= e($old['email'] ?? '') ?>"<?= isset($err['email']) ? ' aria-invalid="true" aria-describedby="email-err"' : '' ?>>
          <?php if (isset($err['email'])): ?><p class="field-error" id="email-err"><?= e($err['email']) ?></p><?php endif; ?>
        </div>
        <div class="field">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="5" maxlength="3000" required<?= isset($err['message']) ? ' aria-invalid="true" aria-describedby="message-err"' : '' ?>><?= e($old['message'] ?? '') ?></textarea>
          <?php if (isset($err['message'])): ?><p class="field-error" id="message-err"><?= e($err['message']) ?></p><?php endif; ?>
        </div>
        <button class="button" type="submit">Send message</button>
        <p class="form-note">We only use your details to reply. See our <a href="/privacy">privacy notice</a>.</p>
      </form>
    </div>
  </section>
  <?php endif; ?>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
