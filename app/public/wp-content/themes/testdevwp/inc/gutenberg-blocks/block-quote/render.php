<?php
/**
 * Block template.
 */

if (!defined('ABSPATH')) {
    die();
}

// Editor preview.
if (get_field('is_example')) {
    echo '<img src="' . esc_url(get_template_directory_uri() . '/inc/gutenberg-blocks/block-text-image-button/preview.png') . '" alt="Preview">';
    return;
}

//Global fields
$text = get_field('text');
$autor = get_field('autor');

?>

<div class="quote-block-container">
    <div class="container">
        <div class="testdevwp-bloc-acf">
            <p class="testdevwp-bloc-acf-texte"><?php echo $text ?></p>
            <p class="testdevwp-bloc-acf-auteur">Auteur: <?php echo $autor ?></p>
        </div>