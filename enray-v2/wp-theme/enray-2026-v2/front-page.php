<?php
/** Головна. Розмітка з enray-v2/index.html (build_wp.py). */
get_header();
?>
<section class="hero" id="top" aria-labelledby="hero-h">
  <picture class="hero-photo">
    <source media="(max-width: 45em)" srcset="<?php echo esc_url( enray_asset( 'img/hero-m.webp' ) ); ?>">
    <img src="<?php echo esc_url( enray_asset( 'img/hero-1800.webp' ) ); ?>" srcset="<?php echo esc_url( enray_asset( 'img/hero-1200.webp' ) ); ?> 1200w, <?php echo esc_url( enray_asset( 'img/hero-1800.webp' ) ); ?> 1800w, <?php echo esc_url( enray_asset( 'img/hero-2400.webp' ) ); ?> 2400w" sizes="100vw" width="2400" height="1302" alt="Ряд сонячних панелей серед квітучого поля на заході сонця" fetchpriority="high">
  </picture>
  <svg class="sunpath" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
    <defs><radialGradient id="sun-glow"><stop offset="0" stop-color="#ffe27a" stop-opacity=".95"/><stop offset=".35" stop-color="#ffc928" stop-opacity=".55"/><stop offset="1" stop-color="#ffc928" stop-opacity="0"/></radialGradient></defs>
    <path class="sp-arc" d="M-80 760 Q800 -380 1680 760" pathLength="1"/>
    <g class="sp-tick"><circle cx="202" cy="454" r="4"/><text x="202" y="438" text-anchor="middle">06:00</text></g><g class="sp-tick"><circle cx="800" cy="190" r="4"/><text x="800" y="174" text-anchor="middle">12:00</text></g><g class="sp-tick"><circle cx="1398" cy="454" r="4"/><text x="1398" y="438" text-anchor="middle">18:00</text></g>
    <g class="sp-sun"><circle r="70" fill="url(#sun-glow)"/><circle r="11" class="sp-core"/>
      <animateMotion id="sun-move" dur="2.4s" begin="indefinite" fill="freeze" calcMode="spline" keyPoints="0;0.78" keyTimes="0;1" keySplines=".16 1 .3 1" path="M-80 760 Q800 -380 1680 760"/>
    </g>
  </svg>
  <div class="hero-copy">
    <h1 id="hero-h">Сонячні станції, електрика й безпека <span class="hero-key">під&nbsp;ключ</span></h1>
    <p class="hero-sub">Для дому й&nbsp;бізнесу у&nbsp;Вінницькій області. Проєкт, монтаж і&nbsp;сервіс від однієї команди.</p>
    <div class="hero-actions">
      <a class="btn btn-primary btn-lg" href="#kalkulyator">Порахувати потужність</a>
      <a class="btn btn-glass btn-lg" href="#posluhy">Усі послуги</a>
    </div>
  </div>
</section>

