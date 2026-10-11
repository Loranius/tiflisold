<?php
/** Послуга «Проєктування СЕС». Згенеровано enray/tools/build_services.py — правте дані там. */
?>
  <section class="hero hero--scenario hero--service" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><a href="<?php echo esc_url( home_url( '/' ) ); ?>#posluhy">Послуги</a><span aria-hidden="true"> / </span><span>Проєктування</span></p>
      <h1 id="hero-h">Проєкт сонячної станції під ваше спожи&shy;вання</h1>
      <p class="hero-sub">Виїзд і заміри, оцінка даху чи ділянки й можливості підключення до мережі, підбір обладнання під ваші рахунки.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="<?php echo esc_url( home_url( '/' ) ); ?>#kalkulyator">Порахувати потужність</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">Проєктування СЕС</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows">
        <div><dt>Станції</dt><dd>дахові й наземні, 6–100 кВт</dd></div>
        <div><dt>Територія</dt><dd>Вінниця й область</dd></div>
        <div><dt>Що потрібно від вас</dt><dd>рахунки за електроенергію за рік</dd></div>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Вартість проєкту</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Строк підготовки</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
      </dl>
    </figure>
  </section>

  <section class="section includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <div class="inc-grid">
      <div class="inc"><h3>Виїзд на об'єкт</h3><ul><li>заміри даху або ділянки</li><li>збір даних для проєкту</li><li>оцінка місця для інвертора й щита</li></ul></div>
      <div class="inc"><h3>Аналіз місця</h3><ul><li>орієнтація й рельєф</li><li>кліматичні умови й сонячна радіація</li><li>оптимальне розміщення панелей</li></ul></div>
      <div class="inc"><h3>Підключення до мережі</h3><ul><li>технічні можливості підключення</li><li>юридичні вимоги й документи</li></ul></div>
      <div class="inc"><h3>Проєкт</h3><ul><li>потужність і склад обладнання під ваше споживання</li><li>схема розміщення й підключення</li></ul></div>
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
      <figure><img src="<?php echo esc_url( enray_img( 'dim-g2.webp' ) ); ?>" width="800" height="500" alt="Сонячні панелі на двосхилому даху приватного будинку" loading="lazy"><figcaption>Дахова СЕС · 2024</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'biz-g1.webp' ) ); ?>" width="800" height="500" alt="Наземна станція 30 кВт у Ладижині" loading="lazy"><figcaption>Наземна СЕС 30 кВт · 2026</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'agro-detail.webp' ) ); ?>" width="800" height="500" alt="Станція для поливу саду" loading="lazy"><figcaption>СЕС 100 кВт · 2025</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'dim-g4.webp' ) ); ?>" width="800" height="500" alt="Панелі на плоскому даху, вигляд з дрона" loading="lazy"><figcaption>Дахова СЕС · 2024</figcaption></figure>
    </div>
  </section>

  <section class="section faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про проєктування</h2>
    <div class="faq-list">
      <details><summary>Що потрібно від мене для проєкту?<svg class="ico"><use href="#i-plus"/></svg></summary><p>Рахунки за електроенергію за рік і доступ до даху чи ділянки. За рахунками інженер рахує потужність, а на місці перевіряє, де стануть панелі й інвертор.</p></details>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Скільки коштує проєкт?<svg class="ico"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Чи можна замовити лише проєкт, без монтажу?<svg class="ico"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
    </div>
  </section>

  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>Заявка на проєкт станції</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00.</p>
      <?php enray_request_form( 'service', 'Проєктування СЕС' ); ?>
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
          <li><a class="svc" href="<?php echo esc_url( home_url( '/budivnytstvo/' ) ); ?>"><span class="svc-name">Будівництво СЕС</span><span class="svc-what">дахові й наземні станції: кріплення, панелі, інвертор і акумулятори, налагодження</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
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
