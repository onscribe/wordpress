<?php
/**
 * Plugin Name: Onscribe
 * Author: Onscribe
 * Author URI: http://onscri.be/
 *
 * @author Makis Tracend
 * @copyright K&D Interactive Inc., All Rights Reserved
 * This code is released under the GPL license version 3 or later, available here
 * http://www.gnu.org/licenses/gpl.txt
 */

class OnscribeSettings
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page()
	{
		// This page will be under "Settings"
		add_options_page(
			'Settings Admin',
			'Onscribe',
			'manage_options',
			'my-setting-admin',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'my_option_name' );
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>Onscribe Settings</h2>
			<form method="post" action="options.php">
			<?php
				// This prints out all hidden setting fields
				settings_fields( 'my_option_group' );
				do_settings_sections( 'my-setting-admin' );
				submit_button();
			?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init()
	{
		register_setting(
			'onscribe_group', // Option group
			'onscribe', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'onscribe_settings', // ID
			'Onscribe Settings', // Title
			array( $this, 'print_section_info' ), // Callback
			'onscribe-admin' // Page
		);

		add_settings_field(
			'key', // ID
			'API key', // Title
			array( $this, 'onscribe_fields_key' ), // Callback
			'onscribe-admin', // Page
			'onscribe_settings' // Section
		);

		add_settings_field(
			'secret',
			'API secret',
			array( $this, 'onscribe_fields_secret' ),
			'onscribe-admin',
			'onscribe_settings'
		);
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input )
	{
		$new_input = array();
		if( isset( $input['key'] ) )
			$new_input['key'] = absint( $input['key'] );

		if( isset( $input['secret'] ) )
			$new_input['secret'] = sanitize_text_field( $input['secret'] );

		return $new_input;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_info()
	{
		print 'Enter your settings below:';
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function onscribe_fields_key()
	{
		printf(
			'<input type="text" id="onscribe_key" name="onscribe[key]" value="%s" />',
			isset( $this->options['key'] ) ? esc_attr( $this->options['key']) : ''
		);
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function onscribe_fields_secret()
	{
		printf(
			'<input type="text" id="onscribe_secret" name="onscribe[secret]" value="%s" />',
			isset( $this->options['secret'] ) ? esc_attr( $this->options['secret']) : ''
		);
	}
}

if( is_admin() )
	$onscribe_settings = new OnscribeSettings();

?>