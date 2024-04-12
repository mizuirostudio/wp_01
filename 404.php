<?php get_header(); ?>

<article id="not-found" class="wrapper page-wrapper">
        <h1><?php echo wp_get_document_title(); ?></h1>

    <section>
        <h2>404 Not Found</h2>
        <p>お探しのページは見つかりませんでした。<wbr>ページが削除、またはURL変更された可能性があります。</p>
        <button type="button" onclick="location.href='<?php echo esc_url(home_url()); ?>'" class="btn-color">トップに戻る</button>
    </section>
</article>

<?php get_footer(); ?>