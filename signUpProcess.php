<?php
require "./dbConn.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];


if(empty($fname)){
    echo("please enter your first name !");
}elseif(strlen($fname)>15){
    echo("First name must have less than 15 charactors !");
}elseif(empty($lname)){
    echo("please enter your second name !");
}elseif(strlen($lname)>50){
    echo("last name must have less than 50 charactors !");
}elseif(empty($email)){
    echo("please enter your email !");
}elseif(strlen($email)>=100){
    echo("Email must have less than 15 charactors !");
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid email!");
}elseif(empty($password)){
    echo("please enter your password !");
}elseif(strlen($password)<5 || strlen($password)>20){
    echo("password must be between 5 - 20 charactors");
}elseif(empty($mobile)){
    echo("please enter your mobile !");
}elseif(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo("Invalid mobile number");
}else{
    $resul = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `mobile`='".$mobile."'");
    $num =$resul->num_rows;

    if($num>0){
        echo("User with the same Email or Mobile already exists.");
    }else{
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` 
    (`email`,`fname`,`lname`,`password`,`mobile`,`joined_date`,`status`,`gender_id`) VALUES 
    ('".$email."','".$fname."','".$lname."','".$password."','".$mobile."','".$date."','1','".$gender."')");

        echo "success";
    }
}



?>