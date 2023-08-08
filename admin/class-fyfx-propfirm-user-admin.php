<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://fundyourfx.com
 * @since      1.0.0
 *
 * @package    Fyfx_Propfirm_User
 * @subpackage Fyfx_Propfirm_User/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Fyfx_Propfirm_User
 * @subpackage Fyfx_Propfirm_User/admin
 * @author     Ardi JM Consulting <ardi@jm-consulting.id>
 */
class Fyfx_Propfirm_User_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fyfx_Propfirm_User_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fyfx_Propfirm_User_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fyfx-propfirm-user-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fyfx_Propfirm_User_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fyfx_Propfirm_User_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fyfx-propfirm-user-admin.js', array( 'jquery' ), $this->version, false );

	}

	// Add a custom field to WooCommerce product
	function add_custom_field() {
	    global $product;

	    // Display the custom field on the product edit page
	    woocommerce_wp_text_input(
	        array(
	            'id'          => '_program_id',
	            'label'       => __('Program Id', 'woocommerce'),
	            'placeholder' => __('Enter Program Id value', 'woocommerce'),
	            'desc_tip'    => true,
	            'description' => __('Enter Program Id value here.', 'woocommerce'),
	            'value'       => get_post_meta($product->get_id(), '_program_id', true),
	        )
	    );
	}
	add_action('woocommerce_product_options_general_product_data', 'add_custom_field');

	// Save the custom field value
	function save_custom_field($product_id) {
	    $program_id = sanitize_text_field($_POST['_program_id']);
	    update_post_meta($product_id, '_program_id', $program_id);
	}
	add_action('woocommerce_process_product_meta', 'save_custom_field');

}
