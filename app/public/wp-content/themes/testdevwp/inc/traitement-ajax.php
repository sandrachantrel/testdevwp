<?php
/**
 * Handle ajax request.
 */

//empêche l'utilisateur public d'accéder directement à vos fichiers .php via une URL.
if (!defined('ABSPATH')) {
    die();
}

/**
 * Handle block-contact form ajax request.
 */
function testdevwp_contact_form_ajax_handle()
{
    //Vérifie la requête Ajax pour empêcher le traitement de requêtes externes au blog.
    // possibilité de mettre un 3eme argument : die:false pour personnaliser le message d'erreur
    check_ajax_referer('ajax_contact_nonce', 'security');

    //recuperation des donnees verifiees
    $parameters = checkRequireValue(
        array(
            'first_name',
            'last_name',
            'email' => array('type' => 'email'),
            'subject',
            'message' => array('type' => 'textarea'),
        ),
        true
    );

    // envoi d'un message d'erreur si un des parametre n'a pas été rempli
    if (empty($parameters)) {
        // esc-html Récupére la traduction de $text et l'échappe pour une utilisation en toute sécurité dans la sortie HTML.
        // wp_send_json permet d'internationnaliser les messages d'erreur
        wp_send_json_error(array('message' => esc_html__('Please fill required fields!', 'testdevwp')));
    }

    // variable contenant la function servant à créer les variables correspondant aux champs du mail qu'on enverra
    $mail_fields = testdevwp_mail_fields();

    // fonction wp_mail() proposée par wordpress permet de limiter l’envoi de spams
    // wp_mail facilite la gestion d'envoi de mail
    $sent_admin = WP_Mail::init()
        ->to($mail_fields['email'])
        ->from(sprintf('%1$s %2$s <%3$s>', $parameters['first_name'], $parameters['last_name'], $parameters['email']))
        ->bcc($mail_fields['bcc'])
        ->cc($mail_fields['cc'])
        ->subject(esc_html__('Contact from your website', 'testdevwp'))
        ->template(
            get_template_directory() . '/inc/email-template/template-mail.php', $parameters
        )
        ->send();

    if (!$sent_admin) {

        wp_send_json_error(array('message' => esc_html__('Error! Message was not sent! Please contact us by phone.', 'testdevwp')));
    }

    //get redirect page id
    $redirect_page_id = testdevwp_opt('thank_you_page');
    $redirect_url = get_permalink($redirect_page_id);
    wp_send_json_success(
        array(
            'redirect' => $redirect_url,
        )
    );
}

add_action('wp_ajax_testdevwp_contact_form', 'testdevwp_contact_form_ajax_handle');
add_action('wp_ajax_nopriv_testdevwp_contact_form', 'testdevwp_contact_form_ajax_handle');