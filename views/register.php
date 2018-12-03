<?php

$title = "Register";
require_once 'inc.header.php';
require_once '../config/Database.php';
require_once '../models/User.php';

if (isset($_POST['register'])) {
    $database = new Database();
    $pdo = $database->connect();
    $user = new User($pdo);
    $data = $user->register_authentication(strtolower($_POST['email']), $_POST['password'], $_POST['re_password'], 
                                    ucwords($_POST['first_name']), ucwords($_POST['last_name']));
}

?>

<!-- VIEW -->
<div class="container-fluid px-0">
    <div class="row mx-0">
        <!-- LEFT SIDE PHOTO -->
        <div class="col-6 px-0">
            <img src="../img/landing-img.jpg" alt="bragaboutit" id="landing-img">
        </div>
        <!-- RIGHT SIDE -->
        <div class="col-6 px-0" id="right-col">
            <!-- HEADER -->
            <div class="row mx-0 py-3 mb-5 log-reg-header">
                <div class="offset-1"></div>
                <!-- LOGO -->
                <div class="col-5">
                    <a href="../index.php" class="clear-links-properties">
                        <img src="../img/logo.png" alt="bragyard" class="logo-in-header">
                        <img src="../img/logo-name.png" alt="bragyard" class="logo-in-header">
                    </a>
                </div>
                <div class="col-3 text-right mt-3">
                    <a href="login.php" class="login-reg-links">Log in</a>
                </div>
                <div class="col-3 text-center mt-3">
                    <a href="register.php" class="login-reg-links">Register</a>
                </div>
            </div>
            <div class="row text-center mx-0">
                <!-- LOGO -->
                <div class="offset-5 col-2 offset-5 mt-3">
                    <img src="../img/logo.png" alt="bragyard" class="logo-icon">
                </div>
            </div>
            <div class="row mx-0">
                <div class="offset-2"></div>
                <div class="col-8 mt-3 form-layout">
                    <form action="" method="post" class="mx-2 mt-5 mb-4">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="E-mail" 
                                    require="required" id="email-register-id"
                                    <?php   if(isset($data['email'])) echo 'value="'.$data['email'].'"'; 
                                            else echo 'autofocus="autofocus"'; ?> >
                                    <?php if(isset($data['email_msg'])) {
                                                echo '<small id="email-register-id" 
                                                class="custom-small-id">'.$data['email_msg'].'</small>'; 
                                            } ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" 
                                    required="required" id="pwd1-register-id" 
                                    <?php if(isset($data['pwd_msg'])) echo 'autofocus="autofocus"'; ?> >
                                    <?php if(isset($data['pwd_msg'])) {
                                                echo '<small id="pwd1-register-id" 
                                                class="custom-small-id">'.$data['pwd_msg'].'</small>'; 
                                            } ?> 
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="re_password" placeholder="Re-type Password" 
                                    required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" 
                                    required="required"  
                                    <?php if(isset($data['first_name'])) echo 'value="'.$data['first_name'].'"'?> >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" 
                                    required="required" 
                                    <?php if(isset($data['last_name'])) echo 'value="'.$data['last_name'].'"'?>> 
                        </div>
                        <div class="row text-center">
                            <div class="col-12">
                                <input type="submit" class="submit-btn" name="register" value="Register">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>

