<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo bloginfo('description'); ?>">

  <?php wp_head(); ?>
</head>

<body>
  <header class="header">
    <?php $html_tag = (is_home() || is_front_page()) ? 'h1' : 'div'; ?>
    <<?php echo $html_tag; ?> class="logo-bg">
      <a href="<?php echo esc_url(home_url()); ?>">
        <img src="<?php echo esc_url(get_theme_file_uri('images/logo-color.svg')); ?>" class="logo" alt="みずいろスタジオロゴ">
        <span>みずいろスタジオ</span>
      </a>
    </<?php echo $html_tag; ?>>
    <?php wp_nav_menu(
      array(
        'theme_location' => 'header-menu',
        'container' => 'nav',
        'container_class' => 'header-menu-wrapper',
        'menu_class' => 'header-menu',
      )
    );
    ?>
    <button id="sp-menu-btn" type="button" aria-label="メニューを開く" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <?php wp_nav_menu(
      array(
        'theme_location' => 'sp-menu',
        'container' => 'nav',
        'container_class' => 'sp-menu-wrapper',
        'menu_class' => 'sp-menu',
      )
    );
    ?>
  </header>
