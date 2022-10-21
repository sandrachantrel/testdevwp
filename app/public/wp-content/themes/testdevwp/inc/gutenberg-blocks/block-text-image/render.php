<?php
/**
 * Block template.
 * Block ID: vipers-text-image-button
 *
 * @package Vipers
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

// Editor preview.
if ( get_field( 'is_example' ) ) {
    echo '<img src="' . esc_url( get_template_directory_uri() . '/inc/gutenberg-blocks/block-text-image-button/preview.png' ) . '" alt="Preview">';
    return;
}
