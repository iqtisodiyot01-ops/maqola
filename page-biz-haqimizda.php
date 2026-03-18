<?php
/*
 * Template Name: Biz Haqimizda
 * Template Post Type: page
 */
get_header(); ?>

<!-- About Hero -->
<section class="about-hero">
    <div class="container">
        <div class="hero-badge" style="justify-content:center;">🎓 <?php _e('O\'zbekistonning ilmiy portali', 'zamonaviy-iqtisodiyot'); ?></div>
        <h1><?php _e('Biz Haqimizda', 'zamonaviy-iqtisodiyot'); ?></h1>
        <p><?php _e('Zamonaviy Iqtisodiyot — O\'zbekistondagi ilmiy-tadqiqot ishlarini ommaga yetkazuvchi ochiq platforma.', 'zamonaviy-iqtisodiyot'); ?></p>
    </div>
</section>

<!-- Mission & Stats -->
<section class="about-content">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <h2>🎯 <?php _e('Bizning Maqsad', 'zamonaviy-iqtisodiyot'); ?></h2>
                <p><?php _e('Zamonaviy Iqtisodiyot — O\'zbekistondagi iqtisodiy, ijtimoiy va ilmiy tadqiqotlarni keng jamoatchilikka yetkazish uchun yaratilgan ochiq kirish platformasi.', 'zamonaviy-iqtisodiyot'); ?></p>
                <p><?php _e('Biz olimlar, tadqiqotchilar va talabalar uchun sifatli ilmiy nashr qilish imkoniyatini yaratamiz. Har bir maqola mutaxassislar tomonidan ko\'rib chiqiladi va sifat standartlariga javob berishi ta\'minlanadi.', 'zamonaviy-iqtisodiyot'); ?></p>
                <p><?php _e('2020-yilda tashkil etilganidan beri biz 1,200 dan ortiq maqola nashr qildik va O\'zbekistondagi 50+ universitetdan tadqiqotchilar bilan hamkorlik qilmoqdamiz.', 'zamonaviy-iqtisodiyot'); ?></p>

                <h2 style="margin-top:32px;">🏆 <?php _e('Bizning Qadriyatlar', 'zamonaviy-iqtisodiyot'); ?></h2>
                <ul style="display:flex;flex-direction:column;gap:12px;margin-top:12px;">
                    <?php
                    $values = [
                        ['🔬', 'Ilmiy aniqlik', 'Barcha maqolalar peer-review jarayonidan o\'tadi'],
                        ['🌐', 'Ochiq kirish', 'Barcha ilmiy materiallar bepul va ochiq'],
                        ['🇺🇿', 'Milliy ilm', 'O\'zbek tilida ilmiy nashriyotni rivojlantirish'],
                        ['⚡', 'Tezkorlik', 'Maqolangiz 3-5 kun ichida ko\'rib chiqiladi'],
                    ];
                    foreach ($values as $v) : ?>
                    <li style="display:flex;align-items:flex-start;gap:14px;padding:14px;background:var(--color-bg);border-radius:var(--radius);border:1px solid var(--color-border);">
                        <span style="font-size:24px;"><?php echo $v[0]; ?></span>
                        <div>
                            <strong style="display:block;font-size:15px;color:var(--color-text);margin-bottom:3px;"><?php echo esc_html($v[1]); ?></strong>
                            <span style="font-size:13px;color:var(--color-text-muted);"><?php echo esc_html($v[2]); ?></span>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Stats -->
            <div>
                <div class="stats-grid">
                    <?php
                    $maqolalar_count = wp_count_posts('maqola')->publish;
                    $stats = [
                        ['1,200+', 'Nashr qilingan maqolalar'],
                        ['50+', 'Hamkor universitetlar'],
                        ['8,000+', 'Oylik o\'quvchilar'],
                        ['7', 'Ilmiy yo\'nalishlar'],
                    ];
                    foreach ($stats as $s) : ?>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo esc_html($s[0]); ?></div>
                        <div class="stat-label"><?php echo esc_html($s[1]); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Process -->
                <div style="margin-top:32px;background:var(--color-bg-white);border:1px solid var(--color-border);border-radius:var(--radius-lg);padding:28px;">
                    <h3 style="font-size:18px;font-weight:700;color:var(--color-primary);margin-bottom:20px;">📋 <?php _e('Nashr jarayoni', 'zamonaviy-iqtisodiyot'); ?></h3>
                    <?php
                    $steps = [
                        ['1', 'Maqola yuborish', 'Shaklni to\'ldiring va maqolangizni yuboring'],
                        ['2', 'Ko\'rib chiqish', 'Tahririyat 3-5 kun ichida ko\'rib chiqadi'],
                        ['3', 'Tuzatish', 'Kerak bo\'lsa tuzatishlar so\'raladi'],
                        ['4', 'Nashr qilish', 'Tasdiqlangan maqola saytda e\'lon qilinadi'],
                    ];
                    foreach ($steps as $step) : ?>
                    <div style="display:flex;align-items:flex-start;gap:14px;<?php echo $step[0] < 4 ? 'margin-bottom:16px;' : ''; ?>">
                        <div style="width:32px;height:32px;background:var(--color-primary);color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;flex-shrink:0;">
                            <?php echo $step[0]; ?>
                        </div>
                        <div>
                            <strong style="display:block;font-size:14px;color:var(--color-text);"><?php echo esc_html($step[1]); ?></strong>
                            <span style="font-size:13px;color:var(--color-text-muted);"><?php echo esc_html($step[2]); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <div style="text-align:center;margin-bottom:40px;">
            <h2 style="font-size:32px;font-weight:800;color:var(--color-primary);margin-bottom:12px;">
                👥 <?php _e('Tahririyat Jamoasi', 'zamonaviy-iqtisodiyot'); ?>
            </h2>
            <p style="font-size:17px;color:var(--color-text-muted);max-width:500px;margin:0 auto;">
                <?php _e('Tajribali mutaxassislardan iborat jamoamiz sifatni kafolatlaydi.', 'zamonaviy-iqtisodiyot'); ?>
            </p>
        </div>
        <div class="team-grid">
            <?php
            $team = [
                ['P', 'Prof. Alisher Toshmatov', 'Bosh muharrir — Iqtisodiyot fanlari doktori'],
                ['N', 'Dr. Nodira Yusupova', 'Ilmiy muharrir — Moliya va bank ishi'],
                ['S', 'Dr. Sherzod Nazarov', 'Texnik muharrir — IT va innovatsiyalar'],
                ['M', 'Dr. Malika Rahimova', 'Muharrir — Agrar iqtisodiyot'],
                ['J', 'Dr. Jasur Mirzayev', 'Muharrir — Tibbiyot va biologiya'],
                ['F', 'Feruza Xolmatova', 'Jamoat bilan munosabatlar'],
            ];
            foreach ($team as $member) : ?>
            <div class="team-card">
                <div class="team-avatar"><?php echo $member[0]; ?></div>
                <div class="team-name"><?php echo esc_html($member[1]); ?></div>
                <div class="team-role"><?php echo esc_html($member[2]); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Partners -->
