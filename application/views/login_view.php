<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="iki website e ipel ho">
    <meta name="author" content="ipel">
    <title>Warehouse Application</title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png'); ?>">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url()?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
</head>

<body class="bg-gradient-primary">
	
	<div class="container">
    <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-;g-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?= form_open_multipart($form, array("class" => "user") );?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="nik" placeholder="Enter NIK">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <label>Warehouse Application</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php 
        $msg = $this->session->flashdata("msg");
        $msg_status = $this->session->flashdata("msg_status");
        $msg_title = $this->session->flashdata("msg_title");
        if(isset($msg)): 
    ?>
        <div class="alert <?= $msg_status; ?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 id="omg-error-txt"><?= $msg_title; ?><a class="anchorjs-link" href="#omg-error-txt"><span class="anchorjs-icon"></span></a></h4>
            <p><?php echo $msg; ?></p>
        </div>
    <?php endif; ?>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url()?>assets/js/sb-admin-2.min.js"></script>
     <script>
        $(document).ready(function() {
            setTimeout(function(){
                $(".alert").hide(500);
            },3000);
        });
    </script>
</body>

</html>