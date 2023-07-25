<?php 
// Fungsi untuk mengirimkan API saat status pesanan berubah dari "On Hold" menjadi "Completed"
function send_api_on_order_status_change($order_id, $old_status, $new_status, $order) {
    // Retrieve endpoint URL and API Key from plugin settings
    $endpoint_url = esc_attr(get_option('fyfx_your_propfirm_plugin_endpoint_url'));
    $api_key = esc_attr(get_option('fyfx_your_propfirm_plugin_api_key'));
    $request_method = get_option('fyfx_your_propfirm_plugin_enable_response_header');

    // Check if endpoint URL and API Key are provided
    if (empty($endpoint_url) || empty($api_key)) {
        return;
    }

    $plugin_enabled = get_option('fyfx_your_propfirm_plugin_enabled');
    if ($plugin_enabled !== 'enable') {
        return;
    }

    if ($old_status === 'on-hold' && $new_status === 'completed') {
        $enable_response_header = get_option('fyfx_your_propfirm_plugin_enable_response_header');
        $user_email = $order->get_billing_email();
        $user_first_name = $order->get_billing_first_name();
        $user_last_name = $order->get_billing_last_name();

        // Set additional user details  
        $user_address = $order->get_billing_address_1();
        $user_city = $order->get_billing_city();
        $user_zip_code = $order->get_billing_postcode();
        $user_country = $order->get_billing_country();
        $user_phone = $order->get_billing_phone();

        // Mendapatkan SKU produk terkait dari pesanan
        $items = $order->get_items();
        $program_id = '';
        foreach ($items as $item) {
            $product = $item->get_product();
            $program_id = $product->get_sku(); // Mendapatkan SKU produk
            break; // Hanya mengambil SKU produk dari item pertama
        }

        $mt_version = $_POST['mt_version'];
        if (!empty($mt_version)){
            $mt_version_value = $mt_version;
        }
        else{
            $mt_version_value = 'MT4';
        }

        $api_data = array(
            'email' => $user_email,
            'firstname' => $user_first_name,
            'lastname' => $user_last_name,
            'programId' => $program_id, // Menggunakan SKU produk sebagai programId            
            'mtVersion' => $mt_version_value,
            'addressLine' => $user_address,
            'city' => $user_city,
            'zipCode' => $user_zip_code,
            'country' => $user_country,
            'phone' => $user_phone
        );

        // Send the API request
        if ($request_method === 'curl') {
            $response = fyfx_your_propfirm_plugin_send_curl_request($endpoint_url, $api_key, $api_data);
            $http_status = $response['http_status'];
            $api_response = $response['api_response'];
        } else {
            $response = fyfx_your_propfirm_plugin_send_wp_remote_post_request($endpoint_url, $api_key, $api_data);
            $http_status = $response['http_status'];
            $api_response = $response['api_response'];
        }    

        if ($http_status == 201) {
            // Jika pengguna berhasil dibuat (kode respons: 201)
            //wc_add_notice('User created successfully.' . $api_response, 'success');
        } elseif ($http_status == 400) {
            // Jika terjadi kesalahan saat membuat pengguna (kode respons: 400)
            $error_message = isset($api_response['error']) ? $api_response['errors'] : 'An error occurred while creating the user. Error Type A.';
            //wc_add_notice($error_message .' '. $api_response, 'error');
        } elseif ($http_status == 409) {
            // Jika terjadi kesalahan saat membuat pengguna (kode respons: 400)
            $error_message = isset($api_response['error']) ? $api_response['errors'] : 'An error occurred while creating the user. Error Type B.';
            //wc_add_notice($error_message .' '. $api_response, 'error');
        } elseif ($http_status == 500) {
            // Jika terjadi kesalahan saat membuat pengguna (kode respons: 400)
            $error_message = isset($api_response['error']) ? $api_response['errors'] : 'An error occurred while creating the user. Error Type C.';
            //wc_add_notice($error_message .' '. $api_response, 'error');
        } else {
            $error_message = isset($api_response['message']) ? $api_response['message'] : 'An error occurred while creating the user. Error Type A.';
            // Menampilkan pemberitahuan umum jika kode respons tidak dikenali
            //wc_add_notice($error_message .' '. $api_response, 'error');
        }

        $api_response_test = $error_message ." Code : ".$http_status ." Message : ".$api_response ;

        // Menyimpan respons API sebagai metadata pesanan
        update_post_meta($order_id, 'api_response',$api_response_test);
    }
}
add_action('woocommerce_order_status_changed', 'send_api_on_order_status_change', 10, 4);