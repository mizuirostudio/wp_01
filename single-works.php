<?php get_header(); ?>
<?php breadcrumb(); ?>
<article id="page-article" class="wrapper page-wrapper">

  <?php if (have_posts()) : the_post(); ?>
    <div class="tag"><?php echo get_the_term_list($post->ID, 'works_tag', '<ul><li>', '</li><li>', '</li></ul>'); ?></div>
    <div class="the-time"><?php the_time('Y.m.d'); ?></div>
    <h1><?php echo wp_get_document_title(); ?></h1>
    <?php
    echo get_the_post_thumbnail($post->ID, 'large');
    ?>

    <?php the_content(); ?>
  <?php endif; ?>
</article>
<?php breadcrumb(); ?>
<?php get_footer(); ?>