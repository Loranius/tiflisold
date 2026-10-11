(function () {
  'use strict';

  var fmt1 = new Intl.NumberFormat('uk-UA', { maximumFractionDigits: 1, minimumFractionDigits: 1 });
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Доба з відключеннями: приклад графіка (ілюстративно)
  var OUTAGES = [[2, 6], [10, 14], [18, 22]];
  var SUN = [7, 19];                      // години, коли панелі дають енергію
  var cellsBox = document.getElementById('day-cells');
  var strip = document.querySelector('.day-strip');
  var summary = document.getElementById('day-summary');
  var btns = document.querySelectorAll('.seg-btn');

  function isOut(h) { return OUTAGES.some(function (o) { return h >= o[0] && h < o[1]; }); }
  function kind(h, mode) {
    if (!isOut(h)) return mode === 'on' && h >= SUN[0] && h < SUN[1] ? 'grid sun' : 'grid';
    if (mode === 'off') return 'dark';
    return h >= SUN[0] && h < SUN[1] ? 'sun' : 'bat';
  }

  if (cellsBox) {
    for (var h = 0; h < 24; h++) {
      var c = document.createElement('span');
      c.className = 'cell cell--' + kind(h, 'off').split(' ')[0];
      c.style.setProperty('--i', h);
      cellsBox.appendChild(c);
    }
  }

  var TEXT = {
    off: '<b>12 годин</b> без світла: котел, холодильник та інтернет вимикаються разом із мережею.',
    on: '<b>0 годин</b> без світла: вдень будинок живлять панелі, вночі акумулятор.'
  };

  function setMode(mode) {
    btns.forEach(function (b) { b.setAttribute('aria-pressed', String(b.dataset.mode === mode)); });
    strip.dataset.mode = mode;
    summary.innerHTML = TEXT[mode];
    var cells = cellsBox.children;
    for (var h = 0; h < cells.length; h++) {
      var k = kind(h, mode).split(' ');
      cells[h].className = 'cell cell--' + k[0] + (k[1] ? ' cell--sunlit' : '');
    }
  }
  btns.forEach(function (b) { b.addEventListener('click', function () { setMode(b.dataset.mode); }); });

  // Резерв: енергія на нічні відключення і орієнтир АКБ
  var NIGHT_HOURS = OUTAGES.reduce(function (s, o) { return s + (o[0] >= SUN[0] && o[1] <= SUN[1] ? 0 : o[1] - o[0]); }, 0);
  var BATS = [5, 10, 15, 20, 25, 30];
  var loads = document.querySelectorAll('.loads input');
  var kwhOut = document.getElementById('rz-kwh');
  var batOut = document.getElementById('rz-bat');
  var fLoads = document.getElementById('f-loads');

  function calc() {
    var kw = 0, names = [];
    loads.forEach(function (i) { if (i.checked) { kw += Number(i.value); names.push(i.dataset.name); } });
    var kwh = kw * NIGHT_HOURS;
    var need = kwh * 1.25;
    var bat = BATS.find(function (b) { return b >= need; });
    kwhOut.textContent = '≈ ' + fmt1.format(kwh);
    batOut.textContent = !names.length ? 'оберіть прилади' : bat ? 'від ' + bat + ' кВт·год' : 'понад 30 кВт·год';
    if (fLoads) fLoads.value = names.join(', ');
  }
  loads.forEach(function (i) { i.addEventListener('change', calc); });
  if (kwhOut) calc();

  var form = document.getElementById('request-form');
  if (form) form.addEventListener('enray:reset', calc);

  if (reduce && strip) strip.classList.add('no-motion');
})();
