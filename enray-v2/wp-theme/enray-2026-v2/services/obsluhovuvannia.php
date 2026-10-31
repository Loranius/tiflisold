<?php
/** Послуга «obsluhovuvannia». Згенеровано enray-v2/tools/build_wp.py з enray-v2/posluhy/obsluhovuvannia/. */
?>

  <div class="rings" aria-hidden="true"></div>

  <section class="phero phero--svc" aria-labelledby="hero-h">
    <img class="phero-photo" src="<?php echo esc_url( enray_asset( 'img/roof-f2.webp' ) ); ?>" width="1100" height="613" alt="Дахова сонячна станція EnRay, вигляд з дрона" fetchpriority="high">
    <div class="phero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( home_url( '/#posluhy' ) ); ?>">Послуги</a><span aria-hidden="true">/</span><span>Обслуговування</span></p>
      <h1 id="hero-h">Обслугову&shy;вання сонячних станцій</h1>
      <p class="phero-sub">Огляд і діагностика, чищення панелей, налаштування інвертора й ремонт, щоб станція давала стільки енергії, скільки має.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#zayavka">Замовити огляд</a>
        <a class="btn btn-glass btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-phone"/></svg>Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">Обслуговування СЕС</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows"><div><dt>Станції</dt><dd>дахові й наземні, мережеві й гібридні</dd></div><div><dt>Територія</dt><dd>Вінниця й область</dd></div><?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Станції інших монтажників</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?><?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Вартість виїзду й огляду</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?><?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Як швидко приїдемо</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?><?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Гарантія на обладнання</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?></dl>
    </figure>
  </section>

  <section class="includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <ul class="inc-grid"><li class="inc"><h3>Огляд і діагностика</h3><ul><li>панелі, кабелі, кріплення й з'єднання</li><li>інвертор і акумулятори</li><li>пошук причин нижчої генерації</li></ul></li><li class="inc"><h3>Профілактика</h3><ul><li>чищення панелей від пилу й бруду</li><li>перевірка конструкцій і кріплень</li></ul></li><li class="inc"><h3>Налаштування</h3><ul><li>параметри інвертора</li><li>якість з'єднань</li><li>моніторинг роботи станції</li></ul></li><li class="inc"><h3>Ремонт</h3><ul><li>заміна несправних деталей</li><li>оперативний ремонт</li><li>консультації з експлуатації</li></ul></li></ul>
  </section>

  <section class="steps" aria-labelledby="steps-h">
    <h2 id="steps-h">Як проходить обслуговування</h2>
    <ol class="timeline">
        <li><span class="step-n">01</span><h3>Заявка</h3><p>Що сталося або коли був останній огляд.</p></li>
        <li><span class="step-n">02</span><h3>Виїзд</h3><p>Діагностика на місці.</p></li>
        <li><span class="step-n">03</span><h3>Роботи</h3><p>Чищення, налаштування або ремонт.</p></li>
        <li><span class="step-n">04</span><h3>Пояснення</h3><p>Що зроблено й на що зважати далі.</p></li>
    </ol>
  </section>

  <section class="works" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <ul class="gallery" aria-label="Роботи EnRay">
      <li><img src="<?php echo esc_url( enray_asset( 'img/dim-inverter.webp' ) ); ?>" alt="Інвертор і електрощиток станції 6 кВт у будинку" loading="lazy" decoding="async"><span>Інвертор і щиток · 2024</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/biz-detail.webp' ) ); ?>" alt="Кріплення й кабелі наземної станції" loading="lazy" decoding="async"><span>Наземна СЕС · 2026</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/dim-g1.webp' ) ); ?>" alt="Дахова сонячна станція на приватному будинку" loading="lazy" decoding="async"><span>Дахова СЕС · 2024</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/biz-g3.webp' ) ); ?>" alt="Панелі наземної станції" loading="lazy" decoding="async"><span>Наземна СЕС · 2026</span></li>
    </ul>
  </section>

  <section class="faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про обслуговування</h2>
    <div class="faq-list">
      <details><summary>Що входить у плановий огляд?<svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></summary><p>Перевірка панелей, кабелів і конструкцій, чищення панелей, перевірка інвертора й акумуляторів, аналіз того, скільки енергії дає станція.</p></details>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Як часто обслуговувати станцію?<svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Чи обслуговуєте станції, які ставили інші компанії?<svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
    </div>
  </section>

  <section class="request" id="zayavka" aria-labelledby="req-h">
    <div class="req-side">
      <h2 id="req-h">Заявка на обслуговування</h2>
      <p class="lead">Інженер передзвонить у&nbsp;робочий час, 09:00–18:00.</p>
      <p class="req-alt">Зручніше голосом?</p>
      <a class="req-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
    <div class="req-card">
      <?php enray_request_form( 'service', 'Обслуговування СЕС' ); ?>
    </div>
  </section>

  <section class="others" aria-labelledby="oth-h">
    <h2 id="oth-h">Інші послуги</h2>
    <ul class="svc-links"><li><a class="svc-link" href="<?php echo esc_url( home_url( '/proiektuvannia/' ) ); ?>"><span class="svc-link-name">Проєктування СЕС</span><span class="svc-link-what">виїзд і заміри, оцінка підключення до мережі, проєкт під ваше споживання</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/budivnytstvo/' ) ); ?>"><span class="svc-link-name">Будівництво СЕС</span><span class="svc-link-what">дахові й наземні станції: кріплення, панелі, інвертор і акумулятори, налагодження</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/electrical-works/' ) ); ?>"><span class="svc-link-name">Електромонтажні роботи</span><span class="svc-link-what">проєкт і монтаж проводки, освітлення, заземлення й блискавкозахист, модернізація мереж</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/systemy-okhorony-ta-bezpeky/' ) ); ?>"><span class="svc-link-name">Системи охорони</span><span class="svc-link-what">охоронна й пожежна сигналізація, контроль доступу, захист периметра</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/videosposterezhennia-cctv/' ) ); ?>"><span class="svc-link-name">Відеоспостереження</span><span class="svc-link-what">камери для дому й бізнесу, запис 24/7, перегляд з телефона</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li></ul>
  </section>
