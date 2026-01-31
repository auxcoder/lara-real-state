# Libraries Documentation

This document catalogs all JavaScript/CSS libraries in `public/assets/libs/`.

**Status Legend:**

- ✅ **In Use** - Currently loaded in views
- ❌ **Unused** - Not referenced anywhere (candidate for removal)
- 🔄 **Replaced** - Functionality replaced by Vite packages

---

## Currently Used Libraries

### 1. Simplebar (60KB)

**Status:** ✅ In Use  
**Purpose:** Custom scrollbar styling
**Used In:** `resources/views/auth/register.blade.php`  
**Files:**

- `simplebar/simplebar.min.js` (58KB)

**Description:** Lightweight custom scrollbar plugin that replaces native scrollbars with styled versions.

**Usage:**

```html
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
```

---

### 2. Node Waves (8KB)

**Status:** ✅ In Use  
**Purpose:** Material Design ripple effect  
**Used In:** `resources/views/auth/register.blade.php`  
**Files:**

- `node-waves/waves.min.js` (6.2KB)

**Description:** Creates Material Design-style ripple effects on button clicks.

**Usage:**

```html
<script src="/assets/libs/node-waves/waves.min.js"></script>
```

---

### 3. Feather Icons (76KB)

**Status:** ❌ Unused  
**Purpose:** Icon library  
**Used In:** `resources/views/auth/register.blade.php`  
**Files:**

- `feather-icons/feather.min.js` (74KB)

**Description:** Open-source icon set with 280+ icons. Used for UI icons in admin theme.

**Usage:**

```html
<script src="/assets/libs/feather-icons/feather.min.js"></script>
<script>
    feather.replace();
</script>
```

**Note:** Consider replacing with Bootstrap Icons (already loaded via Vite) to reduce dependencies.

---

## Unused Libraries (Candidates for Removal)

### 4. ApexCharts (520KB)

**Status:** ❌ Unused  
**Purpose:** Interactive charts library  
**Replaced By:** Chart.js (loaded via CDN on dashboard)  
**Files:**

- `apexcharts/apexcharts.min.js` (517KB)

**Description:** Modern charting library for creating interactive visualizations. Dashboard uses Chart.js instead.

**Original Usage:** Admin dashboard charts (now using Chart.js)

---

### 5. Bootstrap (80KB)

**Status:** 🔄 Replaced  
**Purpose:** CSS framework  
**Replaced By:** Bootstrap 5.3.8 via Vite  
**Files:**

- `bootstrap/js/bootstrap.bundle.min.js`

**Description:** Static Bootstrap JS bundle. Now loaded via Vite in `resources/js/admin.js` and `resources/js/app.js`.

**Why Unused:** Vite compiles Bootstrap from npm package, no need for static files.

---

### 6. DataTables (Core) (88KB)

**Status:** ❌ Unused  
**Purpose:** Advanced table features (sorting, filtering, pagination)  
**Files:**

- `datatables.net/js/jquery.dataTables.min.js`

**Description:** jQuery plugin for enhanced HTML tables. Not used in current application.

---

### 7. DataTables Bootstrap 5 Theme (16KB)

**Status:** ❌ Unused  
**Purpose:** Bootstrap 5 styling for DataTables  
**Files:**

- `datatables.net-bs5/css/dataTables.bootstrap5.min.css`
- `datatables.net-bs5/js/dataTables.bootstrap5.min.js`

**Description:** Bootstrap 5 integration for DataTables. Requires DataTables core.

---

### 8. DataTables Buttons (92KB)

**Status:** ❌ Unused  
**Purpose:** Export buttons for DataTables (Excel, PDF, Print)  
**Files:**

- `datatables.net-buttons/js/` (multiple files)

**Description:** Adds export functionality to DataTables. Not used.

---

### 9. DataTables Buttons Bootstrap 5 (16KB)

**Status:** ❌ Unused  
**Purpose:** Bootstrap 5 styling for DataTables buttons  
**Files:**

- `datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css`
- `datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js`

