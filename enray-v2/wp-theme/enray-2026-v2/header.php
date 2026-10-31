<?php
/** Шапка: скляне меню над фото. Згенеровано enray-v2/tools/build_wp.py. */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Перейти до змісту</a>
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-menu" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></symbol>
  <symbol id="i-close" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></symbol>
  <symbol id="i-phone" viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></symbol>
  <symbol id="i-viber" viewBox="0 0 24 24"><path d="M12 2.5c4.9 0 8.5 2.6 8.5 8.3 0 5.6-3.6 8.2-8.5 8.2-.8 0-1.6-.1-2.3-.2L6 21.5v-3.6C4.3 16.5 3.5 14 3.5 10.8 3.5 5.1 7.1 2.5 12 2.5z"/><path d="M9.2 7.6c.4-.3 1-.3 1.2.2l.6 1.3c.2.4 0 .8-.3 1.1l-.4.3c.4 1 1.3 1.9 2.3 2.3l.3-.4c.3-.3.7-.4 1.1-.3l1.3.6c.5.2.5.8.2 1.2-.6.8-1.6 1.1-2.6.6a8.3 8.3 0 0 1-3.8-3.8c-.5-1-.2-2 .1-3.1z"/></symbol>
  <symbol id="i-arrow" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
  <symbol id="i-left" viewBox="0 0 24 24"><path d="M15 6l-6 6 6 6"/></symbol>
  <symbol id="i-right" viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></symbol>
  <symbol id="i-plus" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></symbol>
  <symbol id="i-home" viewBox="0 0 24 24"><path d="M3.5 11 12 4l8.5 7"/><path d="M5.5 9.5V20h13V9.5"/><path d="M10 20v-5.5h4V20"/></symbol>
  <symbol id="i-factory" viewBox="0 0 24 24"><path d="M3 20V9l5 3V9l5 3V5h4l1 15z"/><path d="M3 20h18"/></symbol>
  <symbol id="i-drop" viewBox="0 0 24 24"><path d="M12 3.5s-6 6.6-6 10.6a6 6 0 0 0 12 0c0-4-6-10.6-6-10.6z"/></symbol>
  <symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 3 4.5 6v5.5c0 4.6 3.2 8.2 7.5 9.5 4.3-1.3 7.5-4.9 7.5-9.5V6z"/><path d="m9 12 2 2 4-4"/></symbol>
  <symbol id="i-camera" viewBox="0 0 24 24"><path d="M3 8.5h11.5v8H3z"/><path d="M14.5 11l6-3v8l-6-3"/></symbol>
  <symbol id="i-bolt" viewBox="0 0 24 24"><path d="M13 2.5L4.5 13.5H11l-1 8 8.5-11H12l1-8z"/></symbol>
  <symbol id="i-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v2.5M12 19.5V22M4.9 4.9l1.8 1.8M17.3 17.3l1.8 1.8M2 12h2.5M19.5 12H22M4.9 19.1l1.8-1.8M17.3 6.7l1.8-1.8"/></symbol>
  <symbol id="i-check" viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></symbol>
</svg>

<header class="top">
  <div class="nav">
    <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="EnRay, на головну"><img src="<?php echo esc_url( enray_asset( 'img/logo-mark.png' ) ); ?>" width="43" height="41" alt=""><span>ENRAY</span></a>
    <nav class="nav-links" aria-label="Основна навігація"><?php enray_nav_links(); ?></nav>
    <a class="nav-phone" href="<?php echo esc_attr( enray_tel() ); ?>"><?php echo esc_html( enray_opt( 'phone' ) ); ?></a>
    <a class="btn btn-primary nav-cta" href="#zayavka">Отримати розрахунок</a>
    <a class="icon-btn nav-call" href="<?php echo esc_attr( enray_tel() ); ?>" aria-label="Подзвонити: <?php echo esc_attr( enray_opt( 'phone' ) ); ?>"><svg class="ico" aria-hidden="true"><use href="#i-phone"/></svg></a>
    <button class="icon-btn nav-toggle" type="button" aria-expanded="false" aria-controls="mobile-menu" aria-label="Відкрити меню"><svg class="ico" aria-hidden="true"><use href="#i-menu"/></svg></button>
  </div>
  <div class="mobile-menu" id="mobile-menu" hidden>
    <?php enray_nav_links(); ?>
    <a class="btn btn-primary" href="#zayavka">Отримати розрахунок</a>
  </div>
</header>
