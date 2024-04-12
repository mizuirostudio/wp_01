<?php get_header(); ?>

<article id="page-article" class="wrapper page-wrapper">
  <?php if (have_posts()) : the_post(); ?>
    <h1><?php echo wp_get_document_title(); ?></h1>

    <?php
    echo get_the_post_thumbnail($post->ID, 'large');
    ?>
    <div class="tag"><?php echo get_the_term_list($post->ID, 'works-tag', '<ul><li>', '</li><li>', '</li></ul>'); ?></div>
    <?php the_content(); ?>
  <?php endif; ?>
</article>

<?php get_footer(); ?>