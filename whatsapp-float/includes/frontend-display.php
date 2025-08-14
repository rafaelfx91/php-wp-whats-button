<?php
/**
* Exibição do botão WhatsApp no frontend
*/

// Adicionar CSS e JS
add_action('wp_enqueue_scripts', 'whatsapp_float_enqueue_scripts');

function whatsapp_float_enqueue_scripts() {
    wp_enqueue_style(
        'whatsapp-float-css',
        WHATSAPP_FLOAT_PLUGIN_URL . 'assets/css/whatsapp-float.css',
        array(),
        WHATSAPP_FLOAT_VERSION
    );
}

// Adicionar botão ao footer
add_action('wp_footer', 'whatsapp_float_display_button');
/*
function whatsapp_float_display_button() {
$options = get_option('whatsapp_float_settings');

// Verificar se o botão está ativo e se há um número definido
if (empty($options['active']) || empty($options['phone_number'])) {
return;
}

$phone_number = esc_attr($options['phone_number']);
$button_text = esc_attr($options['button_text']);
$position_class = ($options['button_position'] === 'left') ? 'left' : '';

// Gerar URL do WhatsApp
$whatsapp_url = 'https://wa.me/' . $phone_number;

?>
<a id="robbu-whatsapp-button" class="<?php echo $position_class; ?>" target="_blank" href="<?php echo $whatsapp_url; ?>">
<div class="rwb-tooltip"><?php echo $button_text; ?></div>
<img src="<?php echo WHATSAPP_FLOAT_PLUGIN_URL; ?>assets/images/whatsapp-icon.png" alt="<?php echo $button_text; ?>">
</a>
<?php
}*/
function whatsapp_float_display_button() {
    $options = get_option('whatsapp_float_settings');
    
    if (empty($options['active']) || empty($options['phone_number'])) {
        return;
    }
    
    $phone_number = esc_attr($options['phone_number']);
    $button_text = esc_attr($options['button_text']);
    $position_class = ($options['button_position'] === 'left') ? 'left' : '';
    $button_image = !empty($options['button_image']) ? 
    esc_url($options['button_image']) : 
    WHATSAPP_FLOAT_PLUGIN_URL . 'assets/images/whatsapp-icon.png';
    
    ?>
    <a id="robbu-whatsapp-button" class="<?php echo $position_class; ?>" target="_blank" href="https://wa.me/<?php echo $phone_number; ?>">
    <div class="rwb-tooltip"><?php echo $button_text; ?></div>
    <img src="<?php echo $button_image; ?>" alt="<?php echo $button_text; ?>">
    </a>
    <?php
}