<?php
/*
Plugin Name:  MessageDisplay
Description:  Ajout d'un message au dessus de la liste des services
Version:      1.0
Author:       SandraChantrel
*/

// Portion de code permettant d’éviter l’accès direct au fichier du plugin par mesure de sécurité.

defined('ABSPATH') or die('Oups !');


// CREATION DE LA PAGE OPTION DU MESSAGE DISPLAY

add_action('admin_menu', 'register_messagedisplay_addMenu');
add_action('admin_init', 'registersettings');

// CREATION DES PARAMETRES DE LA PAGE OPTION

function registersettings()
{
    register_setting('message_display_menu', 'message_display_custom');
    add_settings_section('message_display_menu_section', 'Paramètres', function () {
        echo "Veuillez personnaliser votre message: ";
    }, 'message_display_menu');
    add_settings_field('message_display_textarea', "Votre Message", function () {
        // mise en place de l'éditeur de texte TinyMCE
        wp_editor( get_option('message_display_custom'),'message_display_custom');
    }, 'message_display_menu', 'message_display_menu_section');

}

// AJOUT DANS LE MENU

function register_messagedisplay_addMenu()
{
    add_menu_page("Gestion du message display", "Message display", "manage_options", "message_display_menu", "render_message_display");
}

// AFFICHAGE DU MESSAGE

function render_message_display()
{
    ?>
    <h1>Paramétrage du Message display</h1>
    <form action="options.php" method="post">
        <?php
        settings_fields('message_display_menu');
        do_settings_sections('message_display_menu');
        submit_button();
        ?>
    </form>
    <?php
}




