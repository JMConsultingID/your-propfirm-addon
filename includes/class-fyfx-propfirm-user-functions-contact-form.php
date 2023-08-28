<?php
// Add plugin settings Contact Form fields
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

    add_settings_field(
        'fyfx_your_propfirm_plugin_select_form_field',
        'Select Form Provider',
        'fyfx_your_propfirm_plugin_select_form_field_callback',
        'fyfx_your_propfirm_plugin_contact_form_settings',
        'fyfx_your_propfirm_plugin_contact_form_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_form_pages_field',
        'Select Page Contact Form',
        'fyfx_your_propfirm_plugin_form_pages_field_callback',
        'fyfx_your_propfirm_plugin_contact_form_settings',
        'fyfx_your_propfirm_plugin_contact_form_general'
    );

    add_settings_field(
        'fyfx_your_propfirm_plugin_form_trigger_field',
        'From Trigger ID',
        'fyfx_your_propfirm_plugin_form_trigger_field_callback',
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

    register_setting(
        'fyfx_your_propfirm_plugin_contact_form_settings',
        'fyfx_your_propfirm_plugin_form_pages_field',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    register_setting(
        'fyfx_your_propfirm_plugin_contact_form_settings',
        'fyfx_your_propfirm_plugin_form_trigger_field'
    );
}
add_action('admin_init', 'fyfx_your_propfirm_plugin_contact_form_settings_fields');

function get_divi_contact_forms() {
    $args = array(
        'post_type' => 'page', // Query for pages
        'posts_per_page' => -1, // Get all pages
    );
    $query = new WP_Query($args);
    $forms = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $forms[get_the_ID()] = get_the_title();
        }
        wp_reset_postdata();
    } else {
        $forms[] = "None";
    }
    return $forms;
}

// Render Contact Form section callback
function fyfx_your_propfirm_plugin_contact_form_section_callback() {
    echo 'Configure the Contact Form settings for YPF Plugin.';
}

// Render enable plugin Contact Form field
function fyfx_your_propfirm_plugin_contact_form_enabled_callback() {
    $plugin_enabled = get_option('fyfx_your_propfirm_plugin_contact_form_enabled');
    ?>
    <select name="fyfx_your_propfirm_plugin_contact_form_enabled">
        <option value="enable" <?php selected($plugin_enabled, 'enable'); ?>>Enabled</option>
        <option value="disable" <?php selected($plugin_enabled, 'disable'); ?>>Disabled</option>
    </select>
    <?php
}

// Render Select form field
function fyfx_your_propfirm_plugin_select_form_field_callback() {
    $select_form = get_option('fyfx_your_propfirm_plugin_select_form_field');
    ?>
    <select name="fyfx_your_propfirm_plugin_select_form_field">
        <option value="wp-form-7" <?php selected($select_form, 'wp-form-7'); ?>>Contact Form 7</option>
        <option value="wp-forms" <?php selected($select_form, 'wp-form'); ?>>WPForms</option>
        <option value="divi-form" <?php selected($select_form, 'divi-form'); ?>>Divi Form</option>
    </select>
    <?php
}

// Render Select Pages Form field
function fyfx_your_propfirm_plugin_form_pages_field_callback() {
    $options = get_option('fyfx_your_propfirm_plugin_form_pages_field');
    $selected_form_divi = isset($options['fyfx_your_propfirm_plugin_form_pages_field']) ? sanitize_text_field($options['fyfx_your_propfirm_plugin_form_pages_field']) : '';
    $divi_forms = get_divi_contact_forms();
    ?>
    <select name="fyfx_your_propfirm_plugin_form_pages_field">
        <?php
            foreach ($divi_forms as $id => $title) {
                $page_id = $id;
                $selected = $page_id === $selected_form_divi ? 'selected' : '';
                echo '<option value="' . $page_id . ' $selected ">' . $title . '</option>';
            }
        ?>
    </select>
    <?php
}

// Render Form Trigger field
function fyfx_your_propfirm_plugin_form_trigger_field_callback() {
    $form_trigger = get_option('fyfx_your_propfirm_plugin_form_trigger_field');
    echo '<div class="form-trigger-fields">';
    echo '<input type="text" name="fyfx_your_propfirm_plugin_form_trigger_field" value="' . $form_trigger . '" style="width: 400px;" />';
    echo '</div>';
}