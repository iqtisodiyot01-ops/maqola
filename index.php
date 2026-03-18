<?php get_header(); ?>

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="container">
        <div class="hero-badge">🚀 <?php _e('O\'zbekistonning yetakchi ilmiy portali', 'zamonaviy-iqtisodiyot'); ?></div>
        <h1 class="hero-title">
            <?php _e('Ilmiy izlanishlarni', 'zamonaviy-iqtisodiyot'); ?>
            <span><?php _e('kashf eting', 'zamonaviy-iqtisodiyot'); ?></span>
            <?php _e('va ulashing', 'zamonaviy-iqtisodiyot'); ?>
        </h1>
        <p class="hero-subtitle">
            <?php _e('Minglab ilmiy maqolalar, dissertatsiyalar va tadqiqot natijalari ochiq arxivi. Ilm-fan rivojiga o\'z hissangizni qo\'shing.', 'zamonaviy-iqtisodiyot'); ?>
        </p>
        <div class="hero-search">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" style="flex-shrink:0;">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="search" name="s"
                    placeholder="<?php esc_attr_e('Maqola nomi, muallif yoki kalit so\'zlarni kiriting...', 'zamonaviy-iqtisodiyot'); ?>"
                    value="<?php echo get_search_query(); ?>">
                <input type="hidden" name="post_type" value="maqola">
                <button type="submit"><?php _e('Qidirish', 'zamonaviy-iqtisodiyot'); ?></button>
            </form>
        </div>
    </div>
</section>

<!-- CATEGORY FILTER -->
<div class="category-filter" style="background:var(--color-bg-white); border-bottom:1px solid var(--color-border);">
    <div class="container">
        <div class="category-filter-inner" style="padding:20px 0;">
            <div class="filter-label">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                <?php _e('Toifalar:', 'zamonaviy-iqtisodiyot'); ?>
            </div>
            <div class="category-tabs">
                <?php
                $current_toifa = get_query_var('toifa', '');
                $current_term = $current_toifa ? get_term_by('slug', $current_toifa, 'toifa') : null;
                ?>
                <a href="<?php echo esc_url(get_post_type_archive_link('maqola') ?: home_url('/')); ?>"
                   class="cat-tab <?php echo !$current_term ? 'active' : ''; ?>">
                    <?php _e('Barchasi', 'zamonaviy-iqtisodiyot'); ?>
                </a>
                <?php
                $terms = get_terms(['taxonomy' => 'toifa', 'hide_empty' => false, 'orderby' => 'name']);
                if (!empty($terms) && !is_wp_error($terms)) :
                    foreach ($terms as $term) :
                        $is_active = $current_term && $current_term->term_id === $term->term_id;
                ?>
                    <a href="<?php echo esc_url(get_term_link($term)); ?>"
                       class="cat-tab <?php echo $is_active ? 'active' : ''; ?>">
                        <?php echo esc_html($term->name); ?>
                    </a>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>

