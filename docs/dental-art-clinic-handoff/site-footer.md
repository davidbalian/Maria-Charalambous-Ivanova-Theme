# How To: Site Footer (Multi-Column Layout, Hours Table, Cookie Banner)

A **dark** full-width footer: **four columns** on desktop (logo + three content columns), collapsing to **stacked sections** on small screens; a **divider bar** for copyright and credits; and a **floating cookie consent** strip mounted just before the closing **`body`** hooks.

The **opening hours timetable** uses the **same reusable partial** pattern as elsewhere. Day rows, **`contact-hours`** styling, **`--footer`** variant, **`js-clinic-status`**, and Cyprus-time logic are documented in **[contact-hours-schedule-table.md](./contact-hours-schedule-table.md)** — this guide only describes **how the footer mounts** that block and adapts typography for a **dark-on-light** inversion.

---

## What It Looks Like

- **Top region:** **`max-width`** inner row, **`flex`** with **`space-between`** and **`wrap`**, generous horizontal **`gap`** between columns on desktop.
- **Column 1:** Light-styled logo (invert filter on a transparent PNG/AVIF on dark bg).
- **Column 2:** Primary nav via **`wp_nav_menu`** (**`theme_location`** chosen by locale).
- **Column 3:** Supplementary links (often a static list or secondary menu location).
- **Column 4:** Contact list (tel, maps link wrapping address); below that the **hours** heading + optional **OPEN NOW/CLOSED** chip + **`contact-hours`** table with **`contact-hours--footer`** modifier.
- **Bottom bar:** Top border (**low-contrast hairline on dark**), two lines or columns: **© year** and **agency / credits** links.
- **Cookie banner:** Fixed-style panel (controlled by CSS in your bundle), **`hidden`** until JS reveals it; **`localStorage`** remembers dismiss.

---

## Dependencies

| Piece | Role |
|--------|------|
| **WordPress** | `wp_nav_menu`, `wp_footer()`, optional `wp_body_open`-free zone for banner |
| **Hours partial** | Shared table include — see **[contact-hours-schedule-table.md](./contact-hours-schedule-table.md)** |
| **Clinic status JS** | Same **`.js-clinic-status`** updater as homepage/contact; spans can exist in multiple DOM locations |
| **Cookie JS** | Dismiss handlers + **`localStorage`** key (implement in your main bundle) |

---

## HTML structure (generic)

```html
<footer id="colophon" class="site-footer">
  <div class="site-footer__inner">
    <div class="site-footer__col site-footer__col--logo">
      <a href="/" class="site-footer__logo-link">
        <img class="site-footer__logo" src="logo-light-for-dark-bg.webp" alt="Site name" width="200" height="40" loading="lazy" />
      </a>
    </div>

    <div class="site-footer__col">
      <h4 class="site-footer__heading">Navigation</h4>
      <nav class="footer-navigation" aria-label="Footer">
        <!-- wp_nav_menu: ul of primary links -->
      </nav>
    </div>

    <div class="site-footer__col">
      <h4 class="site-footer__heading">Services</h4>
      <nav class="footer-navigation">
        <ul><!-- curated or second menu_location --></ul>
      </nav>
    </div>

    <div class="site-footer__col">
      <h4 class="site-footer__heading">Contact</h4>
      <ul class="site-footer__contact">
        <li><a href="tel:+1000000000">Phone</a></li>
        <li>
          <a href="https://maps.google.com/…" target="_blank" rel="noopener noreferrer" class="site-footer__address">
            Street, City
          </a>
        </li>
      </ul>
      <!-- Include hours partial with footer modifier — see linked doc -->
      <!-- heading_class e.g. site-footer__subheading; status_id e.g. footer-clinic-status; modifier --footer -->
    </div>
  </div>

  <div class="site-footer__bottom">
    <p>&copy; 2026 Business Name. All rights reserved.</p>
    <p>Designed by <a href="…">Studio</a></p>
  </div>
</footer>

<!-- Often placed after footer, still before wp_footer(): -->
<div id="cookie-banner" class="cookie-banner" role="dialog" aria-label="Cookie consent" hidden>
  <button type="button" class="cookie-banner__close" aria-label="Dismiss">&times;</button>
  <p class="cookie-banner__text">… <a href="/privacy/">Privacy Policy</a>.</p>
  <div class="cookie-banner__actions">
    <button type="button" class="cookie-banner__accept btn btn-primary">Accept</button>
    <button type="button" class="cookie-banner__reject btn btn-outline">Reject</button>
  </div>
</div>
```

---

## Including the hours block in the footer

Render the **same** hours template used on the homepage and contact page, but pass arguments tailored to the footer:

| Argument | Typical footer value |
|----------|---------------------|
| **`modifier`** | `'--footer'` → table class **`contact-hours contact-hours--footer`** |
| **`heading_class`** | e.g. **`site-footer__subheading`** (uppercase-ish, muted white) |
| **`heading_tag`** | default **`h4`** or **`h3`** if you skipped a level only in footer (keep outline sensible) |
| **`status_id`** | stable **`id`** on **`.js-clinic-status`** (e.g. `footer-clinic-status`) for tests or **`aria-labelledby`** linking |

