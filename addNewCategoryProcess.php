<?php

session_start();
require "./dbConn.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["email"]) && isset($_POST["name"])){
    if($_SESSION["au"]["email"] == $_POST["email"]){

        $cname = $_POST["name"];
        $umail = $_POST["email"];

        $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_name` LIKE '%".$cname."%'");
        $category_num = $category_rs->num_rows;

        if($category_num == 0){

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$umail."'");

            // EMAIL CODE
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sahanmadusha001@gmail.com';
            $mail->Password = 'bapibucrvdwgogvc';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('sahanmadusha001@gmail.com', 'Reset Password');
            $mail->addReplyTo('sahanmadusha001@gmail.com', 'Reset Password');
            $mail->addAddress($umail);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Forgot Password Verification Code';
            $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }
            // EMAIL CODE

        }else{
            echo ("This Category Already Exists");
        }
    }else{
        echo ("Invalid User");
    }
}else{
    echo ("Something Missing");
}

?>