<?php
/**
 * WhatsApp chat link helpers (same number as clinic phone).
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * E.164 digits only (no +), for wa.me links.
 */
function mci_whatsapp_phone_digits() {
	return '35725377757';
}

/**
 * Full https://wa.me/ URL for opening a chat.
 */
function mci_whatsapp_chat_url() {
	return 'https://wa.me/' . mci_whatsapp_phone_digits();
}

/**
 * Human-readable number for display (matches header / contact).
 */
function mci_whatsapp_phone_display() {
	return '+357 25 377757';
}
