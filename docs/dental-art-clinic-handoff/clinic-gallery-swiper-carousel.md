# How To: “The Clinic” Horizontal Photo Carousel (Swiper, Prev/Next, Variable-Width Slides)

A homepage band with a **dark diagonal gradient** background, **title + subtitle** and **paired circular arrow buttons** in a header row, and a **Swiper** carousel of **variable-width images** — each slide is a fixed **height** with **intrinsic horizontal crop** (`width: auto` on the image, **`object-fit: cover`**). Buttons are wired as **Swiper `navigation`** targets. Slide data typically comes from a **CMS-managed gallery list** (location/slot pattern); wiring is summarized below and detailed in **[gallery-location-keyed-cpt.md](./gallery-location-keyed-cpt.md)**.

---

## What It Looks Like

- **Desktop / tablet:** Header is **`flex`** — copy **left**, **Prev / Next** **right**, vertically aligned to the bottom of the text block.
- **Carousel:** **`slidesPerView: 'auto'`** so each slide’s width follows the photo aspect ratio at a shared **slide height** (large screens ~**280px**, stepped down by breakpoint).
- **Buttons:** Circular, semi-transparent glass on the gradient; **hover** slight **lift**, **focus-visible** outline, **active** **`scale(0.97)`**; **`disabled`** dimmed when Swiper disables ends (mostly relevant if **`loop: false`**).
- **Motion:** **`prefers-reduced-motion`** → animation **speed `0`** in JS + strip button transitions + force swiper wrapper transition **0ms** in CSS.
- **Touch:** **`touch-action: manipulation`** on the section to discourage double-tap zoom when tapping arrows.
- **Mobile layout:** Header uses **`display: contents`** so its children reorder inside the parent **flex column**: **copy** → **carousel** → **nav bar** full width with arrows **space-between** (easier thumbs than clustered top-right).

---

## Dependencies

| Piece | Role |
|--------|------|
| **Swiper** (bundled CSS + JS v12+) | Carousel core, **`navigation`** API |
| **Section CSS** | Layout, slide dimensions, gradient, **`@media`** |
| **`window.load`** | Init Swiper **after** images/metadata so **`slidesPerView: 'auto'`** measures widths correctly |
| **Image rows** | `thumb_url` or `url`, `alt` — normalized list pattern in [gallery-location-keyed-cpt.md](./gallery-location-keyed-cpt.md) |

---

## HTML structure (generic)

```html
<section class="clinic-showcase" aria-label="Clinic photo gallery">
  <div class="container">
    <div class="clinic-showcase__header">
      <div>
        <h2 class="clinic-showcase__title fade-in fade-in-delay-0">The Clinic</h2>
        <p class="clinic-showcase__subtitle fade-in fade-in-delay-1">
          Step inside our practice.
        </p>
      </div>
      <div class="clinic-showcase__nav fade-in fade-in-delay-2" aria-label="Clinic gallery navigation">
        <button type="button" class="clinic-showcase__btn js-clinic-prev" aria-label="Previous photos">
          <span aria-hidden="true">&#8592;</span>
        </button>
        <button type="button" class="clinic-showcase__btn js-clinic-next" aria-label="Next photos">
          <span aria-hidden="true">&#8594;</span>
        </button>
      </div>
    </div>

    <div class="swiper clinic-showcase__carousel js-clinic-swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="thumb-or-full.webp" alt="Treatment room" loading="lazy" decoding="async" />
        </div>
        <!-- repeat per image -->
      </div>
    </div>
  </div>
</section>
```

**Class mapping note:** Replace **`clinic-showcase`** with your BEM prefix (e.g. **`home-v2-clinic`**). Keep **`js-clinic-swiper`**, **`js-clinic-prev`**, **`js-clinic-next`** as stable hooks for one init script, or rename consistently in both markup and JS.

**Empty state:** If your resolver returns **no images**, **omit the entire section** so you do not ship an empty Swiper.

---

## CSS (reference)

### Section + header + buttons

```css
.clinic-showcase {
  padding: var(--space-3xl) 0;
  background: linear-gradient(to top right, var(--color-text), var(--color-secondary));
  touch-action: manipulation;
}

.clinic-showcase .container {
  display: flex;
  flex-direction: column;
}

.clinic-showcase__header {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: var(--space-lg);
  margin-bottom: var(--space-lg);
}

.clinic-showcase__title {
  font-size: 2rem;
  margin: 0;
  color: var(--color-white);
}

.clinic-showcase__subtitle {
  margin: var(--space-xs) 0 0;
  font-size: 1rem;
  color: rgba(255, 255, 255, 0.7);
}

.clinic-showcase__nav {
  display: flex;
  align-items: center;
  gap: var(--space-xs);
  flex-shrink: 0;
}

.clinic-showcase__btn {
  width: 46px;
  height: 46px;
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(255, 255, 255, 0.1);
  color: var(--color-white);
  font-size: 1.125rem;
  cursor: pointer;
  transition:
    transform 0.25s var(--ease),
    background-color 0.2s var(--ease),
    border-color 0.2s var(--ease),
    opacity 0.2s var(--ease);
}

.clinic-showcase__btn:hover:not(:disabled),
.clinic-showcase__btn:focus-visible:not(:disabled) {
  transform: translateY(-1px);
  border-color: rgba(0, 0, 0, 0.28);
}

.clinic-showcase__btn:active:not(:disabled) {
  transform: scale(0.97);
}

.clinic-showcase__btn:focus-visible {
  outline: 2px solid var(--color-primary);
  outline-offset: 2px;
}

.clinic-showcase__btn:disabled {
  opacity: 0.42;
  cursor: not-allowed;
}
```

