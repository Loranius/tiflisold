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

  // Заливка повзунків до положення ручки
  var fillRange = function (r) { r.style.setProperty('--p', (r.value - r.min) / (r.max - r.min) * 100 + '%'); };
  document.querySelectorAll('input[type=range]').forEach(function (r) {
    fillRange(r);
    r.addEventListener('input', function () { fillRange(r); });
  });

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
    var GEN = ['січня', 'лютого', 'березня', 'квітня', 'травня', 'червня', 'липня', 'серпня', 'вересня', 'жовтня', 'листопада', 'грудня'];
    var ACC = ['січень', 'лютий', 'березень', 'квітень', 'травень', 'червень', 'липень', 'серпень', 'вересень', 'жовтень', 'листопад', 'грудень'];
    // Типовий розподіл річної генерації по місяцях для Вінниччини (сума = 1)
    var F = [0.025, 0.045, 0.075, 0.11, 0.125, 0.13, 0.14, 0.125, 0.095, 0.07, 0.035, 0.025];
    var YIELD = 1150, EX_BILL = 20000, EX_TARIFF = 8;
    var chart = document.querySelector('.bill-chart');
    var mini = document.getElementById('bill-mini');
    var el = function (id) { return document.getElementById(id); };
    var bBill = el('b-bill'), bBillNum = el('b-bill-num'), bTariff = el('b-tariff'), bKw = el('b-kw');
    var mode = 'off';
    var mine = { bill: false, tariff: false, kw: false, share: false };
    var state = { bill: EX_BILL, tariff: EX_TARIFF };

    var build = function (box) {
      for (var m = 0; m < 12; m++) {
        var col = document.createElement('span');
        col.className = 'bcol';
        col.style.setProperty('--i', m);
        col.innerHTML = '<span class="bcol-ghost"></span><span class="bcol-sun"></span>';
        box.appendChild(col);
      }
      var cap = document.createElement('span');
      cap.className = 'cap-line';
      box.appendChild(cap);
    };
    build(cols); if (mini) build(mini);

    var round = function (n, st) { return Math.round(n / st) * st; };
    var num = function (v) { return Number(String(v).replace(/\s/g, '').replace(',', '.')); };

    var compute = function () {
      var kw = Number(bKw.value);
      var share = Number((document.querySelector('input[name=share]:checked') || {}).value || 0.6);
      var cap = state.bill / state.tariff * share;            // денне споживання, кВт·год/міс
      var months = F.map(function (f) {
        var gen = kw * YIELD * f;
        return { gen: gen, save: Math.min(gen, cap) * state.tariff, capped: gen >= cap };
      });
      var save = months.reduce(function (a, x) { return a + x.save; }, 0);
      return { bill: state.bill, tariff: state.tariff, kw: kw, share: share, months: months, save: save, gen: kw * YIELD };
    };

    var paint = function (box, r, on) {
      for (var i = 0; i < 12; i++) {
        var p = Math.min(100, r.months[i].save / r.bill * 100);
        box.children[i].style.setProperty('--sun', (on ? p : 0) + '%');
        box.children[i].style.setProperty('--ghost', (on ? 0 : p) + '%');
      }
      box.style.setProperty('--cap', (r.share * 100) + '%');
      box.classList.toggle('is-on', on);
    };

    var range = function (r) {
      var idx = r.months.map(function (x, i) { return x.capped ? i : -1; }).filter(function (i) { return i >= 0; });
      if (!idx.length) return '';
      return idx.length === 1 ? 'один місяць (' + ACC[idx[0]] + ')' : 'з ' + GEN[idx[0]] + ' по ' + ACC[idx[idx.length - 1]];
    };

    var render = function () {
      var r = compute();
      var pct = Math.round(r.save / (r.bill * 12) * 100);
      paint(cols, r, mode === 'on');
      if (mini) paint(mini, r, true);
      el('b-save').textContent = '≈ ' + fmt.format(round(r.save, 1000));
      el('b-save-label').textContent = 'Економія за рік · ' + (mine.bill && mine.tariff ? 'за вашими даними' : 'приклад');
      el('b-sentence').textContent = 'Це ≈ ' + pct + '% річного рахунку. Станція ' + r.kw + ' кВт дасть ≈ ' + fmt.format(round(r.gen, 100)) + ' кВт·год за рік.';
      el('b-kw-out').textContent = r.kw + ' кВт';
      var rg = range(r);
      el('bill-summary').innerHTML = mode === 'off'
        ? 'За рік <b>' + fmt.format(round(r.bill * 12, 1000)) + ' грн</b> за електроенергію, кожен місяць повністю з мережі.'
        : 'Станція закриває <b>≈ ' + fmt.format(round(r.save, 1000)) + ' грн</b> за рік' +
          (rg ? ': ' + rg + ' — всю денну частину споживання, взимку менше.' : ', найбільше влітку.');
      var parts = [
        'рахунок ' + fmt.format(r.bill) + ' грн/міс' + (mine.bill ? '' : ' (приклад)'),
        'тариф ' + String(r.tariff).replace('.', ',') + ' грн/кВт·год' + (mine.tariff ? '' : ' (приклад)'),
        'станція ' + r.kw + ' кВт' + (mine.kw ? '' : ' (приклад)'),
        '≈ ' + Math.round(r.share * 100) + '% споживання вдень' + (mine.share ? '' : ' (приклад)')
      ];
      var any = mine.bill || mine.tariff || mine.kw || mine.share;
      el('bill-note').textContent = (any ? 'Розрахунок: ' : 'Приклад, ілюстративно: ') + parts.join(', ') + '. Змініть дані в калькуляторі нижче.';
      document.querySelector('#bill-table tbody').innerHTML = r.months.map(function (x, i) {
        return '<tr><td>' + MONTHS[i] + '</td><td>' + fmt.format(round(r.bill, 10)) + '</td><td>' + fmt.format(round(r.bill - x.save, 10)) + '</td></tr>';
      }).join('');
      var set = function (id, ok, v) { var f = el(id); if (f && ok) f.value = v; };
      set('f-bill', mine.bill, r.bill); set('f-tariff', mine.tariff, String(r.tariff).replace('.', ',')); set('f-kw', mine.kw, r.kw);
    };

    var setBill = function (v, from) {
      if (!(v >= 1000)) return false;
      state.bill = v; mine.bill = true;
      if (from !== 'range') { bBill.value = Math.min(Number(bBill.max), Math.max(Number(bBill.min), v)); fillRange(bBill); }
      if (from !== 'num') bBillNum.value = v;
      el('b-bill-hint').textContent = 'Ваш рахунок: ' + fmt.format(v) + ' грн на місяць.';
      return true;
    };
    bBill.addEventListener('input', function () { setBill(Number(bBill.value), 'range'); render(); });
    bBillNum.addEventListener('input', function () { if (setBill(num(bBillNum.value), 'num')) render(); });
    bTariff.addEventListener('input', function () {
      var v = num(bTariff.value);
      var hint = el('b-tariff-hint');
      if (bTariff.value === '') { mine.tariff = false; state.tariff = EX_TARIFF; hint.textContent = 'Поки поле порожнє, рахуємо з прикладом 8 грн. Введіть тариф з рахунку.'; render(); return; }
      if (!(v >= 1 && v <= 30)) { hint.textContent = 'Введіть тариф від 1 до 30 грн за кВт·год. Поки рахуємо з останнім правильним значенням.'; return; }
      state.tariff = v; mine.tariff = true; hint.textContent = 'Ваш тариф: ' + String(v).replace('.', ',') + ' грн за кВт·год.'; render();
    });
    bKw.addEventListener('input', function () { mine.kw = true; render(); });
    document.querySelectorAll('input[name=share]').forEach(function (i) { i.addEventListener('change', function () { mine.share = true; render(); }); });
    bindToggle(function (md) { mode = md; chart.dataset.mode = md; render(); });
    if (form) form.addEventListener('enray:reset', render);
    if (reduce) { chart.classList.add('no-motion'); if (mini) mini.classList.add('no-motion'); }
    render();
  }
})();
