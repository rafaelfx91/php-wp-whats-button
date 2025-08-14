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