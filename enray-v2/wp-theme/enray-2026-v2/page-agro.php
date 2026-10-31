<?php
/** Сторінка сценарію «agro». Розмітка з enray-v2/agro/ (build_wp.py). */
get_header();
?>
<main id="main" class="sheet sheet--page">
  <div class="rings" aria-hidden="true"></div>

  <section class="phero" aria-labelledby="hero-h">
    <img class="phero-photo" src="<?php echo esc_url( enray_asset( 'img/hero-1800.webp' ) ); ?>" width="1800" height="977" alt="Сонячна станція EnRay 100 кВт на даху господарської будівлі біля водойми для поливу саду" fetchpriority="high">
    <div class="phero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true">/</span><span>Для поливу</span></p>
      <h1 id="hero-h">Енергія для поливу просто з&nbsp;поля</h1>
      <p class="phero-sub">Сонячні станції для насосів і&nbsp;поливу у&nbsp;Вінницькій області, зокрема автономні, там, де немає мережі.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#kalkulyator">Порахувати для насосів</a>
        <a class="btn btn-glass btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-phone"/></svg>Подзвонити</a>
      </div>
    </div>
  </section>

  <section class="day" aria-labelledby="season-h">
    <div class="sec-head">
      <h2 id="season-h">Скільки енергії потрібно насосам за сезон</h2>
      <p class="lead">Енергія насосів по місяцях сезону поливу без станції й&nbsp;зі станцією. Графік перерахується за вашими даними нижче.</p>
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

  <section class="rezerv" id="kalkulyator" aria-labelledby="calc-h">
    <div class="sec-head">
      <h2 id="calc-h">Порахуйте для своїх насосів</h2>
      <p class="lead">Вкажіть насоси й сезон. Обидва графіки на сторінці перерахуються за вашими даними.</p>
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

  <section class="case-feature" aria-labelledby="case-h">
    <div class="sec-head">
      <h2 id="case-h">Полив саду в&nbsp;Луці-Мелешківській</h2>
      <p class="lead">Станція 100&nbsp;кВт для поливу саду, змонтована за 10&nbsp;днів.</p>
    </div>
    <div class="cf-grid">
      <figure class="cf-main">
        <img src="<?php echo esc_url( enray_asset( 'img/agro-detail.webp' ) ); ?>" width="800" height="600" alt="Ряди сонячних панелей станції 100 кВт на даху господарської будівлі поруч із садом у селі Лука-Мелешківська" loading="lazy" decoding="async">
        <figcaption>СЕС 100&nbsp;кВт · Лука-Мелешківська · 2025</figcaption>
      </figure>
      <div class="cf-side">
        <dl class="cf-spec">
          <div><dt>Потужність</dt><dd>100 кВт</dd></div>
          <div><dt>Задача</dt><dd class="txt">автономний полив саду</dd></div>
          <div><dt>Де</dt><dd class="txt">Лука-Мелешківська, Вінницька обл.</dd></div>
          <div><dt>Рік</dt><dd>2025</dd></div>
          <div><dt>Монтаж</dt><dd>10 днів</dd></div>
        </dl>
        <p class="cf-note">Обстежили ділянку й затінення, розрахували потужність під пікові навантаження поливу, змонтували станцію й налаштували її разом із системою поливу.</p>
      </div>
    </div>
  </section>

  <section class="steps" aria-labelledby="steps-h">
    <h2 id="steps-h">Від насоса до власної енергії</h2>
    <ol class="timeline">
        <li><span class="step-n">01</span><h3>Виїзд</h3><p>Насоси, джерело води, ділянка, затінення.</p></li>
        <li><span class="step-n">02</span><h3>Проєкт</h3><p>Потужність під пікове навантаження поливу.</p></li>
        <li><span class="step-n">03</span><h3>Постачання</h3><p>Панелі, інвертори, конструкції.</p></li>
        <li><span class="step-n">04</span><h3>Монтаж</h3><p>10 днів для станції 100 кВт.</p></li>
        <li><span class="step-n">05</span><h3>Запуск</h3><p>Налаштування разом із системою поливу.</p></li>
    </ol>
  </section>

  <section class="faq" aria-labelledby="faq-h">
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
    
  </section>

  <section class="request" id="zayavka" aria-labelledby="req-h">
    <div class="req-side">
      <h2 id="req-h">Розрахунок для вашого поливу</h2>
      <p class="lead">Інженер передзвонить у&nbsp;робочий час, 09:00–18:00, і&nbsp;попросить дані насосів, щоб підібрати потужність станції.</p>
      <p class="req-alt">Зручніше голосом?</p>
      <a class="req-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
    <div class="req-card">
      <?php enray_request_form( 'agro' ); ?>
    </div>
  </section>
</main>
<?php
get_footer();
