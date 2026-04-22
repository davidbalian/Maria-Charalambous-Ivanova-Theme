/**
 * Admin UI for the Galleries metabox.
 *
 * Opens the WP media modal, appends selected attachments to the grid,
 * supports removing and drag-reordering thumbnails, and keeps a hidden
 * JSON input in sync so the saver can persist the list.
 */
(function ($) {
	'use strict';

	var l10n = window.mciGalleries || {};

	/**
	 * Serialise the DOM grid back into a JSON array on the hidden input.
	 *
	 * @param {jQuery} $root Metabox root element.
	 */
	function syncInput($root) {
		var items = [];
		$root.find('[data-mci-galleries-item]').each(function () {
			var $item = $(this);
			var kind = $item.data('kind');
			if (kind === 'attachment') {
				items.push({ kind: 'attachment', id: parseInt($item.data('id'), 10) || 0 });
			} else if (kind === 'url') {
				items.push({
					kind: 'url',
					url: String($item.data('url') || ''),
					alt: String($item.data('alt') || '')
				});
			}
		});
		$root.find('[data-mci-galleries-input]').val(JSON.stringify(items));
		$root.find('.mci-galleries-empty').toggle(items.length === 0);
	}

	/**
	 * Build an <li> for a given item.
	 *
	 * @param {Object} item { kind, id?, url?, alt?, thumb }
	 * @returns {jQuery}
	 */
	function buildItem(item) {
		var $li = $('<li>', {
			class: 'mci-galleries-item',
			'data-mci-galleries-item': ''
		});
		$li.attr('data-kind', item.kind);
		if (item.kind === 'attachment') {
			$li.attr('data-id', item.id);
		} else {
			$li.attr('data-url', item.url);
			$li.attr('data-alt', item.alt || '');
		}
		$('<img>', { src: item.thumb, alt: '' }).appendTo($li);
		if (item.kind === 'url') {
			$('<span>', { class: 'mci-galleries-item__meta', text: l10n.urlLabel || 'URL' }).appendTo($li);
		}
		$('<button>', {
			type: 'button',
			class: 'mci-galleries-item__remove',
			'aria-label': l10n.removeLabel || 'Remove image',
			html: '&times;'
		}).appendTo($li);
		return $li;
	}

	/**
	 * Open the WP media modal and append selections to the list.
	 *
	 * @param {jQuery} $root Metabox root.
	 */
	function openMediaModal($root) {
		var frame = wp.media({
			title: l10n.modalTitle || 'Select images',
			button: { text: l10n.modalButton || 'Add to gallery' },
			library: { type: 'image' },
			multiple: 'add'
		});

		frame.on('select', function () {
			var $list = $root.find('[data-mci-galleries-list]');
			frame.state().get('selection').each(function (attachment) {
				var data = attachment.toJSON();
				var thumb = data.sizes && data.sizes.medium ? data.sizes.medium.url : data.url;
				$list.append(buildItem({ kind: 'attachment', id: data.id, thumb: thumb }));
			});
			syncInput($root);
		});

		frame.open();
	}

	/**
	 * Wire one metabox root.
	 *
	 * @param {jQuery} $root Metabox root.
	 */
	function initRoot($root) {
		var $list = $root.find('[data-mci-galleries-list]');

		if ($list.sortable) {
			$list.sortable({
				items: '> [data-mci-galleries-item]',
				tolerance: 'pointer',
				forcePlaceholderSize: true,
				placeholder: 'mci-galleries-item mci-galleries-item--placeholder',
				update: function () {
					syncInput($root);
				}
			});
		}

		$root.on('click', '[data-mci-galleries-add]', function (event) {
			event.preventDefault();
			openMediaModal($root);
		});

		$root.on('click', '.mci-galleries-item__remove', function (event) {
			event.preventDefault();
			$(this).closest('[data-mci-galleries-item]').remove();
			syncInput($root);
		});
	}

	$(function () {
		$('[data-mci-galleries]').each(function () {
			initRoot($(this));
		});
	});
})(jQuery);
