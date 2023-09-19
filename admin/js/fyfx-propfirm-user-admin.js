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
	jQuery(document).ready(function($) {
    // Saat Quick Edit dipanggil, set value dari custom field "_program_id"
    $('#the-list').on('click', '.editinline', function() {

	        // Ambil row ID dari produk yang sedang diedit
	        var post_id = $(this).closest('tr').attr('id');
	        post_id = post_id.replace("post-", "");

	        // Ambil value dari kolom "Program ID" untuk produk tersebut
	        var program_id = $('#program_id-' + post_id).text();

	        // Set value untuk input field "_program_id" dalam form Quick Edit
	        $(':input[name="_program_id"]').val(program_id);
	    });

	});


})( jQuery );
