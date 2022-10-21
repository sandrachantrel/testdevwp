<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Visions Nouvelles</title>
    <?php wp_head() ?>
</head>
<body>

<!-- Personnalisation du header pour la page service -->

<?php
wp_body_open();

if (is_singular('services', 'contact')) { ?>
<header class="container-fluid header-container-services">
    <div class="container text-center">
        <a href="http://testdev.local/" class="logo-cliquable" rel="bookmark">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/logo.png'; ?>"
                 alt="Logo de Visions Nouvelles" title="Logo cliquable pour un retour à l'accueil">
        </a>
    </div>
</header>
<main class="container-fluid main-container">
    <?php
    } else { ?>

    <!-- Header de la page d'accueil-->

    <header class="container-fluid header-container">
        <div class="container text-center">
            <a href="http://testdev.local/" class="logo-cliquable" rel="bookmark">
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/logo.png'; ?>"
                     alt="Logo de Visions Nouvelles" title="Logo cliquable pour un retour à l'accueil">
            </a>
        </div>
    </header>
    <main class="container-fluid main-container">
        <?php
        }
        ?>


