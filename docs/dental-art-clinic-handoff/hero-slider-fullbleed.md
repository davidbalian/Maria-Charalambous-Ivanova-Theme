# How To: Full-Bleed Slider Hero Section

A full-viewport hero with a Swiper image carousel, Ken Burns zoom, scroll parallax, responsive images, staggered fade-in text, and a chevron scroll indicator.

---

## What It Looks Like

- Full-bleed image slider fills the viewport (desktop: `min(98svh, 1920px)`, mobile: stacked)
- Images autoplay with a slow Ken Burns zoom, crossfade transition between slides
- Dark gradient overlay sits on top of the images so text is readable
- Text band sits **below** the slider (not overlaid) — heading, subtext, CTAs
- A chevron at the bottom smoothly scrolls to the next section
- As the user scrolls down, the slider drifts upward slightly (parallax)
- All text elements fade in from below on load, staggered

---

## Dependencies

- **Swiper.js v12** — `swiper-bundle.min.css` + `swiper-bundle.min.js`
- **Web Animations API** — native in all modern browsers, no polyfill needed

---

## HTML Structure

```html
<section class="hero">

  <!-- FULL-BLEED SLIDER -->
  <div class="hero__slider-bleed">
    <div class="swiper hero__carousel js-hero-swiper" aria-label="Hero photos">
      <div class="swiper-wrapper">

        <!-- Repeat per slide -->
        <div class="swiper-slide">
          <div class="hero__slide">
            <picture>
              <!-- Mobile-cropped image -->
              <source media="(max-width: 768px)" srcset="image-mobile.webp" />
              <!-- Desktop image -->
              <img
                src="image-desktop.webp"
                alt="Descriptive alt text"
                loading="eager"
                decoding="async"
                fetchpriority="high"  <!-- high on first, auto on second, low on rest -->
              />
            </picture>
          </div>
        </div>
        <!-- /slide -->

      </div>
    </div>
  </div>
  <!-- /slider-bleed -->

  <!-- TEXT BAND + CHEVRON -->
  <div class="hero__bottom">
    <div class="hero__text-band">
      <div class="hero__inner">
        <div class="hero__content">
          <h1 class="hero__title fade-in fade-in-delay-0">Your Heading Here</h1>
          <p class="hero__text fade-in fade-in-delay-1">Supporting subtext goes here.</p>
          <div class="hero__ctas">
            <div class="fade-in fade-in-delay-2">
              <a href="#" class="btn btn-primary">Primary CTA</a>
            </div>
            <div class="fade-in fade-in-delay-3">
              <a href="#" class="btn btn-outline">Secondary CTA</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CHEVRON -->
    <a href="#next-section" class="hero__scroll-down js-hero-scroll-next" aria-label="Scroll to next section">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="6 9 12 15 18 9"></polyline>
      </svg>
    </a>
  </div>

</section>
```

**Key structural notes:**
- `.hero__slider-bleed` uses the full-bleed trick (see CSS below) — it breaks out of any container width constraint
- Wrap each CTA in a `div.fade-in` rather than putting `.fade-in` on the button directly — keeps button hover transitions clean
- `fetchpriority` values: `"high"` on slide 0, `"auto"` on slide 1, `"low"` on all others

---

## CSS

### Hero Container

```css
.hero {
  --hero-viewport: min(98svh, 1920px);

  position: relative;
  box-sizing: border-box;
  padding: 0;
  min-height: var(--hero-viewport);
  height: var(--hero-viewport);
  max-height: var(--hero-viewport);
  display: flex;
  flex-direction: column;
  align-items: stretch;
  overflow: hidden;
  background: #0e0e0e; /* shows during image decode */
}
```

### Full-Bleed Slider

The `margin-inline` trick breaks the slider out of any parent container without using `position: absolute`.

```css
.hero__slider-bleed {
  flex: 1 1 auto;
  min-height: 0;
  width: 100vw;
  margin-left: calc(50% - 50vw);
  margin-right: calc(50% - 50vw);
  position: relative;
  will-change: transform; /* promote GPU layer for parallax */
}
```

### Dark Overlay

Desktop uses three radial gradients to darken corners/edges while leaving the center brighter. Mobile simplifies to a flat overlay.

