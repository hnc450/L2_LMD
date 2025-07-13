<?php 
  namespace Messages;
 
  class Messages
  {

    private static $instance;

    public static function getInstance():Messages{
        if(is_null(static::$instance)){
            static::$instance = new Messages();
        }
        return static::$instance;
    }

    public function success(string $sujet ,string $email, string $name, string $message){
      $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
      try {
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com'; // Ton serveur SMTP
          $mail->SMTPAuth = true;
          $mail->Username = 'henoctumonakiese@gmail.com'; // Ton email
          $mail->Password = 'ssigcfqxkvpemqow'; // Ton mot de passe
          $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;
          $mail->CharSet = 'UTF-8';

         // Expéditeur et destinataire
         $mail->setFrom('henoctumonakiese@gamil.com', 'Henock');
         $mail->addAddress($email,$name);

         // Contenu du message
         $mail->isHTML(true);
         $mail->Subject = $sujet;
         $mail->Body    = "
                <div style='
                    font-family: Arial, sans-serif; 
                    background-color: #ffffff; 
                    padding: 30px; 
                    max-width: 500px; 
                    margin: auto;
                    border: 1px solid #dedede; 
                    border-radius: 12px; 
                    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                '>
                    <div style='text-align: center;'>
                        <img src=\"https://cdn-icons-png.flaticon.com/512/845/845646.png\" alt=\"Succès\" width=\"80\" style=\"margin-bottom: 20px;\"/>
                        <h2 style=\"color: #2e8b57; margin-bottom: 10px;\"> $sujet </h2>
                        <p style=\"color: #444; font-size: 16px;\">Bonjour <strong> $email </strong>,</p>
                        <p style=\"color: #444;\"> $message </p>
                        <div style=\"background-color: #e0ffe0; padding: 15px; margin-top: 20px; border-radius: 8px; color: #2e8b57; font-weight: bold;\">
                            ✅ Merci pour votre efficacité !
                        </div>
                        <p style=\"margin-top: 30px; font-size: 14px; color: #888;\">— QuizWorld </p>
                    </div>
                </div>
                ";
         $mail->AltBody = $message;

         // Envoi
         $mail->send();
         echo 'Message envoyé avec succès';
      } 
      catch (\PHPMailer\PHPMailer\Exception $e) {
        echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
      }
    }
  }
?>