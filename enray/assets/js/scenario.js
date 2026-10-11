(function () {
  'use strict';

  var fmt = new Intl.NumberFormat('uk-UA');
  var fmt1 = new Intl.NumberFormat('uk-UA', { maximumFractionDigits: 1, minimumFractionDigits: 1 });
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var btns = document.querySelectorAll('.seg-btn');
  var form = document.getElementById('request-form');

  function bindToggle(onChange) {
    btns.forEach(function (b) {
      b.addEventListener('click', function () {
        btns.forEach(function (x) { x.setAttribute('aria-pressed', String(x === b)); });
        onChange(b.dataset.mode);
      });
    });
  }

  /* ---------- Дім: доба з відключеннями (приклад графіка, ілюстративно) ---------- */
  var cellsBox = document.getElementById('day-cells');
  if (cellsBox) {
    var OUTAGES = [[2, 6], [10, 14], [18, 22]];
    var SUN = [7, 18];                    // години, коли панелі дають енергію
    var strip = document.querySelector('.day-strip');
    var summary = document.getElementById('day-summary');
    var isOut = function (h) { return OUTAGES.some(function (o) { return h >= o[0] && h < o[1]; }); };
    var kind = function (h, mode) {
      if (!isOut(h)) return 'grid';
      if (mode === 'off') return 'dark';
      return h >= SUN[0] && h < SUN[1] ? 'sun' : 'bat';
    };
    for (var h = 0; h < 24; h++) {
      var c = document.createElement('span');
      c.className = 'cell cell--' + kind(h, 'off');
      c.style.setProperty('--i', h);
      cellsBox.appendChild(c);
    }
    var TEXT = {
      off: '<b>12 годин</b> без світла: котел, холодильник та інтернет вимикаються разом із мережею.',
      on: '<b>0 годин</b> без світла: вдень будинок живлять панелі, вночі акумулятор.'
    };
    bindToggle(function (mode) {
      strip.dataset.mode = mode;
      summary.innerHTML = TEXT[mode];
      for (var i = 0; i < cellsBox.children.length; i++) cellsBox.children[i].className = 'cell cell--' + kind(i, mode);
    });
    if (reduce) strip.classList.add('no-motion');

    // Резерв: енергія на нічні відключення і орієнтир АКБ
    var NIGHT_HOURS = OUTAGES.reduce(function (s, o) { return s + (o[0] >= SUN[0] && o[1] <= SUN[1] ? 0 : o[1] - o[0]); }, 0);
    var BATS = [5, 10, 15, 20, 25, 30];
    var loads = document.querySelectorAll('.loads input');
    var kwhOut = document.getElementById('rz-kwh');
    var batOut = document.getElementById('rz-bat');
    var fLoads = document.getElementById('f-loads');
    var calc = function () {
      var kw = 0, names = [];
      loads.forEach(function (i) { if (i.checked) { kw += Number(i.value); names.push(i.dataset.name); } });
      var kwh = kw * NIGHT_HOURS;
      var bat = BATS.find(function (b) { return b >= kwh * 1.25; });
      kwhOut.textContent = '≈ ' + fmt1.format(kwh);
      batOut.textContent = !names.length ? 'оберіть прилади' : bat ? 'від ' + bat + ' кВт·год' : 'понад 30 кВт·год';
      if (fLoads) { fLoads.value = names.join(', '); fLoads.style.height = 'auto'; fLoads.style.height = fLoads.scrollHeight + 'px'; }
    };
    if (kwhOut) {
      loads.forEach(function (i) { i.addEventListener('change', calc); });
      calc();
      if (form) form.addEventListener('enray:reset', calc);
    }
  }

  /* ---------- Бізнес: рахунок за рік без станції і зі станцією ---------- */
  var cols = document.getElementById('bill-cols');
  if (cols) {
    var MONTHS = ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'];
    // Типовий розподіл річної генерації по місяцях для Вінниччини (сума = 1)
    var F = [0.025, 0.045, 0.075, 0.11, 0.125, 0.13, 0.14, 0.125, 0.095, 0.07, 0.035, 0.025];
    var YIELD = 1150;
    var chart = document.querySelector('.bill-chart');
    var sumOut = document.getElementById('bill-summary');
    var noteOut = document.getElementById('bill-note');
    var tbody = document.querySelector('#bill-table tbody');
    var el = function (id) { return document.getElementById(id); };
    var bBill = el('b-bill'), bTariff = el('b-tariff'), bKw = el('b-kw');
    var mode = 'off', touched = false;

    for (var m = 0; m < 12; m++) {
      var col = document.createElement('span');
      col.className = 'bcol';
      col.style.setProperty('--i', m);
      col.innerHTML = '<span class="bcol-sun"></span>';
      cols.appendChild(col);
    }

    var round = function (n, s) { return Math.round(n / s) * s; };
    var compute = function () {
      var bill = Number(bBill.value);
      var tariff = Math.max(0.5, Number(String(bTariff.value).replace(',', '.')) || 8);
      var kw = Number(bKw.value);
      var share = Number((document.querySelector('input[name=share]:checked') || {}).value || 0.6);
      var cons = bill / tariff;                 // кВт·год на місяць
      var months = F.map(function (f) {
        var gen = kw * YIELD * f;
        var used = Math.min(gen, cons * share);
        return { gen: gen, save: used * tariff };
      });
      var save = months.reduce(function (s, x) { return s + x.save; }, 0);
      return { bill: bill, tariff: tariff, kw: kw, share: share, months: months, save: save, gen: kw * YIELD };
    };

    var render = function () {
      var r = compute();
      el('b-bill-out').textContent = fmt.format(r.bill) + ' грн';
      el('b-kw-out').textContent = r.kw + ' кВт';
      el('b-save').textContent = '≈ ' + fmt.format(round(r.save, 1000));
      el('b-share-out').textContent = '≈ ' + Math.round(r.save / (r.bill * 12) * 100) + '%';
      el('b-gen').textContent = '≈ ' + fmt.format(round(r.gen, 100)) + ' кВт·год';
      var pct = function (v) { return Math.min(100, v / r.bill * 100); };
      for (var i = 0; i < 12; i++) cols.children[i].style.setProperty('--sun', (mode === 'on' ? pct(r.months[i].save) : 0) + '%');
      sumOut.innerHTML = mode === 'off'
        ? 'За рік <b>' + fmt.format(round(r.bill * 12, 1000)) + ' грн</b> за електроенергію, кожен місяць повністю з мережі.'
        : 'Станція закриває <b>≈ ' + fmt.format(round(r.save, 1000)) + ' грн</b> за рік, найбільше в теплі місяці, коли сонця більше.';
      noteOut.textContent = (touched ? 'За вашими даними: ' : 'Приклад, ілюстративно: ') + 'рахунок ' + fmt.format(r.bill) + ' грн/міс, тариф ' +
        String(r.tariff).replace('.', ',') + ' грн/кВт·год, станція ' + r.kw + ' кВт, ≈ ' + Math.round(r.share * 100) +
        '% споживання вдень. Змініть дані в калькуляторі нижче.';
      tbody.innerHTML = r.months.map(function (x, i) {
        return '<tr><td>' + MONTHS[i] + '</td><td>' + fmt.format(round(r.bill, 10)) + '</td><td>' + fmt.format(round(r.bill - x.save, 10)) + '</td></tr>';
      }).join('');
      var set = function (id, v) { var f = el(id); if (f) f.value = v; };
      set('f-bill', r.bill); set('f-tariff', String(r.tariff).replace('.', ',')); set('f-kw', r.kw);
    };

    bindToggle(function (md) { mode = md; chart.dataset.mode = md; render(); });
    [bBill, bTariff, bKw].forEach(function (i) { i.addEventListener('input', function () { touched = true; render(); }); });
    document.querySelectorAll('input[name=share]').forEach(function (i) { i.addEventListener('change', function () { touched = true; render(); }); });
    if (form) form.addEventListener('enray:reset', render);
    if (reduce) chart.classList.add('no-motion');
    render();
  }
})();
