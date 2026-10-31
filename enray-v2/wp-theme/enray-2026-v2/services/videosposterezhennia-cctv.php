<?php
/** Послуга «videosposterezhennia-cctv». Згенеровано enray-v2/tools/build_wp.py з enray-v2/posluhy/videosposterezhennia-cctv/. */
?>

  <div class="rings" aria-hidden="true"></div>

  <section class="phero phero--svc phero--art" aria-labelledby="hero-h">
    <span class="phero-art" aria-hidden="true"><svg class="ico" aria-hidden="true"><use href="#i-camera"/></svg></span>
    <div class="phero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( home_url( '/#posluhy' ) ); ?>">Послуги</a><span aria-hidden="true">/</span><span>Відеоспостереження</span></p>
      <h1 id="hero-h">Відео&shy;спосте&shy;реження для дому й бізнесу</h1>
      <p class="phero-sub">Підбір і монтаж камер, запис 24/7 і перегляд з телефона чи комп'ютера: для будинку, офісу, складу або території.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#zayavka">Замовити огляд</a>
        <a class="btn btn-glass btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-phone"/></svg>Подзвонити</a>
      </div>
    </div>
    <figure class="stamp" aria-labelledby="stamp-h">
      <figcaption class="stamp-head"><span id="stamp-h">Відеоспостереження</span><span class="stamp-by">EnRay · Вінниця</span></figcaption>
      <dl class="stamp-rows"><div><dt>Камери</dt><dd>дротові й бездротові, з нічною зйомкою</dd></div><div><dt>Запис</dt><dd>цілодобово, 24/7</dd></div><div><dt>Перегляд</dt><dd>з телефона або комп'ютера</dd></div><?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Скільки зберігається запис</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?><?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Вартість</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?><?php if ( current_user_can( 'edit_pages' ) ) : ?><div class="is-todo"><dt>Гарантія</dt><dd><span class="todo">уточнити</span></dd></div><?php endif; ?></dl>
    </figure>
  </section>

  <section class="includes" aria-labelledby="inc-h">
    <h2 id="inc-h">Що входить</h2>
    <ul class="inc-grid"><li class="inc"><h3>Проєкт і монтаж</h3><ul><li>де поставити камери, щоб не було сліпих зон</li><li>монтаж і налаштування</li><li>інтеграція з охоронною системою</li></ul></li><li class="inc"><h3>Камери</h3><ul><li>висока роздільна здатність</li><li>чітке зображення вночі</li><li>бездротові камери для дому</li></ul></li><li class="inc"><h3>Запис</h3><ul><li>цілодобовий запис 24/7</li><li>архів для перегляду подій</li></ul></li><li class="inc"><h3>Віддалений доступ</h3><ul><li>перегляд наживо з телефона</li><li>налаштування камер віддалено</li></ul></li></ul>
  </section>

  <section class="steps" aria-labelledby="steps-h">
    <h2 id="steps-h">Як встановлюємо камери</h2>
    <ol class="timeline">
        <li><span class="step-n">01</span><h3>Огляд</h3><p>Об'єкт і зони, які треба бачити.</p></li>
        <li><span class="step-n">02</span><h3>Схема</h3><p>Кількість і місця камер.</p></li>
        <li><span class="step-n">03</span><h3>Монтаж</h3><p>Камери, запис, мережа.</p></li>
        <li><span class="step-n">04</span><h3>Доступ</h3><p>Застосунок на вашому телефоні.</p></li>
    </ol>
  </section>

<?php if ( current_user_can( 'edit_pages' ) ) : ?>  <section class="works" aria-labelledby="works-h">
    <h2 id="works-h">Наші роботи</h2>
    <p class="works-todo">Тут будуть 3–4 фото ваших робіт: щит, проводка, камери чи датчики на реальних об'єктах. Стокові фото не ставимо.</p>
  </section><?php endif; ?>

  <section class="faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання про відеоспостереження</h2>
    <div class="faq-list">
      <details><summary>Чи можна дивитися камери з телефона?<svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></summary><p>Так. Налаштовуємо застосунок: камери видно наживо й у записі з будь-якого місця, де є інтернет.</p></details>
      <details><summary>Чи видно щось уночі?<svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></summary><p>Так, ставимо камери, які дають чітке зображення в темряві й при слабкому освітленні.</p></details>
      <?php if ( current_user_can( 'edit_pages' ) ) : ?><details><summary>Скільки днів зберігається запис?<svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></summary><p><span class="todo">уточнити</span></p></details><?php endif; ?>
    </div>
  </section>

  <section class="request" id="zayavka" aria-labelledby="req-h">
    <div class="req-side">
      <h2 id="req-h">Заявка на відео­спостереження</h2>
      <p class="lead">Інженер передзвонить у&nbsp;робочий час, 09:00–18:00.</p>
      <p class="req-alt">Зручніше голосом?</p>
      <a class="req-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
    <div class="req-card">
      <?php enray_request_form( 'service', 'Відеоспостереження' ); ?>
    </div>
  </section>

  <section class="others" aria-labelledby="oth-h">
    <h2 id="oth-h">Інші послуги</h2>
    <ul class="svc-links"><li><a class="svc-link" href="<?php echo esc_url( home_url( '/proiektuvannia/' ) ); ?>"><span class="svc-link-name">Проєктування СЕС</span><span class="svc-link-what">виїзд і заміри, оцінка підключення до мережі, проєкт під ваше споживання</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/budivnytstvo/' ) ); ?>"><span class="svc-link-name">Будівництво СЕС</span><span class="svc-link-what">дахові й наземні станції: кріплення, панелі, інвертор і акумулятори, налагодження</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/obsluhovuvannia/' ) ); ?>"><span class="svc-link-name">Обслуговування СЕС</span><span class="svc-link-what">діагностика, чищення панелей, налаштування інвертора, ремонт</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/electrical-works/' ) ); ?>"><span class="svc-link-name">Електромонтажні роботи</span><span class="svc-link-what">проєкт і монтаж проводки, освітлення, заземлення й блискавкозахист, модернізація мереж</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a class="svc-link" href="<?php echo esc_url( home_url( '/systemy-okhorony-ta-bezpeky/' ) ); ?>"><span class="svc-link-name">Системи охорони</span><span class="svc-link-what">охоронна й пожежна сигналізація, контроль доступу, захист периметра</span><svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a></li></ul>
  </section>
