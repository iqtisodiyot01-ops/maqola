<?php
defined('ABSPATH') || exit;

/* ==============================
   THEME SETUP
============================== */
function zi_theme_setup() {
    load_theme_textdomain('zamonaviy-iqtisodiyot', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('automatic-feed-links');
    add_theme_support('customize-selective-refresh-widgets');
    register_nav_menus([
        'primary' => __('Asosiy Menyu', 'zamonaviy-iqtisodiyot'),
        'footer'  => __('Footer Menyu', 'zamonaviy-iqtisodiyot'),
    ]);
}
add_action('after_setup_theme', 'zi_theme_setup');

/* ==============================
   ENQUEUE STYLES & SCRIPTS
============================== */
function zi_enqueue_assets() {
    wp_enqueue_style('google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        [], null
    );
    wp_enqueue_style('zi-style', get_stylesheet_uri(), ['google-fonts'], '1.0.0');
    wp_enqueue_script('zi-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);
    wp_localize_script('zi-main', 'zi_vars', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('zi_nonce'),
        'home_url' => home_url('/'),
    ]);
}
add_action('wp_enqueue_scripts', 'zi_enqueue_assets');

/* ==============================
   CUSTOM POST TYPE: MAQOLALAR
============================== */
function zi_register_post_types() {
    register_post_type('maqola', [
        'labels' => [
            'name'               => __('Maqolalar', 'zamonaviy-iqtisodiyot'),
            'singular_name'      => __('Maqola', 'zamonaviy-iqtisodiyot'),
            'add_new'            => __('Yangi qo\'shish', 'zamonaviy-iqtisodiyot'),
            'add_new_item'       => __('Yangi maqola qo\'shish', 'zamonaviy-iqtisodiyot'),
            'edit_item'          => __('Maqolani tahrirlash', 'zamonaviy-iqtisodiyot'),
            'view_item'          => __('Maqolani ko\'rish', 'zamonaviy-iqtisodiyot'),
            'search_items'       => __('Maqolalarni qidirish', 'zamonaviy-iqtisodiyot'),
            'not_found'          => __('Maqola topilmadi', 'zamonaviy-iqtisodiyot'),
            'not_found_in_trash' => __('Axlatda maqola yo\'q', 'zamonaviy-iqtisodiyot'),
            'all_items'          => __('Barcha maqolalar', 'zamonaviy-iqtisodiyot'),
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'maqolalar'],
        'show_in_rest'       => true,
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon'          => 'dashicons-media-document',
        'menu_position'      => 5,
    ]);
}
add_action('init', 'zi_register_post_types');

/* ==============================
   CUSTOM TAXONOMY: TOIFALAR
============================== */
function zi_register_taxonomies() {
    register_taxonomy('toifa', 'maqola', [
        'labels' => [
            'name'              => __('Toifalar', 'zamonaviy-iqtisodiyot'),
            'singular_name'     => __('Toifa', 'zamonaviy-iqtisodiyot'),
            'search_items'      => __('Toifalarni qidirish', 'zamonaviy-iqtisodiyot'),
            'all_items'         => __('Barcha toifalar', 'zamonaviy-iqtisodiyot'),
            'edit_item'         => __('Toifani tahrirlash', 'zamonaviy-iqtisodiyot'),
            'add_new_item'      => __('Yangi toifa qo\'shish', 'zamonaviy-iqtisodiyot'),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'toifa'],
        'show_admin_column' => true,
    ]);
}
add_action('init', 'zi_register_taxonomies');

/* ==============================
   CUSTOM META BOXES
============================== */
function zi_add_meta_boxes() {
    add_meta_box('zi_article_meta', __('Maqola Ma\'lumotlari', 'zamonaviy-iqtisodiyot'),
        'zi_article_meta_callback', 'maqola', 'normal', 'high');
}
add_action('add_meta_boxes', 'zi_add_meta_boxes');

function zi_article_meta_callback($post) {
    wp_nonce_field('zi_save_meta', 'zi_meta_nonce');
    $authors  = get_post_meta($post->ID, '_maqola_authors', true);
    $abstract = get_post_meta($post->ID, '_maqola_abstract', true);
    $keywords = get_post_meta($post->ID, '_maqola_keywords', true);
    $doi      = get_post_meta($post->ID, '_maqola_doi', true);
    $views    = get_post_meta($post->ID, '_maqola_views', true) ?: 0;
    ?>
    <table class="form-table">
        <tr>
            <th><label for="maqola_authors"><?php _e('Mualliflar', 'zamonaviy-iqtisodiyot'); ?> *</label></th>
            <td><input type="text" id="maqola_authors" name="maqola_authors"
                value="<?php echo esc_attr($authors); ?>" class="regular-text"
                placeholder="Ism Familiya, Ism Familiya" /></td>
        </tr>
        <tr>
            <th><label for="maqola_abstract"><?php _e('Annotatsiya', 'zamonaviy-iqtisodiyot'); ?> *</label></th>
            <td><textarea id="maqola_abstract" name="maqola_abstract" class="large-text" rows="4"
                placeholder="Maqolaning qisqacha bayoni..."><?php echo esc_textarea($abstract); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="maqola_keywords"><?php _e('Kalit so\'zlar', 'zamonaviy-iqtisodiyot'); ?> *</label></th>
            <td><input type="text" id="maqola_keywords" name="maqola_keywords"
                value="<?php echo esc_attr($keywords); ?>" class="regular-text"
                placeholder="kalit so'z1, kalit so'z2, ..." /></td>
        </tr>
        <tr>
            <th><label for="maqola_doi"><?php _e('DOI', 'zamonaviy-iqtisodiyot'); ?></label></th>
            <td><input type="text" id="maqola_doi" name="maqola_doi"
                value="<?php echo esc_attr($doi); ?>" class="regular-text"
                placeholder="10.XXXX/xxxxx" /></td>
        </tr>
        <tr>
            <th><?php _e('Ko\'rishlar', 'zamonaviy-iqtisodiyot'); ?></th>
            <td><strong><?php echo esc_html($views); ?></strong></td>
        </tr>
    </table>
    <?php
}

function zi_save_meta($post_id) {
    if (!isset($_POST['zi_meta_nonce']) || !wp_verify_nonce($_POST['zi_meta_nonce'], 'zi_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    $fields = ['maqola_authors', 'maqola_abstract', 'maqola_keywords', 'maqola_doi'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_textarea_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'zi_save_meta');

/* ==============================
   VIEW COUNT
============================== */
function zi_increment_views($post_id) {
    if (get_post_type($post_id) !== 'maqola') return;
    $views = (int) get_post_meta($post_id, '_maqola_views', true);
    update_post_meta($post_id, '_maqola_views', $views + 1);
}
add_action('wp_head', function() {
    if (is_singular('maqola')) zi_increment_views(get_the_ID());
});

/* ==============================
   ARTICLE SUBMISSION (AJAX)
============================== */
function zi_submit_article() {
    check_ajax_referer('zi_nonce', 'nonce');
    $title    = sanitize_text_field($_POST['title'] ?? '');
    $abstract = sanitize_textarea_field($_POST['abstract'] ?? '');
    $content  = sanitize_textarea_field($_POST['content'] ?? '');
    $authors  = sanitize_text_field($_POST['authors'] ?? '');
    $category = sanitize_text_field($_POST['category'] ?? '');
    $keywords = sanitize_text_field($_POST['keywords'] ?? '');
    $doi      = sanitize_text_field($_POST['doi'] ?? '');

    if (!$title || !$abstract || !$content || !$authors || !$category || !$keywords) {
        wp_send_json_error(['message' => 'Barcha majburiy maydonlarni to\'ldiring.']);
        return;
    }
    if (mb_strlen($title) < 5) {
        wp_send_json_error(['message' => 'Sarlavha kamida 5 ta belgidan iborat bo\'lishi kerak.']);
        return;
    }
    if (mb_strlen($abstract) < 50) {
        wp_send_json_error(['message' => 'Annotatsiya kamida 50 ta belgidan iborat bo\'lishi kerak.']);
        return;
    }

    $post_id = wp_insert_post([
        'post_title'   => $title,
        'post_content' => $content,
        'post_status'  => 'pending',
        'post_type'    => 'maqola',
    ]);

    if (is_wp_error($post_id)) {
        wp_send_json_error(['message' => 'Maqola saqlanmadi. Qayta urinib ko\'ring.']);
        return;
    }

    update_post_meta($post_id, '_maqola_abstract', $abstract);
    update_post_meta($post_id, '_maqola_authors', $authors);
    update_post_meta($post_id, '_maqola_keywords', $keywords);
    update_post_meta($post_id, '_maqola_doi', $doi);
    update_post_meta($post_id, '_maqola_views', 0);

    // Assign taxonomy
    if ($category) {
        $term = get_term_by('name', $category, 'toifa');
        if (!$term) {
            $term = wp_insert_term($category, 'toifa');
            if (!is_wp_error($term)) {
                wp_set_object_terms($post_id, $term['term_id'], 'toifa');
            }
        } else {
            wp_set_object_terms($post_id, $term->term_id, 'toifa');
        }
    }

    // Send email notification to admin
    $admin_email = get_option('admin_email');
    $subject = 'Yangi maqola yuborildi: ' . $title;
    $body = "Yangi maqola tasdiqlanish uchun yuborildi.\n\nSarlavha: $title\nMuallif: $authors\nToifa: $category\n\nTasdiqlash uchun: " . admin_url('post.php?post=' . $post_id . '&action=edit');
    wp_mail($admin_email, $subject, $body);

    wp_send_json_success([
        'message' => 'Maqolangiz muvaffaqiyatli yuborildi! Tahririyat ko\'rib chiqadi va tez orada e\'lon qilinadi.',
        'post_id' => $post_id,
    ]);
}
add_action('wp_ajax_zi_submit_article', 'zi_submit_article');
add_action('wp_ajax_nopriv_zi_submit_article', 'zi_submit_article');

/* ==============================
   CONTACT FORM (AJAX)
============================== */
function zi_send_contact() {
    check_ajax_referer('zi_nonce', 'nonce');
    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (!$name || !$email || !$message) {
        wp_send_json_error(['message' => 'Barcha majburiy maydonlarni to\'ldiring.']);
        return;
    }
    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Elektron pochta manzili noto\'g\'ri.']);
        return;
    }

    $admin_email = get_option('admin_email');
    $mail_subject = 'Aloqa formasi: ' . ($subject ?: 'Xabar');
    $mail_body = "Yangi xabar keldi!\n\nIsm: $name\nEmail: $email\nMavzu: $subject\n\nXabar:\n$message";
    $headers = ['Reply-To: ' . $name . ' <' . $email . '>'];

    if (wp_mail($admin_email, $mail_subject, $mail_body, $headers)) {
        wp_send_json_success(['message' => 'Xabaringiz muvaffaqiyatli yuborildi! Tez orada javob beramiz.']);
    } else {
        wp_send_json_error(['message' => 'Xabar yuborilmadi. Iltimos, to\'g\'ridan-to\'g\'ri email orqali bog\'laning.']);
    }
}
add_action('wp_ajax_zi_send_contact', 'zi_send_contact');
add_action('wp_ajax_nopriv_zi_send_contact', 'zi_send_contact');

/* ==============================
   HELPER FUNCTIONS
============================== */
function zi_category_class($cat_name) {
    $slug = sanitize_title($cat_name);
    $map = [
        'fizika' => 'fizika',
        'kimyo' => 'kimyo',
        'biologiya' => 'biologiya',
        'matematika' => 'matematika',
        'kompyuter-fanlari' => 'kompyuter-fanlari',
        'kompyuter_fanlari' => 'kompyuter_fanlari',
        'tibbiyot' => 'tibbiyot',
        'iqtisodiyot' => 'iqtisodiyot',
    ];
    return $map[$slug] ?? 'default';
}

function zi_get_category_list() {
    return [
        'Iqtisodiyot', 'Fizika', 'Kimyo', 'Biologiya',
        'Matematika', 'Kompyuter fanlari', 'Tibbiyot', 'Boshqa'
    ];
}

function zi_time_ago($date_str) {
    $date = strtotime($date_str);
    $diff = time() - $date;
    if ($diff < 86400) return 'Bugun';
    if ($diff < 172800) return 'Kecha';
    $days = floor($diff / 86400);
    if ($days < 30) return $days . ' kun oldin';
    $months = floor($days / 30);
    if ($months < 12) return $months . ' oy oldin';
    return date_i18n('d M, Y', $date);
}

function zi_format_date($date_str) {
    return date_i18n('d M, Y', strtotime($date_str));
}

/* ==============================
   EXCERPT LENGTH
============================== */
add_filter('excerpt_length', fn() => 30);
add_filter('excerpt_more', fn() => '...');

/* ==============================
   WIDGETS
============================== */
function zi_widgets_init() {
    register_sidebar([
        'name'          => __('Sidebar', 'zamonaviy-iqtisodiyot'),
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'zi_widgets_init');

/* ==============================
   FLUSH REWRITE ON ACTIVATION
============================== */
function zi_activate() {
    zi_register_post_types();
    zi_register_taxonomies();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'zi_activate');

/* ==============================
   SEED DEFAULT CATEGORIES
============================== */
function zi_seed_categories() {
    if (get_option('zi_categories_seeded')) return;
    $cats = zi_get_category_list();
    foreach ($cats as $cat) {
        if (!term_exists($cat, 'toifa')) {
            wp_insert_term($cat, 'toifa');
        }
    }
    update_option('zi_categories_seeded', true);
}
add_action('after_switch_theme', 'zi_seed_categories');
