<?php
/** Головна. Розмітка перенесена з прототипу enray/index.html. */
get_header();
?>
<main id="main">
  <section class="hero" id="top">
    <div class="hero-copy">
      <h1>Сонячна станція, яка тримає світло під час відключень</h1>
      <p class="hero-sub">Проєкт, монтаж і підключення у&nbsp;Вінницькій області за&nbsp;7–10&nbsp;днів</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#kalkulyator">Розрахувати станцію</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
    </div>
    <figure class="hero-figure">
      <img src="<?php echo esc_url( enray_img( 'hero-photo.webp' ) ); ?>" width="1410" height="842" alt="Дахова сонячна електростанція 6 кВт на цегляному будинку у Вінницькій області, змонтована EnRay у 2024 році" fetchpriority="high">
      <svg class="callouts" viewBox="0 0 1410 842" preserveAspectRatio="xMidYMax slice" aria-hidden="true" focusable="false">
        <text x="735" y="196" text-anchor="middle" transform="rotate(8.7 735 196)">6 кВт</text>
        <text x="560" y="126" text-anchor="middle">дахова СЕС · 2024</text>
        <text x="1044" y="330" text-anchor="end">монтаж — 1 тиждень</text>
      </svg>
    </figure>
  </section>

  <section class="facts" aria-label="Коротко про EnRay">
    <ul class="facts-strip">
      <li><svg class="ico"><use href="#i-plant"/></svg><span><b>100 кВт</b> — найбільший об'єкт</span></li>
      <li><svg class="ico"><use href="#i-clock"/></svg><span><b>7–10 днів</b> — монтаж</span></li>
      <li><svg class="ico"><use href="#i-doc"/></svg><span>Документи <span class="fact-long">й підключення </span>— на нас</span></li>
      <li class="fact-extra"><svg class="ico"><use href="#i-tool"/></svg><span>Сервіс після запуску</span></li>
    </ul>
  </section>

  <section class="section solutions" aria-labelledby="solutions-h">
    <h2 id="solutions-h">Оберіть свій сценарій</h2>
    <div class="scenario-grid">
      <article class="scenario" id="dim">
        <div class="scenario-media"><span class="tab">Дім</span><img src="<?php echo esc_url( enray_img( 'card-home.webp' ) ); ?>" width="720" height="376" alt="Дахова сонячна станція EnRay на приватному будинку" loading="lazy"></div>
        <div class="scenario-body">
          <p>Резерв на час відключень: гібридна станція з акумулятором для світла, котла, холодильника й інтернету.</p>
          <p class="spec">приклад: дахова СЕС 6 кВт · 2024</p>
          <a class="link-strong scenario-link" href="<?php echo esc_url( home_url( '/dim/' ) ); ?>">Станція для дому <svg class="ico"><use href="#i-arrow"/></svg></a>
        </div>
      </article>
      <article class="scenario" id="biznes">
        <div class="scenario-media"><span class="tab">Бізнес</span><img src="<?php echo esc_url( enray_img( 'card-biz.webp' ) ); ?>" width="720" height="376" alt="Наземна мережева сонячна станція 30 кВт у Ладижині" loading="lazy"></div>
        <div class="scenario-body">
          <p>Менший рахунок за електроенергію: мережева або гібридна станція на даху чи на землі, від проєкту до договору з обленерго.</p>
          <p class="spec">приклад: наземна СЕС 30 кВт · Ладижин · 2026</p>
          <a class="link-strong scenario-link" href="<?php echo esc_url( home_url( '/biznes/' ) ); ?>">Станція для бізнесу <svg class="ico"><use href="#i-arrow"/></svg></a>
        </div>
      </article>
      <article class="scenario" id="agro">
        <div class="scenario-media scenario-media--collage"><span class="tab">Агро</span><img src="<?php echo esc_url( enray_img( 'card-agro.webp' ) ); ?>" width="720" height="376" alt="Сонячні станції EnRay для поливу: панелі біля водойми, на даху господарської будівлі та на землі" loading="lazy"></div>
        <div class="scenario-body">
          <p>Полив, насоси й віддалені ділянки: станції на 50–100 кВт під сезонне навантаження.</p>
          <p class="spec">приклад: СЕС 100 кВт · Лука-Мелешківська · 2025</p>
          <a class="link-strong scenario-link" href="<?php echo esc_url( home_url( '/agro/' ) ); ?>">Станція для поливу <svg class="ico"><use href="#i-arrow"/></svg></a>
        </div>
      </article>
    </div>
  </section>

  <section class="calc" id="kalkulyator" aria-labelledby="calc-h">
    <div class="calc-inner">
      <div class="calc-input">
        <h2 id="calc-h"><label for="bill">Ваш рахунок за світло, грн/міс</label></h2>
        <div class="slider">
          <input id="bill" type="range" min="1000" max="15000" step="500" value="5000" aria-describedby="calc-note">
          <div class="slider-scale" aria-hidden="true"><span>1 000</span><span>5 000</span><span>10 000</span><span>15 000+</span></div>
        </div>
        <output class="bill-value" for="bill" id="bill-out">5 000 грн</output>
      </div>
      <div class="calc-result" aria-live="polite">
        <p class="calc-kw">Рекомендована потужність: <b id="kw-out">≈ 12 кВт</b></p>
        <p class="calc-detail" id="kwh-out">≈ 1 160 кВт·год на місяць, ≈ 13 900 кВт·год на рік</p>
        <p class="calc-note" id="calc-note">Орієнтовно, за тарифом 4,32 грн/кВт·год і генерацією ≈ 1 150 кВт·год на 1 кВт панелей за рік. Точну потужність, склад і ціну інженер порахує після огляду.</p>
        <a class="link-strong" href="#zayavka" id="calc-cta">Отримати детальний розрахунок <svg class="ico"><use href="#i-arrow"/></svg></a>
      </div>
    </div>
  </section>

  <section class="section cases" id="keysy" aria-labelledby="cases-h">
    <div class="cases-head">
      <h2 id="cases-h">Наші реалізовані кейси</h2>
      <a class="link-strong" href="<?php echo esc_url( home_url( '/keysy/' ) ); ?>">Усі кейси <svg class="ico"><use href="#i-arrow"/></svg></a>
    </div>
    <div class="case-grid">
      <article class="case">
        <h3><b>СЕС 100 кВт для поливу саду</b> <span class="nw">· Лука-Мелешківська · 2025</span></h3>
        <img src="<?php echo esc_url( enray_img( 'case-1-photo.webp' ) ); ?>" width="1100" height="262" alt="Сонячні панелі на даху господарської будівлі серед садів у селі Лука-Мелешківська" loading="lazy">
        <dl class="case-meta">
          <div><dt>Потужність</dt><dd>100 кВт</dd></div>
          <div><dt>Монтаж</dt><dd>10 днів</dd></div>
          <div><dt>Задача</dt><dd class="txt">живлення поливу</dd></div>
        </dl>
      </article>
      <article class="case">
        <h3><b>Наземна СЕС 30 кВт</b> <span class="nw">· Ладижин · 2026</span></h3>
        <img src="<?php echo esc_url( enray_img( 'case-2-photo.webp' ) ); ?>" width="1100" height="262" alt="Ряд сонячних панелей наземної станції 30 кВт у Ладижині" loading="lazy" decoding="async">
        <dl class="case-meta">
          <div><dt>Потужність</dt><dd>30 кВт</dd></div>
          <div><dt>Монтаж</dt><dd>1 тиждень</dd></div>
          <div><dt>Задача</dt><dd class="txt">«зелений тариф»</dd></div>
        </dl>
      </article>
    </div>
  </section>

  <section class="section closing" aria-label="Як ми працюємо і заявка">
    <div class="process" id="pro-nas">
      <h2>Як ми працюємо</h2>
      <ol class="steps">
        <li><span class="step-n">01</span><b>Виїзд</b><span>огляд даху чи ділянки, заміри</span></li>
        <li><span class="step-n">02</span><b>Проєкт</b><span>розрахунок генерації, підбір обладнання</span></li>
        <li><span class="step-n">03</span><b>Постачання</b><span>обладнання на об'єкт</span></li>
        <li><span class="step-n">04</span><b>Монтаж</b><span>7–10 днів для станцій 6–100 кВт</span></li>
        <li><span class="step-n">05</span><b>Підключення</b><span>документи, обленерго, сервіс після запуску</span></li>
      </ol>
    </div>
    <div class="request" id="zayavka">
      <h2>Отримати розрахунок</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00, з попереднім розрахунком потужності.</p>
      <?php enray_request_form( 'home' ); ?>
    </div>
  </section>
</main>
<?php
get_footer();
