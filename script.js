/* ============================================================
   Parkhotel Horst — Vergaderen & Bijeenkomst
   Vanilla JS — Sliders, Filters, Animations
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* --- Hamburger Menu --- */
  const hamburger = document.querySelector('.hamburger');
  const mobileMenu = document.querySelector('.mobile-menu');
  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => {
      mobileMenu.classList.toggle('open');
      const spans = hamburger.querySelectorAll('span');
      if (mobileMenu.classList.contains('open')) {
        spans[0].style.transform = 'translateY(7px) rotate(45deg)';
        spans[1].style.opacity = '0';
        spans[2].style.transform = 'translateY(-7px) rotate(-45deg)';
      } else {
        spans.forEach(s => { s.style.transform = ''; s.style.opacity = ''; });
      }
    });
  }

  /* --- Generic Slider Setup --- */
  function initSlider(sliderEl, prevBtn, nextBtn, dotsContainer) {
    if (!sliderEl) return;

    const getCardWidth = () => {
      const card = sliderEl.querySelector('[class$="-card"], .arr-card');
      if (!card) return 0;
      const style = getComputedStyle(sliderEl);
      const gap = parseFloat(style.gap) || 24;
      return card.offsetWidth + gap;
    };

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        sliderEl.scrollBy({ left: -getCardWidth(), behavior: 'smooth' });
      });
    }
    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        sliderEl.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
      });
    }

    // Dots
    if (dotsContainer) {
      const cards = sliderEl.querySelectorAll('[class$="-card"], .arr-card');
      dotsContainer.innerHTML = '';
      cards.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'slider-dot' + (i === 0 ? ' active' : '');
        dot.addEventListener('click', () => {
          sliderEl.scrollTo({ left: i * getCardWidth(), behavior: 'smooth' });
        });
        dotsContainer.appendChild(dot);
      });

      sliderEl.addEventListener('scroll', () => {
        const dots = dotsContainer.querySelectorAll('.slider-dot');
        const idx = Math.round(sliderEl.scrollLeft / (getCardWidth() || 1));
        dots.forEach((d, i) => d.classList.toggle('active', i === idx));
      }, { passive: true });
    }
  }

  // Scenarios slider
  initSlider(
    document.querySelector('.scenarios-slider'),
    document.querySelector('#scenarios-prev'),
    document.querySelector('#scenarios-next'),
    document.querySelector('#scenarios-dots')
  );

  // Rooms slider
  initSlider(
    document.querySelector('.rooms-slider'),
    document.querySelector('#rooms-prev'),
    document.querySelector('#rooms-next'),
    document.querySelector('#rooms-dots')
  );

  // Reviews slider (manual scroll only)
  initSlider(
    document.querySelector('.reviews-slider'),
    document.querySelector('#reviews-prev'),
    document.querySelector('#reviews-next'),
    null
  );

  /* --- Breaks Filter --- */
  const filterTabs = document.querySelectorAll('.filter-tab');
  const breakCards = document.querySelectorAll('.break-card');

  filterTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      filterTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const filter = tab.dataset.filter;

      breakCards.forEach(card => {
        if (filter === 'alle' || card.dataset.cat === filter) {
          card.removeAttribute('data-hidden');
          card.style.display = '';
        } else {
          card.setAttribute('data-hidden', 'true');
          card.style.display = 'none';
        }
      });
    });
  });

  /* --- IntersectionObserver Fade-in --- */
  const fadeEls = document.querySelectorAll('.fade-in');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    fadeEls.forEach(el => observer.observe(el));
  } else {
    // Fallback: just show everything
    fadeEls.forEach(el => el.classList.add('visible'));
  }

  /* --- Sticky nav active link --- */
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-links a, .mobile-menu a');

  const navObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navLinks.forEach(link => {
          link.classList.toggle('active', link.getAttribute('href') === '#' + entry.target.id);
        });
      }
    });
  }, { threshold: 0.4 });
  sections.forEach(s => navObserver.observe(s));

});
