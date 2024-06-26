<?php
require_once 'config.php';
require 'includes/form_handlers/register.php';
require 'includes/form_handlers/login.php';

if (isset($_SESSION['username']) ) {
    header("location: index.php");
    exit();
}

?>

<html>
<head>
    <title>Giriş Yap & Kayıt Ol</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="wrapper">

    <div class="login_box">

        <div class="login_header">
            <h1>Giriş Yap & Kayıt Ol</h1>
        </div>
        <br>
        <div id="first">

            <form action="" method="POST">
                <input type="email" name="log_email" placeholder="Email Address" value="<?php
                if (isset($_SESSION['log_email'])) {
                    echo $_SESSION['log_email'];
                }
                ?>" required>
                <br>
                <input type="password" name="log_password" placeholder="Password"><br>

                <br>
                <input type="submit" name="giris" value="Login">
                <br><br><br>
                <a href="#" id="signup" class="signup">Hesabın yok mu, kayıt ol!</a><br>

                <a href="sifremiunuttum.php" id="signup" class="signup">Şifremi unuttum.</a>

            </form>

        </div>

        <div style="display:none;" id="second">  <!--display:none sayesinde kod gizlenmiştir. kayıt ol sekmesine geçince görünür olacaktır.-->

            <form action="" method="POST">
            <input type="text" name="reg_fname" placeholder="First Name" value="<?php
                if (isset($_SESSION['reg_fname'])) {
                    echo $_SESSION['reg_fname'];
                }
                ?>" required>
                <br>

                <?php if (in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>

                <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
                if (isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                }
                ?>" required>
                <br>
                <?php if (in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

                <input type="email" name="reg_email" placeholder="Email" value="<?php
                if (isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                }
                ?>" required>
                <br>

                <input type="password" name="reg_password" placeholder="Password" required>
                <br>

                <input type="submit" name="kayit" value="Register">
                <br><br><br>
                <a href="#" id="signin" class="signin">Hesabın var mı, giriş yap!</a>
            </form>
        </div>

    </div>

</div>

</body>
</html>
