# Gallery Location-Keyed CPT — Handoff Guide

Editors manage reusable image galleries in **wp-admin**. Each gallery post is tagged with a **location** (slot). On the frontend, templates ask for images by location; the backend returns **one canonical gallery per slot** — the **most recently published** post assigned to that slot. This pattern does **not** require ACF: it uses a private custom post type, classic metaboxes, and `post_meta` for storage.

---

## Registered slots (as of this writing)

| Location slug | Admin label | Where it renders |
|---|---|---|
| `home_before_after` | Home: Before & After | `template-parts/gallery/section-home-before-after.php` |
| `home_clinic` | Home: The Clinic | `template-parts/gallery/section-home-clinic.php` |
| `page_before_after` | Gallery page: Before & After | `template-parts/gallery/section-page-before-after.php` |
| `page_clinic` | Gallery page: The Clinic | `template-parts/gallery/section-page-clinic.php` |
| `smilers_dual` | Home & Services: Smilers — companion images | `template-parts/services-smilers-dual-gallery.php` (included from `services-smilers-row.php` and `home-v2/comprehensive-services.php`) |

---

## File map

| Responsibility | File |
|---|---|
| Location slug constants + `all()` registry | `inc/galleries/class-mci-galleries-locations.php` |
| Post type registration | `inc/galleries/class-mci-galleries-post-type.php` |
| Meta key + nonce constants | `inc/galleries/class-mci-galleries-constants.php` |
| Metabox registration (wires renderer + saver) | `inc/galleries/class-mci-galleries-metabox.php` |
| Metabox HTML rendering | `inc/galleries/class-mci-galleries-metabox-renderer.php` |
| Metabox save logic | `inc/galleries/class-mci-galleries-metabox-saver.php` |
| Admin JS (media modal, sortable, hidden input sync) | `assets/js/admin-mci-galleries.js` |
| Admin CSS | `assets/css/admin-mci-galleries.css` |
| Admin asset enqueueing | `inc/galleries/class-mci-galleries-admin-assets.php` |
| Admin list-table columns | `inc/galleries/class-mci-galleries-admin-columns.php` |
| Frontend image resolver | `inc/galleries/class-mci-galleries-repository.php` |
| Image value object (attachment → row mapping) | `inc/galleries/class-mci-galleries-image.php` |
| Default seed data (placeholder URLs) | `inc/galleries/class-mci-galleries-default-data.php` |
| One-time seeder (creates gallery posts on first run) | `inc/galleries/class-mci-galleries-seeder.php` |
| Bootstrap (loads all files, wires hooks) | `inc/galleries/bootstrap.php` |

---

## How to add a new gallery slot — exact steps

Follow all five steps; skipping any one will cause images to not appear on the frontend.

### Step 1 — Register the slug in `MCI_Galleries_Locations`

In `inc/galleries/class-mci-galleries-locations.php`, add a constant and an entry in `all()`:

```php
const MY_NEW_SLOT = 'my_new_slot';

public static function all() {
    return array(
        // ... existing entries ...
        self::MY_NEW_SLOT => __( 'Descriptive admin label', 'maria-charalambous-ivanova' ),
    );
}
```

This makes the slug valid (`is_valid()` passes) **and** adds it to the Location dropdown in the metabox.

### Step 2 — Add a definition in `MCI_Galleries_Default_Data`

In `inc/galleries/class-mci-galleries-default-data.php`, add an entry to `definitions()`:

```php
MCI_Galleries_Locations::MY_NEW_SLOT => array(
    'title' => __( 'Internal gallery title', 'maria-charalambous-ivanova' ),
    'items' => array(), // or pre-populate with URL items for a starter state
),
```

This is what the seeder uses to create the gallery post on the site. **Without this entry the gallery post will never be created automatically.** `items` can be empty if the admin will fill in images manually, or pre-filled with `['url' => '...', 'alt' => '...']` entries.

### Step 3 — The seeder runs automatically; nothing else needed in PHP

`MCI_Galleries_Seeder::maybe_seed()` runs on `admin_init`. It loops over every location in `Default_Data::definitions()` and creates a gallery post for any location that does not already have one. The next admin page load will create the new post.

No separate bootstrap class, no extra hook — the seeder owns all slot creation.

### Step 4 — Write the frontend template

Call the repository and render images:

```php
$items = MCI_Galleries_Repository::get_items_for_location( MCI_Galleries_Locations::MY_NEW_SLOT );
if ( empty( $items ) ) {
    return; // render nothing until the admin fills in images
}
foreach ( $items as $row ) {
    $src = '' !== $row['thumb_url'] ? $row['thumb_url'] : $row['url'];
    // render <img src="..."> using esc_url( $src ), esc_attr( $row['alt'] ), etc.
}
```

Each `$row` has: `url`, `thumb_url`, `alt`, `width`, `height`.

### Step 5 — Include the template from the relevant page template

Wire the template part into the appropriate page template or section partial.

---

## Seeder — how it works and why it matters

`MCI_Galleries_Seeder::maybe_seed()` uses **per-location idempotency**:

1. Reads a WordPress option (`mci_galleries_seeded_locations_v1`) that stores an array of location slugs that have already been seeded.
2. For each location in `Default_Data::definitions()`:
   - If the slug is already in the seeded array → skip.
   - If any gallery post (any non-trash status) already has that location → mark as seeded, skip.
   - Otherwise → create the gallery post, mark as seeded.
