<?php
session_start();
require "./dbConn.php";


if(isset($_SESSION["u"])){
    $email = $_SESSION["u"]["email"];
    $pageno;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-shop | My Poduct</title>

    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body style="background-color: #E9EBEE;">

    <div class="container-fluid">
        <div class="row">

            <!-- header -->
            <div class="col-12 bg-primary">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12 col-lg-4 mt-1 mb-1 text-center">

                            <?php
                            $profile_image_rs = Database::search("SELECT*FROM `profile_image` WHERE `user_email`='".$email."'");
                            $profile_image_num =  $profile_image_rs->num_rows;
                            $profile_image_date = $profile_image_rs->fetch_assoc();

                            if($profile_image_num == 1){
                                ?>
                                <img src="<?php echo($profile_image_date["path"])?>" width="90px" height="90px" class="rounded-circle" />
                                <?php
                            }else{
                                ?>
                                <img src="./resource/user_icon.svg" width="90px" height="90px" class="rounded-circle" />
                                <?php
                            }
                            ?>
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="row text-center text-lg-start">
                                    <div class="col-12 mt-0 mt-lg-4">
                                        <span class="text-white fw-bold"><?php echo($_SESSION["u"]["fname"]." ".$_SESSION["u"]["lname"])?></span>
                                    </div>
                                    <div class="col-12">
                                        <span class="text-black-50 fw-bold"><?php echo($_SESSION["u"]["email"])?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-2 my-lg-4">
                                <h1 class="offset-4 offset-lg-2 text-white fw-bold">My Products</h1>
                            </div>
                            <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                                <button class="btn btn-warning fw-bold" onclick="window.location ='./addProduct.php' ">Add Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- body -->
            <div class="col-12">
                <div class="row">

                    <!-- filter -->
                    <div class="col-11 col-lg-2 mx-3 my-3 border border-primary rounded">
                        <div class="row">
                            <div class="col-12 mt-3 fs-5">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fw-bold fs-3">Sort Products</label>
                                    </div>
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" placeholder="Search..." class="form-control" id="s" />
                                            </div>
                                            <div class="col-1 p-1">
                                                <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Active Time</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="n">
                                            <label class="form-check-label" for="n">
                                                Newest to oldest
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="o">
                                            <label class="form-check-label" for="o">
                                                Oldest to newest
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">By quantity</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r2" id="h">
                                            <label class="form-check-label" for="h">
                                                High to low
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r2" id="l">
                                            <label class="form-check-label" for="l">
                                                Low to high
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">By condition</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r3" id="b">
                                            <label class="form-check-label" for="b">
                                                Brandnew
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r3" id="u">
                                            <label class="form-check-label" for="u">
                                                Used
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3 mb-3">
                                        <div class="row g-2">
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="btn btn-success fw-bold" onclick="sort1();">Sort</button>
                                            </div>
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="btn btn-primary fw-bold" onclick="clearSort();">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- product -->
                    <div class="col-12 col-lg-9 mt-3 mb-3 bg-white">
                        <div class="row" id="sort">
                            <div class="offset-1 col-10 text-center">
                                <div class="row justify-content-center">
 
                                <?php
                                if(isset($_GET["page"])){
                                    $pageno = $_GET["page"];
                                }else{
                                    $pageno = 1;
                                }

                                $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$email."'");
                                $product_num = $product_rs->num_rows;
                                
                                $results_per_page = 6;
                                $number_of_pages = ceil ($product_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page ;
                                $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$email."'
                                    LIMIT ". $results_per_page ." OFFSET ". $page_results ." ");

                                $selected_nmu = $selected_rs->num_rows;
                                
                                for($x=0; $x < $selected_nmu; $x++){
                                    $selected_data = $selected_rs->fetch_assoc();

                                ?>
                                    <!-- card -->
                                    <div class="card mb-3 mt-3 col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-4 mt-4">

                                            <?php 
                                            
                                            $product_image_rs = Database::search("SELECT*FROM `images` WHERE `product_id`='".$selected_data["id"]."'");
                                            $product_image_data = $product_image_rs->fetch_assoc();
                                            ?>
                                                <img src="<?php echo($product_image_data["code"]) ?>" class="img-fluid rounded-start" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title fw-bold"><?php echo($selected_data["title"]) ?></h5>
                                                    <span class="card-text fw-bold text-primary"><?php echo($selected_data["price"]) ?></span><br />
                                                    <span class="card-text fw-bold text-success"><?php echo($selected_data["qty"]) ?></span>
                                                    
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" 
                                                        id="fd<?php echo($selected_data["id"]); ?>" 
                                                        <?php if($selected_data["status_id"] == 2)
                                                            {?> checked <?php 
                                                            } ?>

                                                            onclick="changeStatus(<?php echo($selected_data['id']);?>);"/>
                                                        <label class="form-check-label fw-bold text-info" for="fd<?php echo($selected_data["id"]); ?>">
                                                        <?php if($selected_data["status_id"] == 2){?>
                                                                Make Your Product Aactive 
                                                        <?php }else{?>
                                                                Make Your Product Deactive
                                                        <?php
                                                        }
                                                        ?>
                                                        </label>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row g-1">
                                                                <div class="col-12 col-lg-6 d-grid">
                                                                    <a class="btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['id'];?>);" >Update</a>
                                                                </div>
                                                                <div class="col-12 col-lg-6 d-grid">
                                                                    <button class="btn btn-danger fw-bold">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- card -->
                                <?php
                                }
                                ?>

                                </div>
                            </div>

                            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-lg justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="<?php if($pageno <= 1){
                                                                                echo("#");
                                                                            }else{
                                                                                echo ("?page=".($pageno-1));
                                                                            }?>" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a>
                                        </li>

                                        <?php
                                            for($x = 1; $x <= $number_of_pages; $x++){
                                                if($x == $pageno){
                                        ?>
                                                    <li class="page-item active">
                                                        <a class="page-link" href="<?php echo("?page=".($x));?>"> <?php echo $x; ?> </a>
                                                    </li>
                                        <?php                                           
                                                }else{
                                        ?>
                                                    <li class="page-item"><a class="page-link" href="<?php echo ("?page=".($x));?>"><?php echo $x ; ?></a></li>
                                        <?php 
                                                }
                                            }
                                        ?>
                                            
                                        <li class="page-item">
                                            <a class="page-link" href="<?php if($pageno >= $number_of_pages){
                                                                                    echo("#");
                                                                                }else{
                                                                                    echo("?page=".($pageno + 1));
                                                                                }?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                    <!-- product -->
                </div>
            </div>
            <!-- body -->

        </div>
    </div>

    <script src="./bootstrap.bundle.js "></script>
    <script src="./script.js"></script>
</body>
</html>

<?php
}else{
    header("location:home.php");
}
?>