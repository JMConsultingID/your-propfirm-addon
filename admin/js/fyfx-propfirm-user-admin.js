(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	// Initially show/hide fields based on selected environment
    showHideFields();

    // Detect changes in the selected environment radio button
    $('input[name="fyfx_your_propfirm_plugin_environment"]').on('change', function() {
        showHideFields();
    });

    function showHideFields() {
        var selectedEnvironment = $('#fyfx_your_propfirm_plugin_selected_environment').val();

        // Hide all fields
        $('.woocommerce-create-user-plugin-field').hide();

        // Show fields based on the selected environment
        if (selectedEnvironment === 'sandbox') {
            $('#fyfx_your_propfirm_plugin_sandbox_endpoint_url').show();
            $('#fyfx_your_propfirm_plugin_sandbox_test_key').show();
        } else if (selectedEnvironment === 'live') {
            $('#fyfx_your_propfirm_plugin_endpoint_url').show();
            $('#fyfx_your_propfirm_plugin_api_key').show();
        }
    }

})( jQuery );
