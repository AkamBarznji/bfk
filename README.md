# iStyle Barbers website

PHP site. All shop details (phone, email, hours, prices, booking link, social links)
live in `includes/config.php`. Leave a value empty to hide it on the site.

- `index.php` homepage, `privacy.php`, `404.php`
- `includes/` shared header, footer, helpers (blocked from the web by `.htaccess`)
- `styles.css`, `site.js`, `images/`, `fonts/` (Archivo, SIL Open Font License)
- Photos: Unsplash licence. Replace with real shop photos in `images/` using the same file names.

The contact form uses PHP `mail()`; the server needs working mail delivery.
