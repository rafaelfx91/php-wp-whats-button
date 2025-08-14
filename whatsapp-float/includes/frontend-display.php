<?php
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', 'wf_enqueue_styles');
add_action('wp_footer', 'wf_display_button');

function wf_enqueue_styles() {
    wp_enqueue_style(
        'wf-style',
        WF_URL . 'assets/css/style.css',
        [],
        WF_VERSION
    );
}

function wf_display_button() {
    $options = get_option('wf_settings');
    
    if (!$options['active'] || empty($options['phone'])) {
        return;
    }

    $phone = preg_replace('/[^0-9]/', '', $options['phone']);
    ?>
    <a id="wf-button" class="wf-<?php echo esc_attr($options['position']); ?>" 
       href="https://wa.me/<?php echo esc_attr($phone); ?>" 
       target="_blank">
        <img src="<?php echo esc_url($options['image']); ?>" alt="WhatsApp">
        <span class="wf-tooltip"><?php echo esc_html($options['text']); ?></span>
    </a>
    <?php
}