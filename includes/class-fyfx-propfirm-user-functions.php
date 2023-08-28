<?php
// Add plugin settings page
function fyfx_your_propfirm_plugin_settings_page() {
    add_menu_page(
        'YPF z',                // Judul pada menu utama
        'YPF Plugin',                // Judul pada menu utama
        'manage_options',            // Capability yang dibutuhkan untuk mengakses menu
        'ypf_plugin',                // Slug menu utama
        'ypf_plugin_settings_page_content', // Callback function untuk halaman konten
        'dashicons-buddicons-replies',    // Ikona menu (Anda dapat mengganti dengan ikon lain)
        45                           // Urutan di dalam menu
    );

    add_submenu_page(
        'ypf_plugin',    // Slug menu utama ('jm_autocomplete_plugin' dari menu utama di atas)
        'YPF Woocommerce',      // Judul submenu
        'YPF Contact Form',      // Judul submenu
        'manage_options',            // Capability yang dibutuhkan untuk mengakses submenu
        'fyfx_your_propfirm_plugin', // Slug submenu
        'fyfx_your_propfirm_plugin_settings_page_content' // Callback function untuk halaman konten submenu
    );

    add_submenu_page(
        'ypf_plugin',    // Slug menu utama ('jm_autocomplete_plugin' dari menu utama di atas)
        'YPF Contact Form',      // Judul submenu
        'YPF Contact Form',      // Judul submenu
        'manage_options',            // Capability yang dibutuhkan untuk mengakses submenu
        'fyfx_your_propfirm_plugin_contact_form', // Slug submenu
        'fyfx_your_propfirm_plugin_contact_form_content' // Callback function untuk halaman konten submenu
    );
}

add_action('admin_menu', 'fyfx_your_propfirm_plugin_settings_page');

// Render settings dashboard page content
function ypf_plugin_settings_page_content() {
    ?>
    <div class="wrap">
        <h2>Dashboard YPF Plugin</h2>        
    </div>
    <?php
}

// Render settings form contact page content
function fyfx_your_propfirm_plugin_contact_form_content() {
    ?>
    <div class="wrap">
        <h2>YourPropfirm Contact Form Plugin Settings</h2>
    </div>
    <?php
}

// Render settings page content
function fyfx_your_propfirm_plugin_settings_page_content() {
    ?>
    <div class="wrap">
        <h2>YourPropfirm Woocommerce Plugin Settings</h2>
        <form method="post" action="options.php">
            <?php
                settings_fields('fyfx_your_propfirm_plugin_settings');
                do_settings_sections('fyfx_your_propfirm_plugin_settings');
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Add plugin settings fields
function fyfx_your_propfirm_plugin_settings_fields() {
    add_settings_section(
        'fyfx_your_propfirm_plugin_general',
        'General Settings',
        'fyfx_your_propfirm_plugin_general_section_callback',
        'fyfx_your_propfirm_plugin_settings'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_enabled',
        'Enable Plugin',
        'fyfx_your_propfirm_plugin_enabled_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_environment',
        'Environment',
        'fyfx_your_propfirm_plugin_environment_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_sandbox_endpoint_url',
        'Sandbox Endpoint URL',
        'fyfx_your_propfirm_plugin_sandbox_endpoint_url_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_sandbox_test_key',
        'Sandbox Test Key',
        'fyfx_your_propfirm_plugin_sandbox_test_key_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_endpoint_url',
        'Live Endpoint URL',
        'fyfx_your_propfirm_plugin_endpoint_url_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_api_key',
        'Live API Key',
        'fyfx_your_propfirm_plugin_api_key_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_checkout_form',
        'Checkout Form',
        'fyfx_your_propfirm_plugin_checkout_form_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );    

    add_settings_field(
        'fyfx_your_propfirm_plugin_sellkit_option',
        'SellKit Option',
        'fyfx_your_propfirm_plugin_sellkit_option_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_default_mt_version_field',
        'Select Default MT Version Field',
        'fyfx_your_propfirm_plugin_default_mt_version_field_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_mt_version_field',
        'Enable MT Version Field (On Checkout Page)',
        'fyfx_your_propfirm_plugin_mt_version_field_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_request_method',
        'Request Method',
        'fyfx_your_propfirm_plugin_request_method_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_enable_response_header',
        'Display Response Header in Console Log',
        'fyfx_your_propfirm_plugin_enable_response_header_callback',
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_general'
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_enabled',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_environment',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_sandbox_endpoint_url'
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_sandbox_test_key'
    );


    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_endpoint_url'
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_api_key'
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_checkout_form',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'woocommerce_form'
        )
    );    

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_sellkit_option',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'sellkit_billing'
        )
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_default_mt_version_field',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'MT4'
        )
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_mt_version_field',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'disable'
        )
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_request_method',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'wp_remote_post'
        )
    );

    register_setting(
        'fyfx_your_propfirm_plugin_settings',
        'fyfx_your_propfirm_plugin_enable_response_header'
    );
}
add_action('admin_init', 'fyfx_your_propfirm_plugin_settings_fields');

