<?php get_header(); ?>

<main>
  <div class="top-image">
    <div class="catchcopy">
      <span>Web Design & Coding</span>
    </div>
    <div class="scrolldown"><span>Scroll</span></div>
  </div>
  <div class="wrapper top-wrapper">
    <section id="about">
      <h2>
        About
        <span>
          みずいろスタジオについて
        </span>
      </h2>
      <p>
        みずいろスタジオは、フリーランスで活動している個人のWeb制作事務所です。
        <wbr>
        デザインからサイト構築（コーディング）まで、Webサイト制作を支援しています。強みは、Webマーケティング会社での経験を活かした、コンバージョンにつながるサイト設計です。
      </p>
      <p>
        サイトは作って終わり、ではなく、そこがスタート。
        <wbr>
        お客様の新たなスタートにつながるサイトで、事業に貢献します！
      </p>
      <ol class="pr-points">
        <li class="pr-point">
          <div class="pr-icon icon-sp"></div>
          <span>様々なデバイスに対応するレスポンシブデザイン</span>
        </li>
        <li class="pr-point">
          <div class="pr-icon icon-film"></div>
          <span>サイトの印象を高めるCSS・Javascriptアニメーション</span>
        </li>
        <li class="pr-point">
          <div class="pr-icon icon-code"></div>
          <span>アクセシビリティに配慮したマークアップ</span>
        </li>
        <li class="pr-point">
          <div class="pr-icon icon-pen"></div>
          <span>Wordpress等のCMSを導入した更新しやすいサイト</span>
        </li>
      </ol>
    </section>

    <section id="works">
      <h2>
        Works
        <span>
          これまでに制作したもの
        </span>
      </h2>
      <p>
        みずいろスタジオのこれまでの制作物を一部紹介しています。それぞれのページでは、デザインやコーディングのときに考えたこと、使用したツールや参考書籍等を記載しています。
      </p>
      <ul class="works-slider">
        <?php
        $works_args = [
          'post_type' => 'works',
          'posts_per_page' => 3,
        ];
        $works_posts = get_posts($works_args); ?>


        <?php if ($works_posts) : foreach ($works_posts as $post) : setup_postdata($post);
        ?>
            <li class="works-slide">
              <div class="tag"><?php echo get_the_term_list($post->ID, 'works-tag', '<ul><li>', '</li><li>', '</li></ul>'); ?></div>
              <a href="<?php echo esc_url(get_the_permalink()); ?>" class="link-card">
                <figure>
                  <?php
                  echo get_the_post_thumbnail($post->ID, 'large');
                  ?>
                </figure>


                <div class="works-title"><?php the_title(); ?></div>
                <?php the_excerpt(); ?>
              </a>
            </li>
          <?php endforeach; ?>

        <?php else :
        ?>
          <li>まだ投稿がありません。</li>
        <?php endif;
        wp_reset_postdata(); ?>
      </ul>
      <button type="button" onclick="location.href='<?php echo esc_url(get_post_type_archive_link('works')); ?>'" class="btn-color">実績一覧</button>

    </section>

    <section id="contact">
      <h2>
        Contact
        <span>お問い合わせ、ご依頼承ります</span>
      </h2>
      <?php echo do_shortcode('[contact-form-7 id="0397b14" title="contactform"]'); ?>
    </section>


  </div>
</main>

<?php get_footer(); ?>