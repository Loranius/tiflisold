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
    if (formBill) formBill.value = String(v);
  }
  if (bill) { bill.addEventListener('input', update); update(); }

  // Заявка (у прототипі нікуди не надсилається; у WordPress її прийме Contact Form 7)
  var form = document.getElementById('request-form');
  var msg = document.getElementById('form-msg');
  if (form) {
    var phone = form.querySelector('#f-phone');
    var name = form.querySelector('#f-name');
    var digits = function (s) { return (s || '').replace(/\D/g, ''); };
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var errors = [];
      name.removeAttribute('aria-invalid');
      phone.removeAttribute('aria-invalid');
      if (!name.value.trim()) { errors.push('ім\'я'); name.setAttribute('aria-invalid', 'true'); }
      var d = digits(phone.value);
      if (d.length < 10 || d.length > 12) { errors.push('телефон у форматі +38 0XX XXX XX XX'); phone.setAttribute('aria-invalid', 'true'); }
      msg.classList.toggle('is-error', errors.length > 0);
      if (errors.length) {
        msg.textContent = 'Перевірте: ' + errors.join(', ') + '.';
        (name.getAttribute('aria-invalid') ? name : phone).focus();
        return;
      }
      var btn = form.querySelector('button[type=submit]');
      btn.disabled = true;
      btn.textContent = 'Надсилаємо…';
      setTimeout(function () {
        btn.disabled = false;
        btn.textContent = 'Надіслати запит';
        msg.textContent = 'Дякуємо, ' + name.value.trim() + '! Інженер передзвонить на ' + phone.value.trim() + ' у робочий час. (Прототип: заявка не надсилається.)';
        form.reset();
        if (bill) update();
        form.dispatchEvent(new CustomEvent('enray:reset'));
      }, 600);
    });
  }
})();