// Render enable plugin field
function fyfx_your_propfirm_plugin_enabled_callback() {
    $plugin_enabled = get_option('fyfx_your_propfirm_plugin_enabled');
    ?>
    <select name="fyfx_your_propfirm_plugin_enabled">
        <option value="enable" <?php selected($plugin_enabled, 'enable'); ?>>Enabled</option>
        <option value="disable" <?php selected($plugin_enabled, 'disable'); ?>>Disabled</option>
    </select>
    <?php
}

// Render environment field
function fyfx_your_propfirm_plugin_environment_callback() {
    $environment = get_option('fyfx_your_propfirm_plugin_environment');
    if (empty($environment)) {
        $environment = 'sandbox'; // Set default value to 'sandbox'
    }
    ?>
    <label width="100px">
        <input type="radio" name="fyfx_your_propfirm_plugin_environment" value="sandbox" <?php checked($environment, 'sandbox'); ?> />
        Sandbox Version
    </label>
    <label width="100px">
        <input type="radio" name="fyfx_your_propfirm_plugin_environment" value="live" <?php checked($environment, 'live'); ?> />
        Live Version
    </label>

    <?php
}

// Render sandbox endpoint URL field
function fyfx_your_propfirm_plugin_sandbox_endpoint_url_callback() {
    $sandbox_endpoint_url = get_option('fyfx_your_propfirm_plugin_sandbox_endpoint_url');
    echo '<div class="sandbox-fields">';
    echo '<input type="text" name="fyfx_your_propfirm_plugin_sandbox_endpoint_url" value="' . $sandbox_endpoint_url . '" style="width: 400px;" />';
    echo '</div>';
}

// Render sandbox test key field
function fyfx_your_propfirm_plugin_sandbox_test_key_callback() {
    $sandbox_test_key = get_option('fyfx_your_propfirm_plugin_sandbox_test_key');
    echo '<div class="sandbox-fields">';
    echo '<input type="text" name="fyfx_your_propfirm_plugin_sandbox_test_key" value="' . $sandbox_test_key. '" style="width: 400px;" />';
    echo '</div>';
}


// Render endpoint URL field
function fyfx_your_propfirm_plugin_endpoint_url_callback() {
    $endpoint_url = esc_attr(get_option('fyfx_your_propfirm_plugin_endpoint_url'));
    echo '<div class="live-fields">';
    echo '<input type="text" name="fyfx_your_propfirm_plugin_endpoint_url" value="' . $endpoint_url . '" style="width: 400px;" />';
    echo '</div>';
}

// Render API Key field
function fyfx_your_propfirm_plugin_api_key_callback() {
    $api_key = esc_attr(get_option('fyfx_your_propfirm_plugin_api_key'));
    echo '<div class="live-fields">';
    echo '<input type="text" name="fyfx_your_propfirm_plugin_api_key" value="' . $api_key . '" style="width: 400px;" />';
    echo '</div>';
}

