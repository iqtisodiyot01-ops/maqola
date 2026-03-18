<footer class="site-footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-brand">
                <span class="site-name-footer"><?php bloginfo('name'); ?></span>
                <p><?php bloginfo('description') ?: _e('O\'zbekistondagi iqtisodiy va ilmiy tadqiqotlar uchun ochiq platforma. Ilm-fan rivojiga hissa qo\'shing.', 'zamonaviy-iqtisodiyot'); ?></p>
            </div>
            <div class="footer-col">
                <h4><?php _e('Tezkor Havolalar', 'zamonaviy-iqtisodiyot'); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Bosh sahifa', 'zamonaviy-iqtisodiyot'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/maqola-yuborish/')); ?>"><?php _e('Maqola yuborish', 'zamonaviy-iqtisodiyot'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/biz-haqimizda/')); ?>"><?php _e('Biz haqimizda', 'zamonaviy-iqtisodiyot'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/aloqa/')); ?>"><?php _e('Aloqa', 'zamonaviy-iqtisodiyot'); ?></a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4><?php _e('Toifalar', 'zamonaviy-iqtisodiyot'); ?></h4>
                <ul>
                    <?php
                    $terms = get_terms(['taxonomy' => 'toifa', 'hide_empty' => false, 'number' => 5]);
                    if (!empty($terms) && !is_wp_error($terms)) :
                        foreach ($terms as $term) : ?>
                            <li><a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a></li>
                        <?php endforeach;
                    else :
                        foreach (['Iqtisodiyot', 'Fizika', 'Kimyo', 'Biologiya', 'Tibbiyot'] as $cat) : ?>
                            <li><a href="#"><?php echo esc_html($cat); ?></a></li>
                        <?php endforeach;
                    endif; ?>
                </ul>
            </div>
            <div class="footer-col">
                <h4><?php _e('Aloqa', 'zamonaviy-iqtisodiyot'); ?></h4>
                <ul>
                    <li><a href="mailto:info@zamonaviyiqtisodiyot.uz">📧 info@zamonaviyiqtisodiyot.uz</a></li>
                    <li><a href="tel:+998712345678">📞 +998 71 234 56 78</a></li>
                    <li><a href="<?php echo esc_url(home_url('/aloqa/')); ?>"><?php _e('Aloqa formasi', 'zamonaviy-iqtisodiyot'); ?></a></li>
                    <li><a href="<?php echo esc_url(get_feed_link()); ?>">RSS Feed</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="footer-copyright">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                <?php _e('Barcha huquqlar himoyalangan.', 'zamonaviy-iqtisodiyot'); ?>
            </p>
            <div class="footer-links">
                <a href="<?php echo esc_url(home_url('/maxfiylik-siyosati/')); ?>"><?php _e('Maxfiylik', 'zamonaviy-iqtisodiyot'); ?></a>
                <a href="<?php echo esc_url(home_url('/foydalanish-shartlari/')); ?>"><?php _e('Shartlar', 'zamonaviy-iqtisodiyot'); ?></a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
