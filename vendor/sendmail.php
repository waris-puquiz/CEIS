<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';
require_once '../resources/php/init.php';
insertR();

$mail = new PHPMailer(true);

$email = $_POST['name'];
$seat = $_POST['seat'];
$movie = $_POST['mov'];
$time = $_POST['time'];
$date = $_POST['date'];
$body = "You have successfully reserved seat on the movie $movie, Date: $date, Time: $time, Seat:";
foreach($seat as $data) {
    $body .= " ".strtoupper($data);
}

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'seatreservation.mailer@gmail.com';                    
    $mail->Password   = 'seatreservation';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('seatreservation.mailer@gmail.com');
    $mail->addAddress($email);    

    //Content
    $mail->isHTML(true);                               
    $mail->Subject = 'Cinema Square - Seat Reservation';
    $mail->Body    = $body;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
header("Location: ../index.php");