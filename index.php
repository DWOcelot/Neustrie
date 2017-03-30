<?php
session_start();
//require autoload phpmailer
require __DIR__ . '/vendor/autoload.php';
//inc class Flash pour message soumission form
require_once 'inc/Flash.php';
$Flash = new Flash();
//inc functions perso
include 'inc/functions.php';
//inc submission form
include 'inc/contact.php';

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="asset/images/neustrie-favicon.ico" />
    <title>Neustrie</title>
    <!-- Foundation CSS -->
    <link rel="stylesheet" href="asset/css/foundation.css">
    <!-- Slicknav CSS -->
    <link rel="stylesheet" href="asset/css/slicknav.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="asset/css/animate.css">
    <!-- Font-Awesome  -->
    <link rel="stylesheet" href="asset/css/font-awesome.min.css">
    <!-- SlickSlider CSS -->
    <link rel="stylesheet" href="asset/slickslider/slick.css"/>
    <!-- Perso CSS -->
    <link rel="stylesheet" href="asset/css/style.css">
  </head>

  <body>
    <!-- PROGRESS BAR -->
    <div id="progress-bar"></div>
    <main id="wrapper">
    <!-- HEADER -->
    <nav class="top-bar">
      <div class="top-bar-left">
        <div class="siteTitle">
          <img src="asset/images/neustrie-logo.png" height="100" width="100" alt="Logo Neustrie" />
          <h1><a href="index.php">Neustrie</a></h1>
        </div>
      </div>
      <div class="top-bar-right">
        <ul id="menu" class="menu">
          <li><a href="#presentation" class="scroll">Présentation</a></li>
          <li><a href="#qui-sommes-nous" class="scroll">Qui sommes-nous ?</a></li>
          <li><a href="#contact" class="scroll">Contact</a></li>
        </ul>
      </div>
    </nav>


      <!-- SLIDER PRESENTATION -->
      <section id="presentation" class="expanded row">
        <div class="small-12 columns">

          <!-- SLICKSLIDER -->
          <div class="slickslider">
            <div class="one-slide">
              <img src="asset/images/guitar-slide.jpg" alt="Slide Guitares">
              <p>Guitares</p>
            </div>
            <div class="one-slide">
              <img src="asset/images/crowd-slide.jpg" alt="Slide Foule">
              <p>Foule</p>
            </div>
            <div class="one-slide">
              <img src="asset/images/drums-slide.jpg" alt="Slide Batterie">
              <p>Batterie</p>
            </div>
            <div class="one-slide">
              <img src="asset/images/scene-slide.jpg" alt="Slide Scène">
              <p>Scène</p>
            </div>
            <div class="one-slide">
              <img src="asset/images/scene-slide.jpg" alt="Slide Scène">
              <!-- Youtube video -->
              <iframe id="youtube-video" src="https://www.youtube.com/embed/M2Lcdda34Eg?enablejsapi=1" frameborder="0" allowfullscreen></iframe>
            </div>
          </div>
          <!-- end slickslider -->
        </div>

      </section>
      <!-- end slider presentation -->


      <!-- QUI SOMMES NOUS -->
      <section id="qui-sommes-nous" class="row">

        <div class="small-12 columns">
          <div class="media-object stack-for-small">
            <div class="media-object-section">
              <div class="thumbnail">
                <img src="asset/images/neustrie.jpg" alt="Logo Neustrie" title="Neustrie">
              </div>
            </div>
            <div class="media-object-section media-object-text">
              <h2><strong>Neustrie</strong></h2>
              <p>Quatre musiciens (chanteur/harmonica, bassiste/contrebassiste, batteur/percussionniste, guitarite) dans le vent, adeptes de reprises pop-rock mais aussi et surtout de compositions originales, ils mélangent les styles musicaux et les langues pour offrir des performances qu'ils veulent inoubliables pour leur public.<br>
              S'étant déjà produits sur scène lors de multiples fêtes de la musique, à l'occasion de Téléthons, ils assurent un spectacle vivant et bon enfant devant un public de tous âges et tous horizons.</p>
            </div>
          </div>
        </div>

      </section>
      <!-- end qui sommes nous -->

      <!-- Bouton toggle form contact -->
      <div class="row text-center">
        <div class="small-12 columns">
          <button id="toggleContactForm"><a href="#contact">Nous Contacter</a></button>
        </div>
      </div>
      <!-- Callout Flash message -->
    <?php if($Flash->hasMessage()): ?>
      <div data-closable class="column small-12 callout <?php echo ($Flash->getType() === 'success') ? 'primary' : 'alert' ?> text-center">
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
          <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $Flash->getText(); ?>
      </div>
    <?php endif; ?>


      <!-- CONTACT -->
      <section id="contact">

        <div class="expanded row">
          <div class="small-12 columns text-center">
            <!-- Contact formulaire -->
            <form class="contactForm" action="#" method="POST" <?php if(count($error) > 0) { echo 'data-error="true"'; } ?>>

            <!-- Ligne NOM / Prénom -->
              <div class="row">
                <div class="small-12 medium-6 small-centered columns">
                  <label for="name">Votre NOM : <span class="errorForm errorFormName"><?php if(!empty($error['name'])) { echo $error['name']; } ?></span></label>
                  <input type="text" name="name" placeholder="ex: DUPONT" value="<?php if(!empty($_POST['name'])) { echo $_POST['name']; } ?>" />
                </div>
                <div class="small-12 medium-6 columns">
                  <label for="firstname">Votre Prénom : <span class="errorForm errorFormFirstname"><?php if(!empty($error['firstname'])) { echo $error['firstname']; } ?></span></label>
                  <input type="text" name="firstname" placeholder="ex: Jean" value="<?php if(!empty($_POST['firstname'])) { echo $_POST['firstname']; } ?>" />
                </div>
              </div>
              <!-- Ligne Email -->
              <div class="row">
                <div class="small-12 medium-6 small-centered columns">
                  <label for="mail">Votre E-mail : <span class="errorForm errorFormMail"><?php if(!empty($error['mail'])) { echo $error['mail']; } ?></span></label>
                  <input type="text" name="mail" placeholder="example@mail.fr" value="<?php if(!empty($_POST['mail'])) { echo $_POST['mail']; } ?>" />
                </div>
                <!-- Sujet message -->
                <div class="small-12 medium-6 small-centered columns">
                  <label for="subject">L'objet de votre message : <span class="errorForm errorFormSubject"><?php if(!empty($error['subject'])) { echo $error['subject']; } ?></span></label>
                  <input type="text" name="subject" placeholder="ex: Demande de contact" value="<?php if(!empty($_POST['subject'])) { echo $_POST['subject']; } ?>" />
                </div>
              </div>
              <!-- Ligne Message -->
              <div class="row">
                <div class="small-12 small-centered columns">
                  <label for="message">Votre Message : <span class="errorForm errorFormMessage"><?php if(!empty($error['message'])) { echo $error['message']; } ?></span></label>
                  <textarea name="message" rows="5" placeholder="Ce qui vous passe par la tête..."><?php if(!empty($_POST['message'])) { echo $_POST['message']; } ?></textarea>
                </div>
              </div>
              <!-- Bouton envoyer -->
              <div class="row">
                <div class="small-12 small-centered columns text-center">
                  <input class="button secondary" type="submit" name="submit-form" value="Envoyer"/>
                </div>
              </div>

            </form>
          </div>
        </div>

      </section>
      <!-- end contact formulaire -->

      <!-- Button back to top -->
      <div class="row">
        <button id="backToTop">
          <i class="fa fa-arrow-up" aria-hidden="true"></i>
        </button>
      </div>



      <!-- FOOTER -->
      <footer id="footer">
        <!-- second row footer -->
        <div class="row">
          <div class="small-12 columns text-center">
            <p><i>Copyright © 2017 Neustrie Prod, Tous droits réservés</i></p>
            <div class="social-media">
              <i class="fa fa-facebook" aria-hidden="true">
                <a href="https://www.facebook.com/profile.php?id=100013546516510&lst=1173154471%3A100013546516510%3A1486460172" target="_blank">Neustrie Prod.</a>
              </i>
              <i class="fa fa-envelope-o" aria-hidden="true">
                <a href="mailto:benoit.blondel12@gmail.com">Contacter le Webmaster</a>
              </i>
              <i class="fa fa-github" aria-hidden="true">
                <a href="https://github.com/DWOcelot" target="_blank">DWOcelot</a>
              </i>
            </div>
          </div>
        </div>
      </footer>

    </main>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <!-- JQuery UI -->
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
    crossorigin="anonymous"></script>
    <!-- Foundation JS -->
    <script src="asset/js/vendor/foundation.min.js"></script>
    <!-- Slicknav JS -->
    <script src="asset/js/jquery.slicknav.min.js"></script>
    <!-- Slicknav smooth Scroll JS -->
    <script src="http://slicknav.com/js/jquery.smooth-scroll.min.js"></script>
    <!-- SlickSlider JS -->
    <script type="text/javascript" src="asset/slickslider/slick.min.js"></script>
    <!-- Youtube API -->
    <script type="text/javascript" src="http://youtube.com/iframe_api"></script>
    <!-- JS perso -->
    <script src="asset/js/app.js"></script>
    <!-- Browser Sync -->
    <!-- <script id="__bs_script__">
      //<![CDATA[
      document.write("<script async   src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.8'><\/script>".replace("HOST", location.hostname));
      //]]>
    </script> -->
  </body>
</html>