<main id="main" class="sheet">
  <div class="rings" aria-hidden="true"></div>

  <section class="intro" id="rishennya" aria-labelledby="intro-h">
    <h2 id="intro-h">Енергія для дому й&nbsp;бізнесу</h2>
    <p class="lead">EnRay з&nbsp;Вінниці проєктує й&nbsp;будує сонячні станції, робить електромонтаж, ставить сигналізацію й&nbsp;камери. Від виїзду інженера до підключення в&nbsp;обленерго працює одна команда.</p>
    <ul class="ways">
      <li class="way"><a href="<?php echo esc_url( home_url( '/dim/' ) ); ?>"><img src="<?php echo esc_url( enray_asset( 'img/dim.webp' ) ); ?>" alt="Сонячні панелі на даху цегляного приватного будинку" loading="lazy" decoding="async"><span class="way-text"><b>Для дому</b><span>Світло під час відключень і менший рахунок</span></span><span class="way-ico"><svg class="ico" aria-hidden="true"><use href="#i-home"/></svg></span></a></li>
      <li class="way"><a href="<?php echo esc_url( home_url( '/biznes/' ) ); ?>"><img src="<?php echo esc_url( enray_asset( 'img/biz.webp' ) ); ?>" alt="Наземна сонячна станція 30 кВт у Ладижині" loading="lazy" decoding="async"><span class="way-text"><b>Для бізнесу</b><span>Підприємства, магазини, склади й агрокомпанії</span></span><span class="way-ico"><svg class="ico" aria-hidden="true"><use href="#i-factory"/></svg></span></a></li>
    </ul>
  </section>

  <section class="facts" aria-labelledby="facts-h">
    <h2 id="facts-h">EnRay у фактах</h2>
    <ul class="fact-cards">
      <li class="fact"><img src="<?php echo esc_url( enray_asset( 'img/lad-3.webp' ) ); ?>" alt="" loading="lazy" decoding="async"><b>6–100&nbsp;кВт</b><span>потужність збудованих станцій</span></li>
      <li class="fact"><img src="<?php echo esc_url( enray_asset( 'img/roof-f2.webp' ) ); ?>" alt="" loading="lazy" decoding="async"><b>7–10&nbsp;днів</b><span>монтаж за нашими кейсами</span></li>
      <li class="fact"><img src="<?php echo esc_url( enray_asset( 'img/ground-2.webp' ) ); ?>" alt="" loading="lazy" decoding="async"><b>Документи</b><span>і підключення до мережі — на нас</span></li>
    </ul>
  </section>

  <section class="services" id="posluhy" aria-labelledby="svc-h">
    <div class="sec-head">
      <h2 id="svc-h">Що ми робимо</h2>
      <p class="lead">Сонячна енергетика, електрика й безпека: одна команда замість трьох підрядників.</p>
    </div>
    <div class="rail" data-rail>
      <ul class="rail-track" tabindex="0" aria-label="Послуги, гортайте вбік">
        <li class="svc-card">
          <img src="<?php echo esc_url( enray_asset( 'img/roof-a2.webp' ) ); ?>" alt="Сонячні панелі на даху приватного будинку" loading="lazy" decoding="async">
          <div class="svc-body">
            <span class="svc-n">01</span>
            <h3>Проєктування СЕС</h3>
            <p>Виїзд і заміри, оцінка підключення до мережі, проєкт під ваше споживання.</p>
          </div>
          <a class="svc-go" href="<?php echo esc_url( home_url( '/proiektuvannia/' ) ); ?>" aria-label="Детальніше: Проєктування СЕС"><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a>
        </li>
        <li class="svc-card">
          <img src="<?php echo esc_url( enray_asset( 'img/lad-2.webp' ) ); ?>" alt="Наземна станція 30 кВт у Ладижині" loading="lazy" decoding="async">
          <div class="svc-body">
            <span class="svc-n">02</span>
            <h3>Будівництво СЕС</h3>
            <p>Дахові й наземні станції 6–100 кВт: кріплення, панелі, інвертор і акумулятори, налагодження.</p>
          </div>
          <a class="svc-go" href="<?php echo esc_url( home_url( '/budivnytstvo/' ) ); ?>" aria-label="Детальніше: Будівництво СЕС"><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a>
        </li>
        <li class="svc-card">
          <img src="<?php echo esc_url( enray_asset( 'img/roof-e2.webp' ) ); ?>" alt="Дахова сонячна станція EnRay" loading="lazy" decoding="async">
          <div class="svc-body">
            <span class="svc-n">03</span>
            <h3>Обслуговування СЕС</h3>
            <p>Діагностика, чищення панелей, налаштування інвертора, ремонт.</p>
          </div>
          <a class="svc-go" href="<?php echo esc_url( home_url( '/obsluhovuvannia/' ) ); ?>" aria-label="Детальніше: Обслуговування СЕС"><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a>
        </li>
        <li class="svc-card">
          <img src="<?php echo esc_url( enray_asset( 'img/dim-inverter.webp' ) ); ?>" alt="Інвертор і електрощиток, змонтовані EnRay" loading="lazy" decoding="async">
          <div class="svc-body">
            <span class="svc-n">04</span>
            <h3>Електромонтажні роботи</h3>
            <p>Проводка, щити, освітлення, заземлення й блискавкозахист, модернізація мереж.</p>
          </div>
          <a class="svc-go" href="<?php echo esc_url( home_url( '/electrical-works/' ) ); ?>" aria-label="Детальніше: Електромонтажні роботи"><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a>
        </li>
        <li class="svc-card svc-card--art">
          <span class="svc-art"><svg class="ico" aria-hidden="true"><use href="#i-shield"/></svg></span>
          <div class="svc-body">
            <span class="svc-n">05</span>
            <h3>Системи охорони</h3>
            <p>Охоронна й пожежна сигналізація, контроль доступу, захист периметра.</p>
          </div>
          <a class="svc-go" href="<?php echo esc_url( home_url( '/systemy-okhorony-ta-bezpeky/' ) ); ?>" aria-label="Детальніше: Системи охорони"><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a>
        </li>
        <li class="svc-card svc-card--art">
          <span class="svc-art"><svg class="ico" aria-hidden="true"><use href="#i-camera"/></svg></span>
          <div class="svc-body">
            <span class="svc-n">06</span>
            <h3>Відеоспостереження</h3>
            <p>Камери для дому й бізнесу, запис 24/7, перегляд з телефона.</p>
          </div>
          <a class="svc-go" href="<?php echo esc_url( home_url( '/videosposterezhennia-cctv/' ) ); ?>" aria-label="Детальніше: Відеоспостереження"><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a>
        </li>
      </ul>
      <div class="rail-ctrl">
        <div class="rail-progress" aria-hidden="true"><span></span></div>
        <button class="round" type="button" data-dir="-1" aria-label="Попередні послуги"><svg class="ico" aria-hidden="true"><use href="#i-left"/></svg></button>
        <button class="round" type="button" data-dir="1" aria-label="Наступні послуги"><svg class="ico" aria-hidden="true"><use href="#i-right"/></svg></button>
      </div>
    </div>
  </section>

  <section class="calc" id="kalkulyator" aria-labelledby="calc-h">
    <div class="calc-inner">
      <div class="calc-top">
        <h2 id="calc-h">Яка потужність вам потрібна</h2>
        <fieldset class="calc-switch" id="calc-switch" hidden>
          <legend class="sr-only">Для чого станція</legend>
          <label><input type="radio" name="calc-mode" value="dim" data-object="Станція для дому" checked><span>Дім</span></label>
          <label><input type="radio" name="calc-mode" value="biz" data-object="Станція для бізнесу"><span>Бізнес</span></label>
        </fieldset>
      </div>

      <div class="calc-panel" data-mode="dim">
        <div class="calc-input">
          <label class="calc-label" for="bill">Ваш рахунок за світло, грн/міс</label>
          <div class="slider">
            <input id="bill" type="range" min="1000" max="15000" step="500" value="5000" aria-describedby="calc-note">
            <div class="slider-scale" aria-hidden="true"><span style="--at:0">1 000</span><span style="--at:.2857">5 000</span><span style="--at:.6429">10 000</span><span style="--at:1">15 000+</span></div>
          </div>
          <output class="bill-value" for="bill" id="bill-out">5 000 грн</output>
        </div>
        <div class="calc-result" aria-live="polite">
          <p class="calc-kw">Рекомендована потужність: <b id="kw-out">≈ 12 кВт</b></p>
          <p class="calc-detail" id="kwh-out">≈ 1 160 кВт·год на місяць, ≈ 13 900 кВт·год на рік</p>
          <p class="calc-note" id="calc-note">Орієнтовно, за побутовим тарифом 4,32 грн/кВт·год і генерацією ≈ 1 150 кВт·год на 1 кВт панелей за рік. Ємність акумулятора на час відключень інженер підбере під ваші прилади. Точну потужність, склад і ціну інженер порахує після огляду.</p>
          <a class="link-strong" href="#zayavka">Отримати детальний розрахунок <svg class="ico"><use href="#i-arrow"/></svg></a>
        </div>
      </div>

      <div class="calc-panel" data-mode="biz" hidden>
        <div class="calc-input">
          <label class="calc-label" for="c-kwh">Споживання за місяць, кВт·год</label>
          <div class="slider">
            <input id="c-kwh" type="range" min="1000" max="12000" step="250" value="3000" aria-describedby="c-biz-note">
            <div class="slider-scale" aria-hidden="true"><span style="--at:0">1 000</span><span style="--at:.3636">5 000</span><span style="--at:1">12 000+</span></div>
          </div>
          <output class="bill-value" for="c-kwh" id="c-kwh-out">3 000 кВт·год</output>
        </div>
        <div class="calc-result" aria-live="polite">
          <p class="calc-kw">Рекомендована потужність: <b id="c-biz-kw">≈ 30 кВт</b></p>
          <p class="calc-detail" id="c-biz-detail">≈ 36 000 кВт·год на рік споживання, станція дасть ≈ 34 500 кВт·год на рік</p>
          <p class="calc-note" id="c-biz-note">Споживання в кВт·год є в рахунку або в кабінеті обленерго. Тариф для бізнесу в кожного свій, тому економію в гривнях інженер порахує за вашим тарифом і тим, скільки енергії ви використовуєте вдень.</p>
          <a class="link-strong" href="#zayavka">Отримати детальний розрахунок <svg class="ico"><use href="#i-arrow"/></svg></a>
        </div>
      </div>
    </div>
  
  </section>

  <section class="cases" id="keysy" aria-labelledby="cases-h">
    <div class="sec-head">
      <h2 id="cases-h">Збудовані станції</h2>
      <a class="link-pill" href="<?php echo esc_url( home_url( '/keysy/' ) ); ?>">Усі кейси <svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a>
    </div>
    <ul class="case-row" tabindex="0" aria-label="Збудовані станції, гортайте вбік">
        <li class="case">
          <img src="<?php echo esc_url( enray_asset( 'img/case-3.webp' ) ); ?>" alt="Дахова сонячна станція 6 кВт на приватному будинку" loading="lazy" decoding="async">
          <div class="case-body">
            <p class="case-meta">2024 · Вінницька обл.</p>
            <h3>Дахова СЕС 6&nbsp;кВт</h3>
            <dl><div><dt>Потужність</dt><dd>6 кВт</dd></div><div><dt>Монтаж</dt><dd>1 тиждень</dd></div><div><dt>Об'єкт</dt><dd>приватний будинок</dd></div></dl>
          </div>
        </li>
        <li class="case">
          <img src="<?php echo esc_url( enray_asset( 'img/case-2.webp' ) ); ?>" alt="Наземна станція 30 кВт у Ладижині" loading="lazy" decoding="async">
          <div class="case-body">
            <p class="case-meta">2026 · Ладижин</p>
            <h3>Наземна СЕС 30&nbsp;кВт</h3>
            <dl><div><dt>Потужність</dt><dd>30 кВт</dd></div><div><dt>Монтаж</dt><dd>1 тиждень</dd></div><div><dt>Задача</dt><dd>«зелений тариф»</dd></div></dl>
          </div>
        </li>
        <li class="case">
          <img src="<?php echo esc_url( enray_asset( 'img/case-1.webp' ) ); ?>" alt="Станція 100 кВт на даху господарської будівлі" loading="lazy" decoding="async">
          <div class="case-body">
            <p class="case-meta">2025 · Лука-Мелешківська</p>
            <h3>СЕС 100&nbsp;кВт для господарства</h3>
            <dl><div><dt>Потужність</dt><dd>100 кВт</dd></div><div><dt>Монтаж</dt><dd>10 днів</dd></div><div><dt>Задача</dt><dd>живлення господарства</dd></div></dl>
          </div>
        </li>
    </ul>
  </section>

  <section class="steps" id="etapy" aria-labelledby="steps-h">
    <h2 id="steps-h">Як ми працюємо</h2>
    <p class="lead">Від першого дзвінка до запуску станції — п'ять зрозумілих кроків.</p>
    <ol class="timeline">
        <li><span class="step-n">01</span><h3>Виїзд</h3><p>Інженер оглядає дах чи ділянку, робить заміри.</p></li>
        <li><span class="step-n">02</span><h3>Проєкт</h3><p>Розрахунок генерації й підбір обладнання під ваше споживання.</p></li>
        <li><span class="step-n">03</span><h3>Постачання</h3><p>Обладнання на об'єкт.</p></li>
        <li><span class="step-n">04</span><h3>Монтаж</h3><p>7–10 днів для станцій 6–100 кВт.</p></li>
        <li><span class="step-n">05</span><h3>Підключення</h3><p>Документи, договір з обленерго, сервіс після запуску.</p></li>
    </ol>
  </section>

  <section class="request" id="zayavka" aria-labelledby="req-h">
    <div class="req-side">
      <h2 id="req-h">Отримати розрахунок</h2>
      <p class="lead">Інженер передзвонить у&nbsp;робочий час, 09:00–18:00, уточнить задачу й дасть попередній розрахунок.</p>
      <p class="req-alt">Зручніше голосом?</p>
      <a class="req-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
    <div class="req-card">
      <?php enray_request_form( 'home' ); ?>
    </div>
  </section>
</main>
<?php
get_footer();
