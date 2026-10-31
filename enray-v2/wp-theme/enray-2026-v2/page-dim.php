<?php
/** Сторінка сценарію «dim». Розмітка з enray-v2/dim/ (build_wp.py). */
get_header();
?>
<main id="main" class="sheet sheet--page">
  <div class="rings" aria-hidden="true"></div>

  <section class="phero" aria-labelledby="hero-h">
    <img class="phero-photo" src="<?php echo esc_url( enray_asset( 'img/dim-hero.webp' ) ); ?>" width="1280" height="960" alt="Сонячна станція EnRay на даху приватного будинку" fetchpriority="high">
    <div class="phero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true">/</span><span>Для дому</span></p>
      <h1 id="hero-h">Світло вдома, навіть коли за&nbsp;вікном графік</h1>
      <p class="phero-sub">Гібридна сонячна станція з&nbsp;акумулятором для приватного будинку у&nbsp;Вінницькій області.</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#rezerv">Порахувати резерв</a>
        <a class="btn btn-glass btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-phone"/></svg>Подзвонити</a>
      </div>
    </div>
  </section>

  <section class="day" aria-labelledby="day-h">
    <div class="sec-head">
      <h2 id="day-h">Як змінюється доба зі станцією</h2>
      <p class="lead">Перемкніть і порівняйте: та сама доба з&nbsp;відключеннями без станції й&nbsp;зі станцією.</p>
    </div>
    <figure class="day-panel" id="doba">
      <div class="day-head">
        <figcaption class="day-title">Доба з&nbsp;відключеннями</figcaption>
        <div class="seg" role="group" aria-label="Порівняння">
          <button type="button" class="seg-btn" data-mode="off" aria-pressed="true">Без станції</button>
          <button type="button" class="seg-btn" data-mode="on" aria-pressed="false">Зі станцією</button>
        </div>
      </div>
      <div class="day-strip" data-mode="off" aria-hidden="true">
        <div class="day-cells" id="day-cells"></div>
        <div class="day-scale"><span>00</span><span>06</span><span>12</span><span>18</span><span>24</span></div>
      </div>
      <p class="day-summary" id="day-summary" aria-live="polite"><b>12 годин</b> без світла: котел, холодильник та інтернет вимикаються разом із мережею.</p>
      <ul class="legend" aria-hidden="true">
        <li><i class="sw sw--grid"></i>мережа</li>
        <li><i class="sw sw--sun"></i>сонце</li>
        <li><i class="sw sw--bat"></i>акумулятор</li>
        <li><i class="sw sw--dark"></i>без світла</li>
      </ul>
      <table class="sr-only">
        <caption>Приклад графіка: відключення 02:00–06:00, 10:00–14:00, 18:00–22:00</caption>
        <thead><tr><th scope="col">Години</th><th scope="col">Без станції</th><th scope="col">Зі станцією</th></tr></thead>
        <tbody>
          <tr><td>02:00–06:00</td><td>без світла</td><td>акумулятор</td></tr>
          <tr><td>10:00–14:00</td><td>без світла</td><td>сонячні панелі</td></tr>
          <tr><td>18:00–22:00</td><td>без світла</td><td>акумулятор</td></tr>
          <tr><td>решта годин</td><td>мережа</td><td>мережа і сонце</td></tr>
        </tbody>
      </table>
      <p class="day-note">Приклад графіка, ілюстративно: три відключення по 4 години. Скільки годин протримає ваша станція, залежить від ємності акумулятора й того, що ви на нього підключите.</p>
    </figure>
  </section>

  <section class="rezerv" id="rezerv" aria-labelledby="rezerv-h">
    <div class="sec-head">
      <h2 id="rezerv-h">Що має працювати, коли мережі немає</h2>
      <p class="lead">Позначте прилади. Порахуємо енергію на нічні відключення з&nbsp;прикладу (8 годин) і&nbsp;орієнтир ємності акумулятора.</p>
    </div>
    <div class="rezerv-grid">
      <fieldset class="loads">
        <legend class="sr-only">Прилади на резерві</legend>
        <label class="load"><input class="load-input" type="checkbox" value="0.08" data-name="холодильник" checked><span class="load-box"><svg class="ico" aria-hidden="true"><use href="#i-check"/></svg></span><span class="load-name">Холодильник</span><span class="load-kw">≈ 0,08 кВт</span></label>
        <label class="load"><input class="load-input" type="checkbox" value="0.12" data-name="газовий котел" checked><span class="load-box"><svg class="ico" aria-hidden="true"><use href="#i-check"/></svg></span><span class="load-name">Газовий котел з насосом</span><span class="load-kw">≈ 0,12 кВт</span></label>
        <label class="load"><input class="load-input" type="checkbox" value="0.03" data-name="роутер і зарядки" checked><span class="load-box"><svg class="ico" aria-hidden="true"><use href="#i-check"/></svg></span><span class="load-name">Роутер і зарядки</span><span class="load-kw">≈ 0,03 кВт</span></label>
        <label class="load"><input class="load-input" type="checkbox" value="0.08" data-name="світло" checked><span class="load-box"><svg class="ico" aria-hidden="true"><use href="#i-check"/></svg></span><span class="load-name">Світлодіодне світло</span><span class="load-kw">≈ 0,08 кВт</span></label>
        <label class="load"><input class="load-input" type="checkbox" value="0.1" data-name="телевізор"><span class="load-box"><svg class="ico" aria-hidden="true"><use href="#i-check"/></svg></span><span class="load-name">Телевізор</span><span class="load-kw">≈ 0,10 кВт</span></label>
        <label class="load"><input class="load-input" type="checkbox" value="0.15" data-name="насос водопостачання"><span class="load-box"><svg class="ico" aria-hidden="true"><use href="#i-check"/></svg></span><span class="load-name">Насос водопостачання</span><span class="load-kw">≈ 0,15 кВт</span></label>
        <label class="load"><input class="load-input" type="checkbox" value="1.5" data-name="бойлер"><span class="load-box"><svg class="ico" aria-hidden="true"><use href="#i-check"/></svg></span><span class="load-name">Електробойлер</span><span class="load-kw">≈ 1,5 кВт</span></label>
      </fieldset>
      <div class="rezerv-result" aria-live="polite">
        <p class="rz-label">Енергія на 8 нічних годин відключень</p>
        <p class="rz-kwh"><span id="rz-kwh">≈ 2,5</span> <small>кВт·год</small></p>
        <p class="rz-label">Орієнтир ємності акумулятора · приклад</p>
        <p class="rz-bat" id="rz-bat">від 5 кВт·год</p>
        <p class="rz-note">Орієнтовно: середня потужність кожного приладу × 8 нічних годин (кожен прилад, зокрема бойлер, рахуємо увімкненим усі 8 годин), плюс запас 25% з округленням угору до кроку 5 кВт·год. Денні відключення закривають панелі, якщо світить сонце. Точну схему й ємність інженер підбере після огляду.</p>
        <a class="link-strong" href="#zayavka" id="rz-cta">Надіслати цей набір інженеру <svg class="ico"><use href="#i-arrow"/></svg></a>
      </div>
    </div>
  </section>

  <section class="case-feature" aria-labelledby="case-h">
    <div class="sec-head">
      <h2 id="case-h">Як це виглядає на даху</h2>
      <p class="lead">Дахова станція 6&nbsp;кВт, яку ми змонтували за тиждень.</p>
    </div>
    <div class="cf-grid">
      <figure class="cf-main">
        <img src="<?php echo esc_url( enray_asset( 'img/dim-case.webp' ) ); ?>" width="1200" height="750" alt="Сонячні панелі на даху цегляного будинку: станція EnRay 6 кВт у Вінницькій області" loading="lazy" decoding="async">
        <figcaption>Дахова СЕС 6&nbsp;кВт · Вінницька обл. · 2024</figcaption>
      </figure>
      <div class="cf-side">
        <dl class="cf-spec">
          <div><dt>Потужність</dt><dd>6 кВт</dd></div>
          <div><dt>Де</dt><dd class="txt">Вінницька область</dd></div>
          <div><dt>Рік</dt><dd>2024</dd></div>
          <div><dt>Монтаж</dt><dd>1 тиждень</dd></div>
        </dl>
        <figure class="cf-inverter">
          <img src="<?php echo esc_url( enray_asset( 'img/dim-inverter.webp' ) ); ?>" width="800" height="800" alt="Інвертор і електрощиток станції 6 кВт у будинку" loading="lazy" decoding="async">
          <figcaption>Інвертор і щиток у будинку, той самий об'єкт</figcaption>
        </figure>
      </div>
    </div>
    <ul class="gallery" aria-label="Інші дахові станції EnRay, 2024">
      <li><img src="<?php echo esc_url( enray_asset( 'img/roof-b1.webp' ) ); ?>" alt="Дахова сонячна станція на приватному будинку" loading="lazy" decoding="async"><span>Дахова СЕС · 2024</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/dim-g2.webp' ) ); ?>" alt="Сонячні панелі на двосхилому даху" loading="lazy" decoding="async"><span>Дахова СЕС · 2024</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/dim-g3.webp' ) ); ?>" alt="Панелі на червоній металочерепиці" loading="lazy" decoding="async"><span>Дахова СЕС · 2024</span></li>
      <li><img src="<?php echo esc_url( enray_asset( 'img/dim-g4.webp' ) ); ?>" alt="Панелі на плоскому даху, вигляд з дрона" loading="lazy" decoding="async"><span>Дахова СЕС · 2024</span></li>
    </ul>
  </section>

  <section class="steps" aria-labelledby="steps-h">
    <h2 id="steps-h">Від дзвінка до світла в&nbsp;будинку</h2>
    <ol class="timeline">
        <li><span class="step-n">01</span><h3>Виїзд</h3><p>Огляд даху, щитка й місця для інвертора.</p></li>
        <li><span class="step-n">02</span><h3>Проєкт</h3><p>Потужність, ємність АКБ, що буде на резерві.</p></li>
        <li><span class="step-n">03</span><h3>Постачання</h3><p>Панелі, інвертор, акумулятор на об'єкт.</p></li>
        <li><span class="step-n">04</span><h3>Монтаж</h3><p>Близько тижня для 6 кВт.</p></li>
        <li><span class="step-n">05</span><h3>Запуск</h3><p>Налаштування, документи, обленерго.</p></li>
    </ol>
  </section>

  <section class="faq" aria-labelledby="faq-h">
    <h2 id="faq-h">Питання власників будинків</h2>
    <div class="faq-list">
      <details>
        <summary>Чи буде світло, коли вимкнуть мережу?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Так, якщо станція гібридна з акумулятором. Мережева станція без акумулятора під час відключення зупиняється: інвертор вимикається з міркувань безпеки, щоб не подавати струм у лінію. Тому для резерву ставимо гібридний інвертор і акумулятор.</p>
      </details>
      <details>
        <summary>Скільки годин протримає акумулятор?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Залежить від ємності й навантаження. Холодильник, котел, роутер і світло разом споживають у середньому близько 0,3 кВт, тому 5 кВт·год вистачить приблизно на 12–15 годин. Бойлер чи насос скорочують цей час у рази. Порахуйте свій набір у блоці вище.</p>
      </details>
      <details>
        <summary>Що робити з документами й обленерго?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Оформлення беремо на себе: технічні умови, договір з обленерго, підключення до мережі. Від вас потрібні підпис і документи на будинок.</p>
      </details>
      <details>
        <summary>Скільки триває монтаж?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Станцію 6 кВт на даху будинку у Вінницькій області ми змонтували за тиждень. Точний термін залежить від даху, щитка й наявності обладнання, його назвемо після виїзду.</p>
      </details>
      <details>
        <summary>Що з обслуговуванням після запуску?<svg class="ico"><use href="#i-plus"/></svg></summary>
        <p>Оглядаємо станцію, чистимо панелі, налаштовуємо інвертор, ремонтуємо й консультуємо щодо експлуатації.</p>
      </details>
    
  </section>

  <section class="request" id="zayavka" aria-labelledby="req-h">
    <div class="req-side">
      <h2 id="req-h">Розрахунок для вашого будинку</h2>
      <p class="lead">Інженер передзвонить у&nbsp;робочий час, 09:00–18:00, з&nbsp;попереднім розрахунком потужності й&nbsp;ємності акумулятора.</p>
      <p class="req-alt">Зручніше голосом?</p>
      <a class="req-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
    <div class="req-card">
      <?php enray_request_form( 'dim' ); ?>
    </div>
  </section>
</main>
<?php
get_footer();