**Description:** Bootstrap 5 theme for DataTables buttons extension.

---

### 10. DataTables KeyTable (16KB)

**Status:** ❌ Unused  
**Purpose:** Keyboard navigation for DataTables  
**Files:**

- `datatables.net-keytable/js/dataTables.keyTable.min.js`

**Description:** Adds Excel-like keyboard navigation to DataTables.

---

### 11. DataTables KeyTable Bootstrap 5 (8KB)

**Status:** ❌ Unused  
**Purpose:** Bootstrap 5 styling for KeyTable  
**Files:**

- `datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css`
- `datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js`

**Description:** Bootstrap 5 theme for KeyTable extension.

---

### 12. DataTables Responsive (20KB)

**Status:** ❌ Unused  
**Purpose:** Responsive tables for mobile devices  
**Files:**

- `datatables.net-responsive/js/dataTables.responsive.min.js`

**Description:** Makes DataTables responsive on small screens.

---

### 13. DataTables Responsive Bootstrap 5 (12KB)

**Status:** ❌ Unused  
**Purpose:** Bootstrap 5 styling for responsive DataTables  
**Files:**

- `datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css`
- `datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js`

**Description:** Bootstrap 5 theme for responsive extension.

---

### 14. DataTables Select (16KB)

**Status:** ❌ Unused  
**Purpose:** Row/cell selection for DataTables  
**Files:**

- `datatables.net-select/js/dataTables.select.min.js`

**Description:** Adds row and cell selection capabilities to DataTables.

---

### 15. DataTables Select Bootstrap 5 (12KB)

**Status:** ❌ Unused  
**Purpose:** Bootstrap 5 styling for DataTables select  
**Files:**

- `datatables.net-select-bs5/css/select.bootstrap5.min.css`
- `datatables.net-select-bs5/js/select.bootstrap5.min.js`

**Description:** Bootstrap 5 theme for select extension.

---

### 16. Flatpickr (68KB)

**Status:** ❌ Unused  
**Purpose:** Date/time picker  
**Files:**

- `flatpickr/flatpickr.min.css` (16KB)
- `flatpickr/flatpickr.min.js` (49KB)

**Description:** Lightweight date picker with no dependencies. Not used in current forms.

**Alternative:** HTML5 `<input type="date">` or Bootstrap Datepicker

---

### 17. GLightbox (72KB)

**Status:** ❌ Unused  
**Purpose:** Lightbox for images/videos  
**Files:**

- `glightbox/css/glightbox.min.css`
- `glightbox/js/glightbox.min.js`

**Description:** Pure JavaScript lightbox. Property images don't use lightbox functionality.

---

### 18. Gumshoe.js (4KB)

**Status:** ❌ Unused  
**Purpose:** Scrollspy navigation  
**Files:**

- `gumshoejs/gumshoe.min.js` (3KB)

**Description:** Highlights navigation items based on scroll position. Not used in current navigation.

**Alternative:** Bootstrap's built-in scrollspy

---

### 19. jQuery (88KB)

**Status:** 🔄 Replaced  
**Purpose:** JavaScript utility library  
**Replaced By:** Vanilla JS + Alpine.js  
**Files:**

- `jquery/jquery.min.js` (85KB)

**Description:** Static jQuery file. Application now uses jQuery only via CDN for Select2 on visitor form.

**Why Unused:** 98.8% jQuery eliminated, remaining usage loads from CDN.

---

### 20. jQuery Countdown (8KB)

**Status:** ❌ Unused  
**Purpose:** Countdown timer plugin  
**Files:**

- `jquery-countdown/jquery.countdown.min.js` (5.2KB)

**Description:** jQuery plugin for countdown timers. Not used in application.

---

### 21. jQuery CounterUp (4KB)

**Status:** ❌ Unused  
**Purpose:** Animated number counters  
**Files:**

- `jquery.counterup/jquery.counterup.min.js` (2.1KB)

**Description:** Animates numbers counting up. Not used in current UI.

---

### 22. Moment.js (52KB)

