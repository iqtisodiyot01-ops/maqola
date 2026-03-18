'use strict';

(function () {
    /* =========================================================
       SAVED ARTICLES — localStorage based
    ========================================================= */
    const STORAGE_KEY = 'zi_saved_articles';

    function getSaved() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]'); }
        catch (e) { return []; }
    }

    function setSaved(ids) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(ids));
    }

    function isSaved(id) {
        return getSaved().includes(String(id));
    }

    function toggleSave(id) {
        const ids = getSaved();
        const sid = String(id);
        const idx = ids.indexOf(sid);
        if (idx > -1) {
            ids.splice(idx, 1);
        } else {
            ids.push(sid);
        }
        setSaved(ids);
        return idx === -1; // true = now saved
    }

    function updateSaveBtn(btn, saved) {
        const iconEl = btn.querySelector('.save-icon');
        const textEl = btn.querySelector('.save-text');
        if (saved) {
            btn.classList.add('saved');
            if (iconEl) iconEl.textContent = '🔖';
            if (textEl) textEl.textContent = 'Saqlangan';
            btn.title = 'Saqlangandan olib tashlash';
        } else {
            btn.classList.remove('saved');
            if (iconEl) iconEl.textContent = '🔖';
            if (textEl) textEl.textContent = 'Saqlash';
            btn.title = 'Saqlash';
        }
    }

    function initSaveBtns() {
        document.querySelectorAll('.js-save-btn').forEach(function (btn) {
            const id = btn.dataset.id;
            if (!id) return;
            // Set initial state
            updateSaveBtn(btn, isSaved(id));
            // Click handler
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const nowSaved = toggleSave(id);
                updateSaveBtn(btn, nowSaved);
                // Show toast
                showToast(nowSaved ? '✅ Maqola saqlandi!' : '🗑️ Saqlangandan olib tashlandi');
                // Update saved count in nav
                updateSavedCount();
            });
        });
    }

    function updateSavedCount() {
        const count = getSaved().length;
        const link = document.getElementById('saved-nav-link');
        if (!link) return;
        // Remove old badge
        const old = link.querySelector('.saved-count-badge');
        if (old) old.remove();
        if (count > 0) {
            const badge = document.createElement('span');
            badge.className = 'saved-count-badge';
            badge.style.cssText = 'background:#ef4444;color:white;border-radius:100px;font-size:11px;font-weight:700;padding:1px 6px;margin-left:4px;';
            badge.textContent = count;
            link.appendChild(badge);
        }
    }

    /* =========================================================
       TOAST NOTIFICATION
    ========================================================= */
    function showToast(msg) {
        const existing = document.getElementById('zi-toast');
        if (existing) existing.remove();

        const toast = document.createElement('div');
        toast.id = 'zi-toast';
        toast.style.cssText = [
            'position:fixed', 'bottom:24px', 'right:24px', 'z-index:9999',
            'background:#1e3a8a', 'color:white', 'padding:12px 20px',
            'border-radius:8px', 'font-size:14px', 'font-weight:500',
            'box-shadow:0 8px 24px rgba(0,0,0,0.15)', 'display:flex',
            'align-items:center', 'gap:8px',
            'animation:zi-fadein 0.3s ease',
        ].join(';');
        toast.textContent = msg;
        document.body.appendChild(toast);

        setTimeout(function () {
            toast.style.animation = 'zi-fadeout 0.3s ease forwards';
            setTimeout(function () { toast.remove(); }, 300);
        }, 2500);
    }

    // Toast animations
    var style = document.createElement('style');
    style.textContent = '@keyframes zi-fadein{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}} @keyframes zi-fadeout{from{opacity:1;transform:translateY(0)}to{opacity:0;transform:translateY(12px)}}';
    document.head.appendChild(style);

    /* =========================================================
       MOBILE MENU TOGGLE
    ========================================================= */
    function initMobileMenu() {
        var toggle = document.getElementById('menu-toggle');
        var nav = document.getElementById('main-nav');
        if (!toggle || !nav) return;
        toggle.addEventListener('click', function () {
            var isOpen = nav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* =========================================================
       SEARCH OVERLAY TOGGLE
    ========================================================= */
    function initSearchToggle() {
        var toggleBtn = document.getElementById('search-toggle');
        var overlay = document.getElementById('search-overlay');
        if (!toggleBtn || !overlay) return;
        toggleBtn.addEventListener('click', function () {
            var visible = overlay.style.display !== 'none';
            overlay.style.display = visible ? 'none' : 'block';
            if (!visible) {
                var input = overlay.querySelector('input[type="search"]');
                if (input) setTimeout(function () { input.focus(); }, 50);
            }
        });
        // Close on Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') overlay.style.display = 'none';
        });
    }

    /* =========================================================
       SMOOTH SCROLL TO TOP (if there's a back-to-top btn)
    ========================================================= */
    function initScrollTop() {
        var btn = document.createElement('button');
        btn.id = 'back-to-top';
        btn.innerHTML = '↑';
        btn.style.cssText = [
            'position:fixed', 'bottom:80px', 'right:24px', 'z-index:999',
            'width:44px', 'height:44px', 'border-radius:50%',
            'background:var(--color-primary)', 'color:white',
            'border:none', 'cursor:pointer', 'font-size:18px',
            'box-shadow:0 4px 12px rgba(30,58,138,0.3)',
            'display:none', 'align-items:center', 'justify-content:center',
            'transition:all 0.2s ease',
        ].join(';');
        document.body.appendChild(btn);

        window.addEventListener('scroll', function () {
            btn.style.display = window.scrollY > 400 ? 'flex' : 'none';
        });
        btn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* =========================================================
       INIT
    ========================================================= */
    document.addEventListener('DOMContentLoaded', function () {
        initSaveBtns();
        updateSavedCount();
        initMobileMenu();
        initSearchToggle();
        initScrollTop();
    });

})();
