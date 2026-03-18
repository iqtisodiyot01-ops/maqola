<?php get_header(); ?>

<main style="padding:60px 0 80px;">
    <div class="container-sm">
        <?php while (have_posts()) : the_post(); ?>
        <article>
            <h1 style="font-size:36px;font-weight:800;color:var(--color-primary);margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid var(--color-border);">
                <?php the_title(); ?>
            </h1>
            <div class="article-content-body">
                <?php the_content(); ?>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
