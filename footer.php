<footer>
  <?php wp_nav_menu(
    array(
      'theme_location' => 'footer-menu',
    )
  );
  ?>
</footer>

<?php wp_footer(); ?>

<script>
  jQuery(function($) {
    $('#sp-menu-btn').click(function() {
      $('#sp-menu-btn, .sp-menu-wrapper').toggleClass('open');
    });
    $('.sp-menu li a').click(function() {
      $('#sp-menu-btn, .sp-menu-wrapper').removeClass('open');
    });
    $('.works-slider').slick({
      autoplaySpeed: 1500,
      speed: 1500,
      autoplay: true,
      Infinity: true,
      slidesToShow: 1,
      slideToscroll: 1,
      arrows: true,
      dots: true,
      centerMode: true,
      centerPadding: '8%'
    });
  });
</script>
</body>

</html>