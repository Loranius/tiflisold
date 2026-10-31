(function () {
  'use strict';
  var calm = window.matchMedia('(prefers-reduced-motion: reduce)');

  // Каруселі: стрілки гортають на одну картку, смужка показує, скільки пройдено.
  document.querySelectorAll('[data-rail]').forEach(function (rail) {
    var track = rail.querySelector('.rail-track');
    var bar = rail.querySelector('.rail-progress span');
    var prev = rail.querySelector('[data-dir="-1"]'), next = rail.querySelector('[data-dir="1"]');
    var step = function () { var c = track.querySelector('li'); return c ? c.getBoundingClientRect().width + parseFloat(getComputedStyle(track).columnGap || 0) : track.clientWidth; };
    var sync = function () {
      var max = track.scrollWidth - track.clientWidth;
      var p = max > 0 ? track.scrollLeft / max : 1;
      if (bar) bar.style.transform = 'scaleX(' + Math.max(0.08, p) + ')';
      prev.disabled = track.scrollLeft <= 2;
      next.disabled = track.scrollLeft >= max - 2;
      rail.classList.toggle('is-static', max <= 2);
    };
    [prev, next].forEach(function (b) {
      b.addEventListener('click', function () {
        track.scrollBy({ left: step() * Number(b.dataset.dir), behavior: calm.matches ? 'auto' : 'smooth' });
      });
    });
    track.addEventListener('scroll', sync, { passive: true });
    window.addEventListener('resize', sync);
    sync();
  });

  // Картки «Для дому / бізнесу / поливу» відкривають калькулятор у потрібному режимі.
  document.querySelectorAll('[data-calc]').forEach(function (a) {
    a.addEventListener('click', function () {
      var r = document.querySelector('.calc-switch input[value="' + a.dataset.calc + '"]');
      if (r && !r.checked) { r.checked = true; r.dispatchEvent(new Event('change', { bubbles: true })); }
    });
  });

  // «+» на послузі веде до заявки й обирає цю послугу в «Що потрібно», якщо там ще нічого не обрано.
  document.querySelectorAll('[data-pick]').forEach(function (a) {
    a.addEventListener('click', function () {
      var cur = document.querySelector('#request-form input[name="object"]:checked');
      var r = document.querySelector('#request-form input[name="object"][value="' + a.dataset.pick + '"]');
      if (r && !cur) { r.checked = true; r.dispatchEvent(new Event('change', { bubbles: true })); }
    });
  });
})();

(function () {
  'use strict';
  var calm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Відблиск: шар світла всередині фотокарток (додаємо скриптом, щоб розмітка лишалась чистою)
  document.querySelectorAll('.way a, .svc-card, .phero, .hero').forEach(function (el) {
    var g = document.createElement('span'); g.className = 'glint'; g.setAttribute('aria-hidden', 'true');
    el.appendChild(g);
  });

  // Головний момент: дуга шляху сонця креслиться, сонце піднімається до полудня, по панелях проходить відблиск
  var hero = document.querySelector('.hero');
  var move = document.getElementById('sun-move');
  if (hero && move) {
    var svg = hero.querySelector('.sunpath');
    // На вузькому екрані бічні частини дуги обрізані — сонце зупиняється ближче до полудня, щоб його було видно
    if (window.matchMedia('(max-width: 45em)').matches) move.setAttribute('keyPoints', '0;0.54');
    if (calm || !move.beginElement) {
      try { svg.setCurrentTime(2.4); move.beginElement(); svg.setCurrentTime(2.4); svg.pauseAnimations(); } catch (e) {}
    } else {
      hero.classList.add('is-drawing');
      setTimeout(function () { move.beginElement(); }, 250);
      setTimeout(function () { hero.classList.add('is-lit'); }, 1500);
    }
  }
  var ph = document.querySelector('.phero');
  if (ph && !calm) setTimeout(function () { ph.classList.add('is-lit'); }, 300);

  // Стрічка етапів наповнюється енергією, поки читач іде по кроках (статично повна без JS чи з меншим рухом)
  var tl = document.querySelector('.timeline');
  if (tl && !calm && 'IntersectionObserver' in window) {
    var set = function () {
      var r = tl.getBoundingClientRect(), vh = window.innerHeight;
      var p = Math.min(1, Math.max(0, (vh * .7 - r.top) / r.height));
      tl.style.setProperty('--flow', p.toFixed(3));
    };
    var on = false;
    new IntersectionObserver(function (es) {
      if (es[0].isIntersecting && !on) { on = true; window.addEventListener('scroll', set, { passive: true }); set(); }
      else if (!es[0].isIntersecting && on) { on = false; window.removeEventListener('scroll', set); set(); }
    }).observe(tl);
    set();
  }
})();
