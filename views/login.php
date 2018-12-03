 <?php

$title = 'Login';
require_once 'inc.header.php';
require_once '../models/User.php';
require_once '../config/Database.php';

if (isset($_POST['login'])) {
    $database = new Database();
    $pdo = $database->connect();
    $user = new User($pdo);
    $data = $user->login_authentication(strtolower($_POST['email']), $_POST['password']);
}

if (isset($_GET['succ_reg'])) $succ_email = $_GET['succ_reg'];

?>

<div class="container-fluid px-0">
    <div class="row mx-0">  
        
        <!-- LEFT SIDE PHOTO -->
        <div class="col-6 px-0">
            <img src="../img/landing-img.jpg" alt="bragaboutit" id="landing-img">
        </div>
        
        
        <!-- RIGHT SIDE CONTENT -->
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
                
                <!-- LINKS -->
                <div class="col-3 text-right mt-3">
                    <a href="login.php" class="login-reg-links">Log in</a>
                </div>
                <div class="col-3 text-center mt-3">
                    <a href="register.php" class="login-reg-links">Register</a>
                </div>
            </div>
            
            
            <!-- LOGO -->
            <div class="row text-center mx-0">
                <div class="offset-5 col-2 offset-5 mt-3">
                    <img src="../img/logo.png" alt="bragyard" class="logo-icon">
                </div>
            </div>

            <!-- FORM -->
            <div class="row mx-0">
                <div class="offset-2"></div>
                <div class="col-8 mt-3 form-layout">
                    <form action="" method="post" class="mx-2 mt-5 mb-4">
                        <div class="form-group">
                            <input  type="email" class="form-control" name="email" placeholder="E-mail" required="required" 
                                    id = "email-login-id"
                                    <?php   if (!isset($data['email']) && !isset($succ_email)) echo 'autofocus="autofocus"';
                                            if (isset($data['email'])) echo 'value="'.$data['email'].'"'; 
                                            elseif (isset($succ_email)) echo 'value="'.$succ_email.'"'; 
                                    ?>
                            >
                            <?php if (isset($data['email_msg'])) echo '<small id="email-login-id" 
                                                        class="custom-small-id">'.$data['email_msg'].'</small>'; ?>
                        </div>
                        <div class="form-group">
                            <input  type="password" class="form-control" name="password" placeholder="Password" id="pwd-login-id"
                                    required="required"
                                    <?php   if (isset($data['email']) or isset($succ_email)) {
                                                echo 'autofocus="autofocus"'; 
                                            } ?>
                            >
                            <?php if (isset($data['pwd_msg'])) echo '<small id="pwd1-register-id" 
                                                                    class="custom-small-id">'.$data['pwd_msg'].'</small>'; ?>

                        </div>
                        <div class="row text-center">
                            <div class="col-12">
                                <input type="submit" class="submit-btn" name="login" value="Log in">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php if(isset($succ_email)) { ?>
                    <div class="row mt-4 mx-0">
                        <div class="offset-2"></div>
                        <div class="col-8 form-layout text-center">
                            <p class="succ-msg">You have been successfully registered!</p>
                        </div>
                    </div>
                <?php
                }
                ?>
        </div>
    </div>
</div>

</body>

</html>
