jQuery(document).ready(function($) {
    $('.wf-upload-button').click(function(e) {
        e.preventDefault();
        var button = $(this);
        var input = button.siblings('.wf-image-input');

        var frame = wp.media({
            title: 'Selecione a imagem',
            library: {
                type: 'image'
            },
            multiple: false
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            input.val(attachment.url);
        });

        frame.open();
    });
});