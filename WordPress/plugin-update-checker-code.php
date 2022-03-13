<?php

/*
* Required: https://github.com/YahnisElsts/plugin-update-checker
*/

// Step 1
// Add this to your construct of your plugin or themere.

// Updates and settings
add_action( 'admin_init', array( $this, 'myplugin_register_settings') );
add_action('admin_menu', array( $this, 'myplugin_register_options_page') );

$slug = "wcio-woo-servicepos-gift-card"; // This is your plugin or theme slug. This must match what is in github name and in digital manager.
$token = get_option( 'wcio-dm-api-key' ); // Option field for the API key

// Require the plugin update checker files
require dirname(__FILE__) . "/plugin-update-checker/plugin-update-checker.php";

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://websitecare.io/wp-json/wcio/product/'.$slug.'/update/?token='.$token.'',
    __FILE__,
    $slug // Product slug
);


// Step 2
// Add this to your function. It will add the option field for the API key

// Updates and settings
function myplugin_register_settings() {
    add_option( 'wcio-dm-api-key', '');
    register_setting( 'wcio-dm-options-group', 'wcio-dm-api-key', 'myplugin_callback' );
}

function myplugin_register_options_page() {
    add_options_page('Digital manager', 'Digital Manager', 'manage_options', 'myplugin', array($this, 'myplugin_options_page') );
}

function myplugin_options_page() {
?>
    <div>
    <?php screen_icon(); ?>
    <h2>Digital manager options</h2>
    <form method="post" action="options.php">
    <?php settings_fields( 'wcio-dm-options-group' ); ?>
     <table>
    <tr valign="top">
    <th scope="row"><label for="wcio-dm-api-key">API key</label></th>
    <td><input type="text" id="wcio-dm-api-key" name="wcio-dm-api-key" value="<?php echo get_option('wcio-dm-api-key'); ?>" placeholder="Enter API key" /></td>
    </tr>
    </table>
    <?php  submit_button(); ?>
    </form>
    </div>
<?php
}
?>