```css
/* Desktop: directional vignette */
.hero__slider-bleed::after {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse at top left,    rgba(0,0,0,0.70) 0%, transparent 55%),
    radial-gradient(ellipse at top right,   rgba(0,0,0,0.55) 0%, transparent 55%),
    radial-gradient(ellipse at bottom left, rgba(0,0,0,0.70) 0%, transparent 55%);
  pointer-events: none;
  z-index: 1;
}

/* Mobile: simple flat overlay */
@media (max-width: 768px) {
  .hero__slider-bleed::after {
    background: rgba(0, 0, 0, 0.45);
  }
}
```

### Swiper Fill

```css
.hero__carousel,
.hero__carousel .swiper-wrapper,
.hero__carousel .swiper-slide {
  height: 100%;
}

.hero__slide {
  position: absolute;
  inset: 0;
}

.hero__slide img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
```

### Swiper Crossfade Polish

```css
/* Prevent flash of stacked images before Swiper initialises */
.hero__carousel:not(.swiper-initialized) .swiper-slide:not(:first-child) {
  display: none;
}

/* Smoother crossfade than Swiper default */
.hero__carousel.swiper-fade .swiper-slide {
  transition-timing-function: ease-in-out !important;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

/* will-change only on active slide to avoid multiple promoted layers */
.hero__carousel.is-ready .swiper-slide-active .hero__slide img {
  will-change: transform;
}

@media (prefers-reduced-motion: reduce) {
  .hero__carousel.is-ready .swiper-slide-active .hero__slide img {
    will-change: auto;
  }
}
```

### Text Band

```css
.hero__bottom {
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 24px; /* or your spacing token */
  padding: 32px 0 48px;
  box-sizing: border-box;
}

.hero__text-band {
  width: min(100%, 1120px); /* match your container width */
  margin-inline: auto;
  padding-inline: 32px;
  box-sizing: border-box;
}

.hero__inner {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.hero__content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  text-align: left;
  width: max-content;
}

.hero__ctas {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}
```

### Typography

```css
.hero__title {
  font-size: clamp(2.4rem, 5.5vw, 3.4rem);
  font-weight: 400;
  letter-spacing: -0.035em;
  line-height: 1.1;
  margin-bottom: 24px;
  color: #fff;
  max-width: 20ch;
}

.hero__text {
  font-size: 1.1rem;
  color: rgba(255, 255, 255, 0.85);
  margin-bottom: 32px;
  line-height: 1.6;
  max-width: 50ch;
}
```

### Chevron

```css
.hero__scroll-down {
  color: rgba(255, 255, 255, 0.7);
  opacity: 0.5;
  transition: opacity 0.25s ease, transform 0.13s ease;
  flex-shrink: 0;
}

.hero__scroll-down:hover {
  opacity: 1;
}

.hero__scroll-down:active {
  transform: scale(0.97);
}
```

### Fade-In Animations

```css
.fade-in {
  opacity: 0;
  transform: translateY(24px);
  transition:
    opacity 0.6s ease var(--fade-in-delay, 0s),
    transform 0.6s ease var(--fade-in-delay, 0s);
}

.fade-in.visible {
  opacity: 1;
  transform: translateY(0);
}

.fade-in-delay-0 { --fade-in-delay: 0s; }
.fade-in-delay-1 { --fade-in-delay: 0.1s; }
.fade-in-delay-2 { --fade-in-delay: 0.2s; }
.fade-in-delay-3 { --fade-in-delay: 0.3s; }
.fade-in-delay-4 { --fade-in-delay: 0.4s; }
.fade-in-delay-5 { --fade-in-delay: 0.5s; }

/* Collapse all delays on mobile — stagger doesn't work well on small screens */
@media (max-width: 768px) {
  [class*="fade-in-delay-"] {
    --fade-in-delay: 0s !important;
  }
}
```

### Mobile Layout

On mobile, the hero stacks: slider on top, text band below. No fixed viewport height.

```css
@media (max-width: 768px) {
  .hero {
    --hero-viewport: auto;
    height: auto;
    min-height: 0;
    max-height: none;
  }

  .hero__slider-bleed {
    flex: 0 0 auto;
    height: 50vh;
    min-height: 50vh;
    max-height: 50vh;
    will-change: auto;   /* no parallax on mobile */
    transform: none;
  }

  .hero__bottom {
    padding-top: 24px;
  }

  .hero__text-band {
    padding-inline: 16px;
  }

  .hero__content {
    width: 100%;
    max-width: 100%;
  }
}
```