// Render checkout form field
function fyfx_your_propfirm_plugin_checkout_form_callback() {
    $checkout_form = get_option('fyfx_your_propfirm_plugin_checkout_form');
    ?>
    <select name="fyfx_your_propfirm_plugin_checkout_form">
        <option value="woocommerce_form" <?php selected($checkout_form, 'woocommerce_form'); ?>>WooCommerce Checkout Form</option>
        <option value="sellkit_form" <?php selected($checkout_form, 'sellkit_form'); ?>>SellKit Checkout Form</option>
        <option value="disable" <?php selected($checkout_form, 'disable'); ?>>Disable</option>
    </select>
    <?php
}

// Render sellkit option field
function fyfx_your_propfirm_plugin_sellkit_option_callback() {
    $checkout_form = get_option('fyfx_your_propfirm_plugin_checkout_form');
    $sellkit_option = get_option('fyfx_your_propfirm_plugin_sellkit_option');
    if ($checkout_form === 'sellkit_form') {
        ?>
        <select name="fyfx_your_propfirm_plugin_sellkit_option">
            <option value="sellkit_billing" <?php selected($sellkit_option, 'sellkit_billing'); ?>>SellKit Billing</option>
            <option value="sellkit_shipping" <?php selected($sellkit_option, 'sellkit_shipping'); ?>>SellKit Shipping</option>
        </select>
        <?php
    } else {
        echo 'N/A';
    }
}

// Render Default MT Version form field
function fyfx_your_propfirm_plugin_default_mt_version_field_callback() {
    $default_mt = get_option('fyfx_your_propfirm_plugin_default_mt_version_field');
    ?>
    <select name="fyfx_your_propfirm_plugin_default_mt_version_field">
        <option value="MT4" <?php selected($default_mt, 'MT4'); ?>>MT4 Version</option>
        <option value="MT5" <?php selected($default_mt, 'MT5'); ?>>MT5 Version</option>
    </select>
    <?php
}

// Render sellkit option field
function fyfx_your_propfirm_plugin_mt_version_field_callback() {
    $checkout_form = get_option('fyfx_your_propfirm_plugin_checkout_form');
    $mt_version_field = get_option('fyfx_your_propfirm_plugin_mt_version_field');
    if ($checkout_form !== 'disable') {
        ?>
        <select name="fyfx_your_propfirm_plugin_mt_version_field">
            <option value="enable" <?php selected($mt_version_field, 'enable'); ?>>Enable</option>
            <option value="disable" <?php selected($mt_version_field, 'disable'); ?>>Disable</option>
        </select>
        <?php
    } else {
        echo 'N/A';
    }
}

// Render request method field
function fyfx_your_propfirm_plugin_request_method_callback() {
    $request_method = get_option('fyfx_your_propfirm_plugin_request_method');
    ?>
    <select name="fyfx_your_propfirm_plugin_request_method">
        <option value="curl" <?php selected($request_method, 'curl'); ?>>CURL</option>
        <option value="wp_remote_post" <?php selected($request_method, 'wp_remote_post'); ?>>WP REMOTE POST</option>
    </select>
    <?php
}

// Render enable response header field
function fyfx_your_propfirm_plugin_enable_response_header_callback() {
    $enable_response_header = get_option('fyfx_your_propfirm_plugin_enable_response_header');
    ?>
    <label>
        <input type="radio" name="fyfx_your_propfirm_plugin_enable_response_header" value="1" <?php checked($enable_response_header, 1); ?> />
        Yes
    </label>
    <label>
        <input type="radio" name="fyfx_your_propfirm_plugin_enable_response_header" value="0" <?php checked($enable_response_header, 0); ?> />
        No
    </label>
    <?php
}

// Render general settings section callback
function fyfx_your_propfirm_plugin_general_section_callback() {
    echo 'Configure the general settings for YourPropfirm User Plugin.';
}

