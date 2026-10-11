<?php
/** Послуга «Системи охорони». Згенеровано enray/tools/build_services.py — правте дані там. */
?>
  <section class="hero hero--scenario hero--service" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><a href="<?php echo esc_url( home_url( '/' ) ); ?>#posluhy">Послуги</a><span aria-hidden="true"> / </span><span>Системи охорони</span></p>
      <h1 id="hero-h">Системи охорони для дому й бізнесу</h1>
      <p class="hero-sub">Охоронна й пожежна сигналізація, контроль доступу, захист периметра й відеоспостереження: проєкт, монтаж і обслуговування.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#zayavka">Замовити огляд об'єкта</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">Системи охорони</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows">
        <div><dt>Об'єкти</dt><dd>будинки, офіси, виробництва</dd></div>
        <div><dt>Керування</dt><dd>з мобільного застосунку</dd></div>
        <div><dt>Територія</dt><dd>Вінниця й область</dd></div>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Підключення до пульта охорони</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Вартість</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Гарантія</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
      </dl>
    </figure>
  </section>

  <section class="section includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <div class="inc-grid">
      <div class="inc"><h3>Сигналізація</h3><ul><li>охоронна: виявлення вторгнення</li><li>пожежна: дим і вогонь</li><li>оповіщення служб охорони</li></ul></div>
      <div class="inc"><h3>Контроль доступу</h3><ul><li>вхід за карткою, кодом або біометрією</li><li>облік персоналу й гостей</li><li>доступ до окремих зон</li></ul></div>
      <div class="inc"><h3>Периметр</h3><ul><li>інфрачервоні датчики</li><li>датчики руху</li><li>сповіщення про спробу проникнення</li></ul></div>
      <div class="inc"><h3>Відеоспостереження</h3><ul><li>камери всередині й зовні</li><li>запис і перегляд з телефона</li></ul></div>
      <div class="inc"><h3>Розумний дім</h3><ul><li>віддалене керування охороною</li><li>одна система для сигналізації й камер</li></ul></div>
    </div>
  </section>

  <section class="section" aria-labelledby="steps-h">
    <h2 id="steps-h">Як ставимо систему охорони</h2>
    <ol class="steps steps--scenario steps--4">
      <li><span class="step-n">01</span><b>Огляд</b><span>об'єкт, входи, периметр</span></li>
      <li><span class="step-n">02</span><b>Проєкт</b><span>де стануть датчики й камери</span></li>
      <li><span class="step-n">03</span><b>Монтаж</b><span>встановлення й налаштування</span></li>
      <li><span class="step-n">04</span><b>Передача</b><span>доступи на телефон і пояснення</span></li>
    </ol>
  </section>

  <?php if ( current_user_can( 'edit_pages' ) ) : ?><section class="section" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <p class="works-todo">Тут будуть 3–4 фото ваших робіт: щит, проводка, камери чи датчики на реальних об'єктах. Стокові фото не ставимо.</p>
  </section><?php endif; ?>

  <section class="section faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про системи охорони</h2>
    <div class="faq-list">
      <details><summary>Чи можна об'єднати сигналізацію з камерами?<svg class="ico"><use href="#i-plus"/></svg></summary><p>Так. Сигналізацію, контроль доступу й відеоспостереження інтегруємо в одну систему з керуванням з телефона.</p></details>
      <details><summary>Чи можна керувати охороною з телефона?<svg class="ico"><use href="#i-plus"/></svg></summary><p>Так, через мобільний застосунок: ставити й знімати з охорони, бачити події в реальному часі.</p></details>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Чи підключаєте сигналізацію до пульта охоронної компанії?<svg class="ico"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
    </div>
  </section>

  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>Заявка на систему охорони</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00.</p>
      <?php enray_request_form( 'service', 'Системи охорони' ); ?>
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
          <li><a class="svc" href="<?php echo esc_url( home_url( '/obsluhovuvannia/' ) ); ?>"><span class="svc-name">Обслуговування СЕС</span><span class="svc-what">діагностика, чищення панелей, налаштування інвертора, ремонт</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
        </ul>
      </div>
      <div class="svc-group">
        <h3><svg class="ico"><use href="#i-bolt"/></svg>Електрика й безпека</h3>
        <ul class="svc-list">
          <li><a class="svc" href="<?php echo esc_url( home_url( '/electrical-works/' ) ); ?>"><span class="svc-name">Електромонтажні роботи</span><span class="svc-what">проєкт і монтаж проводки, освітлення, заземлення й блискавкозахист, модернізація мереж</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
          <li><a class="svc" href="<?php echo esc_url( home_url( '/videosposterezhennia-cctv/' ) ); ?>"><span class="svc-name">Відеоспостереження</span><span class="svc-what">камери для дому й бізнесу, запис 24/7, перегляд з телефона</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
        </ul>
      </div>
    </div>
  </section>
