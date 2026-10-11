<?php
/** Сторінку не знайдено. */
get_header();
?>
<main id="main" class="wp-main">
  <section class="section wp-article">
    <h1 class="wp-title">Такої сторінки немає</h1>
    <p class="lead">Можливо, адреса змінилась. Почніть з головної або оберіть свій сценарій.</p>
    <p class="wp-404-links">
      <a class="btn btn-primary btn-lg" href="<?php echo esc_url( home_url( '/' ) ); ?>">На головну</a>
      <a class="btn btn-outline btn-lg" href="<?php echo esc_url( home_url( '/dim/' ) ); ?>">Для дому</a>
      <a class="btn btn-outline btn-lg" href="<?php echo esc_url( home_url( '/biznes/' ) ); ?>">Для бізнесу</a>
      <a class="btn btn-outline btn-lg" href="<?php echo esc_url( home_url( '/agro/' ) ); ?>">Агро</a>
    </p>
  </section>
</main>
<?php
get_footer();
