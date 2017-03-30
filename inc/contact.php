<?php

//contact form submission
$error = array();
$success = false;

if(!empty($_POST['submit-form'])) {
  //xss
  $name = (!empty($_POST['name'])) ? trim(strip_tags($_POST['name'])) : '';
  $firstname = (!empty($_POST['firstname'])) ? trim(strip_tags($_POST['firstname'])) : '';
  $mail = (!empty($_POST['mail'])) ? trim(strip_tags($_POST['mail'])) : '';
  $subject = (!empty($_POST['subject'])) ? trim(strip_tags($_POST['subject'])) : '';
  $message = (!empty($_POST['message'])) ? trim(strip_tags($_POST['message'])) : '';

  // NAME
  if(!empty($name)) {
    if(is_numeric($name)) {
      $error['name'] = "Merci de renseigner un nom de famille en toutes lettres";
    }
  } else {
    $error['name'] = "Merci de renseigner un nom de famille";
  }

  //FIRSTNAME
  if(!empty($firstname)) {
    if(is_numeric($firstname)) {
      $error['firstname'] = "Merci de renseigner un prénom en toutes lettres";
    }
  } else {
    $error['firstname'] = "Merci de renseigner un prénom";
  }

  //EMAIL
  if(!empty($mail)) {
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $error['mail'] = "Merci de renseigner un format d'e-mail valide";
    }
  } else {
    $error['mail'] = "Merci de renseigner un e-mail qui servira à vous joindre";
  }

  //OBJECT
  if(!empty($subject)) {
    if(strlen($subject) < 3) {
      $error['subject'] = "Merci d'indiquer un objet plus long";
    } elseif (strlen($subject) > 255) {
      $error['subject'] = "Merci d'indiquer un objet plus court";
    }
  } else {
    $error['subject'] = "Merci de préciser l'objet de votre message";
  }

  //MESSAGE
  if(!empty($message)) {
    if(strlen($message) < 3) {
      $error['message'] = "Merci d'écrire un message plus long";
    } elseif (strlen($message) > 2000) {
      $error['message'] = "Merci d'écrire un message plus court";
    }
  } else {
    $error['message'] = "Merci d'écrire un message";
  }

  //if no error
  if(count($error) == 0) {
    //send mail
    $mailer = new PHPMailer;
    $mailer->isMail();

    $mailer->setFrom($mail, 'Expediteur');
    $mailer->addAddress('admin@neustrie.fr', 'Neustrie - Administrateurs');
    $mailer->addReplyTo($mail, 'Expediteur');

    $mailer->isHTML(true);

    $mailer->Subject = $subject;
    $mailer->Body    = $message;
    $mailer->AltBody = $message;

    if(!$mailer->send()) {
        //fail mail
        //set flash message
        $flashText = "<h4><b>Une erreur est survenue lors de l'envoi du message.</b></h4>";
        $flashText .= "<p>Veuillez réessayer.</p>";
        $Flash->setMessage($flashText, 'error');
        //redirect
        header('Location: index.php#contact');
        exit();

        //echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mailer->ErrorInfo;
    } else {
        //success mail
        //set flash message
        $flashText = "<h4><b>Votre message a bien été envoyé.</b></h4>";
        $flashText .= "<p>Vous recevrez une réponse de l'équipe à l'adresse que vous avez renseignée dans le formulaire.</p>";
        $Flash->setMessage($flashText, 'success');
        //redirect
        header('Location: index.php#contact');
        exit();

        //echo 'Message has been sent';
    }
  }
  // end if(count($error) == 0);

}

?>
