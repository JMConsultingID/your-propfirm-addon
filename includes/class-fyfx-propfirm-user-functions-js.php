<?php
// Additional Script Response
function js_script_response() {
    // Display API response header in inspect element
    $current_url = $_SERVER['REQUEST_URI'];
    $enable_response_header = get_option('fyfx_your_propfirm_plugin_enable_response_header');
    if ($enable_response_header && strpos($current_url, '/checkout/order-received/') !== false){
        $order_id = absint(get_query_var('order-received'));
        $api_response = get_post_meta($order_id, 'api_response', true);
        ?>
        <script>
            var apiResponse = <?php echo json_encode($api_response); ?>;
            console.log(apiResponse);
        </script>
        <?php
    }
    elseif ($enable_response_header && strpos($current_url, '/sellkit_step/') !== false && strpos($current_url, '?order-key=wc_order') !== false) {
        $key = isset( $_GET['order-key'] ) ? sanitize_text_field( $_GET['order-key'] ) : false;
        $current_page_id = get_queried_object_id();
        if ( empty( $key ) ) {
            return;
        }
        if ( $key ) {
            $order_id = wc_get_order_id_by_order_key( $key );
        }
        $api_response = get_post_meta($order_id, 'api_response', true);
        ?>
        <script>
            var apiResponse = <?php echo json_encode($api_response); ?>;
            console.log(apiResponse);
        </script>
        <?php
    }
    else{
        return;
    }
}
do_action('hook_js_script_response');
add_action('hook_js_script_response', 'js_script_response');

function run_js_script_response() {
    do_action('hook_js_script_response');
}
add_action('wp_footer', 'run_js_script_response');