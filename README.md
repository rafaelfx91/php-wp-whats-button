WhatsApp Float - WordPress Plugin
================================

[![WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/whatsapp-float?style=flat-square)
![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-GPLv2-green?style=flat-square)

Um plugin WordPress leve que adiciona um botão flutuante do WhatsApp totalmente configurável.

📦 Instalação
------------

1. Faça o download do plugin:

git clone https://github.com/seuusuario/whatsapp-float.git

2. Envie para o diretório de plugins:

cd wp-content/plugins
unzip ~/Downloads/whatsapp-float-main.zip


3. Ative no painel WordPress em Plugins

🛠️ Estrutura do Plugin
----------------------

whatsapp-float/
├── whatsapp-float.php          # Arquivo principal
├── includes/
│   ├── admin-settings.php      # Configurações
│   └── frontend-display.php    # Exibição
├── assets/
│   ├── css/style.css           # Estilos
│   ├── js/admin.js             # Uploader
│   └── images/                 # Ícones
└── readme.txt                  # Este arquivo

💻 Código Principal
------------------

Arquivo principal (whatsapp-float.php):
---------------------------------------
<?php
/**
* Plugin Name: WhatsApp Float
* Description: Botão flutuante do WhatsApp
* Version: 1.0.0
* Author: Seu Nome
*/

defined('ABSPATH') || exit;

define('WF_VERSION', '1.0.0');
define('WF_PATH', plugin_dir_path(__FILE__)); 
define('WF_URL', plugin_dir_url(__FILE__));

register_activation_hook(__FILE__, function() {
 update_option('wf_settings', [
     'phone' => '',
     'text' => 'Fale conosco',
     'image' => WF_URL . 'assets/images/whatsapp-icon.png',
     'position' => 'right',
     'active' => true
 ]);
});

require_once WF_PATH . 'includes/admin-settings.php';
require_once WF_PATH . 'includes/frontend-display.php';
---------------------------------------

⚙️ Configurações
---------------

Acesse em: Configurações > WhatsApp Float

Opções disponíveis:
- Número do WhatsApp
- Texto do botão
- Imagem personalizada
- Posição (esquerda/direita)
- Ativar/desativar

📜 Licença
---------

Licenciado sob GPLv2 - veja o arquivo LICENSE para detalhes.
