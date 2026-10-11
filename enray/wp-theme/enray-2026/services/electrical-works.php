<?php
/** Послуга «Електромонтажні роботи». Згенеровано enray/tools/build_services.py — правте дані там. */
?>
  <section class="hero hero--scenario hero--service" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><a href="<?php echo esc_url( home_url( '/' ) ); ?>#posluhy">Послуги</a><span aria-hidden="true"> / </span><span>Електромонтаж</span></p>
      <h1 id="hero-h">Електро&shy;монтажні роботи у&nbsp;Вінниці та області</h1>
      <p class="hero-sub">Проєкт і монтаж проводки, освітлення, заземлення й блискавкозахист, модернізація старих мереж для будинків, комерційних і промислових об'єктів.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#zayavka">Замовити виїзд</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">Електромонтажні роботи</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows">
        <div><dt>Об'єкти</dt><dd>житлові, комерційні, промислові</dd></div>
        <div><dt>Територія</dt><dd>Вінниця й область</dd></div>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Виїзд і огляд</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Вартість</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Строки</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Гарантія на роботи</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
      </dl>
    </figure>
  </section>

  <section class="section includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <div class="inc-grid">
      <div class="inc"><h3>Проводка</h3><ul><li>розрахунок навантаження</li><li>проєкт електромережі</li><li>монтаж і розводка проводки</li></ul></div>
      <div class="inc"><h3>Освітлення</h3><ul><li>внутрішнє й зовнішнє освітлення</li><li>підключення вимикачів</li></ul></div>
      <div class="inc"><h3>Захист</h3><ul><li>заземлення</li><li>блискавкозахист</li><li>захист обладнання від перепадів напруги</li></ul></div>
      <div class="inc"><h3>Автоматизація</h3><ul><li>керування освітленням і енергоспоживанням</li><li>рішення для «розумного будинку»</li></ul></div>
      <div class="inc"><h3>Ремонт і модернізація</h3><ul><li>діагностика мережі</li><li>заміна застарілих компонентів</li><li>оновлення під нові навантаження</li></ul></div>
    </div>
  </section>

  <section class="section" aria-labelledby="steps-h">
    <h2 id="steps-h">Як проходять роботи</h2>
    <ol class="steps steps--scenario steps--4">
      <li><span class="step-n">01</span><b>Виїзд</b><span>огляд об'єкта й мережі</span></li>
      <li><span class="step-n">02</span><b>Проєкт</b><span>схема й кошторис</span></li>
      <li><span class="step-n">03</span><b>Монтаж</b><span>роботи за погодженою схемою</span></li>
      <li><span class="step-n">04</span><b>Перевірка</b><span>вимірювання, здача робіт</span></li>
    </ol>
  </section>

  <?php if ( current_user_can( 'edit_pages' ) ) : ?><section class="section" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <p class="works-todo">Тут будуть 3–4 фото ваших робіт: щит, проводка, камери чи датчики на реальних об'єктах. Стокові фото не ставимо.</p>
  </section><?php endif; ?>

  <section class="section faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про електромонтаж</h2>
    <div class="faq-list">
      <details><summary>Для яких об'єктів працюєте?<svg class="ico"><use href="#i-plus"/></svg></summary><p>Для житлових, комерційних і промислових: від квартири чи будинку до виробничих приміщень.</p></details>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Чи можна замовити лише заземлення або блискавкозахист?<svg class="ico"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Скільки коштує електромонтаж?<svg class="ico"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
    </div>
  </section>

  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>Заявка на електромонтаж</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00.</p>
      <?php enray_request_form( 'service', 'Електромонтаж' ); ?>
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
          <li><a class="svc" href="<?php echo esc_url( home_url( '/budivnytstvo/' ) ); ?>"><span class="svc-name">Будівництво СЕС</span><span class="svc-what">дахові й наземні станції: кріплення, панелі, інвертор і акумулятори, налагодження</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
          <li><a class="svc" href="<?php echo esc_url( home_url( '/obsluhovuvannia/' ) ); ?>"><span class="svc-name">Обслуговування СЕС</span><span class="svc-what">діагностика, чищення панелей, налаштування інвертора, ремонт</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
        </ul>
      </div>
      <div class="svc-group">
        <h3><svg class="ico"><use href="#i-bolt"/></svg>Електрика й безпека</h3>
        <ul class="svc-list">
          <li><a class="svc" href="<?php echo esc_url( home_url( '/systemy-okhorony-ta-bezpeky/' ) ); ?>"><span class="svc-name">Системи охорони</span><span class="svc-what">охоронна й пожежна сигналізація, контроль доступу, захист периметра</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
          <li><a class="svc" href="<?php echo esc_url( home_url( '/videosposterezhennia-cctv/' ) ); ?>"><span class="svc-name">Відеоспостереження</span><span class="svc-what">камери для дому й бізнесу, запис 24/7, перегляд з телефона</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
        </ul>
      </div>
    </div>
  </section>
