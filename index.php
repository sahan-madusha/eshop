<?php
session_start();
require "./dbConn.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-shop</title>

    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body class="main_body">
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">
            <!--header-->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title1">hi , welcom to eShop</p>
                    </div>
                </div>
            </div>
            <!--end header-->

            <!--content-->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background"></div>
                        <div class="col-12 col-lg-6" id="signUpBox">
                            <div class="row g-2">
                                <div class="col-12">
                                    <p class="title2">
                                        Creat new account
                                    </p>
                                </div>

                            <div class="col-12 d-none" id="msgdiv">
                            <div id="msgbox" class="alert alert-danger d-flex align-items-center" role="alert">
                                <i  class="bi bi-exclamation-circle fs-5 mr-1"></i>
                                <p class="SignUpalert" id="msg"></p>
                            </div>
                            </div>
                                <div class="col-6">
                                    <label class="form-lable">First name</label>
                                    <input type="text" class="form-control" id="f"/>
                                </div>
                                <div class="col-6">
                                    <label class="form-lable">Last name</label>
                                    <input type="text" class="form-control" id="l"/>
                                </div>
                                <div class="col-12">
                                    <label class="form-lable">email</label>
                                    <input type="email" class="form-control" id="e"/>
                                </div>
                                <div class="col-12">
                                    <label class="form-lable">password</label>
                                    <input type="password" class="form-control" id="p"/>
                                </div>
                                <div class="col-6">
                                    <label class="form-lable">Mobile</label>
                                    <input type="text" class="form-control" id="m"/>
                                </div>
                                <div class="col-6">
                                    <label class="form-lable">Gender</label>
                                    <select class="form-select" id="g">
                                        <?php
                                        $result = Database::search("SELECT*FROM `gender`");
                                        $resultNumber = $result->num_rows;
                                        for($x=0;$x<$resultNumber;$x++){
                                            $data = $result->fetch_assoc();
                                        ?>
                                        <option value="<?php echo($data["id"]);?>" ><?php echo($data["gender_name"]);?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-dark" onclick="changeView();">Already have an account? Sign In</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 d-none" id="signInBox">
                            <div class="row g-2">
                                <div class="col-12">
                                    <p class="title2">Sign In</p>
                                    <span class="text-danger" id="msg2"></span>
                                </div>
                                <div class="col-12 d-none" id="msgdiv2">
                                    <div id="msgbox" class="alert alert-danger d-flex align-items-center" role="alert">
                                    <i  class="bi bi-exclamation-circle fs-5 mr-1"></i>
                                    <p class="SignUpalert" id="msg2"></p>
                                    </div>
                                    <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>
                                </div>
                                <div class="col-12">
                                    <label class="form-lable">E-mail</label>
                                    <input id="email2" type="email" class="form-control" value="<?php echo($email);?>"/>
                                </div>
                                <div class="col-12">
                                    <label class="form-lable">passworrd</label>
                                    <input id="password2" type="password" class="form-control" value="<?php echo($password);?>"/>
                                </div>
                                <div class="form-check col-6">
                                    <input id="rememberme"  class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="link-primary" onclick="forgotPassword();">Forgot password ?</a>
                                </div>
                                <div class="col-6 d-grid">
                                    <button onclick="signIn();" class="btn btn-success">Sign In</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button class="btn btn-danger" onclick="changeView();">New toeShop ? join now</button>
                                </div>
                                
                            </div>
                        </div>
                </div>
            </div>
            <!--end content-->


            <!-- modal -->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"> Reset Password</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row g-3">
                      <div class="col-6">
                        <label class="form-label">New Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="npi"/>
                            <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                        </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Re-type Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="rnp"/>
                                <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Verification Code</label>
                            <input type="text" class="form-control" id="vc"/>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                    </div>
                  </div>
                </div>
            </div>
            <!-- modal -->

            <!--footer-->
            <div class="col-12 fixed-bottom d-none d-lg-block">
                <p class="text-center">&copy; 2020 eShop.lk || All Right Reserved</p>
            </div>
            <!--end footer-->
        </div>
    </div>

    <script src="./bootstrap.js"></script>
    <script src="./bootstrap.bundle.js "></script>
    <script src="./script.js"></script>
    <!-- JavaScript Bundle with Popper -->
</body>
</html>

<!--
vh-100 = vh =100
d-flex = diplay-flex
-->






<!--
    sahan madusha , sahanmadusha001@gmail.com , 200004400162 , 0771617400
                            -->