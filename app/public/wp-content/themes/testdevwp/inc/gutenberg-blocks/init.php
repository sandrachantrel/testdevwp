<?php
/**
 * Init blocks.
 *
 * @package Vipers
 */

if (!defined('ABSPATH')) {
    die();
}

/**
 * Register custom Gutenberg category for theme.
 *
 * @param array $categories Default block categories.
 *
 * @return array
 */

// On enregistre une catégorie permettant dans le back de regrouper nos block au même endroit

function testdevwp_register_custom_block_categories($categories)
{
    return array_merge(
        array(
            array(
                'slug' => 'testdevwp-bloc-category',
                'title' => esc_html__('Test dev WordPress', 'testdevwp'),
                'icon' => 'dashicons-admin-generic',
            ),
        ),
        $categories
    );
}

add_filter('block_categories_all', 'testdevwp_register_custom_block_categories');

require get_template_directory() . '/inc/gutenberg-blocks/block-quote/register.php';
require get_template_directory() . '/inc/gutenberg-blocks/block-text-image/register.php';