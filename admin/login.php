<?php

// $hashed_password = password_hash('Familyone@379', PASSWORD_DEFAULT);
// echo $hashed_password;

?>


<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../images/logo2.png">

        <!-- preloader css -->
        <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <!-- My Css -->
        <link href="assets/css/style.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    </head>

    <body onload="return CheckRefresh()">

    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0 justify-content-center align-items-center" style="min-height: 100vh;">
                    <div class="col-xxl-3 col-lg-4 col-md-5 box-shadow">
                        <div class=" d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="" class="d-block auth-logo">
                                            <img src="../images/logo2.png" alt="" height="85">
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Family One</h5>
                                            <p class="text-muted mt-2">Admin Login</p>
                                        </div>

                                        <?php if (isset($_GET['error'])): ?>
                                        <p class="error"> <?php echo $_GET['error']; ?> </p>
                                        <?php endif ?>

                                        <form class="mt-4 pt-2" action="login-verify.php" method="POST">
                                            <div class="mb-3">
                                                <label class="form-label font-fam" style="font-size: 17px;">Username</label>
                                                <input type="text" name="username" class="form-control font-fam" id="username" placeholder="Enter username" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <label class="form-label font-fam" style="font-size: 17px;">Password</label>
                                                    </div>
                                                    <!-- <div class="flex-shrink-0">
                                                        <div class="">
                                                            <a href="auth-recoverpw.html" class="text-muted">Forgot password?</a>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" name="password1" class="form-control font-fam" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" required>
                                                    <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <div class="form-check">
                                                        
                                                    </div>  
                                                </div>
                                                
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light font-fam" type="submit" style="font-size: 16px;">Log In</button>
                                            </div>
                                        </form>

                                        
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="assets/libs/pace-js/pace.min.js"></script>
        <!-- password addon init -->
        <script src="assets/js/pages/pass-addon.init.js"></script>

        <!-- clear link on refresh -->

        <script>
            function CheckRefresh() {
                if (performance.navigation.type == 1) {
                    window.location.href = removeURLParameters(window.location.href);
                }
            }
            function removeURLParameters(url) {
                    var urlparts = url.split('?');   
                    if (urlparts.length >= 2) {
                        return urlparts[0];
                    }
                    else {
                        return url;
                    }
            }
        </script>

    </body>

</html>