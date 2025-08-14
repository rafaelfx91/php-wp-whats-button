<?php
defined('ABSPATH') || exit;

add_action('admin_menu', 'wf_add_admin_menu');
add_action('admin_init', 'wf_register_settings');
add_action('admin_enqueue_scripts', 'wf_admin_scripts');

function wf_add_admin_menu() {
    add_options_page(
        'WhatsApp Flutuante',
        'WhatsApp Flutuante',
        'manage_options',
        'wf-whatsapp',
        'wf_render_admin_page'
    );
}

function wf_register_settings() {
    register_setting('wf_settings_group', 'wf_settings', 'wf_sanitize_settings');

    add_settings_section(
        'wf_main_section',
        'Configurações do Botão',
        null,
        'wf-whatsapp'
    );

    add_settings_field(
        'wf_phone',
        'Número do WhatsApp',
        'wf_phone_field',
        'wf-whatsapp',
        'wf_main_section'
    );

    add_settings_field(
        'wf_text',
        'Texto do Botão',
        'wf_text_field',
        'wf-whatsapp',
        'wf_main_section'
    );

    add_settings_field(
        'wf_image',
        'Imagem do Botão',
        'wf_image_field',
        'wf-whatsapp',
        'wf_main_section'
    );

    add_settings_field(
        'wf_position',
        'Posição',
        'wf_position_field',
        'wf-whatsapp',
        'wf_main_section'
    );

    add_settings_field(
        'wf_active',
        'Ativar',
        'wf_active_field',
        'wf-whatsapp',
        'wf_main_section'
    );
}

function wf_render_admin_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Acesso negado.');
    }
    ?>
    <div class="wrap">
        <h1>WhatsApp Flutuante</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wf_settings_group');
            do_settings_sections('wf-whatsapp');
            submit_button('Salvar Alterações', 'primary', 'submit', true);
            ?>
        </form>
    </div>
    <?php
}

function wf_admin_scripts($hook) {
    if ($hook === 'settings_page_wf-whatsapp') {
        wp_enqueue_media();
        wp_enqueue_script(
            'wf-admin-js',
            WF_URL . 'assets/js/admin.js',
            ['jquery'],
            WF_VERSION
        );
    }
}

function wf_phone_field() {
    $options = get_option('wf_settings');
    echo '<input type="text" name="wf_settings[phone]" value="' . esc_attr($options['phone']) . '" class="regular-text">';
}

function wf_text_field() {
    $options = get_option('wf_settings');
    echo '<input type="text" name="wf_settings[text]" value="' . esc_attr($options['text']) . '" class="regular-text">';
}

function wf_image_field() {
    $options = get_option('wf_settings');
    ?>
    <input type="text" name="wf_settings[image]" 
           value="<?php echo esc_url($options['image']); ?>" 
           class="regular-text wf-image-input">
    <button class="button wf-upload-button">Selecionar Imagem</button>
    <?php
}

function wf_position_field() {
    $options = get_option('wf_settings');
    ?>
    <select name="wf_settings[position]">
        <option value="right" <?php selected($options['position'], 'right'); ?>>Direita</option>
        <option value="left" <?php selected($options['position'], 'left'); ?>>Esquerda</option>
    </select>
    <?php
}

function wf_active_field() {
    $options = get_option('wf_settings');
    echo '<input type="checkbox" name="wf_settings[active]" value="1" ' . checked($options['active'], true, false) . '>';
}

function wf_sanitize_settings($input) {
    $output = [];
    $output['phone'] = sanitize_text_field($input['phone']);
    $output['text'] = sanitize_text_field($input['text']);
    $output['image'] = esc_url_raw($input['image']);
    $output['position'] = in_array($input['position'], ['left', 'right']) ? $input['position'] : 'right';
    $output['active'] = isset($input['active']);
    return $output;
}