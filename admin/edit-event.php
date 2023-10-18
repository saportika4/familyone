<?php
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION["password"])) { 

    
require ('db.php'); 

error_reporting(E_ALL ^ E_NOTICE);

$id=$_GET['updateid'];
$sql = "SELECT * FROM events WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

    $id = $row['id'];
    // $title = $row['title'];
    $image = $row['img_url'];
      
      
if (isset($_POST['submit'])) {
      
        $id=$_GET['updateid'];
        $img_name = $_FILES['fileUpload']['name'];
        $img_size = $_FILES['fileUpload']['size'];
        $tmp_name = $_FILES['fileUpload']['tmp_name'];
        $error = $_FILES['fileUpload']['error'];

        // $Title = $_POST['title'];
      
        if ($error === 0) {
        	if ($img_size > 2000000) {
        		$em = "Sorry, your file is too large.";
        	    header("Location: edit-event.php?error=$em");
        	}else {
        		$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        		$img_ex_lc = strtolower($img_ex);
      
        		$allowed_exs = array("jpg", "jpeg", "png" ,"webp"); 
      
        		if (in_array($img_ex_lc, $allowed_exs)) {
        			$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        			$img_upload_path = 'assets/uploads/events/'.$new_img_name;
        			
      
              // Update Database
      
              $sql= "UPDATE events SET img_url=? WHERE id=?";
              $stmt = mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: edit-event.php?error=statementfailed");
                exit();
              }
              mysqli_stmt_bind_param($stmt,"ss",$new_img_name,$id);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_close($stmt);

              if(file_exists("assets/uploads/events/".$image)) {
                unlink("assets/uploads/events/".$image);
              }

              move_uploaded_file($tmp_name, $img_upload_path);
            
              $succ = "Event edited successfully";
              header("Location: event-images.php");
              exit();
      
        		}else {
        			$em = "You can't upload files of this type";
        	        header("Location: edit-event.php?error=$em");
        		}
        	}
        }else {
        	$em = "unknown error occurred!";
        	header("Location: edit-event.php?error=$em");
        }
    }   

?>

<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Edit Events</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../images/logo2.png">

        <!-- dropzone css -->
        <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

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

    </head>

    <body onload="return CheckRefresh()">

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
        <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="admin.php" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="../images/logo2.png" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="../images/logo2.png" alt="" height="24"> <span class="logo-txt">Family One</span>
                                </span>
                            </a>

                            <a href="admin.php" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../images/logo2.png" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="../images/logo2.png" alt="" height="24"> <span class="logo-txt">Family One</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
                                    alt="Header Avatar"> -->
                                    <i data-feather="user"></i>
                                <span class="d-none d-xl-inline-block ms-1 fw-medium"><?php echo $_SESSION['user_name']; ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <!-- <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                                <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item logoutBtn" style="cursor:pointer;"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <?php

                include ('includes/header.php');

            ?>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Edit Event</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Event</a></li>
                                            <li class="breadcrumb-item active">Edit Event</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="d-flex justify-content-center align-items-center">
                            <div class="col-lg-6" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px; padding: 50px; border-radius: 8px;">
                                <div class="mt-4 mt-lg-0">

                                    
                                    
                                    <form action="" method="POST" enctype="multipart/form-data">

                                        <input id="file-upload" type="file" name="fileUpload" accept="image/*" style="display:none; visibility:none" required/>

                                        <label for="file-upload" id="file-drag" class="flex-col" style="width: 100%;"> 
                                            <div class="flex-col">
                                                <p class="head1">Upload Image</p>
                                                <img id="file-image" src="assets/images/add.png" alt="Preview" class="hidden" style="min-width: 30px; max-width: 100px">
                                                
                                                <div id="start">
                                                
                                                <!-- <div>Select a file or drag here</div> -->
                                                <div id="notimage" class="hidden"></div>
                                                <!-- <span id="file-upload-btn" class="btn btn-primary">Select a file</span> -->
                                                </div>
                                                <div id="response" class="hidden">
                                                <div id="messages"></div><br>
                                                
                                                </div>
                                            </div>
                                        </label>

                                        <?php if (isset($_GET['error'])): ?>
                                            <p class="error"> <?php echo $_GET['error']; ?> </p>
                                        <?php endif ?>

                                    <?php if (isset($_GET['success'])): ?>
                                            <p class="success"> <?php echo $_GET['success']; ?> </p>
                                        <?php endif ?>

                                        

                                        <div class="row justify-content-end">
                                            <div class="col-sm-9 w-100">
                                                <div>
                                                    <button type="submit" name="submit" class="btn btn-primary w-md w-100">Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center bg-dark p-3">

                    <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="m-0" />

                <div class="p-4">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-light" value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-dark" value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="assets/libs/pace-js/pace.min.js"></script>

        <!-- dropzone js -->
        <script src="assets/libs/dropzone/min/dropzone.min.js"></script>

        <script src="assets/js/app.js"></script>

        <script src="assets/js/add-image.js"></script>

        <!-- sweet alert -->

        <script src="assets/js/sweetalert.js"></script>

        <script>

            $(document).ready(function () {

                $('.logoutBtn').click(function (e) {

                    swal({
                        title: "Are you sure?",
                        text: "You want to logout!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: 'logout.php',  
                                success: function (response) {
                                    swal("Success!", "Logged out successfully!", "success")
                                            .then((result) => {
                                            location.reload();
                                        });

                                }
                            });

                        }
                    });
                    
                });

            });


        </script>


    </body>
</html>

<?php
} else {
    header("location: login.php");
}
?>