---

## JavaScript

### 1. Swiper Initialisation + Ken Burns

The slider is hidden until the first image is decoded, then revealed with `.is-ready`. This prevents a flash of half-loaded content on page load.

Ken Burns is a slow zoom (scale 1 → 1.02) driven by the Web Animations API — not CSS animation — so it can be cancelled mid-cycle and reset cleanly between slides.

```js
(function () {
  var SLIDER_SELECTOR   = '.js-hero-swiper';
  var READY_CLASS       = 'is-ready';
  var DECODE_TIMEOUT_MS = 1500;   // fallback reveal if decode stalls
  var TRANSITION_MS     = 1000;   // Swiper crossfade duration
  var AUTOPLAY_DELAY_MS = 4000;   // time each slide is shown
  var KB_KEYFRAMES      = [{ transform: 'scale(1)' }, { transform: 'scale(1.02)' }];
  var KB_ANIM_KEY       = '_kenBurnsAnim';

  function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  }

  // --- Ken Burns helpers ---

  function clearKenBurns(img) {
    if (!img) return;
    var anim = img[KB_ANIM_KEY];
    if (anim) { anim.cancel(); img[KB_ANIM_KEY] = null; }
    img.style.transform = '';
  }

  function startKenBurns(img) {
    if (!img || typeof img.animate !== 'function') return;
    clearKenBurns(img);
    img[KB_ANIM_KEY] = img.animate(KB_KEYFRAMES, {
      duration: AUTOPLAY_DELAY_MS,
      easing: 'ease-out',
      fill: 'forwards',
    });
  }

  function getImg(slideEl) {
    return slideEl ? slideEl.querySelector('img') : null;
  }

  // --- Reveal helpers ---

  function whenImageReady(img, timeout) {
    return new Promise(function (resolve) {
      var done = false;
      function finish() { if (!done) { done = true; resolve(); } }
      setTimeout(finish, timeout);
      if (!img) { finish(); return; }
      if (img.complete && img.naturalWidth > 0) {
        typeof img.decode === 'function' ? img.decode().then(finish, finish) : finish();
        return;
      }
      img.addEventListener('load',  finish, { once: true });
      img.addEventListener('error', finish, { once: true });
    });
  }

  function warmDecodeAll(root) {
    root.querySelectorAll('img').forEach(function (img) {
      if (typeof img.decode === 'function') img.decode().catch(function(){});
    });
  }

  function reveal(root) {
    requestAnimationFrame(function () {
      requestAnimationFrame(function () { root.classList.add(READY_CLASS); });
    });
  }

  // --- Swiper config ---

  function buildConfig(reducedMotion) {
    var on = reducedMotion ? {} : {
      afterInit: function () {
        startKenBurns(getImg(this.slides[this.activeIndex]));
      },
      slideChangeTransitionStart: function () {
        if (this.previousIndex === this.activeIndex) return;
        startKenBurns(getImg(this.slides[this.activeIndex]));
      },
      slideChangeTransitionEnd: function () {
        if (this.previousIndex === this.activeIndex) return;
        clearKenBurns(getImg(this.slides[this.previousIndex]));
      },
    };

    return {
      effect: 'fade',
      fadeEffect: { crossFade: true },
      loop: true,
      slidesPerView: 1,
      speed: TRANSITION_MS,
      autoplay: reducedMotion ? false : {
        delay: AUTOPLAY_DELAY_MS,
        disableOnInteraction: false,
      },
      on: on,
    };
  }

  // --- Init ---

  function initSlider(root) {
    if (typeof Swiper === 'undefined') { reveal(root); return; }
    var reducedMotion = prefersReducedMotion();
    var firstImg = root.querySelector('img');
    warmDecodeAll(root);
    whenImageReady(firstImg, DECODE_TIMEOUT_MS).then(function () {
      new Swiper(root, buildConfig(reducedMotion));
      reveal(root);
    });
  }

  function init() {
    document.querySelectorAll(SLIDER_SELECTOR).forEach(initSlider);
  }

  document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', init)
    : init();
})();
```

