<?php
/*
 * Template Name: Maqola Yuborish
 * Template Post Type: page
 */
get_header(); ?>

<main class="submit-page">
    <div class="container">
        <div class="page-header-box">
            <h1>✏️ <?php _e('Maqola Yuborish', 'zamonaviy-iqtisodiyot'); ?></h1>
            <p><?php _e('Ilmiy maqolangizni tahririyatga yuboring. Ko\'rib chiqilganidan so\'ng nashr etiladi.', 'zamonaviy-iqtisodiyot'); ?></p>
        </div>

        <div class="container-sm" style="padding:0;">
            <div id="submit-notice" style="display:none;"></div>

            <div class="submit-form-card">
                <h2 style="font-size:20px;font-weight:700;color:var(--color-text);margin-bottom:28px;padding-bottom:20px;border-bottom:1px solid var(--color-border);">
                    📝 <?php _e('Maqola Ma\'lumotlari', 'zamonaviy-iqtisodiyot'); ?>
                </h2>

                <form id="article-submit-form" novalidate>
                    <?php wp_nonce_field('zi_nonce', '_wpnonce'); ?>

                    <div class="form-group">
                        <label class="form-label" for="art_title">
                            <?php _e('Maqola sarlavhasi', 'zamonaviy-iqtisodiyot'); ?> <span class="required">*</span>
                        </label>
                        <input type="text" id="art_title" name="title" class="form-input"
                            placeholder="<?php esc_attr_e('Maqolaning to\'liq sarlavhasi...', 'zamonaviy-iqtisodiyot'); ?>"
                            required minlength="5" maxlength="300">
                        <p class="form-hint"><?php _e('Sarlavha kamida 5, ko\'pi bilan 300 ta belgidan iborat bo\'lsin.', 'zamonaviy-iqtisodiyot'); ?></p>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="art_authors">
                                <?php _e('Mualliflar', 'zamonaviy-iqtisodiyot'); ?> <span class="required">*</span>
                            </label>
                            <input type="text" id="art_authors" name="authors" class="form-input"
                                placeholder="<?php esc_attr_e('Ism Familiya, Ism Familiya', 'zamonaviy-iqtisodiyot'); ?>"
                                required>
                            <p class="form-hint"><?php _e('Vergul bilan ajrating', 'zamonaviy-iqtisodiyot'); ?></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="art_category">
                                <?php _e('Toifa', 'zamonaviy-iqtisodiyot'); ?> <span class="required">*</span>
                            </label>
                            <select id="art_category" name="category" class="form-select" required>
                                <option value=""><?php _e('Toifani tanlang...', 'zamonaviy-iqtisodiyot'); ?></option>
                                <?php foreach (zi_get_category_list() as $cat) : ?>
                                <option value="<?php echo esc_attr($cat); ?>"><?php echo esc_html($cat); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="art_abstract">
                            <?php _e('Annotatsiya (Abstract)', 'zamonaviy-iqtisodiyot'); ?> <span class="required">*</span>
                        </label>
                        <textarea id="art_abstract" name="abstract" class="form-textarea" rows="5"
                            placeholder="<?php esc_attr_e('Maqolaning qisqacha bayoni (50-2000 belgi)...', 'zamonaviy-iqtisodiyot'); ?>"
                            required minlength="50" maxlength="2000"></textarea>
                        <p class="form-hint"><span id="abstract-count">0</span>/2000 <?php _e('belgi', 'zamonaviy-iqtisodiyot'); ?></p>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="art_content">
                            <?php _e('Maqola matni', 'zamonaviy-iqtisodiyot'); ?> <span class="required">*</span>
                        </label>
                        <textarea id="art_content" name="content" class="form-textarea" rows="12"
                            placeholder="<?php esc_attr_e('Maqolaning to\'liq matni (kamida 100 belgi)...', 'zamonaviy-iqtisodiyot'); ?>"
                            required minlength="100"></textarea>
                        <p class="form-hint"><?php _e('Kirish, metodologiya, natijalar, xulosa bo\'limlarini kiriting.', 'zamonaviy-iqtisodiyot'); ?></p>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="art_keywords">
                                <?php _e('Kalit so\'zlar', 'zamonaviy-iqtisodiyot'); ?> <span class="required">*</span>
                            </label>
                            <input type="text" id="art_keywords" name="keywords" class="form-input"
                                placeholder="<?php esc_attr_e('kalit so\'z1, kalit so\'z2, kalit so\'z3', 'zamonaviy-iqtisodiyot'); ?>"
                                required>
                            <p class="form-hint"><?php _e('Vergul bilan ajrating (3-10 ta so\'z)', 'zamonaviy-iqtisodiyot'); ?></p>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="art_doi">DOI</label>
                            <input type="text" id="art_doi" name="doi" class="form-input"
                                placeholder="10.XXXX/xxxxx (ixtiyoriy)">
                            <p class="form-hint"><?php _e('Agar mavjud bo\'lsa kiriting', 'zamonaviy-iqtisodiyot'); ?></p>
                        </div>
                    </div>

                    <!-- Guidelines -->
                    <div class="notice notice-info" style="margin-bottom:28px;">
                        ℹ️ <?php _e('Maqolangiz tahririyat tomonidan ko\'rib chiqiladi. Bu jarayon 3-5 ish kunini olishi mumkin. Tasdiqlangandan so\'ng saytda nashr etiladi.', 'zamonaviy-iqtisodiyot'); ?>
                    </div>

                    <button type="submit" class="form-submit-btn" id="submit-btn">
                        <span>📤</span>
                        <span><?php _e('Maqolani Yuborish', 'zamonaviy-iqtisodiyot'); ?></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
(function() {
    // Character counter
    const abstractEl = document.getElementById('art_abstract');
    const countEl    = document.getElementById('abstract-count');
    if (abstractEl && countEl) {
        abstractEl.addEventListener('input', () => {
            countEl.textContent = abstractEl.value.length;
        });
    }

    // Form submission
    const form = document.getElementById('article-submit-form');
    const noticeEl = document.getElementById('submit-notice');
    const btn = document.getElementById('submit-btn');

    function showNotice(msg, type) {
        noticeEl.className = 'notice notice-' + type;
        noticeEl.innerHTML = (type === 'success' ? '✅ ' : '❌ ') + msg;
        noticeEl.style.display = 'flex';
        noticeEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            btn.disabled = true;
            btn.innerHTML = '<span>⏳</span><span><?php _e('Yuborilmoqda...', 'zamonaviy-iqtisodiyot'); ?></span>';

            const data = new FormData(form);
            data.append('action', 'zi_submit_article');
            data.append('nonce', zi_vars.nonce);

            fetch(zi_vars.ajax_url, { method: 'POST', body: data })
                .then(r => r.json())
                .then(res => {
                    if (res.success) {
                        showNotice(res.data.message, 'success');
                        form.reset();
                        if (countEl) countEl.textContent = '0';
                    } else {
                        showNotice(res.data.message || '<?php _e('Xatolik yuz berdi.', 'zamonaviy-iqtisodiyot'); ?>', 'error');
                    }
                })
                .catch(() => showNotice('<?php _e('Tarmoq xatosi. Qayta urinib ko\'ring.', 'zamonaviy-iqtisodiyot'); ?>', 'error'))
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<span>📤</span><span><?php _e('Maqolani Yuborish', 'zamonaviy-iqtisodiyot'); ?></span>';
                });
        });
    }
})();
</script>

<?php get_footer(); ?>
