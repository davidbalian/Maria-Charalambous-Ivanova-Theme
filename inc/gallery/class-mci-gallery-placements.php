<?php
/**
 * Admin: assign galleries to the four site sections.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Gallery_Placements
 */
class MCI_Gallery_Placements {

	/**
	 * Hook registration.
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'register_setting' ) );
		add_action( 'admin_menu', array( $this, 'add_submenu' ) );
	}

	/**
	 * Register the placements option.
	 */
	public function register_setting() {
		register_setting(
			'mci_gallery_placements_group',
			MCI_Gallery_Constants::PLACEMENTS,
			array(
				'sanitize_callback' => array( $this, 'sanitize' ),
				'default'         => array(),
			)
		);
	}

	/**
	 * Sanitize option array: one int per slot.
	 *
	 * @param mixed $value Submitted value.
	 * @return array
	 */
	public function sanitize( $value ) {
		if ( ! is_array( $value ) ) {
			$value = array();
		}
		$out   = array();
		$slots = MCI_Gallery_Repository::get_slot_keys();
		foreach ( $slots as $key ) {
			$v = isset( $value[ $key ] ) ? absint( $value[ $key ] ) : 0;
			if ( $v && 'publish' === get_post_status( $v ) && MCI_Gallery_Constants::POST_TYPE === get_post_type( $v ) ) {
				$out[ $key ] = $v;
			} else {
				$out[ $key ] = 0;
			}
		}
		return $out;
	}

	/**
	 * Placements submenu under Galleries.
	 */
	public function add_submenu() {
		add_submenu_page(
			'edit.php?post_type=' . MCI_Gallery_Constants::POST_TYPE,
			__( 'Placements', 'maria-charalambous-ivanova' ),
			__( 'Placements', 'maria-charalambous-ivanova' ),
			'manage_options',
			'mci-gallery-placements',
			array( $this, 'render_page' )
		);
	}

	/**
	 * Settings form.
	 */
	public function render_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$galleries = get_posts(
			array(
				'post_type'      => MCI_Gallery_Constants::POST_TYPE,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);
		$placements = get_option( MCI_Gallery_Constants::PLACEMENTS, array() );
		$labels     = MCI_Gallery_Repository::get_slot_labels();
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Gallery placements', 'maria-charalambous-ivanova' ); ?></h1>
			<p class="description"><?php esc_html_e( 'Choose which gallery album appears in each part of the site. Create albums under Galleries, then select them here.', 'maria-charalambous-ivanova' ); ?></p>
			<form method="post" action="options.php">
				<?php settings_fields( 'mci_gallery_placements_group' ); ?>
				<table class="form-table" role="presentation">
					<?php foreach ( $labels as $slot => $label ) : ?>
						<?php
						$sel = isset( $placements[ $slot ] ) ? (int) $placements[ $slot ] : 0;
						?>
						<tr>
							<th scope="row"><label for="mci-placement-<?php echo esc_attr( $slot ); ?>"><?php echo esc_html( wp_strip_all_tags( $label ) ); ?></label></th>
							<td>
								<select name="<?php echo esc_attr( MCI_Gallery_Constants::PLACEMENTS ); ?>[<?php echo esc_attr( $slot ); ?>]" id="mci-placement-<?php echo esc_attr( $slot ); ?>">
									<option value="0"><?php esc_html_e( '— None —', 'maria-charalambous-ivanova' ); ?></option>
									<?php foreach ( $galleries as $g ) : ?>
										<option value="<?php echo esc_attr( (string) $g->ID ); ?>" <?php selected( $sel, (int) $g->ID ); ?>>
											<?php echo esc_html( $g->post_title ); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
				<?php submit_button( __( 'Save placements', 'maria-charalambous-ivanova' ) ); ?>
			</form>
		</div>
		<?php
	}
}
