<?php
/*
Template Name: Template Contact
Template Post Type: page
*/
?>

<?php get_header(); ?>

    <form action="" method="POST" id="contact-form" name="contact-form" enctype="multipart/form-data">
        <form class="row">
            <div class="col-md-6">
                <label class="form-label" for="contact-nom">Nom</label>
                <input type="text" name="last_name" id="contact-nom" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="contact-prenom">Prénom</label>
                <input type="text" name="first_name" id="contact-prenom" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="contact-email">Email</label>
                <input type="email" name="email" id="contact-email" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="contact-sujet">Objet</label>
                <input type="text" name="subject" id="contact-sujet" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="contact-message">Message</label>
                <textarea class="form-control" name="message" id="contact-message" placeholder="" required></textarea>
            </div>
            <div class="col-md-2">
                <!-- WordPress utilise les nonces pour protéger les URL et les formulaires contre l’utilisation abusive de tentatives de piratage.
                     Lorsqu’une URL avec clé nonce est exécutée, une vérification est faite. Lorsque cette vérification échoue, WordPress renvoie une réponse « 403 Forbidden » -->
                <?php wp_nonce_field('ajax_contact_nonce', 'security'); ?>
                <button class="btn btn-primary form-control">Submit</button>
            </div>
        </form>
    </form>

<?php get_footer(); ?>