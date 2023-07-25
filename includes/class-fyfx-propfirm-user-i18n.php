<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://fundyourfx.com
 * @since      1.0.0
 *
 * @package    Fyfx_Propfirm_User
 * @subpackage Fyfx_Propfirm_User/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Fyfx_Propfirm_User
 * @subpackage Fyfx_Propfirm_User/includes
 * @author     Ardi JM Consulting <ardi@jm-consulting.id>
 */
class Fyfx_Propfirm_User_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'fyfx-propfirm-user',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
