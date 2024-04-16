<?php get_header(); ?>
<?php breadcrumb(); ?>
<div class="wrapper page-wrapper">
  <h1><?php echo wp_get_document_title(); ?></h1>
  <ul>
    <?php $args = array(
      'numberposts' => 12,
      'post_type' => 'works'
    );
    $posts = get_posts($args);
    if ($posts) : foreach ($posts as $post) : setup_postdata($post); ?>
        <li class="archive-item">
          <div class="tag"><?php echo get_the_term_list($post->ID, 'works_tag', '<ul><li>', '</li><li>', '</li></ul>'); ?></div>
          <a href="<?php the_permalink(); ?>" class="link-card">
            <?php the_post_thumbnail('large'); ?>
            <div class="the-time"><?php the_time('Y.m.d'); ?></div>
            <div class="works-title"><?php the_title(); ?></div>
            <?php the_excerpt(); ?>
          </a>
        </li>
      <?php endforeach; ?>
    <?php else :
    ?>
      <li>
        <p>記事はまだありません。</p>
      </li>
    <?php endif;
    wp_reset_postdata();
    ?>
  </ul>
</div>
<?php breadcrumb(); ?>
<?php get_footer(); ?>