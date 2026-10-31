<?php
/** Футер-картка і нижня панель зв'язку. Згенеровано enray-v2/tools/build_wp.py. */
?>
<footer class="foot" id="kontakty">
  <div class="foot-card">
    <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="EnRay, на головну"><img src="<?php echo esc_url( enray_asset( 'img/logo-mark.png' ) ); ?>" width="43" height="41" alt=""><span>ENRAY</span></a>
    <nav class="foot-links" aria-label="Розділи"><?php enray_footer_links(); ?></nav>
    <address class="foot-contacts">
      <a href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <a href="<?php echo esc_attr( 'mailto:' . enray_opt( 'email' ) ); ?>"><?php echo esc_html( enray_opt( 'email' ) ); ?></a>
      <span><?php echo esc_html( enray_opt( 'address' ) ); ?></span>
      <span><?php echo esc_html( enray_opt( 'hours' ) ); ?></span>
    </address>
    <div class="foot-cta">
      <a class="btn btn-sun" href="#zayavka">Отримати розрахунок</a>
      <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-viber"/></svg>Viber</a>
    </div>
    <p class="foot-legal"><a href="<?php echo esc_url( home_url( '/publichna-oferta/' ) ); ?>">Публічна оферта</a><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Політика конфіденційності</a><span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> EnRay</span></p>
  </div>
</footer>

<nav class="mobile-bar" aria-label="Швидкий зв'язок">
  <a class="btn btn-ghost" href="<?php echo esc_attr( enray_tel() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-phone"/></svg>Подзвонити</a>
  <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-viber"/></svg>Viber</a>
</nav>

<?php wp_footer(); ?>
</body>
</html>
