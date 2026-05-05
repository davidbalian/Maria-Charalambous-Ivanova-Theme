# How To: Fixed Cookie Consent Banner (Dismissal, Local Storage, Enter/Exit Motion)

A **bottom-corner card** (`role="dialog"`) explaining cookie use with a link to **Privacy Policy**, **Accept** / **Reject** actions, and a **×** dismiss control. Starts **`hidden`**; on first load (no persisted choice) the script removes **`hidden`**, forces a **reflow**, then adds **`is-visible`** so **opacity** and **`translateY`** transition in. Any dismiss path **writes the same consent flag** to **`localStorage`** and hides the banner after **transition completes** (`transitionend`). This pattern is lightweight and **does not differentiate** Accept vs Reject unless you extend the handler (policy/legal alignment is outside this doc).

---

## What It Looks Like

- **Desktop:** **`position: fixed`**, anchored **`bottom/right`** with spacing token, **`max-width` ~420px**, raised surface, border, large shadow.
- **Enter:** Starts **`opacity: 0`** and **`translateY(16px)`**; **`.is-visible`** goes to **`opacity: 1`** / **`translateY(0)`** over ~**0.4s**.
- **Exit:** Removing **`.is-visible`** runs the same transition reversed; **`transitionend`** then sets **`hidden`** so the dialog is **`display: none`** and not keyboard-focusable until next session without storage.
- **Mobile:** **`≤540px`**: stretches **full width minus side margins**, keeps extra **right padding** so copy does not collide with **×**.
- **`×`:** Absolute **top-right** square hit target.

---

## Dependencies

| Piece | Role |
|--------|------|
| **Markup** | Single root **`#…-cookie-banner`**, **`hidden`** by default |
| **CSS** | Fixed layout, **`[hidden]`** rule, **`is-visible`** state |
| **JS** | `DOMContentLoaded` (or equivalent), **`localStorage`**, **`transitionend`** |
| **Privacy route** | `href` to your policy page |

---

## HTML structure (generic)

Place before closing **`body`** hooks so it sits above most content but below modals only if you raise **`z-index`**.

```html
<div id="site-cookie-banner" class="cookie-banner" role="dialog" aria-label="Cookie consent" hidden>
  <button type="button" class="cookie-banner__close" aria-label="Dismiss cookie banner">&times;</button>

  <p class="cookie-banner__text">
    We use cookies to analyse site traffic and improve your experience. By continuing, you agree to our
    <a href="/privacy-policy/">Privacy Policy</a>.
  </p>

  <div class="cookie-banner__actions">
    <button type="button" class="cookie-banner__accept btn btn-primary">Accept</button>
    <button type="button" class="cookie-banner__reject btn btn-outline">Reject</button>
  </div>
</div>
```

- Use one stable **`id`** for `getElementById`.
- **`aria-label`** on the dialog; **`aria-label`** on dismiss.
- Prefer **`ESC` to dismiss** optionally (extend script with `keydown` listener).

---

## CSS (reference)

Root needs **`padding-right`** to reserve space for the absolute close (`calc` spacing + **28px**).

```css
.cookie-banner {
  position: fixed;
  bottom: var(--space-md);
  right: var(--space-md);
  z-index: 9999;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  gap: var(--space-sm);
  max-width: 420px;
  padding: var(--space-md);
  padding-right: calc(var(--space-md) + 28px);
  background: var(--color-surface);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-lg);
  opacity: 0;
  transform: translateY(16px);
  transition:
    opacity 0.4s var(--ease-standard),
    transform 0.4s var(--ease-standard);
}

.cookie-banner[hidden] {
  display: none;
}

.cookie-banner.is-visible {
  opacity: 1;
  transform: translateY(0);
}

.cookie-banner__text {
  flex: 1;
  font-size: 0.8125rem;
  line-height: 1.5;
  color: var(--color-text-muted);
  margin: 0;
}

.cookie-banner__text a {
  color: var(--color-primary);
  text-decoration: underline;
}
.cookie-banner__text a:hover {
  color: var(--color-primary-hover);
}

.cookie-banner__actions {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: var(--space-xs);
}

.cookie-banner__accept,
.cookie-banner__reject {
  font-size: 0.8125rem;
  padding: 8px 20px;
  white-space: nowrap;
}

.cookie-banner__close {
  position: absolute;
  top: var(--space-xs);
  right: var(--space-xs);
  width: 28px;
  height: 28px;
  padding: 0;
  border: none;
  border-radius: var(--radius-sm);
  background: transparent;
  color: var(--color-text-muted);
  font-size: 1.25rem;
  line-height: 1;
  cursor: pointer;
  transition: background 0.2s var(--ease), color 0.2s var(--ease);
}

.cookie-banner__close:hover {
  background: var(--color-bg-subtle);
  color: var(--color-text);
}

@media (max-width: 540px) {
  .cookie-banner {
    left: var(--space-sm);
    right: var(--space-sm);
    max-width: none;
  }
}
```

**`prefers-reduced-motion`:** Optionally force **`transition: none`** on **`.cookie-banner`** and toggle **`is-visible`** without animation.

---

## JavaScript (behavior)

```javascript
document.addEventListener('DOMContentLoaded', function () {
  var banner = document.getElementById('site-cookie-banner');
  var storageKey = 'site_cookies_choice'; // rename per project

  if (!banner || localStorage.getItem(storageKey)) {
    return;
  }

  banner.removeAttribute('hidden');
  banner.offsetHeight; /* reflow: allow display change before transition */
  banner.classList.add('is-visible');

  function dismiss() {
    banner.classList.remove('is-visible');
    banner.addEventListener(
      'transitionend',
      function () {
        banner.setAttribute('hidden', '');
      },
      { once: true }
    );
    localStorage.setItem(storageKey, '1');
  }

  banner.querySelector('.cookie-banner__accept').addEventListener('click', dismiss);
  banner.querySelector('.cookie-banner__close').addEventListener('click', dismiss);

  var reject = banner.querySelector('.cookie-banner__reject');
  if (reject) {
    reject.addEventListener('click', dismiss);
  }
});
```

**Notes**

- **Accept / Reject / ×** intentionally share **`dismiss`** here — both hide the banner and set storage. Split handlers if analytics requires **distinct** rejection or granular consent buckets.
- If **`transitionend`** does not fire (e.g. reduced motion + no transition), **`setHiddenFallback`** **`setTimeout`** after ~**400ms**.
- **`localStorage`** is per-origin; clears if user wipes site data.

---

## Integration checklist

- [ ] Stable **`id`**, **`hidden`**, **`aria-*`**  
- [ ] **`z-index`** above sticky header/footer affordances  
- [ ] **`padding-right`** for close icon  
- [ ] **`transitionend`** + **`hidden`** on exit  
- [ ] **`localStorage`** key namespaced (`project_cookies_accepted`)  
- [ ] Legal review: wording, reject vs accept behavior, geo (GDPR/CCPA tooling if needed)

---

## Related docs

Footer layout often mounts this block next to **`</footer>`** — see **[site-footer.md](./site-footer.md)** for column context. This file describes the banner **standalone** for reuse anywhere in the markup.
