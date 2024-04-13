<?php
function register_my_menus()
{
  register_nav_menus(
    array(
      'header-menu' => 'header-menu',
      'footer-menu' => 'footer-menu',
      'sp-menu' => 'sp-menu',
    )
  );
}
add_action('after_setup_theme', 'register_my_menus');

function my_enqueue_styles()
{
  wp_enqueue_style('ress', get_template_directory_uri() . '/ress.css', array(), false, 'all');
  wp_enqueue_style('style', get_stylesheet_uri(), array('ress'), false, 'all');
  wp_enqueue_style(
    'fontawesome',
    'https://fonts.googleapis.com/css2?family=Marcellus&family=Baskervville:ital@0;1&family=Noto+Sans+JP:wght@400;500;700;900&display=swap',
    array(),
    null
  );
  wp_enqueue_style(
    'googlefonts',
    'https://fonts.googleapis.com/css2?family=Marcellus&family=Baskervville:ital@0;1&family=Noto+Sans+JP:wght@400;500;700;900&display=swap',
    array(),
    null
  );
  wp_enqueue_script('jquery');
  wp_enqueue_style('slick-style', get_template_directory_uri() . '/slick/slick.css', array(), '1.0.0');
  wp_enqueue_style('slick-theme-style', get_template_directory_uri() . '/slick/slick-theme.css', array('slick-style'), '1.0.0');
  wp_enqueue_script('slick-script', get_template_directory_uri() . '/slick/slick.min.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'my_enqueue_styles');

function mytheme_set()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'mytheme_set');
add_theme_support('title-tag');

add_filter('document_title_parts', 'title_tagline');
function title_tagline($title)
{
  if (is_home() || is_front_page()) {
    $title['tagline'] = '';
  }
  return $title;
}
add_filter('document_title_separator', 'title_separator');
function title_separator($separator)
{
  $separator = '|';
  return $separator;
}

function edit_document_title($title)
{
  if (!doing_action('wp_head')) {
    $title['site'] = '';
  }
  return $title;
}

add_filter('document_title_parts', 'edit_document_title');

function add_post_type()
{
  register_post_type(
    'works',
    array(
      'labels' => array(
        'name' => __('制作実績'),
        'singular_name' => __('制作実績')
      ),
      'public' => true,
      'menu_position' => 5,
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
      'has_archive' => true,
      'show_in_rest' => true,
    )
  );
}
add_action('init', 'add_post_type');


function add_taxonomies()
{
  register_taxonomy(
    'works-tag',
    array('works'),
    array(
      'label' => '制作実績タグ',
      'public' => true,
      'show_in_menu' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'show_in_nav_menus' => true,
      'hierarchical' => false,
      'rewrite' => array('slug' => 'works_tag', 'with_front' => true,),
      'show_in_rest' => true,
      'rest_base' => "",
    )
  );
}
add_action('init', 'add_taxonomies', 0);

function breadcrumb()
{
  $wp_obj = get_queried_object();

  echo
  '<div class="p-breadcrumb">' .
    '<ol class="p-breadcrumb__lists" itemscope itemtype="http://schema.org/BreadcrumbList">' .
    '<li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="p-breadcrumb__item">' .
    '<a itemprop="item" href="' . home_url() . '">' .
    '<span itemprop="name">TOP</span>' .
    '</a>' .
    '<meta itemprop="position" content="1">' .
    '</li>';

  if (is_page()) {
    echo
    '<li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="p-breadcrumb__item">' .
      '<a itemprop="item" href="' . home_url($_SERVER["REQUEST_URI"]) . '">' .
      '<span itemprop="name">' . single_post_title('', false) . '</span>' .
      '</a>' .
      '<meta itemprop="position" content="2">' .
      '</li>';
  }
  if (is_post_type_archive()) {
    echo
    '<li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="p-breadcrumb__item">' .
      '<a itemprop="item" href="' . home_url($wp_obj->name) . '">' .
      '<span itemprop="name">' . $wp_obj->label . '</span>' .
      '</a>' .
      '<meta itemprop="position" content="2">' .
      '</li>';
  }

  if (is_tax()) {
    $post_slug = get_post_type();
    $post_label = get_post_type_object($post_slug)->label;
    echo
    '<li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="p-breadcrumb__item">' .
      '<a itemprop="item" href="' . home_url($post_slug) . '">' .
      '<span itemprop="name">' . $post_label . '</span>' .
      '</a>' .
      '<meta itemprop="position" content="2">' .
      '</li>' .
      '<li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="p-breadcrumb__item">' .
      '<a itemprop="item" href="' . home_url($post_slug . '/' . $wp_obj->slug) . '">' .
      '<span itemprop="name">「' . $wp_obj->name . '」カテゴリー一覧</span>' .
      '</a>' .
      '<meta itemprop="position" content="3">' .
      '</li>';
  }

  if (is_singular() && !is_page()) {
    $post_slug = get_post_type();
    $post_label = get_post_type_object($post_slug)->label;
    $post_id = $wp_obj->ID;
    $post_title = $wp_obj->post_title;
    echo
    '<li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="p-breadcrumb__item">' .
      '<a itemprop="item" href="' . home_url($post_slug) . '">' .
      '<span itemprop="name">' . $post_label . '</span>' .
      '</a>' .
      '<meta itemprop="position" content="2">' .
      '</li>' .
      '<li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="p-breadcrumb__item">' .
      '<a itemprop="item" href="' . home_url($post_slug . '/' . $post_id) . '">' .
      '<span itemprop="name">' . $post_title . '</span>' .
      '</a>' .
      '<meta itemprop="position" content="3">' .
      '</li>';
  }

  if (is_404()) {
    echo
    '<li itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="p-breadcrumb__item">' .
      '<a itemprop="item" href="' . home_url($_SERVER["REQUEST_URI"]) . '">' .
      '<span itemprop="name">404 Not Found</span>' .
      '</a>' .
      '<meta itemprop="position" content="2">' .
      '</li>';
  }

  echo
  '</ol>' .
    '</div>';
}
