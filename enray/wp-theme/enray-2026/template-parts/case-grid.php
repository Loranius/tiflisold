<?php
/** Сітка кейсів: фото, назва, дата. Працює з основним циклом або з $GLOBALS['enray_cases']. */
$q = isset( $GLOBALS['enray_cases'] ) ? $GLOBALS['enray_cases'] : $GLOBALS['wp_query'];
if ( ! $q->have_posts() ) {
	echo '<p class="lead">Кейсів поки немає.</p>';
	return;
}
?>
<div class="case-list">
  <?php while ( $q->have_posts() ) : $q->the_post(); ?>
  <article class="case-card">
    <a class="case-card-link" href="<?php the_permalink(); ?>">
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
      <?php else : ?>
        <span class="case-card-noimg" aria-hidden="true"></span>
      <?php endif; ?>
      <h2><?php the_title(); ?></h2>
    </a>
    <p class="spec"><?php echo esc_html( get_the_date( 'Y' ) ); ?></p>
  </article>
  <?php endwhile; ?>
</div>
<?php
the_posts_pagination();
