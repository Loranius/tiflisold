<?php
/** Послуга «Відеоспостереження». Згенеровано enray/tools/build_services.py — правте дані там. */
?>
  <section class="hero hero--scenario hero--service" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><a href="<?php echo esc_url( home_url( '/' ) ); ?>#posluhy">Послуги</a><span aria-hidden="true"> / </span><span>Відеоспостереження</span></p>
      <h1 id="hero-h">Відео&shy;спостереження для дому й бізнесу</h1>
      <p class="hero-sub">Підбір і монтаж камер, запис 24/7 і перегляд з телефона чи комп'ютера: для будинку, офісу, складу або території.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#zayavka">Замовити огляд</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">Відеоспостереження</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows">
        <div><dt>Камери</dt><dd>дротові й бездротові, з нічною зйомкою</dd></div>
        <div><dt>Запис</dt><dd>цілодобово, 24/7</dd></div>
        <div><dt>Перегляд</dt><dd>з телефона або комп'ютера</dd></div>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Скільки зберігається запис</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Вартість</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
        <?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Гарантія</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?>
      </dl>
    </figure>
  </section>

  <section class="section includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <div class="inc-grid">
      <div class="inc"><h3>Проєкт і монтаж</h3><ul><li>де поставити камери, щоб не було сліпих зон</li><li>монтаж і налаштування</li><li>інтеграція з охоронною системою</li></ul></div>
      <div class="inc"><h3>Камери</h3><ul><li>висока роздільна здатність</li><li>чітке зображення вночі</li><li>бездротові камери для дому</li></ul></div>
      <div class="inc"><h3>Запис</h3><ul><li>цілодобовий запис 24/7</li><li>архів для перегляду подій</li></ul></div>
      <div class="inc"><h3>Віддалений доступ</h3><ul><li>перегляд наживо з телефона</li><li>налаштування камер віддалено</li></ul></div>
    </div>
  </section>

  <section class="section" aria-labelledby="steps-h">
    <h2 id="steps-h">Як встановлюємо камери</h2>
    <ol class="steps steps--scenario steps--4">
      <li><span class="step-n">01</span><b>Огляд</b><span>об'єкт і зони, які треба бачити</span></li>
      <li><span class="step-n">02</span><b>Схема</b><span>кількість і місця камер</span></li>
      <li><span class="step-n">03</span><b>Монтаж</b><span>камери, запис, мережа</span></li>
      <li><span class="step-n">04</span><b>Доступ</b><span>застосунок на вашому телефоні</span></li>
    </ol>
  </section>

  <?php if ( current_user_can( 'edit_pages' ) ) : ?><section class="section" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <p class="works-todo">Тут будуть 3–4 фото ваших робіт: щит, проводка, камери чи датчики на реальних об'єктах. Стокові фото не ставимо.</p>
  </section><?php endif; ?>

  <section class="section faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про відеоспостереження</h2>
    <div class="faq-list">
      <details><summary>Чи можна дивитися камери з телефона?<svg class="ico"><use href="#i-plus"/></svg></summary><p>Так. Налаштовуємо застосунок: камери видно наживо й у записі з будь-якого місця, де є інтернет.</p></details>
      <details><summary>Чи видно щось уночі?<svg class="ico"><use href="#i-plus"/></svg></summary><p>Так, ставимо камери, які дають чітке зображення в темряві й при слабкому освітленні.</p></details>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Скільки днів зберігається запис?<svg class="ico"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
    </div>
  </section>

  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>Заявка на відеоспостереження</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00.</p>
      <?php enray_request_form( 'service', 'Відеоспостереження' ); ?>
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
          <li><a class="svc" href="<?php echo esc_url( home_url( '/systemy-okhorony-ta-bezpeky/' ) ); ?>"><span class="svc-name">Системи охорони</span><span class="svc-what">охоронна й пожежна сигналізація, контроль доступу, захист периметра</span><svg class="ico"><use href="#i-arrow"/></svg></a></li>
        </ul>
      </div>
    </div>
  </section>
