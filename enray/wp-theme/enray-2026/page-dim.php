<?php
/** Сторінка сценарію: dim. Розмітка перенесена з прототипу enray/dim/index.html. */
get_header();
?>
<main id="main">
  <section class="hero hero--scenario" aria-labelledby="hero-h">
    <div class="hero-copy">
      <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><span>Для дому</span></p>
      <h1 id="hero-h">Світло вдома, навіть коли за&nbsp;вікном графік</h1>
      <p class="hero-sub">Гібридна сонячна станція з акумулятором для приватного будинку у&nbsp;Вінницькій області</p>
      <div class="hero-actions">
        <a class="btn btn-primary btn-lg" href="#rezerv">Порахувати резерв</a>
        <a class="btn btn-outline btn-lg" href="<?php echo esc_attr( enray_tel() ); ?>">Подзвонити</a>
      </div>
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

  <section class="section rezerv" id="rezerv" aria-labelledby="rezerv-h">
    <div class="rezerv-head">
      <h2 id="rezerv-h">Що має працювати, коли мережі немає</h2>
      <p class="lead">Позначте прилади. Порахуємо, скільки енергії треба на два нічні відключення з прикладу вище (8 годин) і який акумулятор узяти за орієнтир.</p>
    </div>
    <div class="rezerv-grid">
      <fieldset class="loads">
        <legend class="sr-only">Прилади на резерві</legend>
        <label class="load"><input type="checkbox" value="0.08" data-name="холодильник" checked><span class="load-name">Холодильник</span><span class="load-kw">≈ 0,08 кВт</span></label>
        <label class="load"><input type="checkbox" value="0.12" data-name="газовий котел" checked><span class="load-name">Газовий котел з насосом</span><span class="load-kw">≈ 0,12 кВт</span></label>
        <label class="load"><input type="checkbox" value="0.03" data-name="роутер і зарядки" checked><span class="load-name">Роутер і зарядки</span><span class="load-kw">≈ 0,03 кВт</span></label>
        <label class="load"><input type="checkbox" value="0.08" data-name="світло" checked><span class="load-name">Світлодіодне світло</span><span class="load-kw">≈ 0,08 кВт</span></label>
        <label class="load"><input type="checkbox" value="0.1" data-name="телевізор"><span class="load-name">Телевізор</span><span class="load-kw">≈ 0,10 кВт</span></label>
        <label class="load"><input type="checkbox" value="0.15" data-name="насос водопостачання"><span class="load-name">Насос водопостачання</span><span class="load-kw">≈ 0,15 кВт</span></label>
        <label class="load"><input type="checkbox" value="1.5" data-name="бойлер"><span class="load-name">Електробойлер</span><span class="load-kw">≈ 1,5 кВт</span></label>
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

  <section class="section case-feature" aria-labelledby="case-h">
    <h2 id="case-h">Як це виглядає на даху</h2>
    <div class="cf-grid">
      <figure class="cf-main">
        <img src="<?php echo esc_url( enray_img( 'dim-case.webp' ) ); ?>" width="1200" height="735" alt="Сонячні панелі на даху цегляного будинку: станція EnRay 6 кВт у Вінницькій області" loading="lazy">
        <svg class="callouts" viewBox="0 0 1200 735" preserveAspectRatio="xMidYMax slice" aria-hidden="true" focusable="false">
          <text x="375" y="56" text-anchor="middle">дахова СЕС · 2024</text>
          <text class="c-wide" x="470" y="146" text-anchor="middle" transform="rotate(10 470 146)">6 кВт</text>
          <text class="c-narrow" x="220" y="166" text-anchor="middle" transform="rotate(10 220 166)">6 кВт</text>
          <text x="750" y="152" text-anchor="middle">монтаж — 1 тиждень</text>
        </svg>
      </figure>
      <div class="cf-side">
        <dl class="cf-spec">
          <div><dt>Потужність</dt><dd>6 кВт</dd></div>
          <div><dt>Де</dt><dd class="txt">Вінницька область</dd></div>
          <div><dt>Рік</dt><dd>2024</dd></div>
          <div><dt>Монтаж</dt><dd>1 тиждень</dd></div>
        </dl>
        <figure class="cf-inverter">
          <img src="<?php echo esc_url( enray_img( 'dim-inverter.webp' ) ); ?>" width="800" height="800" alt="Інвертор і електрощиток станції 6 кВт у будинку" loading="lazy">
          <figcaption>Інвертор і щиток у будинку, той самий об'єкт</figcaption>
        </figure>
      </div>
    </div>
    <div class="gallery" aria-label="Інші дахові станції EnRay, 2024">
      <figure><img src="<?php echo esc_url( enray_img( 'dim-g1.webp' ) ); ?>" width="800" height="600" alt="Дахова сонячна станція на приватному будинку" loading="lazy"><figcaption>Дахова СЕС · 2024</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'dim-g2.webp' ) ); ?>" width="800" height="600" alt="Сонячні панелі на двосхилому даху" loading="lazy"><figcaption>Дахова СЕС · 2024</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'dim-g3.webp' ) ); ?>" width="800" height="600" alt="Панелі на червоній металочерепиці" loading="lazy"><figcaption>Дахова СЕС · 2024</figcaption></figure>
      <figure><img src="<?php echo esc_url( enray_img( 'dim-g4.webp' ) ); ?>" width="800" height="600" alt="Панелі на плоскому даху, вигляд з дрона" loading="lazy"><figcaption>Дахова СЕС · 2024</figcaption></figure>
    </div>
  </section>

  <section class="section" aria-labelledby="steps-h">
    <h2 id="steps-h">Від дзвінка до світла в будинку</h2>
    <ol class="steps steps--scenario">
      <li><span class="step-n">01</span><b>Виїзд</b><span>огляд даху, щитка й місця для інвертора</span></li>
      <li><span class="step-n">02</span><b>Проєкт</b><span>потужність, ємність АКБ, що буде на резерві</span></li>
      <li><span class="step-n">03</span><b>Постачання</b><span>панелі, інвертор, акумулятор на об'єкт</span></li>
      <li><span class="step-n">04</span><b>Монтаж</b><span>близько тижня для 6 кВт</span></li>
      <li><span class="step-n">05</span><b>Запуск</b><span>налаштування, документи, обленерго</span></li>
    </ol>
  </section>

  <section class="section faq" aria-labelledby="faq-h">
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
    </div>
  </section>

  <section class="section closing closing--scenario" aria-label="Заявка">
    <div class="request" id="zayavka">
      <h2>Розрахунок для вашого будинку</h2>
      <p class="request-lead">Інженер передзвонить у робочий час, 09:00–18:00, з попереднім розрахунком потужності й ємності акумулятора.</p>
      <?php enray_request_form( 'dim' ); ?>
    </div>
    <div class="closing-aside">
      <p>Не хочете заповнювати форму? Зателефонуйте або напишіть у Viber, інженер відповість у робочий час.</p>
      <a class="nav-phone big-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico"><use href="#i-viber"/></svg>Написати у Viber</a>
    </div>
  </section>
</main>
<?php
get_footer();
