<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require __DIR__ . '/vendor/autoload.php';

  $userEmail = $email   ?? ($_POST['email']   ?? '');
  $token = $token   ?? ($_POST['token']   ?? '');

  if (!$userEmail || !$token) {
    echo('E-mail ou token manquant.');

    ?>

        <script>
            setTimeout(()=>{
                location.href = "views/register.php";
            }, 3000);
        </script>

    <?php
      
  }

  $isLocal = in_array(
      $_SERVER['SERVER_NAME'],
      ['localhost', '127.0.0.1']
  );

  $mail = new PHPMailer(true);

  try {

      // $mail->SMTPDebug   = 2;
      // $mail->Debugoutput = 'html';

      $mail->isSMTP();

      if ($isLocal) {

          // docker run -d -p 1025:1025 -p 8025:8025 mailhog/mailhog

          $mail->Host       = 'localhost';
          $mail->Port       = 1025;
          $mail->SMTPAuth   = false;
          $mail->SMTPAutoTLS= false;
          $port = 3000;

      } else {                   
        
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'votre.adresse@gmail.com';
          $mail->Password   = 'VOTRE_APP_PASSWORD';   
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port       = 587;

      }

      $mail->setFrom('owner@memberspace.org', name: 'MemberSpace');
      $mail->addAddress($userEmail, 'Utilisateur');

      $confirmUrl = sprintf(
          'http://%s%s/verification.php?email=%s&token=%s',
          $_SERVER['SERVER_NAME'],
          $port ? ":$port" : '',
          urlencode($userEmail),
          urlencode($token)
      );

      $mail->isHTML(true);
      $mail->Subject = 'Merci de confirmer votre adresse e-mail';
      $mail->Body    = "
          <h1>Bienvenue !</h1>
          <p>Pour activer votre compte, cliquez sur le lien ci-dessous :</p>
          <p><a href=\"{$confirmUrl}\">Confirmer mon e-mail</a></p>
          <p>Ce lien expirera dans 24 h.</p>
      ";
      $mail->AltBody = "Rendez-vous sur {$confirmUrl} pour confirmer votre adresse.";

      $mail->send();
  } catch (Exception $e) {
      error_log("PHPMailer Error: {$mail->ErrorInfo}");
      echo "Une erreur est survenue : " . htmlspecialchars($mail->ErrorInfo);
  }
