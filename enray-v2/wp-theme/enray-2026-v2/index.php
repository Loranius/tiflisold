<?php
/** Запасний шаблон: список записів (кейсів). */
get_header();
?>
<main id="main" class="wp-main">
  <section class="section">
    <h1 class="wp-title"><?php echo is_home() ? 'Кейси' : esc_html( get_the_archive_title() ); ?></h1>
    <?php get_template_part( 'template-parts/case-grid' ); ?>
  </section>
</main>
<?php
get_footer();