// Fungsi untuk menambahkan bidang kustom ke dalam formulir checkout
// function add_custom_checkout_field($fields) {
//     $fields['billing']['mt_version'] = array(
//         'type' => 'select',
//         'label' => __('MT Version', 'woocommerce'),
//         'required' => true,
//         'class' => array('form-row-wide'),
//         'options' => array(
//             '' => __('Pilih MT Version', 'woocommerce'),
//             'MT4' => __('MT Version 4', 'woocommerce'),
//             'MT5' => __('MT Version 5', 'woocommerce')
//         )
//     );

//     return $fields;
// }
// add_filter('sellkit_checkout_billing_fields', 'add_custom_checkout_field');


// Pastikan script ini ditempatkan dalam file functions.php tema aktif Anda di WordPress

// Add custom field to checkout page
function fyfx_your_propfirm_plugin_add_custom_field($fields) {
    $plugin_enabled = get_option('fyfx_your_propfirm_plugin_enabled');
    if ($plugin_enabled !== 'enable') {
        return $fields;
    }
    $checkout_form = get_option('fyfx_your_propfirm_plugin_checkout_form');
    $mt_version_field = get_option('fyfx_your_propfirm_plugin_mt_version_field');

    if ($checkout_form === 'woocommerce_form' && $mt_version_field !== 'disable') {
        $fields['billing']['mt_version'] = array(
            'type' => 'select',
            'label' => 'MetaTrader Version',
            'options' => array(
                'MT4' => 'MetaTrader Version 4',
                'MT5' => 'MetaTrader Version 5'
            ),
            'required' => true,
            'class' => array('form-row-wide'),
            'clear' => true
        );
    }

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'fyfx_your_propfirm_plugin_add_custom_field');

// Fungsi untuk menampilkan select option MT Version setelah hook woocommerce_before_checkout_shipping_form
function display_custom_field_after_shipping_form() {
    $plugin_enabled = get_option('fyfx_your_propfirm_plugin_enabled');
    if ($plugin_enabled !== 'enable') {
        return;
    }
    $checkout_form = get_option('fyfx_your_propfirm_plugin_checkout_form');
    $sellkit_option = get_option('fyfx_your_propfirm_plugin_sellkit_option');
    $mt_version_field = get_option('fyfx_your_propfirm_plugin_mt_version_field');

    if ($checkout_form !== 'woocommerce_form' && $sellkit_option === 'sellkit_shipping' && $mt_version_field !== 'disable') {
        ?>
        <div class="custom-field">
            <?php
            woocommerce_form_field('mt_version', array(
                'type' => 'select',
                'class' => array('form-row-wide'),
                'label' => __('MetaTrader Version', 'woocommerce'),
                'required' => true,
                'options' => array(
                    'MT4' => __('MetaTrader Version 4', 'woocommerce'),
                    'MT5' => __('MetaTrader Version 5', 'woocommerce')
                )
            ), '');
            ?>
        </div>
        <?php
    }
}
add_action('woocommerce_after_checkout_shipping_form', 'display_custom_field_after_shipping_form');

// Fungsi untuk menampilkan select option MT Version setelah hook woocommerce_before_checkout_billing_form
function display_custom_field_after_billing_form() {
    $plugin_enabled = get_option('fyfx_your_propfirm_plugin_enabled');
    if ($plugin_enabled !== 'enable') {
        return;
    }
    $checkout_form = get_option('fyfx_your_propfirm_plugin_checkout_form');
    $sellkit_option = get_option('fyfx_your_propfirm_plugin_sellkit_option');
    $mt_version_field = get_option('fyfx_your_propfirm_plugin_mt_version_field');

    if ($checkout_form !== 'woocommerce_form' && $sellkit_option === 'sellkit_billing' && $mt_version_field !== 'disable') {
        ?>
        <div class="custom-field">
            <?php
            woocommerce_form_field('mt_version', array(
                'type' => 'select',
                'class' => array('form-row-wide'),
                'label' => __('MetaTrader Version', 'woocommerce'),
                'required' => true,
                'options' => array(
                    'MT4' => __('MetaTrader Version 4', 'woocommerce'),
                    'MT5' => __('MetaTrader Version 5', 'woocommerce')
                )
            ), '');
            ?>
        </div>
        <?php
    }
}
add_action('woocommerce_after_checkout_billing_form', 'display_custom_field_after_billing_form');


