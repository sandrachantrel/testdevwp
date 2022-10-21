<?php
/**
 * Create Gutenberg Blocks with ACF Pro.
 *
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

/**
 * Register block.
 */
// CREATION DE NOTRE BLOCK

function testdevwp_register_acf_block_types()
{
    acf_register_block_type(array(
        'name' => 'testdevwp-block-quote',
        'title' => 'Testdevwp Block Quote',
        'description' => "Création d'un bloc Gutenberg avec ACF Pro afin d'afficher une citation.",
        'render_template' => get_template_directory() . '/inc/gutenberg-blocks/block-quote/render.php',
        'category' => 'testdevwp-bloc-category',
        'icon' => 'admin-plugins',
        'mode' => 'preview',
        'keywords' => array('testdevwp', 'block'),
        'enqueue_assets' => function () {
            wp_enqueue_style('testdevwp-block', get_template_directory_uri() . '/bloc-acf.css');
        }
    ));
}

add_action('acf/init', 'testdevwp_register_acf_block_types');

/**
 * Add block fields.
 */
// CREATION DE NOS CHAMPS PRESENTS DANS NOTRE BLOCK

function testdevwp_block_quote_fields()
{

    $prefix = 'testdevwp_field_quote_';

    acf_add_local_field_group(
        array(
            'key' => $prefix . 'block',
            'title' => 'Block Quote',
            'fields' => array(
                array(
                    'key' => $prefix . 'text',
                    'label' => 'Texte',
                    'name' => 'text',
                    'type' => 'wysiwyg',
                    'required' => 1,
                    'placeholder' => 'Ecrivez votre texte',
                ),
                array(
                    'key' => $prefix . 'autor',
                    'label' => 'Autor',
                    'name' => 'autor',
                    'type' => 'text',
                    'required' => 1,
                    'placeholder' => 'Veuillez renseigner l\'auteur',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/testdevwp-block-quote',
                    ),
                ),
            ),
            'active' => true,

        )
    );
}

add_action('acf/init', 'testdevwp_block_quote_fields');