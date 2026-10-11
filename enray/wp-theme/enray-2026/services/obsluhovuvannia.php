<?php
/** Послуга «Обслуговування СЕС». Згенеровано enray/tools/build_services.py — правте дані там. */
?>
  <section class="hero hero--scenario hero--service" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><a href="<?php echo esc_url( home_url( '/' ) ); ?>#posluhy">Послуги</a><span aria-hidden="true"> / </span><span>Обслуговування</span></p>
      <h1 id="hero-h">Обслугову&shy;вання сонячних станцій</h1>
      <p class="hero-sub">Огляд і діагностика, чищення панелей, налаштування інвертора й ремонт, щоб станція давала стільки енергії, скільки має.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#zayavka">Замовити огляд</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">Обслуговування СЕС</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows">
        <div><dt>Станції</dt><dd>дахові й наземні, мережеві й гібридні</dd></div>
        <div><dt>Територія</dt><dd>Вінниця й область</dd></div>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Станції інших монтажників</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Вартість виїзду й огляду</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Як швидко приїдемо</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Гарантія на обладнання</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
      </dl>
    </figure>
  </section>

  <section class="section includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <div class="inc-grid">
      <div class="inc"><h3>Огляд і діагностика</h3><ul><li>панелі, кабелі, кріплення й з'єднання</li><li>інвертор і акумулятори</li><li>пошук причин нижчої генерації</li></ul></div>
      <div class="inc"><h3>Профілактика</h3><ul><li>чищення панелей від пилу й бруду</li><li>перевірка конструкцій і кріплень</li></ul></div>
      <div class="inc"><h3>Налаштування</h3><ul><li>параметри інвертора</li><li>якість з'єднань</li><li>моніторинг роботи станції</li></ul></div>
      <div class="inc"><h3>Ремонт</h3><ul><li>заміна несправних деталей</li><li>оперативний ремонт</li><li>консультації з експлуатації</li></ul></div>
    </div>
  </section>

  <section class="section" aria-labelledby="steps-h">
    <h2 id="steps-h">Як проходить обслуговування</h2>
    <ol class="steps steps--scenario steps--4">
      <li><span class="step-n">01</span><b>Заявка</b><span>що сталося або коли був останній огляд</span></li>
      <li><span class="step-n">02</span><b>Виїзд</b><span>діагностика на місці</span></li>
      <li><span class="step-n">03</span><b>Роботи</b><span>чищення, налаштування або ремонт</span></li>
      <li><span class="step-n">04</span><b>Пояснення</b><span>що зроблено й на що зважати далі</span></li>
    </ol>
  </section>

  <section class="section" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <div class="gallery">
      <figure><img src="<?php echo esc_url( enray_img( 'dim-inverter.webp' ) ); ?>" width="800" height="500" alt="Інвертор і електрощиток станції 6 кВт у будинку" loading="lazy"><figcaption>Інвертор і щиток · 2024</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'biz-detail.webp' ) ); ?>" width="800" height="500" alt="Кріплення й кабелі наземної станції" loading="lazy"><figcaption>Наземна СЕС · 2026</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'dim-g1.webp' ) ); ?>" width="800" height="500" alt="Дахова сонячна станція на приватному будинку" loading="lazy"><figcaption>Дахова СЕС · 2024</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'biz-g3.webp' ) ); ?>" width="800" height="500" alt="Панелі наземної станції" loading="lazy"><figcaption>Наземна СЕС · 2026</figcaption></figure>
    </div>
  </section>

  <section class="section faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про обслуговування</h2>
    <div class="faq-list">
      <details><summary>Що входить у плановий огляд?<svg class="ico"><use href="#i-plus"/></svg></summary><p>Перевірка панелей, кабелів і конструкцій, чищення панелей, перевірка інвертора й акумуляторів, аналіз того, скільки енергії дає станція.</p></details>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Як часто обслуговувати станцію?<svg class="ico"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Чи обслуговуєте станції, які ставили інші компанії?<svg class="ico"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
    </div>
  </section>

  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>Заявка на обслуговування</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00.</p>
      <?php enray_request_form( 'service', 'Обслуговування СЕС' ); ?>
    </div>
    <aside class="closing-aside">
      <p>Не хочете заповнювати форму? Зателефонуйте або напишіть у Viber, інженер відповість у робочий час.</p>
      <a class="nav-phone big-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico"><use href="#i-viber"/></svg>Написати у Viber</a>
    </aside>
  </section>

  <section class="section services services--other" aria-labelledby="services-h">
    <h2 id="services-h">Інші послуги</h2>
    <div class="svc-groups">
      <div class="svc-group">
        <h3><svg class="ico"><use href="#i-sun"/></svg>Сонячна енергетика</h3>
        <ul class="svc-list">
          <li><a class="svc" href="<?php echo esc_url( home_url( '/proiektuvannia/' ) ); ?>"><span class="svc-name">Проєктування СЕС</span><span class="svc-what">виїзд і заміри, оцінка підключення до мережі, проєкт під ваше споживання</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
          <li><a class="svc" href="<?php echo esc_url( home_url( '/budivnytstvo/' ) ); ?>"><span class="svc-name">Будівництво СЕС</span><span class="svc-what">дахові й наземні станції: кріплення, панелі, інвертор і акумулятори, налагодження</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
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
