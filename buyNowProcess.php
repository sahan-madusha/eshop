<?php

require "./dbConn.php";
session_start();

if(isset($_SESSION["u"])){
    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $order_id = uniqid();

    
    //data
    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `user_has_city` WHERE `user_email`='".$umail."'");
    $city_num = $city_rs->num_rows;

    if($city_num == 1){
        $city_data = $city_rs->fetch_assoc();
        $city_id = $city_data["city_id"];
        $address = $city_data["line1"].",".$city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$city_id."'");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["district_id"];
        $delivery = "0";


        if($district_id == "4"){
            $delivery = $product_data["delivery_fee_colombo"];
        }else{
            $delivery = $product_data["delivery_fee_other"];
        }

        $item = $product_data["title"];

        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $uaddress = $address;
        $city = $district_data["name"];

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["city"] = $city;
        $array["umail"] = $umail;

    echo json_encode($array);


    }else{
        echo("2");
    }

}else{
    echo ("1");
}




?>