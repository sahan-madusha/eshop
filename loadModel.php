<?php
require "./dbConn.php";

if(isset($_GET["c"])){

    $brand_id = $_GET["c"];

    echo($brand_id);

    $brand_rs = Database::search("SELECT * FROM `brand_has_model` INNER JOIN model ON 
    brand_has_model.model_id = Model.id INNER JOIN brand ON
    brand_has_model.brand_id = brand.id WHERE
    brand_id = '".$brand_id."' ");
    

    $brand_num = $brand_rs->num_rows;
    
    if($brand_num>0){
        for ($y = 0; $y < $brand_num; $y++) {
            $brand_data = $brand_rs->fetch_assoc();
        ?>
            <option value="<?php echo($brand_data["id"]); ?>"><?php echo($brand_data["Model_name"]); ?></option>
        <?php
        }
    }else{
        $all_brands = Database::search("SELECT * FROM `model`");
        $all_num = $all_brands->num_rows;

        for ($y = 0; $y < $all_num; $y++) {
            $all_data = $all_brands->fetch_assoc();
        ?>

            <option value="<?php echo $all_data["id"]; ?>"><?php echo $all_data["Model_name"]; ?></option>

<?php
        }
    }
}
?>