# How To: Clinic Hours Table + Live Open / Closed Badge

A small **two-column `<table>`** listing weekday ranges and hours, plus an optional **live status** span next to the heading (“OPEN NOW” / “CLOSED NOW”) driven by **JavaScript** in a fixed **IANA timezone**. Styled with a shared **`.contact-hours`** class; can use a **modifier class** for denser footer variants.

This pattern is often **included** inside larger sections (homepage contact block, contact page, site footer). See **Homepage contact + map layout** in [home-contact-map-section.md](./home-contact-map-section.md). For footer column layout and **`contact-hours--footer`** styling, see [site-footer.md](./site-footer.md).

---

## What It Looks Like

- Heading row: **“Hours”** (or translated equivalent) with an inline **status chip** after the title (optional).
- Table: each row = **day range** | **time range** (or “Closed”). Right column right-aligned, lighter text.
- Status: green **open** or red **closed**, bold, with a bullet pseudo-element; updates **every minute** without a page reload.

---

## Dependencies

| Layer | Requirement |
|--------|--------------|
| **Markup** | One `<table>`, semantic heading (`h3`–`h4` typical) |
| **CSS** | Collapsed borders; row separators; `.clinic-status--open` / `--closed` |
| **JS** | `Intl.DateTimeFormat` + `formatToParts` + `timeZone: 'Europe/Nicosia'` (or your clinic TZ) |

No build step required.

---

## HTML Structure (generic)

Template arguments (conceptual) allow re-use:

- **`heading_tag`** — e.g. `h3` in a contact card, `h4` in a footer widget.
- **`heading_text`** — override if not using your default translated “Hours”.
- **`show_status`** — set false to hide the span (table only).
- **`status_id`** — optional `id` on the span for QA anchors or aria targets.
- **`modifier`** — appended to base table class, e.g. `--footer`, for tighter padding.

```html
<div class="contact-block__detail">
  <h3>
    Hours
    <span class="js-clinic-status" id="clinic-open-status"></span>
  </h3>
  <table class="contact-hours">
    <tr><td>Monday – Wednesday</td><td>8:00 AM – 5:30 PM</td></tr>
    <tr><td>Tuesday – Thursday</td><td>8:30 AM – 5:30 PM</td></tr>
    <tr><td>Friday</td><td>8:30 AM – 1:00 PM</td></tr>
    <tr><td>Saturday – Sunday</td><td>Closed</td></tr>
  </table>
</div>
```

**Translation:** Swap static cell copy for your i18n layer (PHP `__()`, JSON, etc.). Headings and row labels must stay consistent across locales.

**Important:** Row text is **human-readable**; the **JS schedule** below must implement the **same** opening rules. If they diverge, the badge will disagree with the printed table. After any hours change, update **both** the table rows and the script.

---

## CSS (reference)

```css
.contact-hours {
  width: 100%;
  border-collapse: collapse;
}

.contact-hours td {
  padding: var(--space-xs) 0;
  font-size: 0.9375rem;
  border-bottom: 1px solid var(--color-border);
}

.contact-hours tr:last-child td {
  border-bottom: none;
}

.contact-hours td:last-child {
  text-align: right;
  color: var(--color-text-muted);
}

.clinic-status--open {
  color: #27ae60;
  font-weight: 700;
  padding-left: 10px;
  position: relative;
}
.clinic-status--open::before {
  content: "•";
  position: absolute;
  left: 0;
}

.clinic-status--closed {
  color: #c0392b;
  font-weight: 700;
  padding-left: 10px;
  position: relative;
}
.clinic-status--closed::before {
  content: "•";
  position: absolute;
  left: 0;
}
```

Optional **footer modifier** (narrower cells, last-row border tweak):

```css
.contact-hours--footer td { font-size: 0.8125rem; }
/* adjust padding / borders as needed */
```

---

## Open / closed logic (JavaScript)

1. Select **all** `.js-clinic-status` nodes (multiple instances: homepage, contact page, footer).
2. On load and **`setInterval(..., 60000)`**, compute **current local time in the clinic timezone** — not the visitor’s browser zone.

```javascript
function updateClinicStatus() {
  var now = new Date();
  var formatter = new Intl.DateTimeFormat('en-US', {
    timeZone: 'Europe/Nicosia', // clinic region
    hour: 'numeric',
    minute: 'numeric',
    hour12: false,
    weekday: 'long'
  });
  var parts = formatter.formatToParts(now);
  var hour = 0, minute = 0, weekday = '';
  parts.forEach(function (p) {
    if (p.type === 'hour') hour = parseInt(p.value, 10);
    if (p.type === 'minute') minute = parseInt(p.value, 10);
    if (p.type === 'weekday') weekday = p.value;
  });

  var currentMinutes = hour * 60 + minute;
  var openStart = null;
  var closeMinutes = null;

  // Example policy (mirror your printed table exactly):
  if (weekday === 'Monday' || weekday === 'Wednesday') {
    openStart = 8 * 60;       // 08:00
    closeMinutes = 17 * 60 + 30; // 17:30
  } else if (weekday === 'Tuesday' || weekday === 'Thursday') {
    openStart = 8 * 60 + 30;  // 08:30
    closeMinutes = 17 * 60 + 30;
  } else if (weekday === 'Friday') {
    openStart = 8 * 60 + 30;
    closeMinutes = 13 * 60;   // 13:00
  }
  // Sat/Sun: openStart stays null → closed

  var isOpen = openStart !== null
    && currentMinutes >= openStart
    && currentMinutes < closeMinutes;

  document.querySelectorAll('.js-clinic-status').forEach(function (el) {
    if (isOpen) {
      el.textContent = 'OPEN NOW'; // or localized string from injected config
      el.className = 'js-clinic-status clinic-status--open';
    } else {
      el.textContent = 'CLOSED NOW';
      el.className = 'js-clinic-status clinic-status--closed';
    }
  });
}

updateClinicStatus();
setInterval(updateClinicStatus, 60000);
```

**Edge cases**

- **`weekday`** strings depend on **`en-US`** + `Intl` (e.g. `"Monday"`). Keep locale fixed in the formatter for stable comparisons, or map `formatToParts` weekday to numeric **day of week** if you prefer.
- **Holidays / exceptions:** not modeled; badge reflects weekly rules only unless you extend the script.

**Structured data:** If you output **Schema.org `OpeningHoursSpecification`** elsewhere (SEO), reuse the **same** hours there to avoid contradictory machine-readable data.

---

## Checklist (porting)

- [ ] Table semantics + i18n for row labels  
- [ ] `.contact-hours` + optional `--footer` modifier  
- [ ] `.js-clinic-status` in heading; optional `id`  
- [ ] JS: correct **time zone**, minute math, interval refresh  
- [ ] Open/closed strings localized (inject via `wp_localize_script` or similar)  
- [ ] Table rows and JS rules **updated together** when business hours change  

---

For where this block sits in a **two-column contact + map** layout, continue to [home-contact-map-section.md](./home-contact-map-section.md).
