<?php
/**
 * Plugin Name: WhatsApp Flutuante
 * Plugin URI: https://seusite.com/whatsapp-float
 * Description: Adiciona um botão flutuante do WhatsApp que pode ser configurado no painel administrativo.
 * Version: 1.0.0
 * Author: Seu Nome
 * Author URI: https://seusite.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: whatsapp-float
 * Domain Path: /languages
 */

// Segurança - impede acesso direto
defined('ABSPATH') || exit;

// Definir constantes do plugin
define('WHATSAPP_FLOAT_VERSION', '1.0.0');
define('WHATSAPP_FLOAT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WHATSAPP_FLOAT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WHATSAPP_FLOAT_DEFAULT_IMAGE', WHATSAPP_FLOAT_PLUGIN_URL . 'assets/images/whatsapp-icon.png');

// Carregar arquivos necessários
require_once WHATSAPP_FLOAT_PLUGIN_DIR . 'includes/admin-settings.php';
require_once WHATSAPP_FLOAT_PLUGIN_DIR . 'includes/frontend-display.php';

// Registrar ativação/desativação
register_activation_hook(__FILE__, 'whatsapp_float_activate');
register_deactivation_hook(__FILE__, 'whatsapp_float_deactivate');

/**
 * Função de ativação do plugin
 */
function whatsapp_float_activate() {
    // Adicionar opções padrão se não existirem
    if (!get_option('whatsapp_float_settings')) {
        $default_settings = array(
            'phone_number' => '',
            'button_position' => 'right',
            'button_text' => 'Fale conosco',
            'active' => true
        );
        update_option('whatsapp_float_settings', $default_settings);
    }
}

/**
 * Função de desativação do plugin
 */
function whatsapp_float_deactivate() {
    // Não remover as opções para preservar as configurações
}

// Adicionar scripts para o uploader de mídia
add_action('admin_enqueue_scripts', 'whatsapp_float_admin_scripts');

function whatsapp_float_admin_scripts($hook) {
    if ($hook === 'settings_page_whatsapp-float') {
        wp_enqueue_media();
        wp_enqueue_script(
            'whatsapp-float-admin',
            WHATSAPP_FLOAT_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            WHATSAPP_FLOAT_VERSION,
            true
        );
    }
}