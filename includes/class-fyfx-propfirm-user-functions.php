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