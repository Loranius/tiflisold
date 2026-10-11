<?php
/** Звичайна сторінка: заголовок і вміст із редактора. */
get_header();
?>
<main id="main" class="wp-main">
  <?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class( 'section wp-article' ); ?>>
    <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><span><?php the_title(); ?></span></p>
    <h1 class="wp-title"><?php the_title(); ?></h1>
    <div class="wp-content"><?php the_content(); ?></div>
  </article>
  <?php endwhile; ?>
</main>
<?php
get_footer();
