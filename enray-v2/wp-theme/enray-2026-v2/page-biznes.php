<?php
/** Сторінка сценарію «biznes». Розмітка з enray-v2/biz/ (build_wp.py). */
get_header();
?>
<main id="main" class="sheet sheet--page">
  <div class="rings" aria-hidden="true"></div>

  <section class="phero" aria-labelledby="hero-h">
    <img class="phero-photo" src="<?php echo esc_url( enray_asset( 'img/biz-hero.webp' ) ); ?>" width="1280" height="720" alt="Ряд панелей наземної сонячної станції EnRay 30 кВт у Ладижині" fetchpriority="high">
    <div class="phero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true">/</span><span>Для бізнесу</span></p>
      <h1 id="hero-h">Менший рахунок за&nbsp;світло для&nbsp;бізнесу</h1>
      <p class="phero-sub">Мережеві й гібридні сонячні станції на даху чи на землі у&nbsp;Вінницькій області: проєкт, монтаж і&nbsp;підключення до мережі.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#kalkulyator">Порахувати економію</a>
        <a class="btn btn-glass btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-phone"/></svg>Подзвонити</a>
      </div>
    </div>
  </section>

  <section class="day" aria-labelledby="bill-h">
    <div class="sec-head">
      <h2 id="bill-h">Скільки з рахунку закриє станція</h2>
      <p class="lead">Рахунок за рік по місяцях без станції й&nbsp;зі станцією. Графік перерахується, щойно ви введете свої дані нижче.</p>
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

  <section class="rezerv" id="kalkulyator" aria-labelledby="calc-h">
    <div class="sec-head">
      <h2 id="calc-h">Порахуйте для свого бізнесу</h2>
      <p class="lead">Введіть свій рахунок і&nbsp;тариф. Обидва графіки на сторінці перерахуються за вашими даними.</p>
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

  <section class="case-feature" aria-labelledby="case-h">
    <div class="sec-head">
      <h2 id="case-h">Наша станція в&nbsp;Ладижині</h2>
      <p class="lead">Наземна мережева станція 30&nbsp;кВт, змонтована за тиждень.</p>
    </div>
    <div class="cf-grid">
      <figure class="cf-main">
        <img src="<?php echo esc_url( enray_asset( 'img/case-2.webp' ) ); ?>" width="800" height="500" alt="Наземна мережева сонячна станція 30 кВт у Ладижині, змонтована EnRay у 2026 році" loading="lazy" decoding="async">
        <figcaption>Наземна СЕС 30&nbsp;кВт · Ладижин · 2026</figcaption>
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
          <img src="<?php echo esc_url( enray_asset( 'img/biz-detail.webp' ) ); ?>" width="800" height="600" alt="Інвертор і щиток захисту на стійках під панелями станції в Ладижині" loading="lazy" decoding="async">
          <figcaption>Інвертор і щиток під панелями, той самий об'єкт</figcaption>
        </figure>
      </div>
    </div>
    <ul class="gallery" aria-label="Наземні станції EnRay, 2026">
      <li><img src="<?php echo esc_url( enray_asset( 'img/biz-g1.webp' ) ); ?>" alt="Ряд панелей наземної станції в Ладижині" loading="lazy" decoding="async"><span>Ладижин · 30 кВт · 2026</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/biz-g2.webp' ) ); ?>" alt="Конструкція наземної станції в Ладижині, вигляд знизу" loading="lazy" decoding="async"><span>Ладижин · конструкція</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/biz-g3.webp' ) ); ?>" alt="Наземна сонячна станція біля сільського будинку, вигляд з дрона" loading="lazy" decoding="async"><span>Наземна СЕС · 2026</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/biz-g4.webp' ) ); ?>" alt="Ряди панелей наземної станції на ділянці" loading="lazy" decoding="async"><span>Наземна СЕС · 2026</span></li>
    </ul>
  </section>

  <section class="steps" aria-labelledby="steps-h">
    <h2 id="steps-h">Від рахунку до власної генерації</h2>
    <ol class="timeline">
        <li><span class="step-n">01</span><h3>Виїзд</h3><p>Огляд даху чи ділянки, рахунки за рік.</p></li>
        <li><span class="step-n">02</span><h3>Проєкт</h3><p>Потужність під денне споживання.</p></li>
        <li><span class="step-n">03</span><h3>Постачання</h3><p>Панелі, інвертори, конструкції.</p></li>
        <li><span class="step-n">04</span><h3>Монтаж</h3><p>Близько тижня для 30 кВт.</p></li>
        <li><span class="step-n">05</span><h3>Підключення</h3><p>Документи, обленерго, лічильник.</p></li>
    </ol>
  </section>

  <section class="faq" aria-labelledby="faq-h">
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
    
  </section>

  <section class="request" id="zayavka" aria-labelledby="req-h">
    <div class="req-side">
      <h2 id="req-h">Розрахунок для вашого бізнесу</h2>
      <p class="lead">Інженер передзвонить у&nbsp;робочий час, 09:00–18:00, і&nbsp;попросить рахунки за рік, щоб порахувати потужність та економію точно.</p>
      <p class="req-alt">Зручніше голосом?</p>
      <a class="req-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
    <div class="req-card">
      <?php enray_request_form( 'biznes' ); ?>
    </div>
  </section>
</main>
<?php
get_footer();
