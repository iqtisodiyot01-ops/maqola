<?php get_header(); ?>

<section style="background:linear-gradient(135deg,#f0f4ff,#e8f0ff);padding:48px 0;text-align:center;">
    <div class="container">
        <?php if (is_tax('toifa')) : $term = get_queried_object(); ?>
        <div class="hero-badge" style="justify-content:center;">📂 <?php _e('Toifa', 'zamonaviy-iqtisodiyot'); ?></div>
        <h1 style="font-size:40px;font-weight:800;color:var(--color-primary);margin:12px 0 8px;">
            <?php echo esc_html($term->name); ?>
        </h1>
        <p style="color:var(--color-text-muted);font-size:16px;">
            <?php printf(_n('%d ta maqola', '%d ta maqola', $term->count, 'zamonaviy-iqtisodiyot'), $term->count); ?>
        </p>
        <?php else : ?>
        <h1 style="font-size:40px;font-weight:800;color:var(--color-primary);margin-bottom:8px;">
            📚 <?php _e('Barcha Maqolalar', 'zamonaviy-iqtisodiyot'); ?>
        </h1>
        <?php endif; ?>
    </div>
</section>

<!-- Category tabs -->
<div style="background:var(--color-bg-white);border-bottom:1px solid var(--color-border);padding:16px 0;">
    <div class="container">
        <div class="category-tabs">
            <a href="<?php echo esc_url(get_post_type_archive_link('maqola')); ?>"
               class="cat-tab <?php echo !is_tax() ? 'active' : ''; ?>">
                <?php _e('Barchasi', 'zamonaviy-iqtisodiyot'); ?>
            </a>
            <?php
            $terms = get_terms(['taxonomy' => 'toifa', 'hide_empty' => true]);
            if (!is_wp_error($terms)) :
                foreach ($terms as $term) :
                    $is_active = is_tax('toifa', $term);
            ?>
            <a href="<?php echo esc_url(get_term_link($term)); ?>"
               class="cat-tab <?php echo $is_active ? 'active' : ''; ?>">
                <?php echo esc_html($term->name); ?>
            </a>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>

<main class="articles-section">
    <div class="container">
        <?php if (have_posts()) : ?>
        <div class="section-header">
            <h2 class="section-title"><?php _e('Maqolalar', 'zamonaviy-iqtisodiyot'); ?></h2>
            <span class="articles-count"><?php echo $wp_query->found_posts; ?> <?php _e('ta', 'zamonaviy-iqtisodiyot'); ?></span>
        </div>
        <div class="articles-grid">
            <?php while (have_posts()) : the_post();
                $post_id  = get_the_ID();
                $abstract = get_post_meta($post_id, '_maqola_abstract', true);
                $authors  = get_post_meta($post_id, '_maqola_authors', true);
                $keywords = get_post_meta($post_id, '_maqola_keywords', true);
                $views    = (int) get_post_meta($post_id, '_maqola_views', true);
                $toifalar = get_the_terms($post_id, 'toifa');
                $toifa_name = (!empty($toifalar) && !is_wp_error($toifalar)) ? $toifalar[0]->name : 'Umumiy';
                $cat_class  = zi_category_class($toifa_name);
            ?>
            <article class="article-card" data-post-id="<?php echo $post_id; ?>">
                <div class="card-meta">
                    <span class="category-badge <?php echo esc_attr($cat_class); ?>"><?php echo esc_html($toifa_name); ?></span>
                    <span class="card-date"><?php echo zi_format_date(get_the_date('Y-m-d')); ?></span>
                </div>
                <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="card-abstract"><?php echo esc_html($abstract ?: get_the_excerpt()); ?></p>
                <?php if ($keywords) :
                    $kw_list = array_slice(array_map('trim', explode(',', $keywords)), 0, 3);
                ?>
                <div class="keywords-list" style="margin-bottom:12px;">
                    <?php foreach ($kw_list as $kw) : ?><span class="keyword-tag"><?php echo esc_html($kw); ?></span><?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="card-footer">
                    <span class="card-author">👤 <?php echo esc_html($authors ?: 'Noma\'lum'); ?></span>
                    <div class="card-stats">
                        <span class="card-stat">👁 <?php echo number_format($views); ?></span>
                        <button class="save-btn js-save-btn" data-id="<?php echo $post_id; ?>">
                            <span class="save-icon">🔖</span>
                            <span class="save-text"><?php _e('Saqlash', 'zamonaviy-iqtisodiyot'); ?></span>
                        </button>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <div class="pagination"><?php the_posts_pagination(['prev_text' => '←', 'next_text' => '→']); ?></div>
        <?php else : ?>
        <div class="empty-state">
            <div class="empty-icon">📂</div>
            <h3><?php _e('Maqola topilmadi', 'zamonaviy-iqtisodiyot'); ?></h3>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary"><?php _e('Bosh sahifaga qaytish', 'zamonaviy-iqtisodiyot'); ?></a>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