<!-- ARTICLES SECTION -->
<main class="articles-section">
    <div class="container">
        <?php
        // Build query
        $paged = get_query_var('paged', 1);
        $toifa_slug = get_query_var('toifa', '');
        $search_q = get_search_query();

        $args = [
            'post_type'      => 'maqola',
            'post_status'    => 'publish',
            'posts_per_page' => 9,
            'paged'          => $paged,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];

        if ($toifa_slug) {
            $args['tax_query'] = [[
                'taxonomy' => 'toifa',
                'field'    => 'slug',
                'terms'    => $toifa_slug,
            ]];
        }

        if ($search_q) {
            $args['s'] = $search_q;
        }

        $articles = new WP_Query($args);
        $total_found = $articles->found_posts;
        ?>

        <div class="section-header">
            <h2 class="section-title">
                <?php
                if ($search_q) {
                    printf(_n('"%s" bo\'yicha %d natija', '"%s" bo\'yicha %d natija', $total_found, 'zamonaviy-iqtisodiyot'), esc_html($search_q), $total_found);
                } elseif ($toifa_slug && $current_term) {
                    echo esc_html($current_term->name) . ' ' . __('maqolalari', 'zamonaviy-iqtisodiyot');
                } else {
                    _e('So\'nggi maqolalar', 'zamonaviy-iqtisodiyot');
                }
                ?>
            </h2>
            <span class="articles-count">
                <?php printf(_n('%d maqola', '%d maqola', $total_found, 'zamonaviy-iqtisodiyot'), $total_found); ?>
            </span>
        </div>

        <?php if ($articles->have_posts()) : ?>
            <div class="articles-grid">
                <?php while ($articles->have_posts()) : $articles->the_post();
                    $post_id  = get_the_ID();
                    $authors  = get_post_meta($post_id, '_maqola_authors', true);
                    $abstract = get_post_meta($post_id, '_maqola_abstract', true);
                    $keywords = get_post_meta($post_id, '_maqola_keywords', true);
                    $views    = (int) get_post_meta($post_id, '_maqola_views', true);
                    $toifalar = get_the_terms($post_id, 'toifa');
                    $toifa_name = (!empty($toifalar) && !is_wp_error($toifalar)) ? $toifalar[0]->name : __('Umumiy', 'zamonaviy-iqtisodiyot');
                    $cat_class = zi_category_class($toifa_name);
                ?>
                <article class="article-card" data-post-id="<?php echo $post_id; ?>">
                    <div class="card-meta">
                        <span class="category-badge <?php echo esc_attr($cat_class); ?>">
                            <?php echo esc_html($toifa_name); ?>
                        </span>
                        <span class="card-date"><?php echo zi_format_date(get_the_date('Y-m-d')); ?></span>
                    </div>

                    <h3 class="card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <p class="card-abstract">
                        <?php echo esc_html($abstract ?: get_the_excerpt()); ?>
                    </p>

                    <?php if ($keywords) : ?>
                    <div class="keywords-list" style="margin-bottom:12px;">
                        <?php
                        $kw_list = array_slice(array_map('trim', explode(',', $keywords)), 0, 3);
                        foreach ($kw_list as $kw) :
                        ?>
                        <span class="keyword-tag"><?php echo esc_html($kw); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div class="card-footer">
                        <span class="card-author">
                            👤 <?php echo esc_html($authors ?: __('Noma\'lum', 'zamonaviy-iqtisodiyot')); ?>
                        </span>
                        <div class="card-stats">
                            <span class="card-stat">👁 <?php echo number_format($views); ?></span>
                            <button class="save-btn js-save-btn" data-id="<?php echo $post_id; ?>" title="<?php esc_attr_e('Saqlash', 'zamonaviy-iqtisodiyot'); ?>">
                                <span class="save-icon">🔖</span>
                                <span class="save-text"><?php _e('Saqlash', 'zamonaviy-iqtisodiyot'); ?></span>
                            </button>
                        </div>
                    </div>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php
                echo paginate_links([
                    'total'     => $articles->max_num_pages,
                    'current'   => $paged,
                    'prev_text' => '← ' . __('Oldingi', 'zamonaviy-iqtisodiyot'),
                    'next_text' => __('Keyingi', 'zamonaviy-iqtisodiyot') . ' →',
                    'type'      => 'plain',
                ]);
                ?>
            </div>

        <?php else : ?>
            <div class="empty-state">
                <div class="empty-icon">🔍</div>
                <h3><?php _e('Maqola topilmadi', 'zamonaviy-iqtisodiyot'); ?></h3>
                <p><?php _e('Qidiruv so\'zingizni o\'zgartiring yoki boshqa toifani tanlang.', 'zamonaviy-iqtisodiyot'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <?php _e('Bosh sahifaga qaytish', 'zamonaviy-iqtisodiyot'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
