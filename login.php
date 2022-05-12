<?php
session_start();
include('config.php');
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email == "" || $password == "") {
        if ($email == "") {
            $emailError = "Email filed is requried";
        }
        if ($password == "") {
            $passwordError = "Password filed is requried";
        }
    } else {
        $user =  $con->query("
            SELECT id, email, password FROM users WHERE email = '$email' and status = 1;
          ");
        $data = $user->fetch_assoc();
        if ($data) {
            $verify = password_verify($password, $data['password']);
            if ($verify) {
                $_SESSION['user_id'] = $data['id'];
                $id=$data['id'];
                setcookie("id", $id, time()+3600*10*500);

                header('location: /project1/');
            } else {
                $passwordError = "password did not match";
            }
        }else if(empty($data['status'])){
             $Error="<h5 style='color:red'>Waiting for admin Permisson<h5>";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Log In page</title>

    <?php include('frontend/common/css.php'); ?>
</head>

<body>
    <?php include('frontend/common/header.php'); ?>

    <!-- contact-form 2 -->
    <section class="w3l-contact-2 py-5">
        <div class="contact-grids d-grid">
            <div class="contact-right">
                <?php if(isset($Error)){
                    echo $Error;
                    }?>
                <form method="POST" class="signin-form">
                    <div class="input-grids">
                        <input type="email" name="email" id="email" placeholder="Your Email*" class="contact-input" required="" />
                        <input type="password" name="password" id="password" placeholder="Your Password*" class="contact-input" required="" />

                    </div>
                    <button type="submit" name="login" class="btn btn-style btn-outline">Login</button>
                </form>
            </div>
            <p style="margin-left: 20px; color:blue">Don't have account please <a href="signup.php" style="color: red;">sign up-></a></p>
        </div>
    </section>
    <!-- /contact-form-2 -->

    <!-- Template JavaScript -->
    <?php include('frontend/common/footer.php'); ?>
    <?php include('frontend/common/js.php'); ?>
</body>

</html>