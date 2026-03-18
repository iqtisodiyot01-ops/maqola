<?php
/*
 * Template Name: Saqlangan Maqolalar
 * Template Post Type: page
 */
get_header(); ?>

<main class="articles-section">
    <div class="container">
        <div class="page-header-box" style="text-align:left;margin-bottom:32px;">
            <h1 style="font-size:32px;font-weight:800;color:var(--color-primary);">
                🔖 <?php _e('Saqlangan Maqolalar', 'zamonaviy-iqtisodiyot'); ?>
            </h1>
            <p style="color:var(--color-text-muted);font-size:16px;margin-top:8px;">
                <?php _e('Siz saqlagan maqolalar ro\'yxati. Bu ma\'lumotlar faqat sizning qurilmangizda saqlanadi.', 'zamonaviy-iqtisodiyot'); ?>
            </p>
        </div>

        <div class="saved-notice">
            ℹ️ <?php _e('Saqlangan maqolalar brauzeringizda mahalliy ravishda saqlanadi. Boshqa qurilmada ko\'rinmaydi.', 'zamonaviy-iqtisodiyot'); ?>
        </div>

        <div id="saved-loading" style="text-align:center;padding:60px 0;">
            <div style="font-size:40px;margin-bottom:16px;">⏳</div>
            <p style="color:var(--color-text-muted);"><?php _e('Yuklanmoqda...', 'zamonaviy-iqtisodiyot'); ?></p>
        </div>

        <div id="saved-articles-container" style="display:none;">
            <div id="saved-empty" class="empty-state" style="display:none;">
                <div class="empty-icon">🔖</div>
                <h3><?php _e('Saqlangan maqolalar yo\'q', 'zamonaviy-iqtisodiyot'); ?></h3>
                <p><?php _e('Maqolalarni saqlash uchun 🔖 tugmasini bosing. Ular shu yerda ko\'rinadi.', 'zamonaviy-iqtisodiyot'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <?php _e('Maqolalarni ko\'rish', 'zamonaviy-iqtisodiyot'); ?>
                </a>
            </div>
            <div id="saved-list" class="articles-grid"></div>
        </div>
    </div>
</main>

<script>
(function() {
    const STORAGE_KEY = 'zi_saved_articles';
    const savedIds = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
    const loadingEl  = document.getElementById('saved-loading');
    const containerEl = document.getElementById('saved-articles-container');
    const emptyEl    = document.getElementById('saved-empty');
    const listEl     = document.getElementById('saved-list');

    function getCatClass(cat) {
        const map = {
            'Iqtisodiyot': 'iqtisodiyot', 'Fizika': 'fizika', 'Kimyo': 'kimyo',
            'Biologiya': 'biologiya', 'Matematika': 'matematika',
            'Kompyuter fanlari': 'kompyuter-fanlari', 'Tibbiyot': 'tibbiyot',
        };
        return map[cat] || 'default';
    }

    if (!savedIds.length) {
        loadingEl.style.display = 'none';
        containerEl.style.display = 'block';
        emptyEl.style.display = 'block';
        return;
    }

    // Fetch saved articles from WordPress REST API
    const ids = savedIds.join(',');
    fetch(zi_vars.home_url + 'wp-json/wp/v2/maqola?include=' + ids + '&per_page=100&_embed')
        .then(r => r.json())
        .then(posts => {
            loadingEl.style.display = 'none';
            containerEl.style.display = 'block';

            if (!posts || !posts.length) {
                emptyEl.style.display = 'block';
                return;
            }

            posts.forEach(post => {
                const date = new Date(post.date);
                const dateStr = date.toLocaleDateString('uz-UZ', {day:'2-digit', month:'short', year:'numeric'});
                const abstract = (post.meta && post.meta._maqola_abstract) ? post.meta._maqola_abstract : (post.excerpt ? post.excerpt.rendered.replace(/<[^>]*>/g,'') : '');
                const authors  = (post.meta && post.meta._maqola_authors) ? post.meta._maqola_authors : '';
                const keywords = (post.meta && post.meta._maqola_keywords) ? post.meta._maqola_keywords : '';

                let toifaName = 'Umumiy';
                if (post._embedded && post._embedded['wp:term']) {
                    const toifaTerms = post._embedded['wp:term'].flat().filter(t => t.taxonomy === 'toifa');
                    if (toifaTerms.length) toifaName = toifaTerms[0].name;
                }
                const catClass = getCatClass(toifaName);

                const kwTags = keywords ? keywords.split(',').slice(0,3).map(k =>
                    `<span class="keyword-tag">${k.trim()}</span>`
                ).join('') : '';

                const card = document.createElement('article');
                card.className = 'article-card';
                card.dataset.postId = post.id;
                card.innerHTML = `
                    <div class="card-meta">
                        <span class="category-badge ${catClass}">${toifaName}</span>
                        <span class="card-date">${dateStr}</span>
                    </div>
                    <h3 class="card-title"><a href="${post.link}">${post.title.rendered}</a></h3>
                    <p class="card-abstract">${abstract.substring(0, 200)}...</p>
                    ${kwTags ? `<div class="keywords-list" style="margin-bottom:12px;">${kwTags}</div>` : ''}
                    <div class="card-footer">
                        <span class="card-author">👤 ${authors || '<?php _e('Noma\'lum', 'zamonaviy-iqtisodiyot'); ?>'}</span>
                        <div class="card-stats">
                            <button class="save-btn saved js-save-btn" data-id="${post.id}" title="<?php esc_attr_e('Saqlangan', 'zamonaviy-iqtisodiyot'); ?>">
                                <span class="save-icon">🔖</span>
                                <span class="save-text"><?php _e('Saqlangan', 'zamonaviy-iqtisodiyot'); ?></span>
                            </button>
                        </div>
                    </div>`;
                listEl.appendChild(card);
            });
        })
        .catch(() => {
            loadingEl.style.display = 'none';
            containerEl.style.display = 'block';
            emptyEl.style.display = 'block';
        });
})();
</script>

<?php get_footer(); ?>
