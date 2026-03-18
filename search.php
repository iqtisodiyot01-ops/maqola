<?php get_header(); ?>

<section style="background:linear-gradient(135deg,#f0f4ff,#e8f0ff);padding:48px 0;text-align:center;">
    <div class="container">
        <h1 style="font-size:36px;font-weight:800;color:var(--color-primary);margin-bottom:16px;">
            🔍 <?php printf(__('"%s" bo\'yicha qidiruv', 'zamonaviy-iqtisodiyot'), get_search_query()); ?>
        </h1>
        <div class="hero-search">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" style="flex-shrink:0;">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="search" name="s" value="<?php echo get_search_query(); ?>"
                    placeholder="<?php esc_attr_e('Qidirish...', 'zamonaviy-iqtisodiyot'); ?>">
                <input type="hidden" name="post_type" value="maqola">
                <button type="submit"><?php _e('Qidirish', 'zamonaviy-iqtisodiyot'); ?></button>
            </form>
        </div>
    </div>
</section>

<main class="articles-section">
    <div class="container">
        <?php if (have_posts()) : ?>
        <div class="section-header">
            <h2 class="section-title">
                <?php printf(_n('%d natija topildi', '%d natija topildi', $wp_query->found_posts, 'zamonaviy-iqtisodiyot'), $wp_query->found_posts); ?>
            </h2>
        </div>
        <div class="articles-grid">
            <?php while (have_posts()) : the_post();
                $post_id  = get_the_ID();
                $abstract = get_post_meta($post_id, '_maqola_abstract', true);
                $authors  = get_post_meta($post_id, '_maqola_authors', true);
                $views    = (int) get_post_meta($post_id, '_maqola_views', true);
                $toifalar = get_the_terms($post_id, 'toifa');
                $toifa_name = (!empty($toifalar) && !is_wp_error($toifalar)) ? $toifalar[0]->name : 'Umumiy';
                $cat_class = zi_category_class($toifa_name);
            ?>
            <article class="article-card" data-post-id="<?php echo $post_id; ?>">
                <div class="card-meta">
                    <span class="category-badge <?php echo esc_attr($cat_class); ?>"><?php echo esc_html($toifa_name); ?></span>
                    <span class="card-date"><?php echo zi_format_date(get_the_date('Y-m-d')); ?></span>
                </div>
                <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="card-abstract"><?php echo esc_html($abstract ?: get_the_excerpt()); ?></p>
                <div class="card-footer">
                    <span class="card-author">👤 <?php echo esc_html($authors ?: 'Noma\'lum'); ?></span>
                    <div class="card-stats">
                        <span class="card-stat">👁 <?php echo number_format($views); ?></span>
                        <button class="save-btn js-save-btn" data-id="<?php echo $post_id; ?>">
                            <span class="save-icon">🔖</span>
                        </button>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <div class="pagination"><?php the_posts_pagination(); ?></div>
        <?php else : ?>
        <div class="empty-state">
            <div class="empty-icon">🔍</div>
            <h3><?php _e('Natija topilmadi', 'zamonaviy-iqtisodiyot'); ?></h3>
            <p><?php printf(__('"%s" so\'zi bo\'yicha maqola topilmadi. Boshqa so\'z bilan qidiring.', 'zamonaviy-iqtisodiyot'), esc_html(get_search_query())); ?></p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary"><?php _e('Bosh sahifaga qaytish', 'zamonaviy-iqtisodiyot'); ?></a>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
