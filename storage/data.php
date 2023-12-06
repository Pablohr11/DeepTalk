<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendMail($to, $username, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'deeptalk.php.project';                     //SMTP username
        $mail->Password   = 'twxj mvzc kvio jfxn';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('registro@deeptalk.es', 'Deeptalk');
        $mail->addAddress($to, $username);     //Add a recipient
        //$mail->addAddress('maildeejemplo@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('captura.png');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "<b>$message</b>";
        $mail->AltBody = $message;
        
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}

function obtenerHoraDeFecha($fecha){
    return substr($fecha, 11,5);
}

function obtenerFechaDeMensaje($fecha){
    $date =  new DateTime(substr($fecha, 0,10));
    $mes = monthToSpanish($date->format("F"));
    return $date->format("d")." de ".$mes;
}

function monthToSpanish(string $month) {
    $palabra = "error";

    switch (strtolower($month)) {
        case "january":
            $palabra = "Enero";
            break;
        case "february":
            $palabra = "Febrero";
            break;
        case "march":
            $palabra = "Marzo";
            break;
        case "april":
            $palabra = "Abril";
            break;
        case "may":
            $palabra = "Mayo";
            break;
        case "june":
            $palabra = "Junio";
            break;
        case "july":
            $palabra = "Julio";
            break;
        case "august":
            $palabra = "Agosto";
            break;
        case "september":
            $palabra = "Septiembre";
            break;
        case "october":
            $palabra = "Octubre";
            break;
        case "november":
            $palabra = "Noviembre";
            break;
        case "december":
            $palabra = "Diciembre";
            break;
    }

    return $palabra;

}

?>