3. Saves the updated seeded array back to the option.

**Effect:** every slot in `Default_Data::definitions()` gets exactly one gallery post created — no matter how many times `admin_init` fires or whether the site is new or existing. Adding a new slug to definitions + running any admin page is enough to provision the post.

**Migration note:** sites that ran the original seeder (which used a global boolean flag `mci_galleries_seeded_v1`) are migrated automatically — the seeder marks the original four locations as already-seeded on first run with the new code.

---

## Common pitfalls

### Do NOT create a separate "slot bootstrap" class

The previous implementation had `MCI_Galleries_Smilers_Dual_Slot_Bootstrap` — a one-off class that ran on every `admin_init` and created an empty `smilers_dual` post if none existed. It was removed because it caused these bugs:

- **Silent recreation after trash.** WP's `post_status => 'any'` excludes trash. Trashing the gallery post (or accidentally clearing its Location dropdown, which deletes `_mci_gallery_location` meta) made the bootstrap think no post existed and create a new empty one. The repository's "newest published wins" then returned the empty post instead of the user's edited one, so images never appeared on the frontend.
- **No default content.** The bootstrap created an empty post. The other four galleries had placeholder URL items as starting content. The inconsistency made smilers behave differently in the admin.

**The correct pattern:** add the slot to `Default_Data::definitions()` (Step 2). The seeder handles creation, with safe idempotency.

### Do NOT add a new slot only to `MCI_Galleries_Locations`

Just adding the slug constant and `all()` entry makes the dropdown show the option, but the gallery post is never created. The seeder won't create it unless the location is also in `Default_Data::definitions()`. The frontend will always receive an empty array.

### Clearing the Location dropdown deletes meta

`MCI_Galleries_Metabox_Saver::save_location()` calls `delete_post_meta` when the Location dropdown submits an empty value. If an admin accidentally selects "— None —" and clicks Update, the gallery post's location meta is removed. The repository can no longer find the post. To recover, reopen the post and re-select the correct location.

### Multiple posts for the same location

The repository uses `orderby => date, order => DESC, posts_per_page => 1` — the **newest published** gallery post wins. If two posts share the same location slug, the older one is silently ignored. If the wrong post (e.g. an empty auto-created one) has a newer date, it will render empty. Fix: check **Galleries → All Galleries** admin list, look at the Location column, trash any duplicate empty posts for the same slot.

---

## Data model

**Meta keys** (defined in `MCI_Galleries_Constants`):

| Constant | Meta key | Value |
|---|---|---|
| `META_LOCATION` | `_mci_gallery_location` | String slug, e.g. `smilers_dual` |
| `META_IMAGES` | `_mci_gallery_images` | Serialized PHP array of item objects |

**Stored item shapes:**

```json
// Media Library attachment
{ "kind": "attachment", "id": 12345 }

// Raw URL (seed data, CDN, etc.)
{ "kind": "url", "url": "https://…/image.webp", "alt": "Description" }
```

**Normalized row** (what templates receive from `MCI_Galleries_Repository`):

| Field | Attachment | URL item |
|---|---|---|
| `url` | `wp_get_attachment_image_src( $id, 'large' )[0]` | `url` from meta |
| `thumb_url` | `wp_get_attachment_image_src( $id, 'medium_large' )[0]` | Same as `url` |
| `alt` | `_wp_attachment_image_alt` | `alt` from meta |
| `width` | From `large` dimensions | `0` |
| `height` | From `large` dimensions | `0` |

---

## Frontend resolver

`MCI_Galleries_Repository::get_items_for_location( $slug )` — static, per-request memoized. Takes a location slug, returns an array of normalized rows (empty array if none). Safe to call multiple times on the same request; the WP_Query only runs once per slug.

---

## Security checklist (save_post)

- Return early on `DOING_AUTOSAVE`.
- Verify nonce (`mci_galleries_save` action, `mci_galleries_nonce` field).
- Check `current_user_can( 'edit_post', $post_id )`.
- Location: validate against `MCI_Galleries_Locations::is_valid()`; otherwise `delete_post_meta`.
- Images: `json_decode`, then per-item: cast `id` to int (attachment) or `esc_url_raw` the URL; drop malformed entries.

---

## Admin UI notes

- The **nonce field** is rendered by the Location metabox renderer. The save guard checks for this nonce before writing any meta. If the user hides the Location metabox via Screen Options, the nonce is absent and **neither** location nor images will save. Keep both metaboxes visible.
- The Images metabox hidden input (`[data-mci-galleries-input]`) is kept in sync by `assets/js/admin-mci-galleries.js` via `syncInput()` — it fires on media modal select, thumbnail remove, and sortable drag. If JavaScript is disabled or broken, the input retains its last serialized value (or the initial value from PHP on page load, which is the already-saved state).

---

## Extending slots — quick checklist

- [ ] Add constant + `all()` entry to `MCI_Galleries_Locations`
- [ ] Add definition (title + items) to `MCI_Galleries_Default_Data::definitions()`
- [ ] Load any WP admin page to trigger the seeder (creates the gallery post)
- [ ] Write a frontend template calling `MCI_Galleries_Repository::get_items_for_location()`
- [ ] Wire the template part into the page template or section partial
- [ ] In WP admin, open the new gallery post, add images, click Update
- [ ] Verify the frontend renders them
