(function () {
  'use strict';

  var fmt = new Intl.NumberFormat('uk-UA');
  var TARIFF = 4.32;          // грн за кВт·год, побутовий тариф
  var YIELD = 1150;           // кВт·год на рік з 1 кВт панелей, Вінницька обл.
  var SIZES = [3, 5, 6, 8, 10, 12, 15, 20, 25, 30, 40, 50];

  // Меню на телефоні
  var toggle = document.querySelector('.nav-toggle');
  var menu = document.getElementById('mobile-menu');
  if (toggle && menu) {
    var setMenu = function (open) {
      menu.hidden = !open;
      toggle.setAttribute('aria-expanded', String(open));
      toggle.setAttribute('aria-label', open ? 'Закрити меню' : 'Відкрити меню');
      toggle.querySelector('use').setAttribute('href', open ? '#i-close' : '#i-menu');
    };
    toggle.addEventListener('click', function () { setMenu(menu.hidden); });
    menu.addEventListener('click', function (e) { if (e.target.closest('a')) setMenu(false); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !menu.hidden) { setMenu(false); toggle.focus(); } });
    // Дотик поза меню й шапкою закриває меню.
    document.addEventListener('click', function (e) {
      if (!menu.hidden && !menu.contains(e.target) && !toggle.contains(e.target)) setMenu(false);
    });
    // Якщо екран розширився до повної навігації, відкрите меню більше не потрібне.
    var wide = window.matchMedia('(min-width: 1101px)');
    var onWide = function () { if (wide.matches && !menu.hidden) setMenu(false); };
    if (wide.addEventListener) wide.addEventListener('change', onWide); else wide.addListener(onWide);
  }

  // Калькулятор
  var bill = document.getElementById('bill');
  var billOut = document.getElementById('bill-out');
  var kwOut = document.getElementById('kw-out');
  var kwhOut = document.getElementById('kwh-out');
  var formBill = document.getElementById('f-bill');

  function roundTo(n, step) { return Math.round(n / step) * step; }

  function update() {
    var v = Number(bill.value);
    var pct = (v - bill.min) / (bill.max - bill.min) * 100;
    bill.style.setProperty('--p', pct + '%');
    var month = v / TARIFF;
    var year = month * 12;
    var need = year / YIELD;
    var kw = SIZES.find(function (s) { return s >= need * 0.95; }) || SIZES[SIZES.length - 1];
    var plus = v >= Number(bill.max);
    billOut.textContent = fmt.format(v) + (plus ? '+ грн' : ' грн');
    kwOut.textContent = (plus ? 'від ' : '≈ ') + kw + ' кВт';
    kwhOut.textContent = '≈ ' + fmt.format(roundTo(month, 10)) + ' кВт·год на місяць, ≈ ' + fmt.format(roundTo(year, 100)) + ' кВт·год на рік';
    bill.setAttribute('aria-valuetext', billOut.textContent);
  }
  if (bill) {
    // У форму переносимо лише суму, яку відвідувач сам вибрав повзунком.
    bill.addEventListener('input', function () { update(); if (formBill) formBill.value = String(Number(bill.value)); });
    update();
  }

  // Бізнес: потужність за споживанням у кВт·год, без припущень про тариф.
  var BIZ = [5, 10, 15, 20, 25, 30, 40, 50, 60, 80, 100];
  var sizeUp = function (need, list) {
    return list.find(function (s) { return s >= need * 0.95; }) || Math.ceil(need / 10) * 10;
  };
  var BIG = ' Це більше за наш найбільший збудований об\'єкт (100 кВт), тому проєкт обговоримо з інженером.';
  var cKwh = document.getElementById('c-kwh');
  var setP = function (r) { r.style.setProperty('--p', (r.value - r.min) / (r.max - r.min) * 100 + '%'); };
  var updBiz = function () {
    var v = Number(cKwh.value), plus = v >= Number(cKwh.max);
    var year = v * 12, kw = sizeUp(year / YIELD, BIZ);
    setP(cKwh);
    document.getElementById('c-kwh-out').textContent = fmt.format(v) + (plus ? '+' : '') + ' кВт·год';
    cKwh.setAttribute('aria-valuetext', fmt.format(v) + ' кВт·год на місяць');
    document.getElementById('c-biz-kw').textContent = (plus ? 'від ' : '≈ ') + kw + ' кВт';
    document.getElementById('c-biz-detail').textContent = '≈ ' + fmt.format(roundTo(year, 100)) + ' кВт·год на рік споживання, станція дасть ≈ ' +
      fmt.format(roundTo(kw * YIELD, 100)) + ' кВт·год на рік.' + (kw > 100 ? BIG : '');
  };
  if (cKwh) { cKwh.addEventListener('input', updBiz); updBiz(); }

  // Агро: сезон квітень — вересень, станція закриває й найслабший місяць (як у калькуляторі для поливу).
  var cPump = document.getElementById('c-pump'), cHours = document.getElementById('c-hours');
  var updAgro = function () {
    var pump = Number(cPump.value), hours = Number(cHours.value);
    var DAYS = [30, 31, 30, 31, 31, 30], FA = [0.11, 0.125, 0.13, 0.14, 0.125, 0.095];
    var MON = ['квітень', 'травень', 'червень', 'липень', 'серпень', 'вересень'];
    var need = 0, worst = 0, kwMax = 0;
    DAYS.forEach(function (d, i) {
      need += pump * hours * d;
      var k = pump * hours * d / (YIELD * FA[i]);
      if (k > kwMax) { kwMax = k; worst = i; }
    });
    var kw = Math.ceil(kwMax / 5) * 5;
    setP(cPump); setP(cHours);
    document.getElementById('c-pump-out').textContent = pump + ' кВт';
    document.getElementById('c-hours-out').textContent = hours + ' год';
    cHours.setAttribute('aria-valuetext', hours + ' год на день');
    document.getElementById('c-agro-kw').textContent = '≈ ' + kw + ' кВт';
    document.getElementById('c-agro-detail').textContent = 'Насосам потрібно ≈ ' + fmt.format(roundTo(need, 100)) +
      ' кВт·год за сезон, найслабший місяць — ' + MON[worst] + '.' + (kw > 100 ? BIG : '');
  };
  if (cPump && cHours) { [cPump, cHours].forEach(function (r) { r.addEventListener('input', updAgro); }); updAgro(); }

  // Перемикач Дім / Бізнес / Агро. Без JS видно лише калькулятор для дому.
  var sw = document.getElementById('calc-switch');
  if (sw) {
    sw.hidden = false;
    var autoObj = null;
    sw.addEventListener('change', function (e) {
      var mode = e.target.value;
      document.querySelectorAll('.calc-panel').forEach(function (p) { p.hidden = p.dataset.mode !== mode; });
      // Вибір відвідувача переносимо у форму, якщо там ще нічого не обрано вручну.
      var cur = document.querySelector('#request-form input[name="object"]:checked');
      if (!cur || cur === autoObj) {
        var r = document.querySelector('#request-form input[name="object"][value="' + e.target.dataset.object + '"]');
        if (r) { r.checked = true; autoObj = r; r.dispatchEvent(new Event('change', { bubbles: true })); }
      }
    });
  }

  // Заявка (у прототипі нікуди не надсилається; у WordPress її прийме Contact Form 7)
  var form = document.getElementById('request-form');
  var msg = document.getElementById('form-msg');
  var summary = document.getElementById('form-errors');
  // У WordPress форму надсилає Contact Form 7: власну перевірку не вмикаємо,
  // лише повертаємо калькулятори до початкового стану після успішного надсилання.
  if (form && form.classList.contains('wpcf7-form')) {
    document.addEventListener('wpcf7mailsent', function () {
      if (bill) update();
      form.dispatchEvent(new CustomEvent('enray:reset'));
    });
  } else if (form) {
    var digits = function (s) { return (s || '').replace(/\D/g, ''); };
    var num = function (s) { return Number(String(s).replace(/[\s ]/g, '').replace(',', '.')); };

    // Правила для полів, які є на сторінці. Повертають текст помилки або ''.
    var RULES = {
      'f-name': function (v) {
        v = v.trim();
        if (!v) return 'Вкажіть, як до вас звертатися.';
        if (v.length < 2) return 'Ім\'я занадто коротке.';
        if (/\d/.test(v)) return 'Ім\'я не має містити цифр.';
        return '';
      },
      'f-phone': function (v) {
        var d = digits(v);
        if (!d) return 'Вкажіть номер, щоб інженер міг передзвонити.';
        if (/[^\d\s+()-]/.test(v)) return 'Номер може містити лише цифри, пробіли, «+», дужки й дефіс.';
        var ok = (d.length === 12 && d.indexOf('380') === 0) || (d.length === 10 && d.charAt(0) === '0');
        return ok ? '' : 'Перевірте номер: 10 цифр, наприклад 067 123 45 67, або з кодом +38.';
      }
    };
    var numeric = function (input) {
      return function (v) {
        if (!v.trim()) return '';
        var n = num(v);
        return isFinite(n) && n > 0 ? '' : 'Тут потрібне число' + (input.dataset.unit ? ', ' + input.dataset.unit : '') + '.';
      };
    };
    form.querySelectorAll('input[inputmode="numeric"], input[inputmode="decimal"]').forEach(function (i) {
      if (!RULES[i.id]) RULES[i.id] = numeric(i);
    });

    // Під кожне поле з правилом — місце для тексту помилки, пов'язане з полем.
    var errNode = function (el, field) {
      var id = el.id + '-err';
      var p = document.getElementById(id);
      if (!p) {
        p = document.createElement('p');
        p.className = 'field-err'; p.id = id; p.hidden = true;
        field.appendChild(p);
        var d = el.getAttribute('aria-describedby');
        el.setAttribute('aria-describedby', (d ? d + ' ' : '') + id);
      }
      return p;
    };
    var setErr = function (el, field, text) {
      var p = errNode(el, field);
      p.textContent = text; p.hidden = !text;
      if (text) el.setAttribute('aria-invalid', 'true'); else el.removeAttribute('aria-invalid');
    };

    var picks = form.querySelectorAll('fieldset[data-required]');
    var check = function (el) {
      if (el.tagName === 'FIELDSET') {
        var on = el.querySelector('input:checked');
        setErr(el, el, on ? '' : el.dataset.err);
        return on ? '' : el.dataset.err;
      }
      var rule = RULES[el.id];
      if (!rule) return '';
      var text = rule(el.value);
      setErr(el, el.closest('.field') || el.parentNode, text);
      return text;
    };
    var targets = function () {
      return Array.prototype.slice.call(picks).concat(Object.keys(RULES).map(function (id) { return document.getElementById(id); }).filter(Boolean))
        .sort(function (a, b) { return a.compareDocumentPosition(b) & 2 ? 1 : -1; });
    };

    // Поле телефону: прибираємо літери одразу під час введення.
    var phone = document.getElementById('f-phone');
    if (phone) phone.addEventListener('input', function () {
      var clean = phone.value.replace(/[^\d\s+()-]/g, '');
      if (clean !== phone.value) phone.value = clean;
    });

    // Повторна перевірка поля після першої спроби надіслати; успіх ховаємо, щойно відвідувач знову друкує.
    var tried = false;
    form.addEventListener('input', function (e) {
      if (msg.textContent) { msg.textContent = ''; msg.className = 'form-msg'; }
      if (!tried) return;
      var el = e.target.closest('fieldset[data-required]') || e.target;
      check(el);
      var left = targets().filter(function (t) { return t.getAttribute('aria-invalid') === 'true'; }).length;
      summary.hidden = !left;
      if (left) summary.textContent = left === 1 ? 'Залишилось виправити одне поле.' : 'Залишилось виправити полів: ' + left + '.';
    });
    form.addEventListener('change', function (e) { if (tried && e.target.type === 'radio') check(e.target.closest('fieldset')); });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      tried = true;
      var bad = targets().filter(function (el) { return check(el); });
      if (bad.length) {
        summary.hidden = false;
        summary.textContent = bad.length === 1 ? 'Виправте поле, позначене знаком «!».' : 'Виправте поля, позначені знаком «!»: ' + bad.length + '.';
        var first = bad[0];
        (first.tagName === 'FIELDSET' ? first.querySelector('input') : first).focus({ preventScroll: true });
        first.scrollIntoView({ block: 'center', behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
        return;
      }
      summary.hidden = true;
      var btn = form.querySelector('button[type=submit]');
      btn.disabled = true;
      btn.textContent = 'Надсилаємо…';
      setTimeout(function () {
        btn.disabled = false;
        btn.textContent = 'Надіслати запит';
        msg.className = 'form-msg is-success';
        msg.textContent = 'Дякуємо! Заявку прийнято. Інженер передзвонить на ' + phone.value.trim() + ' у робочий час, 09:00–18:00. (Прототип: заявка не надсилається.)';
        form.reset();
        tried = false;
        if (bill) update();
        form.dispatchEvent(new CustomEvent('enray:reset'));
        msg.setAttribute('tabindex', '-1');
        msg.focus({ preventScroll: true });
        msg.scrollIntoView({ block: 'center' });
      }, 600);
    });
  }
})();
