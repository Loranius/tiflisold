<?php
/** Сторінка сценарію: agro. Розмітка перенесена з прототипу enray/agro/index.html. */
get_header();
?>
<main id="main">
  <section class="hero hero--scenario" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><span>Агро</span></p>
      <h1 id="hero-h">Енергія для поливу просто з&nbsp;поля</h1>
      <p class="hero-sub">Сонячні станції для насосів і поливу у&nbsp;Вінницькій області, зокрема автономні, там, де немає мережі</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#kalkulyator">Порахувати для насосів</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
    </div>

    <figure class="day-panel bill-panel">
      <div class="day-head">
        <figcaption class="day-title">Сезон поливу, енергія насосів</figcaption>
        <div class="seg" role="group" aria-label="Порівняння">
          <button type="button" class="seg-btn" data-mode="off" aria-pressed="true">Без станції</button>
          <button type="button" class="seg-btn" data-mode="on" aria-pressed="false">Зі станцією</button>
        </div>
      </div>
      <div class="bill-chart season-chart" data-mode="off" aria-hidden="true">
        <div class="bill-cols season-cols" id="season-cols"></div>
        <div class="bill-scale"><span data-s="С">січ</span><span data-s="Л">лют</span><span data-s="Б">бер</span><span data-s="К">кві</span><span data-s="Т">тра</span><span data-s="Ч">чер</span><span data-s="Л">лип</span><span data-s="С">сер</span><span data-s="В">вер</span><span data-s="Ж">жов</span><span data-s="Л">лис</span><span data-s="Г">гру</span></div>
      </div>
      <p class="day-summary" id="season-summary" aria-live="polite">За сезон насосам потрібно <b>≈ 43 900 кВт·год</b>, усе з мережі або генератора.</p>
      <ul class="legend" aria-hidden="true">
        <li><i class="sw sw--grid"></i>мережа або генератор</li>
        <li><i class="sw sw--sun"></i>закриває станція</li>
        <li><i class="sw sw--idle"></i>поза сезоном</li>
        <li class="lg-on" hidden><i class="sw sw--gen"></i>генерація станції</li>
        <li class="lg-on" hidden><i class="sw sw--weak"></i>найслабший місяць</li>
      </ul>
      <table class="sr-only" id="season-table">
        <caption id="season-caption">Енергія насосів по місяцях сезону, кВт·год</caption>
        <thead><tr><th scope="col">Місяць</th><th scope="col">Потрібно насосам</th><th scope="col">Закриває станція</th></tr></thead>
        <tbody></tbody>
      </table>
      <p class="day-note" id="season-note">Приклад, ілюстративно: насоси 30 кВт, 8 год на день, сезон квітень — вересень, станція 50 кВт. Змініть дані в калькуляторі нижче.</p>
    </figure>
  </section>

  <section class="section biz-calc" id="kalkulyator" aria-labelledby="calc-h">
    <div class="rezerv-head">
      <h2 id="calc-h">Порахуйте для своїх насосів</h2>
      <p class="lead">Вкажіть насоси й сезон. Графік поруч і графік на початку сторінки перерахуються за вашими даними.</p>
    </div>
    <div class="rezerv-grid">
      <div class="biz-inputs">
        <div class="bi-row">
          <label for="a-pump">Сумарна потужність насосів, кВт</label>
          <input id="a-pump" type="range" min="1" max="150" step="1" value="30">
          <output for="a-pump" id="a-pump-out" class="bi-val">30 кВт</output>
        </div>
        <div class="bi-row">
          <label for="a-hours">Скільки годин на день працюють насоси</label>
          <input id="a-hours" type="range" min="1" max="14" step="1" value="8">
          <output for="a-hours" id="a-hours-out" class="bi-val">8 год</output>
          <p class="bi-hint">Рахуємо, що насоси працюють у світлий час. Нічний полив потребує акумулятора або накопичення води.</p>
        </div>
        <div class="bi-row bi-season">
          <span class="bi-label" id="a-season-l">Сезон поливу</span>
          <div class="bi-selects" role="group" aria-labelledby="a-season-l">
            <label class="sr-only" for="a-from">Початок сезону</label>
            <select id="a-from" class="bi-select"></select>
            <span aria-hidden="true">—</span>
            <label class="sr-only" for="a-to">Кінець сезону</label>
            <select id="a-to" class="bi-select"></select>
          </div>
        </div>
        <div class="bi-row">
          <label for="a-kw">Потужність станції, кВт</label>
          <input id="a-kw" type="range" min="10" max="300" step="5" value="50">
          <output for="a-kw" id="a-kw-out" class="bi-val">50 кВт</output>
        </div>
      </div>
      <div class="rezerv-result" aria-live="polite">
        <p class="rz-label" id="a-cover-label">Станція закриває за сезон · приклад</p>
        <p class="rz-kwh"><span id="a-cover">≈ 93</span>&nbsp;<span class="rz-pct">%</span></p>
        <p class="bi-sentence" id="a-sentence">Насосам потрібно ≈ 43 900 кВт·год за сезон. Щоб закрити й найслабший місяць (вересень), потрібно ≈ 70 кВт панелей.</p>
        <div class="bill-mini" aria-hidden="true">
          <div class="bill-cols bill-cols--mini season-cols" id="season-mini"></div>
        </div>
        <p class="rz-note">Орієнтовно: 1 кВт панелей дає ≈ 1 150 кВт·год на рік, розподіл по місяцях типовий для Вінниччини, насоси працюють удень, без акумулятора й накопичення води. Похмурі дні знижують генерацію. Точний розрахунок інженер зробить за паспортами насосів і графіком поливу.</p>
        <a class="link-strong" href="#zayavka">Надіслати ці дані інженеру <svg class="ico"><use href="#i-arrow"/></svg></a>
      </div>
    </div>
  </section>

  <section class="section case-feature" aria-labelledby="case-h">
    <h2 id="case-h">Полив саду в Луці-Мелешківській</h2>
    <div class="cf-grid cf-grid--stack">
      <figure class="cf-main cf-main--wide">
        <img src="<?php echo esc_url( enray_img( 'agro-case.webp' ) ); ?>" width="1440" height="707" alt="Сонячна станція 100 кВт на даху господарської будівлі поруч із водоймою і садом у селі Лука-Мелешківська" loading="lazy">
        <svg class="callouts" viewBox="0 0 1440 707" preserveAspectRatio="xMidYMax slice" aria-hidden="true" focusable="false">
          <text x="669" y="358" text-anchor="middle">100 кВт</text>
          <text class="c-wide" x="278" y="290" text-anchor="start">полив саду · 2025</text>
          <text class="c-narrow" x="380" y="290" text-anchor="middle">полив · 2025</text>
          <text x="1011" y="280" text-anchor="middle">монтаж — 10 днів</text>
        </svg>
      </figure>
      <div class="cf-side">
        <dl class="cf-spec">
          <div><dt>Потужність</dt><dd>100 кВт</dd></div>
          <div><dt>Задача</dt><dd class="txt">автономний полив саду</dd></div>
          <div><dt>Де</dt><dd class="txt">Лука-Мелешківська, Вінницька обл.</dd></div>
          <div><dt>Рік</dt><dd>2025</dd></div>
          <div><dt>Монтаж</dt><dd>10 днів</dd></div>
        </dl>
        <div class="cf-aside">
        <p class="cf-note">Обстежили ділянку й затінення, розрахували потужність під пікові навантаження поливу, змонтували станцію й налаштували її разом із системою поливу.</p>
        <figure class="cf-inverter">
          <img src="<?php echo esc_url( enray_img( 'agro-detail.webp' ) ); ?>" width="800" height="600" alt="Ряди сонячних панелей на даху господарської будівлі, поруч сад і водойма" loading="lazy">
          <figcaption>Панелі на даху господарської будівлі, той самий об'єкт</figcaption>
        </figure>
        </div>
      </div>
    </div>
  </section>

  <section class="section" aria-labelledby="steps-h">
    <h2 id="steps-h">Від насоса до власної енергії</h2>
    <ol class="steps steps--scenario">
      <li><span class="step-n">01</span><b>Виїзд</b><span>насоси, джерело води, ділянка, затінення</span></li>
      <li><span class="step-n">02</span><b>Проєкт</b><span>потужність під пікове навантаження поливу</span></li>
      <li><span class="step-n">03</span><b>Постачання</b><span>панелі, інвертори, конструкції</span></li>
      <li><span class="step-n">04</span><b>Монтаж</b><span>10 днів для станції 100 кВт</span></li>
      <li><span class="step-n">05</span><b>Запуск</b><span>налаштування разом із системою поливу</span></li>
    </ol>
  </section>

  <section class="section faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання агровиробників</h2>
    <div class="faq-list">
      <details>
        <summary>Чи можна поливати там, де немає мережі?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Так. Станцію в Луці-Мелешківській ми будували саме для автономного поливу саду. Схему, потужність і обладнання підбираємо під ваші насоси та графік поливу.</p>
      </details>
      <details>
        <summary>Що буде в похмурий день або ввечері?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Генерація падає, тож у проєкті закладаємо запас: більшу потужність панелей, акумулятор, накопичення води в резервуарі або резервне живлення від мережі чи генератора. Варіант обираємо разом із вами після огляду.</p>
      </details>
      <details>
        <summary>Що робити зі станцією поза сезоном поливу?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Якщо об'єкт підключений до мережі, енергію можна використовувати на господарстві: склади, холодильні камери, майстерні. Умови віддачі надлишку в мережу залежать від чинних правил і договору з обленерго, це обговорюємо на консультації.</p>
      </details>
      <details>
        <summary>Скільки триває монтаж?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Станцію 100 кВт для поливу саду в Луці-Мелешківській ми змонтували за 10 днів. Точний термін назвемо після виїзду: він залежить від даху чи ділянки та наявності обладнання.</p>
      </details>
      <details>
        <summary>Дах чи земля?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Обидва варіанти. У Луці-Мелешківській панелі стоять на даху господарської будівлі поруч із садом. Якщо даху немає або він слабкий, ставимо наземну станцію.</p>
      </details>
    </div>
  </section>

  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>Розрахунок для вашого поливу</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00, і попросить дані насосів, щоб підібрати потужність станції.</p>
      <?php enray_request_form( 'agro' ); ?>
    </div>
    <div class="closing-aside">
      <p>Зручніше голосом? Зателефонуйте або напишіть у Viber, інженер відповість у робочий час.</p>
      <a class="nav-phone big-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
  </section>
</main>
<?php
get_footer();
