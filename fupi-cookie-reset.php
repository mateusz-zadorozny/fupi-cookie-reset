<?php
/**
 * Plugin Name:     Reset WP Full Picture cookie settings
 * Plugin URI:      https://cookies.mpress.cc
 * Description:     Helper plugin to allow reseting WP Full Picture cookie preferences. Use shortcode: [fupi_reset] or [fupi_reset text="Your Custom Text"] in your footer or privacy policy page. Or add 'fupi-reset' class to any element that should trigger the function for reset. Use [fupi_reset display="0"] to just use javascript and class method.
 * Author:          Mateusz Zadorozny mpress.cc
 * Author URI:      https://mpress.cc
 * Text Domain:     fupi-cookie-reset
 * Domain Path:     /languages
 * Version:         1.0.1
 *
 * @package         Fupi_Cookie_Reset
 */

function fupi_reset_shortcode($atts)
{
    // Check if a specific plugin is active
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (!is_plugin_active('full-picture-analytics-cookie-notice/full-picture.php')) { // Replace with the actual plugin file
        return ''; // Exit if the specific plugin is not active
    }

    // Check if a specific option is set
    $fupi_cookie_notice = get_option('fupi_cookie_notice'); // Replace with the actual option name
    if (!$fupi_cookie_notice) {
        return ''; // Exit if the option is not set
    }

    // Extract shortcode attributes
    $atts = shortcode_atts(
        array(
            'text' => 'Reset cookie preferences',
            'display' => true,
        ),
        $atts
    );

    // Enqueue the JavaScript file
    wp_enqueue_script('fupi-reset-script', plugins_url('fupi-reset-script.js', __FILE__), array(), '1.0', true);

    if ($atts['display'] !== '0') {
        // Return the link HTML
        return '<a class="fupi-reset-link" href="#" onclick="deleteCookiesAndReload(); return false;">' . esc_html($atts['text']) . '</a>';
    } else
        return '';

}

add_shortcode('fupi_reset', 'fupi_reset_shortcode');
?>