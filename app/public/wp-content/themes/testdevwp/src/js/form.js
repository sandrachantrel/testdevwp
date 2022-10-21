//jQuery est une bibliothèque JavaScript libre et multiplateforme créée pour faciliter l'écriture de scripts côté client dans le code HTML des pages web.
// Execution du code JS que si le DOM est prêt
jQuery(document).ready(function ($) {

    // Création d'une variable pour notre formulaire
    let form = $("#contact-form");
    console.log(form);
    // On capte l'evenement soumission du formulaire
    form.submit(function (event) {
        // On recupere l'ensemble des donnees
        let formData = new FormData(form[0]);
        // rajoute action en tant que champs dans le formulaire pour qu'admin-ajax.php comprenne quelle action à executer
        // le nom de l'action est celui se trouvant après wp-ajax-NOM-DE-DOMAINE dans le fichier traitement-ajax.php
        formData.append('action', 'testdevwp_contact_form');

        //L'Ajax ('Asynchronous Javascript and XML) est une combinaison de plusieurs technologies qui permet de récupérer des données sans à avoir à recharger la page.
        $.ajax({
            type: 'post', // Permet de préciser la méthode d’envoi de la requête
            url: testdevwpFormObject.ajaxUrl, //URL de la requête. Seule option strictement obligatoire ;
            data: formData, //Contient les données à envoyer au serveur. Si ces données ne sont pas au format chaine de caractères, elles seront converties en chaine ;
            contentType: false,
            processData: false,
            dataType: "json", //Le type de données qu’on attend en réponse du serveur. Par défaut, jQuery examinera le type MIME de la réponse si aucun type de données n’est spécifié ;
            beforeSend: function (){
                //
            },
            success: function (jsonResponse) {
                if (jsonResponse.success) {

                    // on vide le formulaire
                    form[0].reset();

                    // au succes on redirige l'utilisateur
                    window.location.href = jsonResponse.data.redirect;

                }
                else {

                    // on affiche le message d'erreur
                    $('#noty').attr('class', 'noty-success').html(testdevwpFormObject.formError);

                }
            },
        })
        //La méthode preventDefault(), rattachée à l'interface Event, indique à l'agent utilisateur que si l'évènement n'est pas explicitement géré, l'action par défaut ne devrait pas être exécutée comme elle l'est normalement.
        // L'évènement continue sa propagation habituelle à moins qu'un des gestionnaires d'évènement invoque stopPropagation() ou stopImmediatePropagation() pour interrompre la propagation.
        event.preventDefault();
        event.stopPropagation();
    });

});


