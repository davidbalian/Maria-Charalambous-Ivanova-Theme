/**
 * MCI gallery edit screen — wp.media and ordered items list.
 */
(function (wp) {
	'use strict';

	if (typeof window.wp === 'undefined' || !wp.media) {
		return;
	}

	var $list = jQuery('.mci-gallery-items__list');
	var $input = jQuery('#mci_gallery_items');
	var $addBtn = jQuery('.mci-gallery-items__add');
	var $form = $input.closest('form');

	function readItems() {
		try {
			return JSON.parse($input.val() || '[]') || [];
		} catch (e) {
			return [];
		}
	}

	function writeItems(items) {
		$input.val(JSON.stringify(items));
	}

	function escapeHtml(s) {
		if (!s) {
			return '';
		}
		return String(s)
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;');
	}

	function itemThumbUrl(item) {
		if (item.id && mciAdminGallery.thumbs && mciAdminGallery.thumbs[item.id]) {
			return mciAdminGallery.thumbs[item.id];
		}
		if (item.url) {
			return item.url;
		}
		return '';
	}

	function render() {
		var items = readItems();
		$list.empty();
		items.forEach(function (item, index) {
			var thumb = itemThumbUrl(item);
			var row = jQuery(
				'<li class="mci-gallery-item" data-index="' + index + '">' +
					'<span class="mci-gallery-item__thumb"><img width="60" height="60" alt=""/></span>' +
					'<input type="text" class="mci-gallery-item__alt" placeholder="Alt text" />' +
					'<span class="mci-gallery-item__actions">' +
					'<button type="button" class="button button-small mci-gallery-item__up" aria-label="Move up">↑</button> ' +
					'<button type="button" class="button button-small mci-gallery-item__down" aria-label="Move down">↓</button> ' +
					'<button type="button" class="button button-small mci-gallery-item__remove" aria-label="Remove">×</button>' +
					'</span>' +
				'</li>'
			);
			if (thumb) {
				row.find('img').attr('src', thumb);
			} else {
				row.find('img').attr('src', mciAdminGallery.placeholder);
			}
			row.find('.mci-gallery-item__alt').val(item.alt || '');
			$list.append(row);
		});
	}

	function syncAltsToItems() {
		var items = readItems();
		$list.find('.mci-gallery-item').each(function (i) {
			if (items[i]) {
				items[i].alt = jQuery(this).find('.mci-gallery-item__alt').val() || '';
			}
		});
		writeItems(items);
	}

	$addBtn.on('click', function (e) {
		e.preventDefault();
		var frame = wp.media({
			title: mciAdminGallery.addTitle,
			multiple: true,
			library: { type: 'image' }
		});
		frame.on('select', function () {
			var items = readItems();
			var sel = frame.state().get('selection').toArray();
			sel.forEach(function (a) {
				var att = a.toJSON();
				var id = att.id;
				if (!id) {
					return;
				}
				var alt = att.alt && att.alt.length ? att.alt : (att.title || '');
				var url = att.sizes && att.sizes.thumbnail
					? att.sizes.thumbnail.url
					: (att.url || '');
				items.push({ id: id, url: '', alt: alt });
				if (mciAdminGallery.thumbs) {
					mciAdminGallery.thumbs[id] = url || att.url;
				}
			});
			writeItems(items);
			render();
		});
		frame.open();
	});

	$list.on('input', '.mci-gallery-item__alt', function () {
		syncAltsToItems();
	});

	$list.on('click', '.mci-gallery-item__remove', function (e) {
		e.preventDefault();
		var li = jQuery(this).closest('.mci-gallery-item');
		var idx = parseInt(li.data('index'), 10);
		var items = readItems();
		items.splice(idx, 1);
		writeItems(items);
		render();
	});

	$list.on('click', '.mci-gallery-item__up', function (e) {
		e.preventDefault();
		var li = jQuery(this).closest('.mci-gallery-item');
		var idx = parseInt(li.data('index'), 10);
		if (idx < 1) {
			return;
		}
		syncAltsToItems();
		var items = readItems();
		var t = items[idx - 1];
		items[idx - 1] = items[idx];
		items[idx] = t;
		writeItems(items);
		render();
	});

	$list.on('click', '.mci-gallery-item__down', function (e) {
		e.preventDefault();
		var li = jQuery(this).closest('.mci-gallery-item');
		var idx = parseInt(li.data('index'), 10);
		syncAltsToItems();
		var items = readItems();
		if (idx >= items.length - 1) {
			return;
		}
		var t = items[idx + 1];
		items[idx + 1] = items[idx];
		items[idx] = t;
		writeItems(items);
		render();
	});

	$form.on('submit', function () {
		syncAltsToItems();
	});

	render();
})(window.wp);
