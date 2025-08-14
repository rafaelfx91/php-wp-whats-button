<?php
/**
 * Configurações administrativas do plugin WhatsApp Flutuante
 */

// Adicionar menu de configurações
add_action('admin_menu', 'whatsapp_float_add_admin_menu');
add_action('admin_init', 'whatsapp_float_settings_init');

/**
 * Adicionar item de menu no painel administrativo
 */
function whatsapp_float_add_admin_menu() {
    add_options_page(
        'WhatsApp Flutuante',
        'WhatsApp Flutuante',
        'manage_options',
        'whatsapp-float',
        'whatsapp_float_options_page'
    );
}

/**
 * Inicializar configurações
 */
function whatsapp_float_settings_init() {
    register_setting('whatsapp_float', 'whatsapp_float_settings');

    add_settings_section(
        'whatsapp_float_section',
        __('Configurações do Botão WhatsApp', 'whatsapp-float'),
        'whatsapp_float_section_callback',
        'whatsapp_float'
    );

    add_settings_field(
        'phone_number',
        __('Número do WhatsApp', 'whatsapp-float'),
        'whatsapp_float_phone_number_render',
        'whatsapp_float',
        'whatsapp_float_section'
    );

    add_settings_field(
        'button_position',
        __('Posição do Botão', 'whatsapp-float'),
        'whatsapp_float_button_position_render',
        'whatsapp_float',
        'whatsapp_float_section'
    );

    add_settings_field(
        'button_text',
        __('Texto do Botão', 'whatsapp-float'),
        'whatsapp_float_button_text_render',
        'whatsapp_float',
        'whatsapp_float_section'
    );

    add_settings_field(
        'active',
        __('Ativar Botão', 'whatsapp-float'),
        'whatsapp_float_active_render',
        'whatsapp_float',
        'whatsapp_float_section'
    );
    add_settings_field(
    'button_image',
    __('URL da Imagem do WhatsApp', 'whatsapp-float'),
    'whatsapp_float_button_image_render',
    'whatsapp_float',
    'whatsapp_float_section'
    );
}



/**
 * Renderizar campo do número de telefone
 */
function whatsapp_float_phone_number_render() {
    $options = get_option('whatsapp_float_settings');
    ?>
    <input type="text" name="whatsapp_float_settings[phone_number]" value="<?php echo esc_attr($options['phone_number']); ?>" placeholder="5511999999999">
    <p class="description"><?php _e('Digite o número no formato: 5511999999999 (código do país + DDD + número)', 'whatsapp-float'); ?></p>
    <?php
}

/**
 * Renderizar campo de posição do botão
 */
function whatsapp_float_button_position_render() {
    $options = get_option('whatsapp_float_settings');
    ?>
    <select name="whatsapp_float_settings[button_position]">
        <option value="right" <?php selected($options['button_position'], 'right'); ?>><?php _e('Direita', 'whatsapp-float'); ?></option>
        <option value="left" <?php selected($options['button_position'], 'left'); ?>><?php _e('Esquerda', 'whatsapp-float'); ?></option>
    </select>
    <?php
}

/**
 * Renderizar campo de texto do botão
 */
function whatsapp_float_button_text_render() {
    $options = get_option('whatsapp_float_settings');
    ?>
    <input type="text" name="whatsapp_float_settings[button_text]" value="<?php echo esc_attr($options['button_text']); ?>" placeholder="Fale conosco">
    <?php
}

/**
 * Renderizar campo de ativação
 */
function whatsapp_float_active_render() {
    $options = get_option('whatsapp_float_settings');
    ?>
    <input type="checkbox" name="whatsapp_float_settings[active]" <?php checked($options['active'], true); ?> value="1">
    <?php
}

/**
 * Callback da seção de configurações
 */
function whatsapp_float_section_callback() {
    echo __('Configure as opções do botão flutuante do WhatsApp abaixo.', 'whatsapp-float');
}

/**
 * Página de opções do plugin
 */
function whatsapp_float_options_page() {
    // Verificar permissões do usuário
    if (!current_user_can('manage_options')) {
        wp_die(__('Você não tem permissão para acessar esta página.', 'whatsapp-float'));
    }
    ?>
    <div class="wrap">
        <h1><?php _e('WhatsApp Flutuante', 'whatsapp-float'); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('whatsapp_float');
            do_settings_sections('whatsapp_float');
            submit_button();
            ?>
        </form>
    </div>
    <script>
    jQuery(document).ready(function($) {
        // Uploader de mídia
        $('.whatsapp-float-upload').on('click', function(e) {
            e.preventDefault();
            var button = $(this);
            var field = button.prev();
            
            var custom_uploader = wp.media({
                title: 'Selecione a imagem do WhatsApp',
                library: {
                    type: 'image'
                },
                button: {
                    text: 'Usar esta imagem'
                },
                multiple: false
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                field.val(attachment.url);
            }).open();
        });
    });
    </script>
    <div class="wrap">
        <h1><?php _e('WhatsApp Flutuante', 'whatsapp-float'); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('whatsapp_float');
            do_settings_sections('whatsapp_float');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Adicione esta função para renderizar o novo campo
/*
function whatsapp_float_button_image_render() {
    $options = get_option('whatsapp_float_settings');
    $default_image = WHATSAPP_FLOAT_PLUGIN_URL . 'assets/images/whatsapp-icon.png';
    ?>
    <input type="text" name="whatsapp_float_settings[button_image]" 
           value="<?php echo esc_url($options['button_image'] ?: $default_image); ?>" 
           class="regular-text">
    <p class="description"><?php _e('Insira a URL completa da imagem ou deixe em branco para usar o ícone padrão', 'whatsapp-float'); ?></p>
    <?php
}*/
function whatsapp_float_button_image_render() {
    $options = get_option('whatsapp_float_settings');
    $default_image = WHATSAPP_FLOAT_PLUGIN_URL . 'assets/images/whatsapp-icon.png';
    ?>
    <input type="text" name="whatsapp_float_settings[button_image]" 
           value="<?php echo esc_url($options['button_image'] ?: $default_image); ?>" 
           class="regular-text">
    <button class="button whatsapp-float-upload"><?php _e('Selecionar Imagem', 'whatsapp-float'); ?></button>
    <p class="description"><?php _e('Insira a URL completa da imagem ou deixe em branco para usar o ícone padrão', 'whatsapp-float'); ?></p>
    <?php
}

// Atualize a função whatsapp_float_activate() para incluir o novo campo padrão
function whatsapp_float_activate() {
    if (!get_option('whatsapp_float_settings')) {
        $default_settings = array(
            'phone_number' => '',
            'button_position' => 'right',
            'button_text' => 'Fale conosco',
            'button_image' => WHATSAPP_FLOAT_PLUGIN_URL . 'assets/images/whatsapp-icon.png',
            'active' => true
        );
        update_option('whatsapp_float_settings', $default_settings);
    }
}