/* ============================================================
   Parkhotel Horst — script.js
   Handles: nav scroll shadow, menu overlay, sliders, fade-in,
            filter tabs, touch swipe
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  // ============================================================
  // NAV: sticky shadow on scroll
  // ============================================================
  const nav = document.getElementById('nav');
  window.addEventListener('scroll', () => {
    if (nav) {
      nav.style.boxShadow = window.scrollY > 10
        ? '0 4px 24px rgba(0,0,0,0.15)'
        : '0 2px 12px rgba(0,0,0,0.08)';
    }
  });

  // ============================================================
  // MENU OVERLAY
  // ============================================================
  const menuToggle  = document.getElementById('menuToggle');
  const menuOverlay = document.getElementById('menuOverlay');
  const menuClose   = document.getElementById('menuClose');

  const openMenu  = () => menuOverlay?.classList.add('open');
  const closeMenu = () => menuOverlay?.classList.remove('open');

  menuToggle?.addEventListener('click', openMenu);
  menuClose?.addEventListener('click', closeMenu);
  menuOverlay?.addEventListener('click', (e) => {
    if (e.target === menuOverlay) closeMenu();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMenu();
  });

  // ============================================================
  // GENERIC SLIDER FACTORY
  // ============================================================
  function makeSlider({ trackId, prevId, nextId, counterId, getCount }) {
    const track   = document.getElementById(trackId);
    const prev    = document.getElementById(prevId);
    const next    = document.getElementById(nextId);
    const counter = document.getElementById(counterId);
    if (!track || !prev || !next) return;

    let current = 0;

    function getSlideWidth() {
      const first = track.children[0];
      if (!first) return 0;
      const style = window.getComputedStyle(track);
      const gap   = parseFloat(style.gap) || 0;
      return first.offsetWidth + gap;
    }

    function getTotal() {
      return typeof getCount === 'function'
        ? getCount()
        : track.children.length;
    }

    function update() {
      const total = getTotal();
      const offset = current * getSlideWidth();
      track.style.transform = `translateX(-${offset}px)`;
      if (counter) counter.textContent = `${current + 1}/${total}`;
    }

    prev.addEventListener('click', () => {
      const total = getTotal();
      current = (current - 1 + total) % total;
      update();
    });

    next.addEventListener('click', () => {
      const total = getTotal();
      current = (current + 1) % total;
      update();
    });

    // Touch / swipe
    let startX = 0;
    let dragging = false;

    track.addEventListener('touchstart', (e) => {
      startX   = e.touches[0].clientX;
      dragging = true;
    }, { passive: true });

    track.addEventListener('touchend', (e) => {
      if (!dragging) return;
      dragging = false;
      const diff = startX - e.changedTouches[0].clientX;
      const total = getTotal();
      if (Math.abs(diff) > 50) {
        current = diff > 0
          ? (current + 1) % total
          : (current - 1 + total) % total;
        update();
      }
    }, { passive: true });

    // Init
    update();

    // Re-update on resize
    window.addEventListener('resize', () => update());
  }

  // ============================================================
  // SCENARIOS SLIDER (4 cards, show window ~3)
  // ============================================================
  makeSlider({
    trackId:   'scenariosTrack',
    prevId:    'scenariosPrev',
    nextId:    'scenariosNext',
    counterId: 'scenariosCounter',
    getCount:  () => document.querySelectorAll('#scenariosTrack .scenario-card').length,
  });

  // ============================================================
  // ROOMS SLIDER (full rows)
  // ============================================================
  (function() {
    const track   = document.getElementById('roomsTrack');
    const prev    = document.getElementById('roomsPrev');
    const next    = document.getElementById('roomsNext');
    const counter = document.getElementById('roomsCounter');
    if (!track) return;

    let current = 0;
    const rows = track.querySelectorAll('.rooms__row');
    const total = rows.length;

    function update() {
      const h = rows[0]?.offsetHeight || 0;
      track.style.transform = `translateY(-${current * h}px)`;
      if (counter) counter.textContent = `${current + 1}/${total}`;
    }

    prev?.addEventListener('click', () => {
      current = (current - 1 + total) % total;
      update();
    });

    next?.addEventListener('click', () => {
      current = (current + 1) % total;
      update();
    });

    // Touch
    let startY = 0;
    track.addEventListener('touchstart', (e) => { startY = e.touches[0].clientY; }, { passive: true });
    track.addEventListener('touchend', (e) => {
      const diff = startY - e.changedTouches[0].clientY;
      if (Math.abs(diff) > 50) {
        current = diff > 0
          ? (current + 1) % total
          : (current - 1 + total) % total;
        update();
      }
    }, { passive: true });

    update();
    window.addEventListener('resize', update);
  })();

  // ============================================================
  // REVIEWS SLIDER
  // ============================================================
  makeSlider({
    trackId:   'reviewsTrack',
    prevId:    'reviewsPrev',
    nextId:    'reviewsNext',
    counterId: 'reviewsCounter',
    getCount:  () => document.querySelectorAll('#reviewsTrack > *').length,
  });

  // ============================================================
  // FILTER TABS (breaks section)
  // ============================================================
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('filter-btn--active'));
      btn.classList.add('filter-btn--active');
      // In real implementation, filter cards. For now, just toggle active state.
    });
  });

  // ============================================================
  // FADE-IN ON SCROLL — Intersection Observer
  // ============================================================
  const fadeEls = document.querySelectorAll('.fade-in');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );

    fadeEls.forEach((el, i) => {
      el.style.transitionDelay = `${i * 0.05}s`;
      observer.observe(el);
    });
  } else {
    // Fallback: show all immediately
    fadeEls.forEach(el => el.classList.add('visible'));
  }

});
