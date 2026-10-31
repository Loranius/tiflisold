<?php
/** Послуга «proiektuvannia». Згенеровано enray-v2/tools/build_wp.py з enray-v2/posluhy/proiektuvannia/. */
?>

  <div class="rings" aria-hidden="true"></div>

  <section class="phero phero--svc" aria-labelledby="hero-h">
    <img class="phero-photo" src="<?php echo esc_url( enray_asset( 'img/roof-e2.webp' ) ); ?>" width="1100" height="825" alt="Сонячна станція EnRay на даху приватного будинку" fetchpriority="high">
    <div class="phero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( home_url( '/#posluhy' ) ); ?>">Послуги</a><span aria-hidden="true">/</span><span>Проєктування</span></p>
      <h1 id="hero-h">Проєкт сонячної станції під ваше спожи&shy;вання</h1>
      <p class="phero-sub">Виїзд і заміри, оцінка даху чи ділянки й можливості підключення до мережі, підбір обладнання під ваші рахунки.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="<?php echo esc_url( home_url( '/#kalkulyator' ) ); ?>">Порахувати потужність</a>
        <a class="btn btn-glass btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-phone"/></svg>Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">Проєктування СЕС</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows"><div><dt>Станції</dt><dd>дахові й наземні, 6–100 кВт</dd></div><div><dt>Територія</dt><dd>Вінниця й область</dd></div><div><dt>Що потрібно від вас</dt><dd>рахунки за електроенергію за рік</dd></div><?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Вартість проєкту</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?><?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Строк підготовки</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?></dl>
    </figure>
  </section>

  <section class="includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <ul class="inc-grid"><li class="inc"><h3>Виїзд на об'єкт</h3><ul><li>заміри даху або ділянки</li><li>збір даних для проєкту</li><li>оцінка місця для інвертора й щита</li></ul></li><li class="inc"><h3>Аналіз місця</h3><ul><li>орієнтація й рельєф</li><li>кліматичні умови й сонячна радіація</li><li>оптимальне розміщення панелей</li></ul></li><li class="inc"><h3>Підключення до мережі</h3><ul><li>технічні можливості підключення</li><li>юридичні вимоги й документи</li></ul></li><li class="inc"><h3>Проєкт</h3><ul><li>потужність і склад обладнання під ваше споживання</li><li>схема розміщення й підключення</li></ul></li></ul>
  </section>

  <section class="steps" aria-labelledby="steps-h">
    <h2 id="steps-h">Від виїзду до запуску станції</h2>
    <ol class="timeline">
        <li><span class="step-n">01</span><h3>Виїзд</h3><p>Огляд даху чи ділянки, заміри.</p></li>
        <li><span class="step-n">02</span><h3>Проєкт</h3><p>Розрахунок генерації, підбір обладнання.</p></li>
        <li><span class="step-n">03</span><h3>Постачання</h3><p>Обладнання на об'єкт.</p></li>
        <li><span class="step-n">04</span><h3>Монтаж</h3><p>7–10 днів для станцій 6–100 кВт.</p></li>
        <li><span class="step-n">05</span><h3>Підключення</h3><p>Документи, обленерго, сервіс після запуску.</p></li>
    </ol>
  </section>

  <section class="works" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <ul class="gallery" aria-label="Роботи EnRay">
      <li><img src="<?php echo esc_url( enray_asset( 'img/dim-g2.webp' ) ); ?>" alt="Сонячні панелі на двосхилому даху приватного будинку" loading="lazy" decoding="async"><span>Дахова СЕС · 2024</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/biz-g1.webp' ) ); ?>" alt="Наземна станція 30 кВт у Ладижині" loading="lazy" decoding="async"><span>Наземна СЕС 30 кВт · 2026</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/agro-detail.webp' ) ); ?>" alt="Наземна станція 100 кВт" loading="lazy" decoding="async"><span>СЕС 100 кВт · 2025</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/dim-g4.webp' ) ); ?>" alt="Панелі на плоскому даху, вигляд з дрона" loading="lazy" decoding="async"><span>Дахова СЕС · 2024</span></li>
    </ul>
  </section>

  <section class="faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про проєктування</h2>
    <div class="faq-list">
      <details><summary>Що потрібно від мене для проєкту?<svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></summary><p>Рахунки за електроенергію за рік і доступ до даху чи ділянки. За рахунками інженер рахує потужність, а на місці перевіряє, де стануть панелі й інвертор.</p></details>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Скільки коштує проєкт?<svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Чи можна замовити лише проєкт, без монтажу?<svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
    </div>
  </section>

  <section class="request" id="zayavka" aria-labelledby="req-h">
    <div class="req-side">
      <h2 id="req-h">Заявка на проєкт станції</h2>
      <p class="lead">Інженер передзвонить у&nbsp;робочий час, 09:00–18:00.</p>
      <p class="req-alt">Зручніше голосом?</p>
      <a class="req-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
    <div class="req-card">
      <?php enray_request_form( 'service', 'Проєктування СЕС' ); ?>
    </div>
  </section>

  <section class="others" aria-labelledby="oth-h">
    <h2 id="oth-h">Інші послуги</h2>
    <ul class="svc-links"><li><a class="svc-link" href="<?php echo esc_url( home_url( '/budivnytstvo/' ) ); ?>"><span class="svc-link-name">Будівництво СЕС</span><span class="svc-link-what">дахові й наземні станції: кріплення, панелі, інвертор і акумулятори, налагодження</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/obsluhovuvannia/' ) ); ?>"><span class="svc-link-name">Обслуговування СЕС</span><span class="svc-link-what">діагностика, чищення панелей, налаштування інвертора, ремонт</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/electrical-works/' ) ); ?>"><span class="svc-link-name">Електромонтажні роботи</span><span class="svc-link-what">проєкт і монтаж проводки, освітлення, заземлення й блискавкозахист, модернізація мереж</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/systemy-okhorony-ta-bezpeky/' ) ); ?>"><span class="svc-link-name">Системи охорони</span><span class="svc-link-what">охоронна й пожежна сигналізація, контроль доступу, захист периметра</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/videosposterezhennia-cctv/' ) ); ?>"><span class="svc-link-name">Відеоспостереження</span><span class="svc-link-what">камери для дому й бізнесу, запис 24/7, перегляд з телефона</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li></ul>
  </section>
