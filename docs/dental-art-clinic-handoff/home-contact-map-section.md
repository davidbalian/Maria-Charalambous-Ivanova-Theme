# How To: Homepage Contact Section (Text Column + Map Column)

A bottom-of-homepage **contact band**: **left** = heading, phone, email, address, **hours table** (reusable partial), and **actions**; **right** = **Google Maps embed** in a full-height cell. The whole block reads as one **card** (shared background, radius, shadow) with **no gutter** between columns on large screens; on small screens the grid **stacks** (map below or after copy—same source order).

**Hours / schedule:** Implemented as a dedicated pattern (table + optional live open/closed badge). Documented separately so you can reuse it on the contact page and footer without duplicating prose — see [contact-hours-schedule-table.md](./contact-hours-schedule-table.md).

---

## What It Looks Like

- Section sits on a **soft page background**; inner **card** uses **surface** color, **large radius**, **medium shadow**, **`overflow: hidden`** so the map edge is flush.
- **Two-column grid** (`1fr 1fr`), **stretch** alignment so the map column fills vertical space.
- **Left column:** vertically centered block of **stacked details** (label `h3` style: small caps, muted); **primary + secondary CTAs** in a horizontal flex row with wrap.
- **Right column:** **iframe** map, **100%** width/height of cell, **minimum height** so the card feels substantial.
- **Motion:** Per-row **fade-in** classes with staggered delays (optional; uses your global intersection or CSS animation pattern).
- **Breakpoint (e.g. ≤768px):** single column, tighter padding, slightly **taller** map min-height.

---

## Dependencies

| Piece | Notes |
|--------|--------|
| **Container** | Max-width wrapper shared with site sections |
| **Hours block** | Include the hours partial — see linked doc |
| **Map** | Google Maps **embed** URL (`iframe`); `loading="lazy"`, `referrerpolicy`, `title` for a11y |
| **CTAs** | Full contact page link + optional third-party chat link partial |

---

## HTML Structure (generic)

```html
<section class="home-contact" aria-labelledby="home-contact-heading">
  <div class="container">
    <div class="home-contact__grid">
      <div class="home-contact__info">
        <h2 id="home-contact-heading" class="home-contact__title">Contact Us</h2>

        <div class="home-contact__detail">
          <h3>Phone</h3>
          <p><a href="tel:+10000000000">+1 …</a></p>
        </div>

        <div class="home-contact__detail">
          <h3>Email</h3>
          <p><a href="mailto:hello@example.com">hello@example.com</a></p>
        </div>

        <div class="home-contact__detail">
          <h3>Address</h3>
          <p>Street, City, Country</p>
        </div>

        <div class="home-contact__detail">
          <!-- Include hours partial: heading h3 + table + js-clinic-status — see contact-hours-schedule-table.md -->
        </div>

        <div class="home-contact__actions">
          <a href="/contact/" class="btn btn-primary">Contact Us</a>
          <!-- optional secondary CTA -->
        </div>
      </div>

      <div class="home-contact__map">
        <iframe
          src="https://www.google.com/maps/embed?..."
          width="600"
          height="450"
          style="border:0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Clinic location"
        ></iframe>
      </div>
    </div>
  </div>
</section>
```

**Including the schedule:** Render your hours template/part inside the **`home-contact__detail`** wrapper that sits with the other blocks so spacing stays consistent (`margin-bottom` on each detail chunk). Pass options such as **`heading_tag` => `'h3'`** and **`status_id`** if you need a stable hook for tests — details in [contact-hours-schedule-table.md](./contact-hours-schedule-table.md).

---

## CSS (reference)

Section spacing + card grid:

```css
.home-contact {
  padding: var(--space-3xl) 0;
  background-color: var(--color-background-subtle);
}

.home-contact__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0;
  align-items: stretch;
  background-color: var(--color-surface);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-md);
  overflow: hidden;
}

.home-contact__info {
  padding: var(--space-xl);
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.home-contact__title {
  font-size: 2rem;
  margin-bottom: var(--space-lg);
}

.home-contact__detail {
  margin-bottom: var(--space-lg);
}

.home-contact__detail h3 {
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: var(--color-text-muted);
  margin-bottom: var(--space-xs);
}

.home-contact__detail p {
  font-size: 1rem;
}

.home-contact__actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  margin-top: var(--space-md);
  align-self: flex-start;
  align-items: center;
}

.home-contact__map {
  height: 100%;
}

.home-contact__map iframe {
  width: 100%;
  height: 100%;
  min-height: 360px;
  display: block;
}

@media (max-width: 768px) {
  .home-contact__grid {
    grid-template-columns: 1fr;
  }
  .home-contact__info {
    padding: var(--space-md);
  }
  .home-contact__map iframe {
    min-height: 410px;
  }
}
```

---

## Behavior & a11y

- **`aria-labelledby`** on the section pointing at the **`h2` id**.
- Phone/mail **`href`** schemes (`tel:` / `mailto:`).
- Map **`title`** describes purpose (“Clinic location” or similar).
- Staggered **fade-in**: apply your existing utility classes (`fade-in`, `fade-in-delay-n`); observe once if using `IntersectionObserver`.

---

## Related patterns

| Topic | Doc |
|--------|-----|
| Hours table markup, `.contact-hours` CSS, open/closed JS | [contact-hours-schedule-table.md](./contact-hours-schedule-table.md) |
| Larger hero/header overlap sites | Align section padding with your global `--header-height` if the contact block sits under sticky chrome |

---

## Checklist (porting)

- [ ] Two-column card grid + stack at **768px** (or your token breakpoint)  
- [ ] Hours block **included** from shared partial; schedule doc kept in sync  
- [ ] Map iframe lazy-loaded with accessible **title**  
- [ ] CTAs: full contact route + optional chat  
- [ ] Detail stack shares one **BEM chunk** pattern for Phone / Email / Address / Hours  

This guide stays layout-focused; **day-by-day hours and live status** live in [contact-hours-schedule-table.md](./contact-hours-schedule-table.md).
