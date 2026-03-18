<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <div class="logo-icon">📊</div>
                <div class="logo-text">
                    <span class="site-name"><?php bloginfo('name'); ?></span>
                    <span class="site-tagline">ILMIY PORTAL</span>
                </div>
            </a>

            <nav class="main-nav" id="main-nav" aria-label="<?php esc_attr_e('Asosiy menyu', 'zamonaviy-iqtisodiyot'); ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                   class="<?php echo (is_front_page() || is_post_type_archive('maqola') || is_singular('maqola')) && !is_page() ? 'active' : ''; ?>">
                    🏠 <?php _e('Bosh sahifa', 'zamonaviy-iqtisodiyot'); ?>
                </a>
                <?php
                $submit_page = get_page_by_path('maqola-yuborish');
                $about_page  = get_page_by_path('biz-haqimizda');
                $contact_page = get_page_by_path('aloqa');
                $saved_page  = get_page_by_path('saqlangan');
                ?>
                <a href="<?php echo $submit_page ? get_permalink($submit_page->ID) : home_url('/maqola-yuborish/'); ?>"
                   class="<?php echo is_page('maqola-yuborish') ? 'active' : ''; ?>">
                    ✏️ <?php _e('Maqola yuborish', 'zamonaviy-iqtisodiyot'); ?>
                </a>
                <a href="<?php echo $about_page ? get_permalink($about_page->ID) : home_url('/biz-haqimizda/'); ?>"
                   class="<?php echo is_page('biz-haqimizda') ? 'active' : ''; ?>">
                    ℹ️ <?php _e('Biz haqimizda', 'zamonaviy-iqtisodiyot'); ?>
                </a>
                <a href="<?php echo $contact_page ? get_permalink($contact_page->ID) : home_url('/aloqa/'); ?>"
                   class="<?php echo is_page('aloqa') ? 'active' : ''; ?>">
                    📞 <?php _e('Aloqa', 'zamonaviy-iqtisodiyot'); ?>
                </a>
                <a href="<?php echo $saved_page ? get_permalink($saved_page->ID) : home_url('/saqlangan/'); ?>"
                   class="<?php echo is_page('saqlangan') ? 'active' : ''; ?>"
                   id="saved-nav-link">
                    🔖 <?php _e('Saqlangan', 'zamonaviy-iqtisodiyot'); ?>
                </a>
            </nav>

            <div class="header-search">
                <button class="header-search-btn" id="search-toggle" aria-label="Qidirish" title="Qidirish">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </button>
                <button class="menu-toggle" id="menu-toggle" aria-controls="main-nav" aria-expanded="false">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Search Overlay -->
    <div class="search-overlay" id="search-overlay" style="display:none; background:var(--color-bg-white); border-top:1px solid var(--color-border); padding:16px;">
        <div class="container">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form" id="overlay-search-form">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" style="flex-shrink:0;">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="search" name="s" placeholder="<?php esc_attr_e('Maqola, muallif yoki kalit so\'zlarni kiriting...', 'zamonaviy-iqtisodiyot'); ?>"
                    value="<?php echo get_search_query(); ?>" autofocus>
                <input type="hidden" name="post_type" value="maqola">
                <button type="submit"><?php _e('Qidirish', 'zamonaviy-iqtisodiyot'); ?></button>
            </form>
        </div>
    </div>
</header>