// Create user via API when successful payment is made
function send_api_on_order_status_change($order_id, $old_status, $new_status, $order) {
    // Retrieve endpoint URL and API Key from plugin settings
    $request_method = get_option('fyfx_your_propfirm_plugin_enable_response_header');
    $default_mt = get_option('fyfx_your_propfirm_plugin_default_mt_version_field');

    $plugin_enabled = get_option('fyfx_your_propfirm_plugin_enabled');
    if ($plugin_enabled !== 'enable') {
        return;
    }

    // Check the selected environment
    $environment = get_option('fyfx_your_propfirm_plugin_environment');
    if ($environment === 'sandbox') {
        // Perform actions for Sandbox Environment
        $endpoint_url = esc_attr(get_option('fyfx_your_propfirm_plugin_sandbox_endpoint_url'));
        $api_key = esc_attr(get_option('fyfx_your_propfirm_plugin_sandbox_test_key'));
    } else {
        // Perform actions for Live Environment
        $endpoint_url = esc_attr(get_option('fyfx_your_propfirm_plugin_endpoint_url'));
        $api_key = esc_attr(get_option('fyfx_your_propfirm_plugin_api_key'));
    }

    // Check if endpoint URL and API Key are provided
    if (empty($endpoint_url) || empty($api_key)) {
        return;
    }

    if ($new_status == 'completed' && $old_status != 'completed') {
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
            $get_program_id = get_post_meta($product->get_id(), '_program_id', true);
            $sku_product = $product->get_sku();
            if (!empty($get_program_id)) {
                $program_id = $get_program_id;
            } elseif (!empty($sku_product)) {
                $program_id = $sku_product; // Mendapatkan SKU produk
            } else{
                $program_id = '000-000';
            }
            break; // Hanya mengambil SKU produk dari item pertama
        }

        $mt_version = $_POST['mt_version'];
        if (!empty($mt_version)){
            $mt_version_value = $mt_version;
        }
        else{
            if (!empty($default_mt)){
                $mt_version_value = $default_mt;
            }
            else{
                $mt_version_value = 'MT4';
            }
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
            $error_message = isset($api_response['error']) ? $api_response['errors'] : 'An error occurred while creating the user. Error Type 400.';
            //wc_add_notice($error_message .' '. $api_response, 'error');
        } elseif ($http_status == 409) {
            // Jika terjadi kesalahan saat membuat pengguna (kode respons: 400)
            $error_message = isset($api_response['error']) ? $api_response['errors'] : 'An error occurred while creating the user. Error Type 409.';
            //wc_add_notice($error_message .' '. $api_response, 'error');
        } elseif ($http_status == 500) {
            // Jika terjadi kesalahan saat membuat pengguna (kode respons: 400)
            $error_message = isset($api_response['error']) ? $api_response['errors'] : 'An error occurred while creating the user. Error Type 500.';
            //wc_add_notice($error_message .' '. $api_response, 'error');
        } else {
            $error_message = isset($api_response['error']) ? $api_response['errors'] : 'An error occurred while creating the user. Error Type Unknown.';
            // Menampilkan pemberitahuan umum jika kode respons tidak dikenali
            //wc_add_notice($error_message .' '. $api_response, 'error');
        }

        $api_response_test = $error_message ." Code : ".$http_status ." Message : ".$api_response ;
        $key_url = $endpoint_url . " - " .$api_key;
        
        // Menyimpan respons API sebagai metadata pesanan
        update_post_meta($order_id, 'api_response',$api_response_test);
        update_post_meta($order_id, 'api_response_key',$key_url);
        update_post_meta($order_id, 'api_program_id',$get_program_id);
    }
}
add_action('woocommerce_order_status_changed', 'send_api_on_order_status_change', 10, 4);

