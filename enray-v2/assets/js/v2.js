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
