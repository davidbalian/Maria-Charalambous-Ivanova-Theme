/**
 * Gallery CPT edit screen: Media Library picker + ordered items list.
 *
 * Reads/writes a JSON array of { id, url, alt } into #mci_gallery_items.
 */
(function ($, wp) {
	'use strict';

	if (!wp || !wp.media) {
		return;
	}

	var config = window.mciAdminGallery || {};
	var thumbs = config.thumbs || {};
	var strings = config.strings || {};
	var $list, $input, $addBtn, $form, mediaFrame;

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

	function escapeHtml(value) {
		if (!value) {
			return '';
		}
		return String(value)
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;');
	}

	function itemThumbUrl(item) {
		if (item.id && thumbs[item.id]) {
			return thumbs[item.id];
		}
		if (item.url) {
			var urlKey = 'u:' + md5Stub(item.url);
			if (thumbs[urlKey]) {
				return thumbs[urlKey];
			}
			return item.url;
		}
		return config.placeholder || '';
	}

	// Lightweight fallback when md5 is unavailable; matches admin-side key enough
	// for rehydrating thumbs in most cases. If it doesn't match, we fall back to
	// the item URL itself (the admin page then just uses the stored URL).
	function md5Stub(str) {
		var hash = 0;
		for (var i = 0; i < str.length; i++) {
			hash = (hash << 5) - hash + str.charCodeAt(i);
			hash |= 0;
		}
		return String(hash);
	}

	function renderRow(item, index) {
		var thumb = itemThumbUrl(item);
		var alt = escapeHtml(item.alt || '');
		var moveUp = escapeHtml(strings.moveUp || 'Move up');
		var moveDown = escapeHtml(strings.moveDown || 'Move down');
		var removeLbl = escapeHtml(strings.remove || 'Remove');
		var altPh = escapeHtml(strings.altPh || 'Alt text');
		return (
			'<li class="mci-gallery-item" data-index="' + index + '">' +
				'<span class="mci-gallery-item__thumb">' +
					'<img src="' + escapeHtml(thumb) + '" width="60" height="60" alt=""/>' +
				'</span>' +
				'<input type="text" class="mci-gallery-item__alt regular-text" placeholder="' + altPh + '" value="' + alt + '" />' +
				'<span class="mci-gallery-item__actions">' +
					'<button type="button" class="button button-small mci-gallery-item__up" aria-label="' + moveUp + '">&uarr;</button> ' +
					'<button type="button" class="button button-small mci-gallery-item__down" aria-label="' + moveDown + '">&darr;</button> ' +
					'<button type="button" class="button button-small mci-gallery-item__remove" aria-label="' + removeLbl + '">&times;</button>' +
				'</span>' +
			'</li>'
		);
	}

	function render() {
		var items = readItems();
		var html = items.map(renderRow).join('');
		$list.html(html);
	}

	function syncFromDom() {
		var items = readItems();
		$list.find('.mci-gallery-item').each(function (index) {
			var $row = $(this);
			var row = items[index];
			if (!row) {
				return;
			}
			row.alt = $row.find('.mci-gallery-item__alt').val() || '';
		});
		writeItems(items);
	}

	function move(index, delta) {
		var items = readItems();
		var target = index + delta;
		if (target < 0 || target >= items.length) {
			return;
		}
		var tmp = items[index];
		items[index] = items[target];
		items[target] = tmp;
		writeItems(items);
		render();
	}

	function remove(index) {
		var items = readItems();
		items.splice(index, 1);
		writeItems(items);
		render();
	}

	function openMediaLibrary() {
		if (mediaFrame) {
			mediaFrame.open();
			return;
		}
		mediaFrame = wp.media({
			title: config.addTitle || 'Select images',
			library: { type: 'image' },
			multiple: 'add',
			button: { text: config.addTitle || 'Select images' }
		});
		mediaFrame.on('select', function () {
			var selection = mediaFrame.state().get('selection');
			var items = readItems();
			selection.each(function (attachment) {
				var a = attachment.toJSON();
				if (!a || !a.id) {
					return;
				}
				items.push({
					id: parseInt(a.id, 10),
					url: '',
					alt: a.alt || ''
				});
				var sizes = a.sizes || {};
				var thumbUrl = (sizes.thumbnail && sizes.thumbnail.url) || (sizes.medium && sizes.medium.url) || a.url;
				if (thumbUrl) {
					thumbs[a.id] = thumbUrl;
				}
			});
			writeItems(items);
			render();
		});
		mediaFrame.open();
	}

	$(function () {
		$list = $('.mci-gallery-items__list');
		$input = $('#mci_gallery_items');
		$addBtn = $('.mci-gallery-items__add');
		$form = $input.closest('form');
		if (!$list.length || !$input.length) {
			return;
		}

		render();

		$addBtn.on('click', function (e) {
			e.preventDefault();
			openMediaLibrary();
		});

		$list.on('click', '.mci-gallery-item__up', function () {
			var idx = parseInt($(this).closest('.mci-gallery-item').data('index'), 10);
			syncFromDom();
			move(idx, -1);
		});

		$list.on('click', '.mci-gallery-item__down', function () {
			var idx = parseInt($(this).closest('.mci-gallery-item').data('index'), 10);
			syncFromDom();
			move(idx, 1);
		});

		$list.on('click', '.mci-gallery-item__remove', function () {
			var idx = parseInt($(this).closest('.mci-gallery-item').data('index'), 10);
			syncFromDom();
			remove(idx);
		});

		$list.on('input', '.mci-gallery-item__alt', function () {
			syncFromDom();
		});

		if ($form.length) {
			$form.on('submit', syncFromDom);
		}
	});
})(jQuery, window.wp);
