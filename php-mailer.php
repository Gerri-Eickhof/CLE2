<?php
error_reporting(0);
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sentMail() {
        //making variables of the checked input
        $firstname  = mysqli_escape_string($GLOBALS['conn'], $_POST['firstname']);
        $lastname   = mysqli_escape_string($GLOBALS['conn'], $_POST['lastname']);
        $email      = mysqli_escape_string($GLOBALS['conn'], $_POST['mail']);
        $phone      = mysqli_escape_string($GLOBALS['conn'], $_POST['phoneNumber']);
        $date       = mysqli_escape_string($GLOBALS['conn'], $_POST['appDate']);
        $time       = mysqli_escape_string($GLOBALS['conn'], $_POST['appTime']);

        echo $firstname . $lastname . $email;
        //Require the form validation handling
        require_once "form-validation.php";

        //Variables from form to variables in this file
        //    if (empty($errors)) {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // Debug server side
            $mail->SMTPDebug = 2;
            // settings from mail server
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = 'indihelene@gmail.com';
            $mail->Password = 'kankerhoer';

            // mail from, where to and reply email (cc and bcc can be used when removing //
            $mail->setFrom('indihelen@gmail.com');
            $mail->addAddress('luc.karlas@gmail.com', $firstname . " " . $lastname);
            $mail->addReplyTo('indihelene@gmail.com');
            //$mail->addCC('');
            //$mail->addBCC('');

            // Subject of the mail with the date of reservation
            $mail->Subject = "Bevestiging Ophaalafspraak op $date";
            // Making the body of the mail
            $Body = "Geachte $firstname $lastname,\n\n";
            $Body .= "Hierbij bevestigen wij uw afspraak op $date om $time. ";

            // Using the Body for the mail
            $mail->Body = $Body;

            $mail->send();
            // redirecting back to previous page
        } catch (Exception $exception) {
            // error message in case something went wrong
            // echo "Error:" . $mail->ErrorInfo;
        }
}