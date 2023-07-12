<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class EmailTestController extends Controller
{

    public function index()
    {

        $email = 'zarasc.contact@gmail.com';

        $mail = new PHPMailer();
        // $spacing = "‎ ‎ ‎ ‎ ‎ ‎";

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "resa.komara.akbari@gmail.com";
        $mail->Password = "bkjrpudbpadvfzjf";
        $mail->Subject = "[STEPMEPLACE Verification] don't reply!";
        $mail->setFrom("resa.komara.akbari@gmail.com");
        $mail->isHTML(true);
        $mail->Body = ' <b> HELLOWW! </b> ';
        $mail->addAddress($email);
        // $mail->send();

        if ($mail->send()) {
            return 'SENDED!';
        } else {

            return 'somethings wrong, i can feel it!';
        }

        // $mail->smtpClose();

    }
}
