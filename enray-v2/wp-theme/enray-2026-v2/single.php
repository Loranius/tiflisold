<?php
/** Кейс (запис): заголовок, головне фото, текст і галерея прикріплених фото. */
get_header();
?>
<main id="main" class="wp-main">
  <?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class( 'section wp-article' ); ?>>
    <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a><span aria-hidden="true"> / </span><a href="<?php echo esc_url( home_url( '/keysy/' ) ); ?>">Кейси</a><span aria-hidden="true"> / </span><span><?php the_title(); ?></span></p>
    <h1 class="wp-title"><?php the_title(); ?></h1>
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="wp-hero-img"><?php the_post_thumbnail( 'large' ); ?></figure>
    <?php endif; ?>
    <div class="wp-content"><?php the_content(); ?></div>
    <?php
    $content = get_post_field( 'post_content', get_the_ID() );
    if ( false === strpos( $content, 'wp-block-gallery' ) && false === strpos( $content, '[gallery' ) ) :
      $imgs = get_attached_media( 'image', get_the_ID() );
      unset( $imgs[ get_post_thumbnail_id() ] );
      if ( $imgs ) :
    ?>
      <div class="gallery" aria-label="Фото об'єкта">
        <?php foreach ( $imgs as $img ) : ?>
          <figure><?php echo wp_get_attachment_image( $img->ID, 'medium_large', false, array( 'loading' => 'lazy' ) ); ?></figure>
        <?php endforeach; ?>
      </div>
    <?php endif; endif; ?>
    <p class="wp-back"><a class="link-strong" href="<?php echo esc_url( home_url( '/#zayavka' ) ); ?>">Хочу таку станцію <?php enray_icon( 'arrow' ); ?></a></p>
  </article>
  <?php endwhile; ?>
</main>
<?php
get_footer();
