<?php
// Add plugin settings fields
function fyfx_your_propfirm_plugin_contact_form_settings_fields() {
    add_settings_section(
        'fyfx_your_propfirm_plugin_contact_form_general',
        'Contact Form Settings',
        'fyfx_your_propfirm_plugin_contact_form_section_callback',
        'fyfx_your_propfirm_plugin_contact_form_settings'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_contact_form_enabled',
        'Enable YPF Contact Form',
        'fyfx_your_propfirm_plugin_contact_form_enabled_callback',
        'fyfx_your_propfirm_plugin_contact_form_settings',
        'fyfx_your_propfirm_plugin_contact_form_general'
    );

    register_setting(
        'fyfx_your_propfirm_plugin_contact_form_settings',
        'fyfx_your_propfirm_plugin_contact_form_enabled',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


}
add_action('admin_init', 'fyfx_your_propfirm_plugin_contact_form_settings_fields');

// Render general settings section callback
function fyfx_your_propfirm_plugin_contact_form_section_callback() {
    echo 'Configure the Contact Form settings for YPF Plugin.';
}

// Render enable plugin field
function fyfx_your_propfirm_plugin_contact_form_enabled_callback() {
    $plugin_enabled = get_option('fyfx_your_propfirm_plugin_contact_form_enabled');
    ?>
    <select name="fyfx_your_propfirm_plugin_contact_form_enabled">
        <option value="enable" <?php selected($plugin_enabled, 'enable'); ?>>Enabled</option>
        <option value="disable" <?php selected($plugin_enabled, 'disable'); ?>>Disabled</option>
    </select>
    <?php
}
