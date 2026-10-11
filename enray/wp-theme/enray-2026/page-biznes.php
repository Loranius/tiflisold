<?php
/** Сторінка сценарію: biznes. Розмітка перенесена з прототипу enray/biz/index.html. */
get_header();
?>
<main id="main">
  <section class="hero hero--scenario" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><span>Для бізнесу</span></p>
      <h1 id="hero-h">Менший рахунок за&nbsp;світло для&nbsp;бізнесу</h1>
      <p class="hero-sub">Мережеві й гібридні сонячні станції на даху чи на землі у&nbsp;Вінницькій області: проєкт, монтаж і&nbsp;підключення до мережі</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#kalkulyator">Порахувати економію</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
    </div>

    <figure class="day-panel bill-panel">
      <div class="day-head">
        <figcaption class="day-title">Рахунок за рік, по місяцях</figcaption>
        <div class="seg" role="group" aria-label="Порівняння">
          <button type="button" class="seg-btn" data-mode="off" aria-pressed="true">Без станції</button>
          <button type="button" class="seg-btn" data-mode="on" aria-pressed="false">Зі станцією</button>
        </div>
      </div>
      <div class="bill-chart" data-mode="off" aria-hidden="true">
        <div class="bill-cols" id="bill-cols"></div>
        <div class="bill-scale"><span data-s="С">січ</span><span data-s="Л">лют</span><span data-s="Б">бер</span><span data-s="К">кві</span><span data-s="Т">тра</span><span data-s="Ч">чер</span><span data-s="Л">лип</span><span data-s="С">сер</span><span data-s="В">вер</span><span data-s="Ж">жов</span><span data-s="Л">лис</span><span data-s="Г">гру</span></div>
      </div>
      <p class="day-summary" id="bill-summary" aria-live="polite"></p>
      <ul class="legend" aria-hidden="true">
        <li><i class="sw sw--grid"></i>оплата мережі</li>
        <li><i class="sw sw--sun"></i>закриває станція</li>
        <li><i class="sw sw--cap"></i>денне споживання</li>
      </ul>
      <table class="sr-only" id="bill-table">
        <caption>Рахунок по місяцях без станції і зі станцією, грн</caption>
        <thead><tr><th scope="col">Місяць</th><th scope="col">Без станції</th><th scope="col">Зі станцією</th></tr></thead>
        <tbody></tbody>
      </table>
      <p class="day-note" id="bill-note"></p>
    </figure>
  </section>

  <section class="section biz-calc" id="kalkulyator" aria-labelledby="calc-h">
    <div class="rezerv-head">
      <h2 id="calc-h">Порахуйте для свого бізнесу</h2>
      <p class="lead">Введіть свій рахунок і тариф. Графік поруч і графік на початку сторінки перерахуються за вашими даними.</p>
    </div>
    <div class="rezerv-grid">
      <div class="biz-inputs">
        <div class="bi-row">
          <label for="b-bill-num">Рахунок за електроенергію, грн/міс</label>
          <input id="b-bill-num" class="bi-num" type="text" placeholder="наприклад, 20 000" inputmode="numeric" autocomplete="off">
          <input id="b-bill" type="range" min="5000" max="500000" step="5000" value="20000" aria-label="Рахунок, повзунок">
          <p class="bi-hint" id="b-bill-hint">20 000 грн у графіку — приклад. Введіть суму з рахунку.</p>
        </div>
        <div class="bi-row">
          <label for="b-tariff">Ваш тариф, грн за кВт·год</label>
          <input id="b-tariff" class="bi-num" type="text" placeholder="наприклад, 8" inputmode="decimal" autocomplete="off">
          <p class="bi-hint" id="b-tariff-hint">Поки поле порожнє, рахуємо з прикладом 8 грн. Введіть тариф з рахунку.</p>
        </div>
        <div class="bi-row">
          <label for="b-kw">Потужність станції, кВт</label>
          <input id="b-kw" type="range" min="10" max="100" step="5" value="30">
          <output for="b-kw" id="b-kw-out" class="bi-val">30 кВт</output>
        </div>
        <fieldset class="bi-row bi-share">
          <legend>Яка частина споживання припадає на світлий день</legend>
          <div class="seg seg--share" role="radiogroup">
            <label><input type="radio" name="share" value="0.4"><span>≈ 40%</span></label>
            <label><input type="radio" name="share" value="0.6" checked><span>≈ 60%</span></label>
            <label><input type="radio" name="share" value="0.8"><span>≈ 80%</span></label>
          </div>
          <p class="bi-hint">Магазин чи офіс, що працює вдень, ближче до 60–80%. Цілодобове виробництво ближче до 40%.</p>
        </fieldset>
      </div>
      <div class="rezerv-result" aria-live="polite">
        <p class="rz-label" id="b-save-label">Економія за рік · приклад</p>
        <p class="rz-kwh"><span id="b-save">≈ 131 000</span> <small>грн</small></p>
        <p class="bi-sentence" id="b-sentence">Це ≈ 55% річного рахунку. Станція 30 кВт дасть ≈ 34 500 кВт·год за рік.</p>
        <div class="bill-mini" aria-hidden="true">
          <div class="bill-cols bill-cols--mini" id="bill-mini"></div>
        </div>
        <p class="rz-note">Орієнтовно: 1 кВт панелей дає ≈ 1 150 кВт·год на рік, розподіл по місяцях типовий для Вінниччини. Станція покриває лише денну частину споживання. Надлишок, що йде в мережу, не рахуємо. Точний розрахунок інженер зробить за вашими рахунками за рік.</p>
        <a class="link-strong" href="#zayavka">Надіслати ці дані інженеру <svg class="ico"><use href="#i-arrow"/></svg></a>
      </div>
    </div>
  </section>

  <section class="section case-feature" aria-labelledby="case-h">
    <h2 id="case-h">Наша станція в Ладижині</h2>
    <div class="cf-grid">
      <figure class="cf-main">
        <img src="<?php echo esc_url( enray_img( 'biz-case.webp' ) ); ?>" width="1280" height="720" alt="Наземна мережева сонячна станція 30 кВт у Ладижині, змонтована EnRay у 2026 році" loading="lazy">
        <svg class="callouts" viewBox="0 0 1280 720" preserveAspectRatio="xMidYMax slice" aria-hidden="true" focusable="false">
          <text x="500" y="108" text-anchor="middle">наземна СЕС · Ладижин · 2026</text>
          <text x="700" y="212" text-anchor="middle" transform="rotate(-6.6 700 212)">30 кВт</text>
          <text x="1010" y="48" text-anchor="end">монтаж — 1 тиждень</text>
        </svg>
      </figure>
      <div class="cf-side">
        <dl class="cf-spec">
          <div><dt>Потужність</dt><dd>30 кВт</dd></div>
          <div><dt>Тип</dt><dd class="txt">мережева, наземна</dd></div>
          <div><dt>Де</dt><dd class="txt">Ладижин, Вінницька обл.</dd></div>
          <div><dt>Рік</dt><dd>2026</dd></div>
          <div><dt>Монтаж</dt><dd>1 тиждень</dd></div>
          <div><dt>Задача</dt><dd class="txt">«зелений тариф»</dd></div>
        </dl>
        <p class="cf-note">Ця станція продає енергію в мережу за «зеленим тарифом». Розрахунок економії вище — для бізнесу, який споживає енергію на місці.</p>
        <figure class="cf-inverter">
          <img src="<?php echo esc_url( enray_img( 'biz-detail.webp' ) ); ?>" width="800" height="600" alt="Інвертор і щиток захисту на стійках під панелями станції в Ладижині" loading="lazy">
          <figcaption>Інвертор і щиток захисту під панелями, той самий об'єкт</figcaption>
        </figure>
      </div>
    </div>
    <div class="gallery" aria-label="Наземні станції EnRay, 2026">
      <figure><img src="<?php echo esc_url( enray_img( 'biz-g1.webp' ) ); ?>" width="800" height="600" alt="Ряд панелей наземної станції в Ладижині" loading="lazy"><figcaption>Ладижин · 30 кВт · 2026</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'biz-g2.webp' ) ); ?>" width="800" height="600" alt="Конструкція наземної станції в Ладижині, вигляд знизу" loading="lazy"><figcaption>Ладижин · конструкція</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'biz-g3.webp' ) ); ?>" width="800" height="600" alt="Наземна сонячна станція біля сільського будинку, вигляд з дрона" loading="lazy"><figcaption>Наземна СЕС · 2026</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'biz-g4.webp' ) ); ?>" width="800" height="600" alt="Ряди панелей наземної станції на ділянці" loading="lazy"><figcaption>Наземна СЕС · 2026</figcaption></figure>
    </div>
  </section>

  <section class="section" aria-labelledby="steps-h">
    <h2 id="steps-h">Від рахунку до власної генерації</h2>
    <ol class="steps steps--scenario">
      <li><span class="step-n">01</span><b>Виїзд</b><span>огляд даху чи ділянки, рахунки за рік</span></li>
      <li><span class="step-n">02</span><b>Проєкт</b><span>потужність під денне споживання</span></li>
      <li><span class="step-n">03</span><b>Постачання</b><span>панелі, інвертори, конструкції</span></li>
      <li><span class="step-n">04</span><b>Монтаж</b><span>близько тижня для 30 кВт</span></li>
      <li><span class="step-n">05</span><b>Підключення</b><span>документи, обленерго, лічильник</span></li>
    </ol>
  </section>

  <section class="section faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання власників бізнесу</h2>
    <div class="faq-list">
      <details>
        <summary>Чи працюватиме станція під час відключень?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Мережева станція без акумулятора під час відключення зупиняється: інвертор вимикається з міркувань безпеки. Якщо потрібен резерв для кас, холодильного обладнання чи сервера, ставимо гібридний інвертор з акумулятором і виносимо ці лінії на окремий резервний щиток.</p>
      </details>
      <details>
        <summary>Що буде з енергією, яку бізнес не встигає спожити?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Надлишок іде в мережу. Чи можна його продати і на яких умовах, залежить від чинних правил і договору з обленерго, тож це обговорюємо на консультації. У калькуляторі вище надлишок не рахуємо, щоб не завищувати економію.</p>
      </details>
      <details>
        <summary>Дах чи земля?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Будуємо обидва варіанти. Вибір залежить від міцності й орієнтації даху, тіні та вільної площі на ділянці. Його робимо після виїзду.</p>
      </details>
      <details>
        <summary>Скільки триває монтаж?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Наземну мережеву станцію 30 кВт у Ладижині ми змонтували за тиждень, станцію 100 кВт для поливу саду в Луці-Мелешківській — за 10 днів.</p>
      </details>
      <details>
        <summary>Хто займається документами й підключенням?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Ми: технічні умови, договір з обленерго, підключення до мережі. Від вас потрібні підпис і документи на об'єкт.</p>
      </details>
    </div>
  </section>

  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>Розрахунок для вашого бізнесу</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00, і попросить рахунки за рік, щоб порахувати потужність та економію точно.</p>
      <?php enray_request_form( 'biznes' ); ?>
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
