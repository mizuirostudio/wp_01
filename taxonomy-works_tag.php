<?php get_header(); ?>
<?php breadcrumb(); ?>
<div class="wrapper page-wrapper">
  <h1><?php single_term_title() ?></h1>
  <ul>
    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $term_object = get_queried_object();
    $term_slug   = $term_object->slug;
    $args = array(
      'post_type' => 'works',
      'paged' => $paged,
      'taxonomy' => 'works_tag',
      'term' => $term_slug,
      'posts_per_page' => 12
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <li class="archive-item">
          <div class="tag"><?php echo get_the_term_list($post->ID, 'works_tag', '<ul><li>', '</li><li>', '</li></ul>'); ?></div>
          <div class="the-time"><?php the_time('Y.m.d'); ?></div>
          <a href="<?php the_permalink(); ?>" class="link-card">
            <?php the_post_thumbnail('large'); ?>
            <div class="works-title"><?php the_title(); ?></div>
            <?php the_excerpt(); ?>
          </a>
        </li>
      <?php endwhile; ?>
    <?php else : ?>
      <p>記事はまだありません。</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </ul>
  <div class="post-pagination-wrapper">
    <?php
    $args = array(
      'type' => 'list',
      'current' => $paged,
      'total' => $the_query->max_num_pages,
      'prev_text' => '<',
      'next_text' => '>',
    );
    echo paginate_links($args);
    ?>
  </div>
</div>
<?php breadcrumb(); ?>
<?php get_footer(); ?>