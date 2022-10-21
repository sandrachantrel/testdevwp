<?php
/**
 * Template options config.
 *
 * @package Vipers
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

$prefix      = 'testdevwp';

// ajouter la page d'option avec CSF::createOptions permet de créer la page d'option dans le back office

CSF::createOptions(
    $prefix,
    array(
        'menu_title'          => esc_html__( 'Testdevwp options', 'testdevwp' ),
        'menu_slug'           => 'testdevwp-options',
        'framework_title'     => esc_html__( 'Testdevwp options', 'testdevwp' ),
        'admin_bar_menu_icon' => 'dashicons-admin-generic',
        //'menu_icon'           => get_template_directory_uri() . '/img/menu-icon.svg', //mon icon pour le menu latéral dans le back office
        'footer_text'         => sprintf( /* translators: %s: Author Link */ wp_kses_post( __( 'by %s', 'vipers' ) ), '<a href="https://www.visionsnouvelles.com" target="_blank">Visions Nouvelles</a>' ),
        'theme'               => 'light',
        'footer_credit'       => sprintf( /* translators: %s: Author Email */ wp_kses_post( __( 'E-mail us: %s', 'vipers' ) ), '<a href="mailto:webmaster@visionsnouvelles.com">webmaster@visionsnouvelles.com</a>' ),
        'show_in_customizer'  => true,//permet l'édition de ces options via le customizer WordPress depuis le menu Apparence > personnaliser
        'menu_position'       => 2,
    )
);

// ajoute un onglet avec les champs à l'intérieur // permet de créer un menu à notre page option
CSF::createSection(
    $prefix,
    array(
        'title'  => esc_html__( 'Contact Form Options', 'testdevwp' ),
        'icon'   => 'fas fa-envelope',
        'fields' => array(
            array(
                'id'    => 'default_contact_name',
                'type'  => 'text',
                'title' => esc_html__( 'Default Contact Name', 'testdevwp' ),
            ),
            array(
                'id'    => 'default_contact_email',
                'type'  => 'text',
                'title' => esc_html__( 'Default Contact Email', 'testdevwp' ),
            ),
            array(
                'id'    => 'default_contact_mail_cc',
                'type'  => 'text',
                'title' => esc_html__( 'Default Contact Email CC', 'testdevwp' ),
            ),
            array(
                'id'    => 'default_contact_mail_bcc',
                'type'  => 'text',
                'title' => esc_html__( 'Default Contact Email BCC', 'testdevwp' ),
            ),
            array(
                'id'         => 'thank_you_page',
                'type'       => 'select',
                'title'      => esc_html__( '"Thank You" Page', 'testdevwp' ),
                'options'    => 'post',
                'query_args' => array(
                    'posts_per_page' => - 1,
                    'post_type'      => 'page',
                ),
            ),
            array(
                'id'       => 'thank_you_body_code',
                'type'     => 'code_editor',
                'title'    => esc_html__( 'Body Code', 'testdevwp' ),
                'desc'     => esc_html__( 'After &lt;body&gt; opening tag.', 'testdevwp' ),
                'sanitize' => false,
                'settings' => array(
                    'theme' => 'shadowfox',
                    'mode'  => 'htmlmixed',
                ),
            ),
        ),
    )
);
