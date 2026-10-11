<?php
/** Сторінка послуги: вміст із services/<slug>.php, шапка й футер — спільні. */
get_header();
?>
<main id="main">
<?php require get_template_directory() . '/services/' . enray_current_service() . '.php'; ?>
</main>
<?php
get_footer();