// Send API request using CURL
function fyfx_your_propfirm_plugin_send_curl_request($endpoint_url, $api_key, $api_data) {
     // Mengirim data ke API menggunakan cURL
    $api_url = $endpoint_url;
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
        'X-Client-Key: '.$api_key
    );

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");        
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($api_data));        
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Mendapatkan kode stat
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE); // Mendapatkan ukuran header
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_close($ch);

    // Menggunakan respons dari API jika diperlukan
    $api_response = substr($response, $header_size);

    return array(
        'http_status' => $http_status,
        'api_response' => $api_response
    );
}

function fyfx_your_propfirm_plugin_send_wp_remote_post_request($endpoint_url, $api_key, $api_data) {
    // Mengirim data ke API menggunakan WP_REMOTE_POST
    $api_url = $endpoint_url;
    $headers = array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'X-Client-Key' => $api_key
    );

    $response = wp_remote_post(
        $api_url,
        array(
            'timeout' => 30,
            'redirection' => 5,
            'headers' => $headers,            
            'body' => json_encode($api_data)
        )
    );

    $http_status = wp_remote_retrieve_response_code($response);
    $api_response = wp_remote_retrieve_body($response);

    return array(
        'http_status' => $http_status,
        'api_response' => $api_response
    );
}   

// Menampilkan pemberitahuan pada halaman "Thank You"
function display_order_notices() {
    wc_print_notices();
}
add_action('woocommerce_thankyou', 'display_order_notices');

// Menambahkan data respons API ke halaman "Thank You"
function add_api_response_js_to_thankyou_page() {
    // Display API response header in inspect element
    $checkout_form = get_option('fyfx_your_propfirm_plugin_checkout_form');
    $enable_response_header = get_option('fyfx_your_propfirm_plugin_enable_response_header');
    if ($enable_response_header && $checkout_form !== 'sellkit_form' && $checkout_form !== 'disable') {
        $order_id = absint(get_query_var('order-received'));
        $api_response = get_post_meta($order_id, 'api_response', true);
        ?>
        <script>
            var apiResponse = <?php echo json_encode($api_response); ?>;
            console.log(apiResponse);
        </script>
        <?php
    }
    
}
add_action('woocommerce_thankyou', 'add_api_response_js_to_thankyou_page');

// Menambahkan data respons API ke halaman "Thank You"
function add_api_response_js_to_sellkit_thankyou_page() {
    // Display API response header in inspect element
    $checkout_form = get_option('fyfx_your_propfirm_plugin_checkout_form');
    $enable_response_header = get_option('fyfx_your_propfirm_plugin_enable_response_header');
    if ($enable_response_header && $checkout_form !== 'woocommerce_form' && $checkout_form !== 'disable') {
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
}
add_action('woocommerce_before_customer_object_save', 'add_api_response_js_to_sellkit_thankyou_page');

// Add a custom field to WooCommerce product
function your_propfirm_addon_add_program_id_field() {
    global $woocommerce, $post;

    // Get the product ID
    $product_id = $post->ID;

    // Display the custom field on the product edit page
    woocommerce_wp_text_input(
        array(
            'id'          => '_program_id',
            'label'       => __('Program Id (Your Propfirm)', 'woocommerce'),
            'placeholder' => __('Enter Program Id (Your Propfirm)', 'woocommerce'),
            'desc_tip'    => true,
            'description' => __('Enter Program Id (Your Propfirm).', 'woocommerce'),
            'wrapper_class' => 'show_if_simple',
        )
    );
}
add_action('woocommerce_product_options_general_product_data', 'your_propfirm_addon_add_program_id_field', 9);

// Save the custom field value
function your_propfirm_addon_save_program_id_field($product_id) {
    $program_id = sanitize_text_field($_POST['_program_id']);
    update_post_meta($product_id, '_program_id', esc_attr($program_id));
}
add_action('woocommerce_process_product_meta', 'your_propfirm_addon_save_program_id_field');