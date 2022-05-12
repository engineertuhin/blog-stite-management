<?php
include('config.php');
if (isset($_POST['userRegistration'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $status = 0;

    if ($password == $c_password) {
        $confirmPassowrd = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $passwordMatch = "Password did not match";
    }

    $query = "INSERT INTO users (user_name, email, password, status) values('$name', '$email', '$confirmPassowrd', '$status')";
    if ($con->query($query) == true) {
        $success = "Registered successfully but please admin verifyd";
    } else {
        $error = $con->error;
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
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success ?>
                    </div>
                <?php }
                if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo isset($error) ? $error : '' ?>
                    </div>
                <?php } ?>
                <?php if (isset($passwordMatch)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo isset($passwordMatch) ? $passwordMatch : '' ?>
                    </div>
                <?php } ?>
                <form method="POST" class="signin-form">
                    <div class="input-grids">
                        <label>Name<span style="color: red;">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Name*" class="contact-input" required="" />
                        <label>Email<span style="color: red;">*</span></label>
                        <input type="email" name="email" id="email" placeholder="Your Email*" class="contact-input" required="" />
                        <label>Passowrd<span style="color: red;">*</span></label>
                        <input type="password" name="password" id="password" placeholder="Your Password*" class="contact-input" required="" />
                        <label>Confirm Passowrd<span style="color: red;">*</span></label>
                        <input type="password" name="c_password" id="c_password" placeholder="Your Confirm Password*" class="contact-input" required="" />
                    </div>
                    <button type="submit" name="userRegistration" class="btn btn-style btn-outline">Sign Up</button>
                </form>
            </div>
            <p style="margin-left: 20px; color:blue">Already account please <a href="login.php" style="color: red;">Login-></a></p>
        </div>
    </section>
    <!-- /contact-form-2 -->

    <!-- Template JavaScript -->
    <?php include('frontend/common/footer.php'); ?>
    <?php include('frontend/common/js.php'); ?>
</body>

</html>