<?php

// lance les classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// path du dossier PHPMailer % fichier d'envoi du mail
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function EnvoyerEmail($to, $sujet, $body)
{
    $mail = new PHPMailer(true);
      // puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
      try {
        /* DONNEES SERVEUR */
        #####################
        $mail -> SMTPDebug  =  2 ;    
        $mail -> isSMTP();
        // $mail->isSendmail();    // décommenter en mode debug avec le SMTP de Gmail (remplace la ligne précédente)
        $mail->Host = "smtp-mail.outlook.com";
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth = true;
        $mail->Username = "mickey_dt@hotmail.fr";    
        $mail->Password = "Jk43o{63$8%";                                    
        $mail->setFrom("mickey_dt@hotmail.fr");
    
        /* DONNEES DESTINATAIRES */
        ##########################
        $mail->addAddress($to, 'Clients de Mon_Domaine');        // Adresse du destinataire (le nom est facultatif)
           
        /* CONTENU DE L'EMAIL*/
        ##########################
        $mail->isHTML(true);                                      // email au format HTML
        $mail->Subject = utf8_decode($sujet);      // Objet du message (éviter les accents là, sauf si utf8_encode)
        $mail->Body    = $body;          // corps du message en HTML - Mettre des slashes si apostrophes
        $mail->AltBody = 'Contenu au format texte pour les clients e-mails qiui ne le supportent pas'; // ajout facultatif de texte sans balises HTML (format texte)
    
        $mail->send();
        echo 'Message envoyé.';
      
      }
      // si le try ne marche pas > exception ici
      catch (Exception $e) {
        echo "Le Message n'a pas été envoyé. Mailer Error: {$mail->ErrorInfo}"; // Affiche l'erreur concernée le cas échéant
      }  
}

?>