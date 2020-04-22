<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - iAuditor</title>
    <meta name="description" content="inspection, audit, login">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?=base_url('assets/vendor/apple-icon.png');?>">
    <link rel="shortcut icon" href="<?=base_url('assets/vendor/favicon.ico');?>">


    <link rel="stylesheet" href="<?=base_url('assets/vendor/plugins/bootstrap/dist/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/vendor/plugins/font-awesome/css/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/vendor/plugins/themify-icons/css/themify-icons.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/vendor/plugins/flag-icon-css/css/flag-icon.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/vendor/plugins/selectFX/css/cs-skin-elastic.css');?>">

    <link rel="stylesheet" href="<?=base_url('assets/vendor/assets/css/style.css');?>">

    <link href='<?=base_url("assets/css/font-google.css");?>' rel='stylesheet' type='text/css'>



</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="<?=base_url('assets/vendor/images/logo.png');?>" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form action="<?=base_url('login/submit');?>" method="POST">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password">
                        </div>
                                <div class="checkbox">
                                    
                                    <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                                <!-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                                        <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                                    </div>
                                </div> -->
                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="<?=base_url('assets/vendor/plugins/jquery/dist/jquery.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/plugins/popper.js/dist/umd/popper.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/plugins/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/assets/js/main.js');?>"></script>


</body>

</html>
