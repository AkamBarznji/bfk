(() => {
  // Header: solid background once the page scrolls.
  const header = document.querySelector('[data-header]');
  const onScroll = () => header.classList.toggle('is-solid', window.scrollY > 40);
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  // Mobile menu.
  const toggle = document.querySelector('[data-menu-toggle]');
  const nav = document.getElementById('site-nav');
  const setMenu = (open) => {
    toggle.setAttribute('aria-expanded', String(open));
    document.body.classList.toggle('menu-open', open);
  };
  toggle.addEventListener('click', () => setMenu(toggle.getAttribute('aria-expanded') !== 'true'));
  nav.addEventListener('click', (e) => { if (e.target.closest('a')) setMenu(false); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });

  // Gallery lightbox.
  const box = document.querySelector('[data-lightbox]');
  const img = document.querySelector('[data-lightbox-img]');
  document.querySelectorAll('[data-full]').forEach((btn) => {
    btn.addEventListener('click', () => {
      img.src = btn.dataset.full;
      if (box.showModal) box.showModal(); else window.open(btn.dataset.full, '_blank');
    });
  });
  document.querySelector('[data-lightbox-close]').addEventListener('click', () => box.close());
  box.addEventListener('click', (e) => { if (e.target === box) box.close(); });
})();
