<?php

/**
 * Registers a text field setting for Wordpress 4.7 and higher.
 **/
function register_my_setting()
{
    $args = array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => NULL,
    );
    register_setting('general', '_my_option_name', $args);
    // register a new section in the "reading" page
    add_settings_section(
        'yas_settings_section',
        'عنوان',
        'yas_settings_section_callback',
        'general'
    );

    // register a new field in the "wporg_settings_section" section, inside the "reading" page
    add_settings_field(
        'wporg_settings_field',
        'field title',
        'yas_settings_field_callback',
        'general',
        'yas_settings_section'
    );
}
function yas_settings_section_callback()
{
}
function yas_settings_field_callback()
{
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('_my_option_name');
    // output the field
?>
    <input type="text" name="_my_option_name" value="<?php echo isset($setting) ? esc_attr($setting) : ''; ?>">
<?php
}
add_action('admin_init', 'register_my_setting');
