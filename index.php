<?php
require 'PHPMailer/PHPMailerAutoload.php';
require 'connect.php';
include 'question.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 2;

$mail->isSMTP();
$mail->Host = MAIL_HOST;
$mail->SMTPAuth = true;
$mail->Username = MAIL_USERNAME;
$mail->Password = MAIL_PASSWORD;
$mail->SMTPSecure = 'tsl';
$mail->Port = 587;

while($row = $req->fetch()){
    if($row['valide']) {
        
        $mail->setFrom(MAIL_USERNAME, 'Darty');
        $mail->addAddress($row['email']);               
        $mail->addReplyTo(MAIL_USERNAME, 'NoReply');
        $mail->isHTML(true);

        $mail->Subject = "Newsletter";
        $mail->Body = "
                            <h1>Ceci est une campagne de pub.</h1>
                            <p>Merci de ne pas répondre.</p>
                            <table>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Question du jour (in english)</th>
                                </tr>
                                <tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['nom'] . "</td>
                                    <td>" . $row['prenom'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $maQuestion . "</td>
                                </tr>                        
                            </table>                            
                        ";

        if(!$mail->send()) {
            echo "Message could not be sent. <br />";
            echo "Mailer Error: " . $mail->ErrorInfo . "<br />";   
            // Ici le code pour l'erreur avec le bounce, mais mes essais n'ont pas fonctionné
        } else {
            echo 'Message has been sent';
        }
        usleep(100);
    }    
}