<?php
/*
 * Template Name: Aloqa
 * Template Post Type: page
 */
get_header(); ?>

<main class="contact-page">
    <div class="container">
        <div class="page-header-box">
            <h1>📞 <?php _e('Biz bilan Bog\'laning', 'zamonaviy-iqtisodiyot'); ?></h1>
            <p><?php _e('Savollaringiz bo\'lsa, bizga murojaat qiling. 24 soat ichida javob beramiz.', 'zamonaviy-iqtisodiyot'); ?></p>
        </div>

        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info">
                <h2><?php _e('Aloqa Ma\'lumotlari', 'zamonaviy-iqtisodiyot'); ?></h2>
                <p><?php _e('Tahririyat, hamkorlik yoki texnik masalalar bo\'yicha murojaat qilishingiz mumkin.', 'zamonaviy-iqtisodiyot'); ?></p>

                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div class="contact-item-text">
                            <h4><?php _e('Elektron pochta', 'zamonaviy-iqtisodiyot'); ?></h4>
                            <p><a href="mailto:info@zamonaviyiqtisodiyot.uz">info@zamonaviyiqtisodiyot.uz</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-item-text">
                            <h4><?php _e('Telefon', 'zamonaviy-iqtisodiyot'); ?></h4>
                            <p><a href="tel:+998712345678">+998 71 234 56 78</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-item-text">
                            <h4><?php _e('Manzil', 'zamonaviy-iqtisodiyot'); ?></h4>
                            <p><?php _e('Toshkent shahri, Mirzo Ulug\'bek tumani', 'zamonaviy-iqtisodiyot'); ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">⏰</div>
                        <div class="contact-item-text">
                            <h4><?php _e('Ish vaqti', 'zamonaviy-iqtisodiyot'); ?></h4>
                            <p><?php _e('Du–Ju: 09:00 – 18:00', 'zamonaviy-iqtisodiyot'); ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">💬</div>
                        <div class="contact-item-text">
                            <h4>Telegram</h4>
                            <p><a href="https://t.me/zamonaviy_iqtisodiyot" target="_blank" rel="noopener">@zamonaviy_iqtisodiyot</a></p>
                        </div>
                    </div>
                </div>

                <!-- Quick Info Cards -->
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:32px;">
                    <div style="background:var(--color-bg);border:1px solid var(--color-border);border-radius:var(--radius);padding:18px;text-align:center;">
                        <div style="font-size:28px;margin-bottom:6px;">✏️</div>
                        <div style="font-size:13px;font-weight:700;color:var(--color-text);margin-bottom:4px;"><?php _e('Maqola yuborish', 'zamonaviy-iqtisodiyot'); ?></div>
                        <div style="font-size:12px;color:var(--color-text-muted);"><?php _e('3-5 kun ko\'rib chiqiladi', 'zamonaviy-iqtisodiyot'); ?></div>
                    </div>
                    <div style="background:var(--color-bg);border:1px solid var(--color-border);border-radius:var(--radius);padding:18px;text-align:center;">
                        <div style="font-size:28px;margin-bottom:6px;">🤝</div>
                        <div style="font-size:13px;font-weight:700;color:var(--color-text);margin-bottom:4px;"><?php _e('Hamkorlik', 'zamonaviy-iqtisodiyot'); ?></div>
                        <div style="font-size:12px;color:var(--color-text-muted);"><?php _e('24 soat ichida javob', 'zamonaviy-iqtisodiyot'); ?></div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-card">
                <h3 style="font-size:20px;font-weight:700;color:var(--color-text);margin-bottom:24px;">
                    ✉️ <?php _e('Xabar Yuborish', 'zamonaviy-iqtisodiyot'); ?>
                </h3>

                <div id="contact-notice" style="display:none;"></div>

                <form id="contact-form" novalidate>
                    <?php wp_nonce_field('zi_nonce', '_wpnonce'); ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="con_name">
                                <?php _e('Ismingiz', 'zamonaviy-iqtisodiyot'); ?> <span class="required">*</span>
                            </label>
                            <input type="text" id="con_name" name="name" class="form-input"
                                placeholder="<?php esc_attr_e('Ism Familiya', 'zamonaviy-iqtisodiyot'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="con_email">
                                <?php _e('Elektron pochta', 'zamonaviy-iqtisodiyot'); ?> <span class="required">*</span>
                            </label>
                            <input type="email" id="con_email" name="email" class="form-input"
                                placeholder="email@example.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="con_subject"><?php _e('Mavzu', 'zamonaviy-iqtisodiyot'); ?></label>
                        <select id="con_subject" name="subject" class="form-select">
                            <option value=""><?php _e('Mavzuni tanlang', 'zamonaviy-iqtisodiyot'); ?></option>
                            <option value="Maqola yuborish haqida"><?php _e('Maqola yuborish haqida', 'zamonaviy-iqtisodiyot'); ?></option>
                            <option value="Hamkorlik taklifi"><?php _e('Hamkorlik taklifi', 'zamonaviy-iqtisodiyot'); ?></option>
                            <option value="Texnik muammo"><?php _e('Texnik muammo', 'zamonaviy-iqtisodiyot'); ?></option>
                            <option value="Tahririyat bilan bog'lanish"><?php _e('Tahririyat bilan bog\'lanish', 'zamonaviy-iqtisodiyot'); ?></option>
                            <option value="Boshqa"><?php _e('Boshqa', 'zamonaviy-iqtisodiyot'); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="con_message">
                            <?php _e('Xabar', 'zamonaviy-iqtisodiyot'); ?> <span class="required">*</span>
                        </label>
                        <textarea id="con_message" name="message" class="form-textarea" rows="6"
                            placeholder="<?php esc_attr_e('Xabaringizni yozing...', 'zamonaviy-iqtisodiyot'); ?>"
                            required minlength="10"></textarea>
                    </div>

                    <button type="submit" class="form-submit-btn" id="contact-btn">
                        <span>📤</span>
                        <span><?php _e('Xabar Yuborish', 'zamonaviy-iqtisodiyot'); ?></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
(function() {
    const form = document.getElementById('contact-form');
    const noticeEl = document.getElementById('contact-notice');
    const btn = document.getElementById('contact-btn');

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
            data.append('action', 'zi_send_contact');
            data.append('nonce', zi_vars.nonce);

            fetch(zi_vars.ajax_url, { method: 'POST', body: data })
                .then(r => r.json())
                .then(res => {
                    if (res.success) {
                        showNotice(res.data.message, 'success');
                        form.reset();
                    } else {
                        showNotice(res.data.message || '<?php _e('Xatolik yuz berdi.', 'zamonaviy-iqtisodiyot'); ?>', 'error');
                    }
                })
                .catch(() => showNotice('<?php _e('Tarmoq xatosi. Qayta urinib ko\'ring.', 'zamonaviy-iqtisodiyot'); ?>', 'error'))
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<span>📤</span><span><?php _e('Xabar Yuborish', 'zamonaviy-iqtisodiyot'); ?></span>';
                });
        });
    }
})();
</script>

<?php get_footer(); ?>
