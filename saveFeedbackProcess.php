<?php

session_start();
require "./dbConn.php";

if(isset($_SESSION["u"])){

    $mail = $_SESSION["u"]["email"];
    $pid = $_POST["pid"];
    $type = $_POST["t"];
    $feedback = $_POST["feed"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback`(`type`,`feed`,`date`,`product_id`,`user_email`) VALUES 
    ('".$type."','".$feedback."','".$date."','".$pid."','".$mail."')");

    echo "1";

}

?>