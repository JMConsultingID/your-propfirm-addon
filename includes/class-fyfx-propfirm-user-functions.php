<?php
// Add plugin settings page
function fyfx_your_propfirm_plugin_settings_page() {
    add_menu_page(
        'YPF Plugin Dashboard',                // Judul pada menu utama
        'YPF Plugin',                // Judul pada menu utama
        'manage_options',            // Capability yang dibutuhkan untuk mengakses menu
        'ypf_plugin',                // Slug menu utama
        'fyfx_your_propfirm_plugin_settings_page_content', // Callback function untuk halaman konten
        'dashicons-buddicons-replies',    // Ikona menu (Anda dapat mengganti dengan ikon lain)
        45                           // Urutan di dalam menu
    );

    add_submenu_page(
        'ypf_plugin',    // Slug menu utama ('jm_autocomplete_plugin' dari menu utama di atas)
        'YPF Woocommerce',      // Judul submenu
        'YPF Woocommerce',      // Judul submenu
        'manage_options',            // Capability yang dibutuhkan untuk mengakses submenu
        'ypf_plugin', // Slug submenu
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


// Render settings YPF Woocomerce Plugin page content
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

// Render settings YPF Contact Form Plugin page content
function fyfx_your_propfirm_plugin_contact_form_content() {
    ?>
    <div class="wrap">
        <h2>YourPropfirm Contact Form Plugin Settings</h2>
        <form method="post" action="options.php">
        <?php
            settings_fields('fyfx_your_propfirm_plugin_contact_form_settings');
            do_settings_sections('fyfx_your_propfirm_plugin_contact_form_settings');
            submit_button();
        ?>
        </form>
    </div>
    <?php
}

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

// Menambahkan kolom "Program ID" ke daftar produk di halaman admin
function add_program_id_column_to_admin_products($columns) {
    $new_columns = array();

    foreach ($columns as $key => $name) {
        $new_columns[$key] = $name;

        // Menambahkan kolom setelah kolom "SKU"
        if ('sku' === $key) {
            $new_columns['program_id'] = __('YPF-ID', 'woocommerce');
        }
    }

    return $new_columns;
}
add_filter('manage_edit-product_columns', 'add_program_id_column_to_admin_products', 20);

// Menampilkan nilai dari custom field "_program_id" di kolom "Program ID"
function display_program_id_in_admin_products($column, $post_id) {
    if ('program_id' === $column) {
        $program_id = get_post_meta($post_id, '_program_id', true);
        if ($program_id) {
            echo esc_html($program_id);
        } else {
            echo '—'; // Tampilkan tanda dash jika tidak ada nilai
        }
    }
}
add_action('manage_product_posts_custom_column', 'display_program_id_in_admin_products', 10, 2);