# How To: Image Feature Card with Gradient Overlay, Content Lift, and Revealed CTA (“Scientific Precision” pattern)

A **tall photo card** used in a **two-up grid** under a section heading: **portrait or lifestyle image** as `background-image`, a **diagonal fade** from warm dark toward transparent (readability over the photo), **white title + body** anchored to the **bottom-left**, and a **pill-shaped “Learn more” link** that sits **just below** the text block but is **invisible until hover**. On hover the **whole text block translates upward** by a pre-calculated distance so the button **appears to rise into view** while **fading in** (`opacity`).

Entry animation for the cards themselves uses the site-wide **`fade-in` + staggered delay** pattern (see global intersection/CSS utilities); this doc focuses on **card chrome and hover micro-interaction**.

---

## What It Looks Like

- **Idle:** Title, paragraph, and a **glass** CTA outline (low-contrast) — CTA at **`opacity: 0`** but still focusable if you add keyboard affordances later.
- **Hover (pointer devices):** Content block **`translateY` up** (~one “row” of vertical rhythm); CTA **`opacity: 1`**; CTA background/border can brighten on **link** `:hover`.
- **Active press:** CTA uses a quick **`scale(0.97)`** (or your shared **press-feedback** utility) for tactile feedback.
- **Section backdrop:** Optional full-bleed **gradient** behind the grid (e.g. text color → secondary brown) so the cards float on-brand.

---

## Dependencies

| Piece | Role |
|--------|------|
| **CSS** | `position` + `overflow: hidden` on card; `::before` for image tint; transitions on `transform` + `opacity` |
| **Markup** | Wrapper **`.card`** with inline or utility **`background-image`**, inner **`.card__content`** wrapping title, text, anchor |
| **Motion (enter)** | **`fade-in`** / **`IntersectionObserver`** optional |
| **Touch / keyboard** | Consider **`@media (hover: hover)`** so the link is always visible when hover is unavailable (see end) |

---

## HTML structure (generic)

Two cards side by side; swap copy and `href` per column.

```html
<section class="feature-dual" aria-labelledby="feature-dual-heading">
  <div class="container">
    <h2 id="feature-dual-heading" class="feature-dual__title fade-in fade-in-delay-0">Section title</h2>
    <p class="feature-dual__subtitle fade-in fade-in-delay-1">Supporting line.</p>

    <div class="feature-dual__grid">
      <article
        class="feature-dual__card fade-in fade-in-delay-2"
        style="background-image: url('/images/card-a.webp');"
      >
        <div class="feature-dual__card-content">
          <h3 class="feature-dual__card-title">Scientific Precision</h3>
          <p class="feature-dual__card-text">Short supporting copy.</p>
          <a href="/about/" class="feature-dual__card-cta">Learn more</a>
        </div>
      </article>

      <article
        class="feature-dual__card fade-in fade-in-delay-4"
        style="background-image: url('/images/card-b.webp');"
      >
        <div class="feature-dual__card-content">
          <h3 class="feature-dual__card-title">Second pillar</h3>
          <p class="feature-dual__card-text">…</p>
          <a href="/services/" class="feature-dual__card-cta">Learn more</a>
        </div>
      </article>
    </div>
  </div>
</section>
```

---

## CSS (behavioral recipe)

### Section + grid

```css
.feature-dual {
  padding: var(--space-3xl) 0;
  background: linear-gradient(to top right, var(--color-text), var(--color-secondary));
}

.feature-dual__title {
  font-size: 2rem;
  text-align: center;
  margin-bottom: var(--space-sm);
  color: var(--color-white);
}

.feature-dual__subtitle {
  font-size: 1.05rem;
  color: rgba(255, 255, 255, 0.7);
  text-align: center;
  max-width: 680px;
  margin: 0 auto var(--space-xl);
  line-height: 1.65;
}

.feature-dual__grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: var(--space-lg);
}

@media (max-width: 768px) {
  .feature-dual__grid {
    grid-template-columns: 1fr;
  }
}
```

### Card shell + diagonal “fade” overlay

The **photo** is **`background-image`** on the **article**. A **`::before`** draws the **readable scrim** — not `box-shadow`, so the gradient can **diagonally** wander from opaque to clear.

