<?php

/**
 *
 * @param string $context Empty context.
 */
function action_admin_menu(): void
{
    add_options_page('تنظیمات درگاه پرداخت', 'تنظیمات درگاه پرداخت', 'manage_options', 'payment_setting', 'payment_setting_cb',);
}

//* Fires before the administration menu loads in the admin.
/**
 * Fires as an admin screen or script is being initialized.
 *
 */
function action_admin_init(): void
{
    $args = array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => NULL,
    );
    register_setting('payment_settings', '_secret_key', $args);
    register_setting('payment_settings', '_api_key', $args);
    // register a new section in the "reading" page
    add_settings_section(
        'yas_settings_section',
        'عنوان',
        'yas_settings_section_callback',
        'payment_setting'
    );

    // register a new field in the "wporg_settings_section" section, inside the "reading" page
    add_settings_field(
        'wporg_settings_field',
        'mergent id',
        'yas_settings_field_callback_google',
        'payment_setting',
        'yas_settings_section'
    );
    add_settings_field(
        'wporg_settings_field_2',
        'user name',
        'yas_settings_field_callback_2_api',
        '   ',
        'yas_settings_section'
    );
}
function payment_setting_cb()
{
    if (isset($_GET['tab'])) {
        $active_tab = $_GET['tab'];
    } else {
        $active_tab = 'tab-one';
    }


?>
    <div class="wrap">
        <h1 class="nav-tab-wrapper">
            <a href="?page=payment_setting&tab=tab-one" class="nav-tab <?php echo $active_tab == 'tab-one' ? 'nav-tab-active' : ''; ?>"> tab 1</a>
            <a href="?page=payment_setting&tab=tab-two" class="nav-tab <?php echo $active_tab == 'tab-two' ? 'nav-tab-active' : ''; ?>">tab 2</a>
        </h1>
        <form action="options.php" method="post">

            <?php
            if ($active_tab == 'tab-one') {

                settings_fields('payment_settings');
                do_settings_sections('payment_setting');

                submit_button();
                # code...
            } else {
            ?>
                <?php
                if ($active_tab == 'tab-two') { ?>

                    <h1>other settings</h1>
            <?php
                }
            }
            ?>
        </form>
    </div>
<?php
}
function yas_settings_field_callback_google()
{
    // get the value of the setting we've registered with register_setting()
    $mergent = get_option('_secret_key');
    // output the field
?>
    <input type="text" name="_secret_key" value="<?php echo isset($mergent) ? esc_attr($mergent) : ''; ?>">
<?php
}
function yas_settings_field_callback_2_api()
{
    // get the value of the setting we've registered with register_setting()
    $usern = get_option('_api_key');
    // output the field
?>
    <input type="text" name="_api_key" value="<?php echo isset($usern) ? esc_attr($usern) : ''; ?>">
<?php
}
add_action('admin_menu', 'action_admin_menu');
add_action('admin_init', 'action_admin_init');