**Status:** ❌ Unused  
**Purpose:** Date/time manipulation  
**Files:**

- `moment/min/moment.min.js`

**Description:** Date parsing and formatting library. Not used in application.

**Alternative:** Native JavaScript `Date` API or `date-fns` (lighter)

---

### 23. Quill (568KB)

**Status:** ❌ Unused  
**Purpose:** Rich text editor  
**Files:**

- `quill/quill.min.js` (211KB)
- `quill/quill.core.js` (300KB)
- `quill/quill.snow.css` (24KB)
- `quill/quill.bubble.css` (25KB)

**Description:** Modern WYSIWYG editor. Not used in any forms (blog posts use simple textarea).

**Note:** If rich text editing needed, consider TinyMCE or CKEditor alternatives.

---

### 24. Swiper (164KB)

**Status:** ❌ Unused  
**Purpose:** Touch slider/carousel  
**Files:**

- `swiper/swiper-bundle.min.js` (140KB)
- `swiper/swiper-bundle.min.css` (16KB)

**Description:** Modern mobile touch slider. Not used (OwlCarousel was removed earlier).

**Alternative:** Bootstrap Carousel (already available)

---

### 25. Waypoints (12KB)

**Status:** ❌ Unused  
**Purpose:** Trigger functions on scroll  
**Files:**

- `waypoints/lib/jquery.waypoints.min.js`

**Description:** Execute functions when scrolling to elements. Not used in application.

**Alternative:** Intersection Observer API (native)

---

## Summary

### Usage Statistics

- **Total Libraries:** 25
- **In Use:** 3 (12%)
- **Unused:** 19 (76%)
- **Replaced by Vite:** 3 (12%)

### Size Analysis

- **Total Size:** ~2.2MB
- **Used:** 144KB (6.5%)
- **Unused:** ~2.06MB (93.5%)

### Libraries by Category

**UI Components:**

- Simplebar ✅
- Node Waves ✅
- Feather Icons ✅
- GLightbox ❌
- Swiper ❌

**Data Tables (All Unused):**

- DataTables Core ❌
- DataTables BS5 ❌
- DataTables Buttons ❌
- DataTables Buttons BS5 ❌
- DataTables KeyTable ❌
- DataTables KeyTable BS5 ❌
- DataTables Responsive ❌
- DataTables Responsive BS5 ❌
- DataTables Select ❌
- DataTables Select BS5 ❌

**Charts:**

- ApexCharts ❌ (replaced by Chart.js)

**Forms:**

- Flatpickr ❌
- Quill ❌

**Utilities:**

- jQuery 🔄 (replaced by vanilla JS/Alpine.js)
- Moment.js ❌
- Waypoints ❌
- Gumshoe.js ❌
- jQuery Countdown ❌
- jQuery CounterUp ❌

**Frameworks:**

- Bootstrap 🔄 (replaced by Vite)

---

## Recommendations

### Keep (144KB)

1. **Simplebar** - Used in register page
2. **Node Waves** - Used in register page
3. **Feather Icons** - Used in register page

**Note:** Consider replacing Feather Icons with Bootstrap Icons to eliminate this dependency.

### Remove (2.06MB)

All DataTables libraries, ApexCharts, Quill, Swiper, Flatpickr, GLightbox, jQuery utilities, Moment.js, Waypoints, Gumshoe, jQuery, Bootstrap.

**Savings:** ~93.5% reduction (2.2MB → 144KB)

---

## Migration Notes

### If DataTables Needed in Future

Install via npm and load through Vite:

```bash
npm install datatables.net-bs5
```

### If Date Picker Needed

Use HTML5 native or install via npm:

```bash
npm install flatpickr
```

### If Rich Text Editor Needed

Consider lightweight alternatives:

- Trix (Rails default, 200KB)
- TinyMCE (CDN)
- CKEditor (CDN)

### If Lightbox Needed

Use Bootstrap Modal or install via npm:

```bash
npm install glightbox
```

---

**Last Updated:** January 31, 2026  
**Maintained By:** Development Team
