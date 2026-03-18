<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $post_id  = get_the_ID();
    $authors  = get_post_meta($post_id, '_maqola_authors', true);
    $abstract = get_post_meta($post_id, '_maqola_abstract', true);
    $keywords = get_post_meta($post_id, '_maqola_keywords', true);
    $doi      = get_post_meta($post_id, '_maqola_doi', true);
    $views    = (int) get_post_meta($post_id, '_maqola_views', true);
    $toifalar = get_the_terms($post_id, 'toifa');
    $toifa_name = (!empty($toifalar) && !is_wp_error($toifalar)) ? $toifalar[0]->name : __('Umumiy', 'zamonaviy-iqtisodiyot');
    $cat_class = zi_category_class($toifa_name);
?>

<main class="article-page">
    <div class="container-sm">
        <!-- Breadcrumb -->
        <div class="article-breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Bosh sahifa', 'zamonaviy-iqtisodiyot'); ?></a>
            <span class="breadcrumb-sep">›</span>
            <?php if (!empty($toifalar) && !is_wp_error($toifalar)) : ?>
            <a href="<?php echo esc_url(get_term_link($toifalar[0])); ?>"><?php echo esc_html($toifa_name); ?></a>
            <span class="breadcrumb-sep">›</span>
            <?php endif; ?>
            <span><?php the_title(); ?></span>
        </div>

        <div class="article-header">
            <!-- Category + Save -->
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:16px;">
                <span class="category-badge <?php echo esc_attr($cat_class); ?>"><?php echo esc_html($toifa_name); ?></span>
                <button class="save-btn js-save-btn" data-id="<?php echo $post_id; ?>" style="font-size:14px;padding:8px 16px;">
                    <span class="save-icon">🔖</span>
                    <span class="save-text"><?php _e('Saqlash', 'zamonaviy-iqtisodiyot'); ?></span>
                </button>
            </div>

            <!-- Title -->
            <h1 class="article-title-h1"><?php the_title(); ?></h1>

            <!-- Meta Grid -->
            <div class="article-meta-grid">
                <?php if ($authors) : ?>
                <div class="meta-item">
                    <span class="meta-label">👤 <?php _e('Mualliflar', 'zamonaviy-iqtisodiyot'); ?></span>
                    <span class="meta-value"><?php echo esc_html($authors); ?></span>
                </div>
                <?php endif; ?>
                <div class="meta-item">
                    <span class="meta-label">📅 <?php _e('Nashr etilgan', 'zamonaviy-iqtisodiyot'); ?></span>
                    <span class="meta-value"><?php echo zi_format_date(get_the_date('Y-m-d')); ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">👁 <?php _e('Ko\'rishlar', 'zamonaviy-iqtisodiyot'); ?></span>
                    <span class="meta-value"><?php echo number_format($views); ?></span>
                </div>
                <?php if ($doi) : ?>
                <div class="meta-item">
                    <span class="meta-label">🔗 DOI</span>
                    <span class="meta-value">
                        <a href="https://doi.org/<?php echo esc_attr($doi); ?>" target="_blank" rel="noopener">
                            <?php echo esc_html($doi); ?>
                        </a>
                    </span>
                </div>
                <?php endif; ?>
            </div>

            <!-- Abstract -->
            <?php if ($abstract) : ?>
            <div class="abstract-box">
                <h3><?php _e('Annotatsiya', 'zamonaviy-iqtisodiyot'); ?></h3>
                <p><?php echo esc_html($abstract); ?></p>
            </div>
            <?php endif; ?>

            <!-- Keywords -->
            <?php if ($keywords) : ?>
            <div style="margin:20px 0;">
                <span style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:var(--color-text-light);display:block;margin-bottom:8px;">
                    🏷️ <?php _e('Kalit so\'zlar', 'zamonaviy-iqtisodiyot'); ?>
                </span>
                <div class="keywords-list">
                    <?php foreach (array_map('trim', explode(',', $keywords)) as $kw) : ?>
                    <span class="keyword-tag"><?php echo esc_html($kw); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Article Content -->
        <div class="article-content-body">
            <?php the_content(); ?>
        </div>

        <!-- Share & Back -->
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-top:48px;padding-top:32px;border-top:1px solid var(--color-border);">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-outline">
                ← <?php _e('Barcha maqolalar', 'zamonaviy-iqtisodiyot'); ?>
            </a>
            <div style="display:flex;gap:10px;">
                <a href="<?php echo esc_url('https://t.me/share/url?url=' . urlencode(get_permalink()) . '&text=' . urlencode(get_the_title())); ?>"
                   target="_blank" rel="noopener" class="btn btn-outline" style="font-size:13px;">
                    📤 Telegram
                </a>
                <button onclick="navigator.clipboard.writeText('<?php echo esc_js(get_permalink()); ?>').then(() => alert('<?php esc_attr_e('Havola nusxalandi!', 'zamonaviy-iqtisodiyot'); ?>'))"
                    class="btn btn-outline" style="font-size:13px;">
                    🔗 <?php _e('Havola', 'zamonaviy-iqtisodiyot'); ?>
                </button>
            </div>
        </div>

    </div>
</main>

<?php endwhile; ?>
<?php get_footer(); ?>