### Swiper slide sizing (variable width)

```css
.clinic-showcase__carousel.swiper {
  width: 100%;
}

.clinic-showcase__carousel .swiper-slide {
  margin: 0;
  width: auto;
  height: 280px;
  overflow: hidden;
  border-radius: var(--radius-lg);
  transform: translateZ(0);
}

.clinic-showcase__carousel .swiper-slide img {
  width: auto;
  height: 100%;
  max-width: none;
  display: block;
  object-fit: cover;
}

@media (max-width: 1024px) {
  .clinic-showcase__carousel .swiper-slide {
    height: 240px;
  }
}

@media (max-width: 768px) {
  .clinic-showcase__header {
    display: contents;
  }

  .clinic-showcase__header > div:first-child {
    order: 1;
    margin-bottom: var(--space-md);
  }

  .clinic-showcase__carousel {
    order: 2;
  }

  .clinic-showcase__nav {
    order: 3;
    width: 100%;
    margin: var(--space-md) auto 0;
    justify-content: space-between;
    gap: var(--space-xl);
  }

  .clinic-showcase__carousel .swiper-slide {
    height: 200px;
  }
}

@media (prefers-reduced-motion: reduce) {
  .clinic-showcase__btn {
    transition: none;
  }
  .clinic-showcase__carousel .swiper-wrapper {
    transition-duration: 0ms !important;
  }
}
```

**Why `width: auto` on slides:** Each photo keeps its **natural aspect ratio** at the fixed **height**, so the strip feels like a **film strip** rather than equal-width cards.

---

## JavaScript (Swiper init)

Run on **`window.load`** (not only `DOMContentLoaded`) so image dimensions are available for **`slidesPerView: 'auto'`**.

```javascript
window.addEventListener('load', function () {
  var el = document.querySelector('.js-clinic-swiper');
  if (!el || typeof Swiper === 'undefined') return;

  var reduceMotion =
    typeof window.matchMedia === 'function' &&
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  new Swiper(el, {
    slidesPerView: 'auto',
    spaceBetween: 16,
    loop: true,
    speed: reduceMotion ? 0 : 600,
    navigation: {
      prevEl: '.js-clinic-prev',
      nextEl: '.js-clinic-next',
    },
  });
});
```

**Optional:** `breakpoints` for `spaceBetween`, `freeMode`, or `centeredSlides` if you change art direction.

---

## Data source (conceptual)

Resolve an **ordered list** of image rows for a fixed **slot** (e.g. **`home_clinic`**). For each row, set **`img.src`** to **`thumb_url`** with fallback to **`url`**; set **`alt`**. See **[gallery-location-keyed-cpt.md](./gallery-location-keyed-cpt.md)** for the repository pattern and meta shapes.

---

## Assets pipeline (conceptual)

- Enqueue **Swiper CSS** before your **section override** CSS.
- Enqueue **Swiper UMD bundle**, then your **thin init file** with **`Swiper` as dependency**.
- **`defer`** on the init script is fine if `Swiper` is also deferred and order is preserved.

---

## Fade-in copy

Apply **`fade-in`** + **`fade-in-delay-*`** on **title**, **subtitle**, and **nav** (and optionally the carousel root) to match your global scroll-reveal utilities.

---

## Checklist (porting)

- [ ] Header flex + mobile **`display: contents`** reorder  
- [ ] **`slidesPerView: 'auto'`** + fixed slide **height** + **`object-fit: cover`**  
- [ ] Init on **`load`**; guard missing **`Swiper`**  
- [ ] **`prefers-reduced-motion`** in JS and CSS  
- [ ] **`touch-action: manipulation`** on section  
- [ ] Localized **`aria-label`** on section and buttons  
- [ ] Data layer aligned with [gallery-location-keyed-cpt.md](./gallery-location-keyed-cpt.md)  

---

This document describes the **whole inner section** (chrome, nav, Swiper, images). For **how gallery posts feed the slide list**, use **[gallery-location-keyed-cpt.md](./gallery-location-keyed-cpt.md)**.