The **badge** (**OPEN NOW** / **CLOSED NOW**) and **minute-accurate** logic are **not** duplicated in the footer — they reuse the **[contact-hours-schedule-table.md](./contact-hours-schedule-table.md)** scriptpath. Updating hours in production still means syncing **table rows** and **JS rules** everywhere that partial appears.

**Dark footer table:** Override default **`.contact-hours`** neutrals — see next section (**`contact-hours--footer`**).

---

## CSS (reference)

### Shell + columns

```css
.site-footer {
  background-color: var(--color-text-primary); /* e.g. near-black */
  padding: var(--space-3xl) var(--space-lg) 0;
}

.site-footer__inner {
  max-width: var(--container-width);
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 8rem;
  padding-bottom: var(--space-2xl);
}

.site-footer__col {
  width: max-content;
}

.site-footer__logo {
  max-width: 300px;
  height: auto;
  filter: brightness(0) invert(1); /* gold logo reads as light on dark */
}

.site-footer__heading {
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--color-white);
  margin-bottom: var(--space-sm);
}

.footer-navigation ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: var(--space-xs);
}

.footer-navigation a {
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.6);
  transition: color 0.25s var(--ease);
}
.footer-navigation a:hover {
  color: var(--color-white);
}

.site-footer__contact {
  list-style: none;
  padding: 0;
  margin: 0 0 var(--space-md);
  display: flex;
  flex-direction: column;
  gap: var(--space-xs);
}

.site-footer__contact a {
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.6);
}
.site-footer__contact a:hover {
  color: var(--color-white);
}

.site-footer__contact .site-footer__address {
  max-width: 30ch;
  display: inline-block;
}

.site-footer__subheading {
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: rgba(255, 255, 255, 0.6);
  margin-bottom: var(--space-xs);
}
```

### Footer-specific hours overrides

Companion to [contact-hours-schedule-table.md](./contact-hours-schedule-table.md):

```css
.contact-hours--footer {
  font-size: 0.8125rem;
  color: rgba(255, 255, 255, 0.6);
  margin-bottom: var(--space-xs);
}

.contact-hours--footer td {
  padding: 0.25em 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.contact-hours--footer tr:last-child td {
  border-bottom: none;
}

.contact-hours--footer td:first-child {
  padding-right: var(--space-sm);
}
```

**Open/closed colors:** Green/red badges from the schedule doc typically read fine on dark; adjust **only** if contrast fails WCAG against the footer black.

### Bottom bar + responsive

```css
.site-footer__bottom {
  max-width: var(--container-width);
  margin: 0 auto;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  padding: var(--space-md) 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.35);
}

.site-footer__bottom p {
  margin: 0;
}

.site-footer__bottom a {
  color: rgba(255, 255, 255, 0.5);
}
.site-footer__bottom a:hover {
  color: var(--color-white);
}

@media (max-width: 1024px) {
  .site-footer__inner {
    justify-content: flex-start;
  }
}

@media (max-width: 768px) {
  .site-footer {
    padding: var(--space-2xl) var(--space-md) 0;
  }
  .site-footer__inner {
    flex-direction: column;
    gap: var(--space-lg);
  }
  .site-footer__bottom {
    flex-direction: column;
    text-align: center;
    gap: var(--space-xs);
  }
}
```

---

## Multi-language navigation

Mirroring the header: before **`wp_nav_menu`**, select **`theme_location`** based on the active locale (**`primary`** vs **`primary-{lang}`**) when **`has_nav_menu`** is true — otherwise fall back so the footer never silently renders empty when a translation menu is missing.

Full language detection, **`localized_url()`**, **`lang_url()`**, translations, rewrites, and **`wp_nav_menu_objects`** prefixing: **[i18n-multi-language-urls.md](./i18n-multi-language-urls.md)**.

---

## Cookie banner (high level)

Full markup, CSS, **`transitionend`** dismissal, and **`localStorage`** wiring: **[cookie-consent-banner.md](./cookie-consent-banner.md)**.

Summary:

- Markup lives **outside** **`site-footer`** or at its foot; closing body scripts still run afterward.
- Initial state **`hidden`**; script removes **`hidden`**, applies **`is-visible`** after a **`reflow`** to animate entrance.
- **Accept / reject / ×** handlers can all call the same dismiss in a minimal setup; extend for real consent tiers if required.
- **Privacy link** targets your policy route.

---

## Checklist (porting)

- [ ] Four-column semantic structure + logo filter  
- [ ] Locale-aware **`footer` menu location**  
- [ ] Hours partial with **`modifier: --footer`** + **`heading_class`** + **`status_id`** — details in **[contact-hours-schedule-table.md](./contact-hours-schedule-table.md)**  
- [ ] **`contact-hours--footer`** contrasts on dark bg  
- [ ] Footer bottom legal row + responsive stack  
- [ ] Cookie flow + **`aria-label`** on dialog and close  

---

For **timetable rows, normalized hours, ICU timezone logic, and `js-clinic-status` styling**, continue with **[contact-hours-schedule-table.md](./contact-hours-schedule-table.md)**.
