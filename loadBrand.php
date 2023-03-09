<?php
require "./dbConn.php";

if(isset($_GET["c"])){

    $category_id = $_GET["c"];

    $category_rs = Database::search("SELECT * FROM `category_has_brand` INNER JOIN category ON 
    category_has_brand.category_id = category.id INNER JOIN brand ON 
    category_has_brand.brand_id = brand.id WHERE
    category_id = '".$category_id."' ");

    $category_num = $category_rs->num_rows;
    
    if($category_num > 0){

        for ($y = 0; $y < $category_num; $y++) {
            $category_data = $category_rs->fetch_assoc();
        ?>
            <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["brand_name"]; ?></option>
        <?php
        }
    }else{
        $all_brands = Database::search("SELECT * FROM `brand`");
        $all_num = $all_brands->num_rows;

        for ($y = 0; $y < $all_num; $y++) {
            $all_data = $all_brands->fetch_assoc();
        ?>

            <option value="<?php echo $all_data["id"]; ?>"><?php echo $all_data["brand_name"]; ?></option>

<?php
        }
    }
}

?>