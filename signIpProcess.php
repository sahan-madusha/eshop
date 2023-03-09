<?php

session_start();

require "./dbConn.php";

$email = $_POST["email2"];
$password = $_POST["password2"];
$rememberme = $_POST["rememberme"];

if(empty($email)){
    echo("please enter your email !");
}elseif(strlen($email)>100){
    echo("email must have less than 100 charactors !");
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid email!");
}elseif(empty($password)){
    echo("please enter your password !");
}elseif(strlen($password)<5 || strlen($password)>20){
    echo("password must be between 5 - 20 charactors");
}else{
    $result = Database::search(("SELECT `email` ,`password` FROM `user` 
    WHERE `email`='".$email."' AND `password`='".$password."'"));
    $num =$result->num_rows;

    if($num==1){
        echo("success");
        $data=$result->fetch_assoc();
        $_SESSION["u"] = $data;

        if($rememberme=="true"){
            setcookie("email",$email,time()+(60*60*24*365));
            setcookie("password",$password,time()+(60*60*24*365));
        }else{
            setcookie("email","",-1);
            setcookie("password","",-1);
        }
    }else{
        echo("invalid username or password");
    }
}
?>