```css
.feature-dual__card {
  position: relative;
  min-height: 450px;
  background-size: cover;
  background-position: center;
  background-color: var(--color-bg-fallback);
  border-radius: var(--radius-lg);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-end;
  padding: var(--space-lg);
}

.feature-dual__card::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top right,
    rgba(61, 52, 47, 0.85) 0%,
    rgba(148, 127, 99, 0.6) 30%,
    transparent 80%
  );
  pointer-events: none;
  z-index: 0;
}
```

Tune **stops** and **angles** until text meets contrast on your photography.

### Content block lift (the “button pops up” choreography)

1. **`.card-content`** is **`position: relative; z-index: 1`** with **`transition` on `transform`**.
2. The CTA is **`position: absolute`**, **`left: 0`**, **`top: 100%`**, **`margin-top`** = gap between copy and button when revealed.
3. **Default:** CTA **`opacity: 0`**; transition **`opacity`** + hover colors.
4. **Card `:hover`:** lift **`.card-content`** upward by roughly **button height + margins + a hairline** (`1em` proxy for one line of button text, `2px` for border fudge).

```css
.feature-dual__card-content {
  position: relative;
  z-index: 1;
  transition: transform 0.35s var(--ease-standard);
}

.feature-dual__card:hover .feature-dual__card-content {
  transform: translateY(
    calc(-1 * (var(--space-md) + var(--space-xs) * 2 + 1em + 2px))
  );
}

.feature-dual__card-title,
.feature-dual__card-text {
  color: var(--color-white);
}

.feature-dual__card-title {
  font-size: 1.35rem;
  font-weight: 700;
  margin-bottom: var(--space-xs);
}

.feature-dual__card-text {
  font-size: 0.9375rem;
  line-height: 1.65;
  margin: 0;
  max-width: 60ch;
}

.feature-dual__card-cta {
  position: absolute;
  left: 0;
  top: 100%;
  margin-top: var(--space-md);
  display: inline-block;
  padding: var(--space-xs) var(--space-md);
  font-size: 0.9375rem;
  font-weight: 600;
  color: var(--color-white);
  background: rgba(255, 255, 255, 0.2);
  border: 1px solid rgba(255, 255, 255, 0.5);
  border-radius: var(--radius-md);
  text-decoration: none;
  opacity: 0;
  transition:
    opacity 0.3s var(--ease-standard),
    background 0.25s var(--ease-standard),
    border-color 0.25s var(--ease-standard),
    transform 0.13s var(--ease-standard);
}

.feature-dual__card:hover .feature-dual__card-cta {
  opacity: 1;
}

.feature-dual__card-cta:hover {
  background: rgba(255, 255, 255, 0.3);
  border-color: rgba(255, 255, 255, 0.7);
}

.feature-dual__card-cta:active {
  transform: scale(0.97);
}
```

**Why the `calc()`:** The button **lives in document flow vertically below** the paragraph (`top: 100%` of content box). Raising **`card-content`** by ~one control height pulls the invisible button zone into the visible card area exactly as **`opacity`** turns on — reads as **“pops up”** rather than a detached animation.

---

## Fade-in on scroll

Apply **`fade-in`** + **`fade-in-delay-n`** on **`.feature-dual__title`**, **subtitle**, and each **`article`**. Typical observer **`threshold ~0.25`** adds **`visible`** to trigger CSS opacity/transform. Stagger **`delay-2`** and **`delay-4`** on the two cards for a cascading entrance.

---

## Touch and reduced motion

| Concern | Suggestion |
|--------|-------------|
| **No hover on touch** | Under **`@media (hover: none)`**, set **`.feature-dual__card-cta { opacity: 1 }`** and **remove translate** on `:hover`, or duplicate CTA visibly in markup for small breakpoints. |
| **`prefers-reduced-motion`** | Disable **`transform`** on content lift; keep **`opacity`** instant or omit reveal. |

---

## Checklist (porting)

- [ ] Card **`min-height`**, **`cover`**, **`border-radius`**, **`overflow: hidden`**  
- [ ] **`::before` gradient scrim**, **`pointer-events: none`**  
- [ ] **Content `z-index` above scrim**  
- [ ] **CTA absolutely positioned below text**, **`opacity` reveal on card hover**  
- [ ] **`translateY` matched** to approximate CTA vertical footprint  
- [ ] **Responsive single column**, optional title `max-width` for balance on mobile  

---

This pattern ships as paired “pillar” cards (e.g. **precision** vs **aesthetics**) but generalizes to any **two-column** promotional grid with the same hover contract.
