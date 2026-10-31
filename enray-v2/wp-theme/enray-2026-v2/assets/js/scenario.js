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
    var loadsTouched = false; // у форму лише вибір відвідувача, не стартовий набір
    var calc = function () {
      var kw = 0, names = [];
      loads.forEach(function (i) { if (i.checked) { kw += Number(i.value); names.push(i.dataset.name); } });
      var kwh = kw * NIGHT_HOURS;
      var bat = BATS.find(function (b) { return b >= kwh * 1.25; });
      kwhOut.textContent = '≈ ' + fmt1.format(kwh);
      batOut.textContent = !names.length ? 'оберіть прилади' : bat ? 'від ' + bat + ' кВт·год' : 'понад 30 кВт·год';
      if (fLoads && loadsTouched) { fLoads.value = names.join(', '); fLoads.style.height = 'auto'; fLoads.style.height = fLoads.scrollHeight + 'px'; }
    };
    if (kwhOut) {
      loads.forEach(function (i) { i.addEventListener('change', function () { loadsTouched = true; calc(); }); });
      calc();
      if (form) form.addEventListener('enray:reset', function () { loadsTouched = false; calc(); });
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
        col.innerHTML = '<span class="bcol-sun"></span>';
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
      var any = mine.bill || mine.tariff || mine.kw || mine.share;
      var tag = function (own) { return any && !own ? ' (приклад)' : ''; };
      var parts = [
        'рахунок ' + fmt.format(r.bill) + ' грн/міс' + tag(mine.bill),
        'тариф ' + String(r.tariff).replace('.', ',') + ' грн/кВт·год' + tag(mine.tariff),
        'станція ' + r.kw + ' кВт' + tag(mine.kw),
        '≈ ' + Math.round(r.share * 100) + '% споживання вдень' + tag(mine.share)
      ];
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
    var liveB = function () { chart.classList.add('is-live'); if (mini) mini.classList.add('is-live'); };
    [bBill, bBillNum, bTariff, bKw].forEach(function (i) { i.addEventListener('input', liveB); });
    document.querySelectorAll('input[name=share]').forEach(function (i) { i.addEventListener('change', liveB); });
    bindToggle(function (md) { mode = md; chart.dataset.mode = md; chart.classList.remove('is-live'); render(); });
    if (form) form.addEventListener('enray:reset', render);
    if (reduce) { chart.classList.add('no-motion'); if (mini) mini.classList.add('no-motion'); }
    render();
  }
  /* ---------- Агро: енергія насосів у сезон поливу ---------- */
  var sCols = document.getElementById('season-cols');
  if (sCols) {
    var MN = ['січень', 'лютий', 'березень', 'квітень', 'травень', 'червень', 'липень', 'серпень', 'вересень', 'жовтень', 'листопад', 'грудень'];
    var MG = ['січня', 'лютого', 'березня', 'квітня', 'травня', 'червня', 'липня', 'серпня', 'вересня', 'жовтня', 'листопада', 'грудня'];
    var ML = ['січні', 'лютому', 'березні', 'квітні', 'травні', 'червні', 'липні', 'серпні', 'вересні', 'жовтні', 'листопаді', 'грудні'];
    var DAYS = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var FA = [0.025, 0.045, 0.075, 0.11, 0.125, 0.13, 0.14, 0.125, 0.095, 0.07, 0.035, 0.025];
    var YA = 1150;
    var g = function (id) { return document.getElementById(id); };
    var aPump = g('a-pump'), aHours = g('a-hours'), aFrom = g('a-from'), aTo = g('a-to'), aKw = g('a-kw');
    var sChart = document.querySelector('.season-chart'), sMini = g('season-mini');
    var aMode = 'off';
    var own = { pump: false, hours: false, season: false, kw: false };
    MN.forEach(function (m, i) {
      aFrom.add(new Option(m.charAt(0).toUpperCase() + m.slice(1), i));
      aTo.add(new Option(m.charAt(0).toUpperCase() + m.slice(1), i));
    });
    aFrom.value = 3; aTo.value = 8;

    var mk = function (box) {
      for (var m = 0; m < 12; m++) {
        var c = document.createElement('span');
        c.className = 'scol';
        c.style.setProperty('--i', m);
        c.innerHTML = '<span class="scol-need"><span class="bcol-sun"></span></span><span class="gen-mark"></span>';
        box.appendChild(c);
      }
    };
    mk(sCols); if (sMini) mk(sMini);

    var inSeason = function (m, a, b) { return a <= b ? m >= a && m <= b : m >= a || m <= b; };
    var calcA = function () {
      var pump = Number(aPump.value), hours = Number(aHours.value), kw = Number(aKw.value);
      var a = Number(aFrom.value), b = Number(aTo.value);
      var months = DAYS.map(function (d, m) {
        var on = inSeason(m, a, b);
        var need = on ? pump * hours * d : 0;
        var gen = kw * YA * FA[m];
        return { on: on, need: need, gen: gen, cover: Math.min(need, gen), full: on && gen >= need, kwNeed: on ? need / (YA * FA[m]) : 0 };
      });
      var need = months.reduce(function (s, x) { return s + x.need; }, 0);
      var cover = months.reduce(function (s, x) { return s + x.cover; }, 0);
      var kwFull = Math.ceil(Math.max.apply(null, months.map(function (x) { return x.kwNeed; })) / 5) * 5;
      var weakest = months.reduce(function (w, x, i) { return x.on && (w < 0 || x.kwNeed > months[w].kwNeed) ? i : w; }, -1);
      return { pump: pump, hours: hours, kw: kw, a: a, b: b, months: months, need: need, cover: cover, kwFull: kwFull, weakest: weakest };
    };

    var paintA = function (box, r, on) {
      var max = Math.max.apply(null, r.months.map(function (x) { return x.need; })) || 1;
      for (var i = 0; i < 12; i++) {
        var x = r.months[i], col = box.children[i];
        col.classList.toggle('is-idle', !x.on);
        col.style.setProperty('--need', (x.need / max * 100) + '%');
        col.style.setProperty('--sun', (on && x.need ? x.cover / x.need * 100 : 0) + '%');
        col.style.setProperty('--gen', Math.min(100, x.gen / max * 100) + '%');
        col.classList.toggle('is-weak', on && i === r.weakest && r.months[i].cover < r.months[i].need);
      }
    };

    var renderA = function () {
      var r = calcA();
      var pct = r.need ? Math.round(r.cover / r.need * 100) : 0;
      paintA(sCols, r, aMode === 'on');
      sCols.classList.toggle('is-on', aMode === 'on');
      if (sMini) paintA(sMini, r, true);
      g('a-pump-out').textContent = r.pump + ' кВт';
      g('a-hours-out').textContent = r.hours + ' год';
      g('a-kw-out').textContent = r.kw + ' кВт';
      g('a-cover').textContent = '≈ ' + pct;
      var anyA = own.pump || own.hours || own.season || own.kw;
      var allA = own.pump && own.hours && own.season && own.kw;
      g('a-cover-label').textContent = 'Станція закриває за сезон · ' + (allA ? 'за вашими даними' : anyA ? 'частково приклад' : 'приклад');
      g('season-caption').textContent = 'Енергія насосів по місяцях сезону, кВт·год. Найслабший місяць — ' + MN[r.weakest] + '.';
      g('a-sentence').textContent = 'Насосам потрібно ≈ ' + fmt.format(Math.round(r.need / 100) * 100) + ' кВт·год за сезон. ' +
        (pct >= 100 ? 'Станції ' + r.kw + ' кВт вистачає на кожен місяць сезону.'
                    : 'Щоб закрити й найслабший місяць (' + MN[r.weakest] + '), потрібно ≈ ' + r.kwFull + ' кВт панелей.');
      var ord = function (i) { return (i - r.a + 12) % 12; };
      var full = r.months.map(function (x, i) { return x.full ? i : -1; }).filter(function (i) { return i >= 0; })
        .sort(function (p, q) { return ord(p) - ord(q); });
      var contiguous = full.every(function (m, k) { return !k || ord(m) === ord(full[k - 1]) + 1; });
      var fullText = full.length === 1 ? 'у ' + ML[full[0]]
        : contiguous ? 'з ' + MG[full[0]] + ' по ' + MN[full[full.length - 1]]
        : 'у ' + full.map(function (m) { return ML[m]; }).join(', ');
      g('season-summary').innerHTML = aMode === 'off'
        ? 'За сезон насосам потрібно <b>≈ ' + fmt.format(Math.round(r.need / 100) * 100) + ' кВт·год</b>, усе з мережі або генератора.'
        : 'Станція закриває <b>≈ ' + pct + '%</b> енергії насосів' +
          (full.length === r.months.filter(function (x) { return x.on; }).length ? ', у кожному місяці сезону.'
            : full.length ? '; повністю — ' + fullText + (contiguous ? ', на краях сезону менше.' : ', в інші місяці менше.')
            : ', жодного місяця повністю: варто більшу станцію.');
      var tagA = function (o) { return anyA && !o ? ' (приклад)' : ''; };
      g('season-note').textContent = (anyA ? 'Розрахунок: ' : 'Приклад, ілюстративно: ') +
        'насоси ' + r.pump + ' кВт' + tagA(own.pump) + ', ' + r.hours + ' год на день' + tagA(own.hours) +
        ', сезон ' + MN[r.a] + ' — ' + MN[r.b] + tagA(own.season) + ', станція ' + r.kw + ' кВт' + tagA(own.kw) + '. Змініть дані в калькуляторі нижче.';
      document.querySelector('#season-table tbody').innerHTML = r.months.filter(function (x) { return x.on; }).map(function (x) {
        var i = r.months.indexOf(x);
        return '<tr><td>' + MN[i] + '</td><td>' + fmt.format(Math.round(x.need)) + '</td><td>' + fmt.format(Math.round(x.cover)) + '</td></tr>';
      }).join('');
      var put = function (id, ok, v) { var f = g(id); if (f && ok) f.value = v; };
      put('f-kw', own.kw, r.kw); put('f-pump', own.pump, r.pump); put('f-hours', own.hours, r.hours); put('f-season', own.season, MN[r.a] + ' — ' + MN[r.b]);
    };

    var liveA = function () { sChart.classList.add('is-live'); if (sMini) sMini.classList.add('is-live'); };
    [['pump', aPump], ['hours', aHours], ['kw', aKw]].forEach(function (p) { p[1].addEventListener('input', function () { own[p[0]] = true; liveA(); renderA(); }); });
    [aFrom, aTo].forEach(function (s) { s.addEventListener('change', function () { own.season = true; liveA(); renderA(); }); });
    bindToggle(function (md) {
      aMode = md; sChart.dataset.mode = md; sChart.classList.remove('is-live');
      document.querySelectorAll('.lg-on').forEach(function (li) { li.hidden = md !== 'on'; });
      renderA();
    });
    if (form) form.addEventListener('enray:reset', renderA);
    if (reduce) { sChart.classList.add('no-motion'); if (sMini) sMini.classList.add('no-motion'); }
    renderA();
  }
})();
