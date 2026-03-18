=== Zamonaviy Iqtisodiyot ===
Contributors: zamonaviyiqtisodiyot
Version: 1.0.0
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 8.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

O'zbekiston ilmiy maqolalar portali uchun WordPress theme.

== O'rnatish ==

1. wordpress-theme/zamonaviy-iqtisodiyot papkasini ZIP qiling
2. WordPress admin paneliga kiring
3. Ko'rinish (Appearance) → Temalar (Themes) → Yangi qo'shish (Add New)
4. ZIP faylni yuklang va faollashtiring
5. Quyidagi sahifalarni yarating (Pages):

   MUHIM: Har bir sahifa uchun to'g'ri Template ni tanlang!

   a) "Maqola yuborish" sahifasi:
      - Sarlavha: Maqola yuborish
      - Slug: maqola-yuborish
      - Template: Maqola Yuborish

   b) "Biz haqimizda" sahifasi:
      - Sarlavha: Biz haqimizda
      - Slug: biz-haqimizda
      - Template: Biz Haqimizda

   c) "Aloqa" sahifasi:
      - Sarlavha: Aloqa
      - Slug: aloqa
      - Template: Aloqa

   d) "Saqlangan" sahifasi:
      - Sarlavha: Saqlangan
      - Slug: saqlangan
      - Template: Saqlangan Maqolalar

6. Sozlamalar → Doimiy havolalar (Permalinks) → Post name ni tanlang → Saqlang
7. Ko'rinish → Menyu → Menyu yarating va sahifalarni qo'shing

== Maqola Qo'shish ==

WordPress admin → Maqolalar (Custom Post Type) → Yangi maqola
Meta ma'lumotlar (mualliflar, annotatsiya, kalit so'zlar, DOI) maqola muharriridagi
maxsus maydonlarda kiritiladi.

== REST API ==

Saqlangan sahifa WordPress REST API dan foydalanadi.
REST API yoqilgan bo'lishi kerak (sukut bo'yicha yoqilgan).

== Qo'llab-quvvatlash ==

Email: info@zamonaviyiqtisodiyot.uz
Telegram: @zamonaviy_iqtisodiyot

== Changelog ==

= 1.0.0 =
* Birinchi versiya chiqarildi
* Maqola yuborish formasi
* Saqlangan maqolalar (localStorage asosida)
* Biz haqimizda va Aloqa sahifalari
* Toifalar bo'yicha filtrlash
* Qidiruv
* Mobil moslashuvchan dizayn
