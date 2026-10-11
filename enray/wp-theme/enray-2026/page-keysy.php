<?php
/** Сторінка «Кейси» (slug keysy): усі записи-кейси карткою з фото. */
get_header();
?>
<main id="main" class="wp-main">
  <section class="section">
    <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><span>Кейси</span></p>
    <h1 class="wp-title">Наші реалізовані кейси</h1>
    <?php
    while ( have_posts() ) :
      the_post();
      if ( trim( get_the_content() ) ) {
        echo '<div class="wp-content wp-lead">';
        the_content();
        echo '</div>';
      }
    endwhile;
    $cases = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1, 'ignore_sticky_posts' => true ) );
    $GLOBALS['enray_cases'] = $cases;
    get_template_part( 'template-parts/case-grid' );
    wp_reset_postdata();
    ?>
  </section>
</main>
<?php
get_footer();
