<?php get_header(); ?>

<main style="padding:80px 0;">
    <div class="container">
        <div class="empty-state">
            <div class="empty-icon">🔍</div>
            <h1 style="font-size:80px;font-weight:900;color:var(--color-primary);line-height:1;margin-bottom:16px;">404</h1>
            <h3><?php _e('Sahifa topilmadi', 'zamonaviy-iqtisodiyot'); ?></h3>
            <p><?php _e('Kechirasiz, siz qidirayotgan sahifa mavjud emas yoki ko\'chirilgan.', 'zamonaviy-iqtisodiyot'); ?></p>
            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:8px;">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    🏠 <?php _e('Bosh sahifaga qaytish', 'zamonaviy-iqtisodiyot'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/maqolalar/')); ?>" class="btn btn-outline">
                    📚 <?php _e('Maqolalarni ko\'rish', 'zamonaviy-iqtisodiyot'); ?>
                </a>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
