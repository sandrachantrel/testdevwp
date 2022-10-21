<?php

/**
 * Create Gutenberg Blocks with ACF Pro.
 *
 */

if ( ! function_exists( 'acf_register_block_type' ) ) {
    return;
}

/**
 * Register block.
 */

function testdevwp_text_image_block() {
    acf_register_block_type(
        array(
        'name' => 'testdevwp_text_image',
        'title' => esc_html__( 'Text Image Button', 'testdevwp' ),
        'description' => "Création d'un bloc Gutenberg avec ACF Pro afin d'afficher une image et du texte.",
        'render_template' => get_template_directory() . '/inc/gutenberg-blocks/block-text-image/render.php',
        'category' => 'testdevwp-bloc-category',
        'icon' => 'text',
        'mode'            => 'preview',
        'keywords' => array('testdevwp', 'text', 'image'),
        'enqueue_assets' => function () {
            wp_enqueue_style('testdevwp-block', get_template_directory_uri() . '/bloc-acf.css');
        }
    ));
}

add_action('acf/init', 'testdevwp_text_image_block');

/**
 * Add block fields.
 */
// CREATION DE NOS CHAMPS PRESENTS DANS NOTRE BLOCK

function testdevwp_text_image_block_fields() {

    $prefix = 'field_text_image';

    acf_add_local_field_group(
        array(
            'key'      => $prefix . 'block',
            'title'    => esc_html__( 'Text Image Button', 'testdevwp' ),
            'fields'   => array(
                array(
                    'key'     => $prefix . 'block_title',
                    'label'   => esc_html__( 'Text, Image, Button Block', 'testdevwp' ),
                    'message' => esc_html__( 'Display big image with near content and action button.', 'testdevwp' ),
                    'type'    => 'message',
                ),
                array(
                    'key'       => $prefix . 'title_tab',
                    'label'     => esc_html__( 'Title', 'testdevwp' ),
                    'type'      => 'tab',
                    'placement' => 'top',
                ),
                array(
                    'key'        => $prefix . 'title',
                    'name'       => 'title',
                    'type'       => 'group',
                    'layout'     => 'row',
                    'sub_fields' => array(
                        array(
                            'key'   => $prefix . 'text',
                            'label' => esc_html__( 'Title', 'testdevwp' ),
                            'name'  => 'title',
                            'type'  => 'text',
                        ),
                        array(
                            'key'     => $prefix . 'tag',
                            'label'   => esc_html__( 'Title Tag', 'testdevwp' ),
                            'name'    => 'tag',
                            'type'    => 'select',
                            'choices' => array(
                                'h1'   => 'h1',
                                'h2'   => 'h2',
                                'h3'   => 'h3',
                                'h4'   => 'h4',
                                'h5'   => 'h5',
                                'h6'   => 'h6',
                                'p'    => 'p',
                                'span' => 'span',
                            ),
                        ),
                        array(
                            'key'   => $prefix . 'title_is_orange',
                            'label' => esc_html__( 'Is Orange', 'testdevwp' ),
                            'name'  => 'is_orange',
                            'type'  => 'true_false',
                            'ui'    => 1,
                        ),
                    ),
                ),
                array(
                    'key'       => $prefix . 'content_tab',
                    'label'     => esc_html__( 'Content', 'testdevwp' ),
                    'type'      => 'tab',
                    'placement' => 'top',
                ),
                array(
                    'key'  => $prefix . 'content',
                    'name' => 'content',
                    'type' => 'wysiwyg',
                ),
                array(
                    'key'       => $prefix . 'button_tab',
                    'label'     => esc_html__( 'Button', 'testdevwp' ),
                    'type'      => 'tab',
                    'placement' => 'top',
                ),
                array(
                    'key'        => $prefix . 'button',
                    'name'       => 'button',
                    'type'       => 'group',
                    'layout'     => 'row',
                    'sub_fields' => array(
                        array(
                            'key'   => $prefix . 'button_text',
                            'label' => esc_html__( 'Text', 'testdevwp' ),
                            'name'  => 'text',
                            'type'  => 'text',
                        ),
                        array(
                            'key'          => $prefix . 'button_title',
                            'label'        => esc_html__( 'Title', 'testdevwp' ),
                            'instructions' => esc_html__( 'The title attribute.', 'testdevwp' ),
                            'name'         => 'title',
                            'type'         => 'text',
                        ),
                        array(
                            'key'   => $prefix . 'button_url',
                            'label' => esc_html__( 'URL', 'testdevwp' ),
                            'name'  => 'url',
                            'type'  => 'text',
                        ),
                        array(
                            'key'   => $prefix . 'button_icon',
                            'label' => esc_html__( 'Icon', 'testdevwp' ),
                            'name'  => 'icon',
                            'type'  => 'text',
                        ),
                        array(
                            'key'     => $prefix . 'button_icon_pos',
                            'label'   => esc_html__( 'Icon Position', 'testdevwp' ),
                            'name'    => 'icon_pos',
                            'type'    => 'select',
                            'choices' => array(
                                'left'  => esc_html__( 'Left', 'testdevwp' ),
                                'right' => esc_html__( 'Right', 'testdevwp' ),
                            ),
                        ),
                        array(
                            'key'   => $prefix . 'button_new_tab',
                            'label' => esc_html__( 'New Tab', 'testdevwp' ),
                            'name'  => 'new_tab',
                            'type'  => 'true_false',
                            'ui'    => 1,
                        ),
                        array(
                            'key'     => $prefix . 'button_style',
                            'label'   => esc_html__( 'Style', 'testdevwp' ),
                            'name'    => 'style',
                            'type'    => 'select',
                            'choices' => array(
                                'red'          => esc_html__( 'Orange', 'testdevwp' ),
                                'blue'         => esc_html__( 'Blue', 'testdevwp' ),
                                'red-outline'  => esc_html__( 'Orange Outline', 'testdevwp' ),
                                'blue-outline' => esc_html__( 'Blue Outline', 'testdevwp' ),
                            ),
                        ),
                    ),
                ),
                array(
                    'key'       => $prefix . 'image_tab',
                    'label'     => esc_html__( 'Image', 'testdevwp' ),
                    'type'      => 'tab',
                    'placement' => 'top',
                ),
                array(
                    'key'     => $prefix . 'image_pos',
                    'label'   => esc_html__( 'Image Position', 'testdevwp' ),
                    'name'    => 'image_pos',
                    'type'    => 'select',
                    'choices' => array(
                        'left'  => esc_html__( 'Left', 'testdevwp' ),
                        'right' => esc_html__( 'Right', 'testdevwp' ),
                    ),
                ),
                array(
                    'key'           => $prefix . 'image',
                    'label'         => esc_html__( 'Image', 'testdevwp' ),
                    'name'          => 'image',
                    'type'          => 'image',
                    'return_format' => 'id',
                ),
                array(
                    'key'       => $prefix . 'social_tab',
                    'label'     => esc_html__( 'Social Links', 'testdevwp' ),
                    'type'      => 'tab',
                    'placement' => 'top',
                ),
                array(
                    'key'        => $prefix . 'social_links_title',
                    'label'      => esc_html__( 'Social Links Title', 'testdevwp' ),
                    'name'       => 'social_links_title',
                    'type'       => 'group',
                    'layout'     => 'row',
                    'sub_fields' => array(
                        array(
                            'key'   => $prefix . 'text',
                            'label' => esc_html__( 'Title', 'testdevwp' ),
                            'name'  => 'title',
                            'type'  => 'text',
                        ),
                        array(
                            'key'     => $prefix . 'tag',
                            'label'   => esc_html__( 'Title Tag', 'testdevwp' ),
                            'name'    => 'tag',
                            'type'    => 'select',
                            'choices' => array(
                                'h1'   => 'h1',
                                'h2'   => 'h2',
                                'h3'   => 'h3',
                                'h4'   => 'h4',
                                'h5'   => 'h5',
                                'h6'   => 'h6',
                                'p'    => 'p',
                                'span' => 'span',
                            ),
                        ),
                        array(
                            'key'   => $prefix . 'title_is_orange',
                            'label' => esc_html__( 'Is Orange', 'testdevwp' ),
                            'name'  => 'is_orange',
                            'type'  => 'true_false',
                            'ui'    => 1,
                        ),
                    ),
                ),
                array(
                    'key'   => $prefix . 'facebook',
                    'label' => esc_html__( 'Facebook', 'testdevwp' ),
                    'name'  => 'facebook',
                    'type'  => 'text',
                ),
                array(
                    'key'   => $prefix . 'tiktok',
                    'label' => esc_html__( 'TikTok', 'testdevwp' ),
                    'name'  => 'tiktok',
                    'type'  => 'text',
                ),
                array(
                    'key'   => $prefix . 'instagram',
                    'label' => esc_html__( 'Instagram', 'testdevwp' ),
                    'name'  => 'instagram',
                    'type'  => 'text',
                ),
                array(
                    'key'   => $prefix . 'twitter',
                    'label' => esc_html__( 'Twitter', 'testdevwp' ),
                    'name'  => 'twitter',
                    'type'  => 'text',
                ),
                array(
                    'key'   => $prefix . 'linkedin',
                    'label' => esc_html__( 'Linkedin', 'testdevwp' ),
                    'name'  => 'linkedin',
                    'type'  => 'text',
                ),
                // Global fields.
                array(
                    'key'       => $prefix . 'block_fields',
                    'label'     => esc_html__( 'Block Fields', 'testdevwp' ),
                    'type'      => 'tab',
                    'placement' => 'top',
                ),
                array(
                    'key'   => $prefix . 'js_container',
                    'label' => esc_html__( 'Full Width Inside Container', 'testdevwp' ),
                    'name'  => 'js_container',
                    'type'  => 'true_false',
                    'ui'    => 1,
                ),
                array(
                    'key'        => $prefix . 'attributes',
                    'label'      => esc_html__( 'Attributes', 'testdevwp' ),
                    'name'       => 'attributes',
                    'type'       => 'group',
                    'layout'     => 'table',
                    'sub_fields' => array(
                        array(
                            'key'   => $prefix . 'id',
                            'label' => esc_html__( 'Unique ID', 'testdevwp' ),
                            'name'  => 'id',
                            'type'  => 'text',
                        ),
                        array(
                            'key'   => $prefix . 'class',
                            'label' => esc_html__( 'Extra Classes', 'testdevwp' ),
                            'name'  => 'class',
                            'type'  => 'text',
                        ),
                    ),
                ),
                array(
                    'key'        => $prefix . 'margin',
                    'label'      => esc_html__( 'Margins', 'testdevwp' ),
                    'name'       => 'margins',
                    'type'       => 'group',
                    'layout'     => 'table',
                    'sub_fields' => array(
                        array(
                            'key'           => $prefix . 'mt',
                            'label'         => esc_html__( 'Margin Top', 'testdevwp' ),
                            'name'          => 'mt',
                            'type'          => 'text',
                            'default_value' => 50,
                        ),
                        array(
                            'key'           => $prefix . 'mb',
                            'label'         => esc_html__( 'Margin Bottom', 'testdevwp' ),
                            'name'          => 'mb',
                            'type'          => 'text',
                            'default_value' => 100,
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/testdevwp_text_image',
                    ),
                ),
            ),
            'active'   => true,
        )
    );
}


add_action( 'acf/init', 'testdevwp_text_image_block_fields' );