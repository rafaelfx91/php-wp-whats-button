<?php
/**
 * Plugin Name: WhatsApp Flutuante
 * Description: Adiciona um botão flutuante do WhatsApp configurável.
 * Version: 1.0.2
 * Author: DEV ti
 * License: GPLv2
 */

defined('ABSPATH') || exit;

define('WF_VERSION', '1.0.0');
define('WF_PATH', plugin_dir_path(__FILE__));
define('WF_URL', plugin_dir_url(__FILE__));
define('WF_DEFAULT_IMG', WF_URL . 'assets/images/whatsapp-icon.png');

register_activation_hook(__FILE__, 'wf_activate_plugin');

function wf_activate_plugin() {
    $defaults = [
        'phone' => '',
        'text' => 'Fale conosco',
        'image' => WF_DEFAULT_IMG,
        'position' => 'right',
        'active' => true
    ];
    update_option('wf_settings', $defaults);
}

add_action('plugins_loaded', 'wf_load_plugin');
function wf_load_plugin() {
    require_once WF_PATH . 'includes/admin-settings.php';
    require_once WF_PATH . 'includes/frontend-display.php';
}