<section style="padding:60px 0;border-top:1px solid var(--color-border);">
    <div class="container" style="text-align:center;">
        <h2 style="font-size:26px;font-weight:700;color:var(--color-text);margin-bottom:12px;">
            🤝 <?php _e('Hamkor Universitetlar', 'zamonaviy-iqtisodiyot'); ?>
        </h2>
        <p style="color:var(--color-text-muted);margin-bottom:36px;">
            <?php _e('50+ ta O\'zbekiston universiteti bilan hamkorlik qilamiz.', 'zamonaviy-iqtisodiyot'); ?>
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:16px;justify-content:center;">
            <?php
            $unis = ['ToshDTU', 'TATU', 'BuxDU', 'SamDU', 'NamMQI', 'TDIU', 'O\'zMU', 'JDPU'];
            foreach ($unis as $uni) : ?>
            <span style="background:var(--color-bg);border:1px solid var(--color-border);border-radius:var(--radius);padding:10px 20px;font-size:14px;font-weight:600;color:var(--color-text-muted);">
                <?php echo esc_html($uni); ?>
            </span>
            <?php endforeach; ?>
        </div>

        <div style="margin-top:48px;">
            <a href="<?php echo esc_url(home_url('/maqola-yuborish/')); ?>" class="btn btn-primary" style="font-size:16px;padding:14px 32px;">
                📤 <?php _e('Maqola Yuborish', 'zamonaviy-iqtisodiyot'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/aloqa/')); ?>" class="btn btn-outline" style="font-size:16px;padding:14px 32px;margin-left:12px;">
                📞 <?php _e('Bog\'lanish', 'zamonaviy-iqtisodiyot'); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
