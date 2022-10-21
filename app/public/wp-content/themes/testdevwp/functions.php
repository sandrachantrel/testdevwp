<?php

define('TESTDEVWP_OPTIONS', get_option('testdevwp'));

// fonction rendant le theme accessible à la traduction
load_theme_textdomain( 'testdevwp', get_template_directory() . '/languages' );

add_theme_support('post-thumbnails');

// Ajout de Bootstrap et de notre style à notre theme
function testdevwp_register_assets()
{
    // penser à plutot rendre les noms uniques pour éviter les conflits ex: testdevwp-bootstrap-css
    wp_enqueue_script('jquery');
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js');
    wp_register_style('testdevwp', get_stylesheet_directory_uri() . '/style.css', 'bootstrap');

    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
    wp_enqueue_style('testdevwp');

    wp_register_script('testdevwp-form-js', get_stylesheet_directory_uri() . '/src/js/form.js');
    // création d'un objet à plusieurs données afin qu'elles soient disponibles sur l'ensemble de notre projet en JS
    wp_localize_script(
        'testdevwp-form-js',
        'testdevwpFormObject',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'formError' => esc_html__('Please fill in the required fields ! ', 'testdevwp'), // permet d'internationnaliser les messages d'erreur
        )
    );
    wp_enqueue_script('testdevwp-form-js');


}

add_action('wp_enqueue_scripts', 'testdevwp_register_assets');

/**
 * Template framework.
 */
require get_template_directory() . '/inc/framework/codestar-framework/codestar-framework.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-function.php';

/**
 * Ajax handlers.
 */
require get_template_directory() . '/inc/traitement-ajax.php';

/**
 * Class WP MAIL
 */
require get_template_directory() . '/inc/classes/class-wp-mail.php';

/**
 * Template framework.
 * Need call after_setup_theme hook because of translation bug.
 */
function testdevwp_options_init()
{
    /**
     * Template options.
     */
    require get_template_directory() . '/inc/template-option.php';
}

add_action('after_setup_theme', 'testdevwp_options_init');

// Création de notre CPT et nos taxonomies

function testdevwp_register_post_types()
{

    // CPT Services

    $labels = array(
        'name' => 'Services',
        'singular_name' => 'Service',
        'add_new_item' => 'Ajouter un service',
        'edit_item' => 'Modifier le service',
        'menu_name' => 'Services'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        // mettre à true car wp n'est pas capable de gerer l'diteur gutenberg sans l'api rest
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-customizer',
        // permet d'ajouter à gutenberg un bloc par défaut pour l'écran d'ajout et d'édition d'un service
        'template'=> [
                ['acf/testdevwp-block-quote']
        ]
    );

    register_post_type('services', $args);

    // Déclaration de la Taxonomie Services types

    $labels = array(
        'name' => 'Type de services',
        'new_item_name' => 'Nom du nouveau Service',
        'parent_item' => 'Type de service parent',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => true,
    );

    register_taxonomy('type-service', 'services', $args);
}

add_action('init', 'testdevwp_register_post_types');

// CREATION D'UNE META BOX PRIX POUR NOS SERVICES

function testdevwp_add_custom_box()
{

    // J'enregistre une meta prix à mon CPT

    add_meta_box('testdevwp_serviceprix', 'Prix', 'testdevwp_render_serviceprix_box');
}

    // parametrage de la metabox prix

function testdevwp_render_serviceprix_box($post)
{
    // function permettant de recuperer le prix asocié au service en question via l'id
    $serviceprix = get_post_meta($post->ID, '_serviceprix', true)
    ?>
    <label for="serviceprix-input">Prix du service: </label>
    <!-- affichage en dynamique du prix associé au service -->
    <input id="serviceprix-input" type="text" name="serviceprix" value="<?php echo $serviceprix; ?>">
    <?php
}

add_action('add_meta_boxes', 'testdevwp_add_custom_box');

add_action('save_post', 'save_metabox');

function save_metabox($post_id)
{

    // si la metabox est définie, on sauvegarde sa valeur

    if (isset($_POST['serviceprix'])) {
        update_post_meta($post_id, '_serviceprix', esc_html($_POST['serviceprix']));
    }
}

// parametrage d'une taille specifique d'image qu'on appelera dans nos fichier au besoin ex: ligne 17 single-service.php

add_image_size("service-thumbnail", 350, 350, array('center', 'center'));

// CREATION D'UN BLOC GUTENBERG AVEC ACF

/**
 * Gutenberg blocks.
 */
require get_template_directory() . '/inc/gutenberg-blocks/init.php';