### 2. Parallax (Hero Slider)

Moves the slider bleed element upward as the user scrolls, at 25% of scroll speed. GPU-composited via `translate3d` — no paints on scroll. Disabled entirely on mobile.

```js
(function () {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var FACTOR       = 0.25;
  var MOBILE_BP    = 768;

  var sliderBleed  = document.querySelector('.hero__slider-bleed');
  var heroSection  = sliderBleed ? sliderBleed.closest('.hero') : null;
  if (!sliderBleed) return;

  var isMobile     = window.innerWidth <= MOBILE_BP;
  var heroHeight   = heroSection ? heroSection.offsetHeight : 0;
  var ticking      = false;

  function clearTransform() {
    sliderBleed.style.transform = '';
  }

  function update() {
    if (isMobile) { ticking = false; return; }
    var scrollY = window.scrollY;
    if (scrollY <= heroHeight) {
      // translate3d forces GPU compositing — no paint on scroll
      sliderBleed.style.transform = 'translate3d(0, ' + (scrollY * FACTOR) + 'px, 0)';
    }
    ticking = false;
  }

  window.addEventListener('scroll', function () {
    if (ticking) return;
    requestAnimationFrame(update);
    ticking = true;
  }, { passive: true });

  window.addEventListener('resize', function () {
    var wasMobile = isMobile;
    isMobile = window.innerWidth <= MOBILE_BP;
    if (heroSection) heroHeight = heroSection.offsetHeight;
    if (!wasMobile && isMobile) clearTransform();
  }, { passive: true });

  if (isMobile) clearTransform();
  else requestAnimationFrame(update);
})();
```

### 3. Chevron Smooth Scroll + Fade-In Reveal

```js
document.addEventListener('DOMContentLoaded', function () {

  // Smooth scroll on chevron click
  document.querySelectorAll('.js-hero-scroll-next').forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      var href = link.getAttribute('href');
      if (!href || href.indexOf('#') !== 0) return;
      var target = document.querySelector(href);
      if (target) target.scrollIntoView({ behavior: 'smooth' });
    });
  });

  // IntersectionObserver fade-in reveal
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.25 });

  document.querySelectorAll('.fade-in').forEach(function (el) {
    observer.observe(el);
  });

});
```

---

## Performance Notes

| Concern | Solution |
|---|---|
| First image paint | `fetchpriority="high"` on slide 0 |
| Subsequent images | Decode all images eagerly before Swiper init |
| Scroll performance | Single RAF-throttled handler; `translate3d` for GPU compositing |
| Multiple GPU layers | `will-change: transform` only on the active slide's img |
| Reduced motion | Ken Burns + autoplay both disabled via `prefers-reduced-motion` check |
| Mobile battery | Parallax JS disabled at ≤768px; `will-change: auto` on slider bleed |
| Pre-init flash | First slide only shown before Swiper runs; rest hidden with CSS |

---

## Mobile Checklist

- [ ] Slider has a fixed `height: 50vh` (not `100%`) so text band always has room
- [ ] Overlay switches to flat `rgba` — radial gradients can look odd at small sizes
- [ ] All fade-in delays collapse to `0s` — stagger looks laggy on mobile
- [ ] `will-change: auto` and `transform: none` on `.hero__slider-bleed` — no GPU layer for static element
- [ ] Parallax JS short-circuits immediately — no transform applied
- [ ] `<picture>` + `<source media="(max-width: 768px)">` serves a portrait-cropped image
- [ ] Text band `padding-inline` reduces to match your mobile spacing token

---

## Variant Notes

**If you want text overlaid on the image instead of below:**
- Remove `.hero__bottom` / text band structure
- Make `.hero` `position: relative`
- Absolutely position `.hero__content` over the slider with `z-index: 2`
- Switch overlay gradient to cover the bottom of the image where text sits

**If you don't need Ken Burns:**
- Remove the `on:` event handlers from the Swiper config
- Remove the `clearKenBurns` / `startKenBurns` functions entirely

**If you don't need parallax:**
- Remove the parallax IIFE completely
- Remove `will-change: transform` from `.hero__slider-bleed`
