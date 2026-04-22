<?php
/**
 * Admin: assign galleries to the four site slots.
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

	private const SETTINGS_GROUP = 'mci_gallery_placements_group';
	private const MENU_SLUG      = 'mci-gallery-placements';

	/**
	 * Hook registration.
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'register_setting' ) );
		add_action( 'admin_menu', array( $this, 'add_submenu' ) );
	}

	/**
	 * Register the placements option with the Settings API.
	 */
	public function register_setting() {
		register_setting(
			self::SETTINGS_GROUP,
			MCI_Gallery_Constants::PLACEMENTS,
			array(
				'sanitize_callback' => array( $this, 'sanitize' ),
				'default'           => array(),
			)
		);
	}

	/**
	 * Sanitize the placements option: one published gallery ID per slot or 0.
	 *
	 * @param mixed $value Submitted value.
	 * @return array<string, int>
	 */
	public function sanitize( $value ) {
		if ( ! is_array( $value ) ) {
			$value = array();
		}
		$out = array();
		foreach ( MCI_Gallery_Repository::get_slot_keys() as $key ) {
			$id = isset( $value[ $key ] ) ? absint( $value[ $key ] ) : 0;
			if ( $id && 'publish' === get_post_status( $id ) && MCI_Gallery_Constants::POST_TYPE === get_post_type( $id ) ) {
				$out[ $key ] = $id;
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
			self::MENU_SLUG,
			array( $this, 'render_page' )
		);
	}

	/**
	 * Render the settings form.
	 */
	public function render_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$galleries  = $this->get_gallery_choices();
		$placements = get_option( MCI_Gallery_Constants::PLACEMENTS, array() );
		$labels     = MCI_Gallery_Repository::get_slot_labels();
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Gallery placements', 'maria-charalambous-ivanova' ); ?></h1>
			<p class="description">
				<?php esc_html_e( 'Choose which gallery appears in each part of the site. Create galleries under Galleries, then select one here for each slot.', 'maria-charalambous-ivanova' ); ?>
			</p>
			<form method="post" action="options.php">
				<?php settings_fields( self::SETTINGS_GROUP ); ?>
				<table class="form-table" role="presentation">
					<?php foreach ( $labels as $slot => $label ) : ?>
						<?php $selected = isset( $placements[ $slot ] ) ? (int) $placements[ $slot ] : 0; ?>
						<tr>
							<th scope="row">
								<label for="mci-placement-<?php echo esc_attr( $slot ); ?>">
									<?php echo esc_html( $label ); ?>
								</label>
							</th>
							<td>
								<select
									name="<?php echo esc_attr( MCI_Gallery_Constants::PLACEMENTS ); ?>[<?php echo esc_attr( $slot ); ?>]"
									id="mci-placement-<?php echo esc_attr( $slot ); ?>"
								>
									<option value="0"><?php esc_html_e( '— None —', 'maria-charalambous-ivanova' ); ?></option>
									<?php foreach ( $galleries as $g ) : ?>
										<option value="<?php echo esc_attr( (string) $g->ID ); ?>" <?php selected( $selected, (int) $g->ID ); ?>>
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

	/**
	 * List of published gallery posts for the selects.
	 *
	 * @return WP_Post[]
	 */
	private function get_gallery_choices() {
		return get_posts(
			array(
				'post_type'      => MCI_Gallery_Constants::POST_TYPE,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);
	}
}
