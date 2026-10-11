<footer class="site-footer">
  <div class="footer-inner">
    <a class="brand brand--light" href="#top" aria-label="EnRay, на початок сторінки"><img src="<?php echo esc_url( enray_img( 'logo-mark.png' ) ); ?>" width="43" height="41" alt=""><span>ENRAY</span></a>
    <nav class="footer-links" aria-label="Розділи"><?php enray_nav_links( 'footer' ); ?></nav>
    <address class="footer-contacts">
      <a href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
      <span><?php echo esc_html( enray_opt( 'address' ) ); ?></span>
      <a href="<?php echo esc_attr( 'mailto:' . enray_opt( 'email' ) ); ?>"><?php echo esc_html( enray_opt( 'email' ) ); ?></a>
      <span><?php echo esc_html( enray_opt( 'hours' ) ); ?></span>
    </address>
    <p class="footer-legal"><a href="<?php echo esc_url( home_url( '/publichna-oferta/' ) ); ?>">Публічна оферта</a><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Політика конфіденційності</a><span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> EnRay</span></p>
  </div>
</footer>

<div class="mobile-bar">
  <a class="btn btn-outline" href="<?php echo esc_attr( enray_tel() ); ?>"><svg class="ico"><use href="#i-phone"/></svg>Подзвонити</a>
  <a class="btn btn-viber" href="<?php echo esc_attr( enray_viber() ); ?>"><svg class="ico"><use href="#i-viber"/></svg>Viber</a>
</div>


<?php wp_footer(); ?>
</body>
</html>
