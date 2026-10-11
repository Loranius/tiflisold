<?php
/** Послуга «Будівництво СЕС». Згенеровано enray/tools/build_services.py — правте дані там. */
?>
  <section class="hero hero--scenario hero--service" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><a href="<?php echo esc_url( home_url( '/' ) ); ?>#posluhy">Послуги</a><span aria-hidden="true"> / </span><span>Будівництво</span></p>
      <h1 id="hero-h">Будуємо сонячні станції під ключ</h1>
      <p class="hero-sub">Дахові й наземні станції 6–100 кВт: кріплення, панелі, інвертор і акумулятори, підключення й налагодження. Монтаж — 7–10 днів.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="<?php echo esc_url( home_url( '/' ) ); ?>#kalkulyator">Порахувати потужність</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">Будівництво СЕС</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows">
        <div><dt>Станції</dt><dd>дахові й наземні, мережеві й гібридні</dd></div>
        <div><dt>Потужність</dt><dd>6–100 кВт</dd></div>
        <div><dt>Монтаж</dt><dd>7–10 днів</dd></div>
        <div><dt>Документи й підключення</dt><dd>беремо на себе</dd></div>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Вартість</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Гарантія на роботи</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
      </dl>
    </figure>
  </section>

  <section class="section includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <div class="inc-grid">
      <div class="inc"><h3>Підготовка</h3><ul><li>огляд покрівлі чи ділянки</li><li>перевірка міцності даху</li><li>підготовка території для наземної станції</li></ul></div>
      <div class="inc"><h3>Конструкції</h3><ul><li>кріплення під тип покрівлі</li><li>опори для наземних станцій</li></ul></div>
      <div class="inc"><h3>Монтаж обладнання</h3><ul><li>панелі з правильним кутом і орієнтацією</li><li>інвертор, акумулятори, щит</li><li>кабелі й захист</li></ul></div>
      <div class="inc"><h3>Запуск</h3><ul><li>перевірка всіх вузлів</li><li>налаштування інвертора</li><li>перевірка генерації</li></ul></div>
    </div>
  </section>

  <section class="section" aria-labelledby="steps-h">
    <h2 id="steps-h">Від виїзду до запуску станції</h2>
    <ol class="steps steps--scenario steps--5">
      <li><span class="step-n">01</span><b>Виїзд</b><span>огляд даху чи ділянки, заміри</span></li>
      <li><span class="step-n">02</span><b>Проєкт</b><span>розрахунок генерації, підбір обладнання</span></li>
      <li><span class="step-n">03</span><b>Постачання</b><span>обладнання на об'єкт</span></li>
      <li><span class="step-n">04</span><b>Монтаж</b><span>7–10 днів для станцій 6–100 кВт</span></li>
      <li><span class="step-n">05</span><b>Підключення</b><span>документи, обленерго, сервіс після запуску</span></li>
    </ol>
  </section>

  <section class="section" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <div class="gallery">
      <figure><img src="<?php echo esc_url( enray_img( 'case-3.webp' ) ); ?>" width="800" height="500" alt="Дахова станція 6 кВт на цегляному будинку" loading="lazy"><figcaption>Дахова СЕС 6 кВт · 2024</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'case-2.webp' ) ); ?>" width="800" height="500" alt="Наземна станція 30 кВт у Ладижині" loading="lazy"><figcaption>Наземна СЕС 30 кВт · 2026</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'case-1.webp' ) ); ?>" width="800" height="500" alt="Станція 100 кВт на даху господарської будівлі" loading="lazy"><figcaption>СЕС 100 кВт · 2025</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'biz-g2.webp' ) ); ?>" width="800" height="500" alt="Ряд панелей наземної станції" loading="lazy"><figcaption>Наземна СЕС · 2026</figcaption></figure>
    </div>
  </section>

  <section class="section faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про будівництво</h2>
    <div class="faq-list">
      <details><summary>Скільки триває монтаж?<svg class="ico"><use href="#i-plus"/></svg></summary><p>За нашими кейсами 7–10 днів для станцій від 6 до 100 кВт. Точний строк залежить від даху чи ділянки й наявності обладнання.</p></details>
      <details><summary>Хто займається документами й підключенням?<svg class="ico"><use href="#i-plus"/></svg></summary><p>Ми: технічні умови, договір з обленерго й підключення до мережі. Від вас потрібні підпис і документи на об'єкт.</p></details>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Скільки коштує станція?<svg class="ico"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
    </div>
  </section>

  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>Заявка на будівництво станції</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00.</p>
      <?php enray_request_form( 'service', 'Будівництво СЕС' ); ?>
    </div>
    <div class="closing-aside">
      <p>Не хочете заповнювати форму? Зателефонуйте або напишіть у Viber, інженер відповість у робочий час.</p>
      <a class="nav-phone big-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
  </section>

  <section class="section services services--other" aria-labelledby="services-h">
    <h2 id="services-h">Інші послуги</h2>
    <div class="svc-groups">
      <div class="svc-group">
        <h3><svg class="ico"><use href="#i-sun"/></svg>Сонячна енергетика</h3>
        <ul class="svc-list">
          <li><a class="svc" href="<?php echo esc_url( home_url( '/proiektuvannia/' ) ); ?>"><span class="svc-name">Проєктування СЕС</span><span class="svc-what">виїзд і заміри, оцінка підключення до мережі, проєкт під ваше споживання</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
          <li><a class="svc" href="<?php echo esc_url( home_url( '/obsluhovuvannia/' ) ); ?>"><span class="svc-name">Обслуговування СЕС</span><span class="svc-what">діагностика, чищення панелей, налаштування інвертора, ремонт</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
        </ul>
      </div>
      <div class="svc-group">
        <h3><svg class="ico"><use href="#i-bolt"/></svg>Електрика й безпека</h3>
        <ul class="svc-list">
          <li><a class="svc" href="<?php echo esc_url( home_url( '/electrical-works/' ) ); ?>"><span class="svc-name">Електромонтажні роботи</span><span class="svc-what">проєкт і монтаж проводки, освітлення, заземлення й блискавкозахист, модернізація мереж</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
          <li><a class="svc" href="<?php echo esc_url( home_url( '/systemy-okhorony-ta-bezpeky/' ) ); ?>"><span class="svc-name">Системи охорони</span><span class="svc-what">охоронна й пожежна сигналізація, контроль доступу, захист периметра</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
          <li><a class="svc" href="<?php echo esc_url( home_url( '/videosposterezhennia-cctv/' ) ); ?>"><span class="svc-name">Відеоспостереження</span><span class="svc-what">камери для дому й бізнесу, запис 24/7, перегляд з телефона</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
        </ul>
      </div>
    </div>
  </section>
