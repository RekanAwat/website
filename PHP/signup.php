<html lang="en">

<?php
include("../PHP/dbconnect.php")
    ?>

<?php


$error = "";

if (isset($_POST['submit'])) {
    $email = x($_POST['email']);
    $pass = x($_POST['password']);
    $repass = x($_POST['repassword']);

    $query = mysqli_query($db, "SELECT * FROM `administration` WHERE `email` = '$email'");

    if (mysqli_num_rows($query) > 0) {
        $error = "Email address is already exist";
    } else {
        if ($pass != $repass) {
            $error = "password and repeat password not same";
        } else {
            $query = mysqli_query($db, "INSERT INTO `administration`(`email`,`password`,`state`) VALUES('$email','$pass','2')");

            if ($query) {
                header("location: ../PHP/login.php");
            }
        }

    }


}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="../CSS/register.css">
    <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.css">


    <script src="../JS/app.js" defer></script>
    <title>Sign up</title>
</head>

<body style="background-color: #eee;">



    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form class="mx-1 mx-md-4" method="POST">

                                        <div class="form-outline mb-3">
                                            <input type="email" style="font-size: 18px;" id="form3Example3"
                                                class="form-control form-control-lg" name="email"
                                                placeholder="Enter a valid email address" required />
                                        </div>

                                        <div class="form-outline mb-3">
                                            <input type="password" style="font-size: 18px;" id="form3Example4"
                                                class="form-control form-control-lg" placeholder="Create password"
                                                name="password" required />
                                        </div>

                                        <div class="form-outline mb-3">
                                            <input type="password" style="font-size: 18px;" id="form3Example4"
                                                class="form-control form-control-lg" placeholder="Repeat password"
                                                name="repassword" required />
                                        </div>

                                        <div>
                                            <?php if (isset($_POST['submit'])) { ?>
                                                <p class="text-danger">
                                                    <?php echo $error; ?>
                                                </p>
                                            <?php } ?>
                                        </div>


                                        <div class="form-check d-flex justify-content-left mb-4">
                                            <input class="form-check-input me-2" type="checkbox" value="" required>
                                            <label class="form-check-label">
                                                I agree all statements in&nbsp<a href="#!">Terms of service</a>
                                            </label>
                                        </div>

                                        <div class="text-center text-lg-start mt-4 pt-2">
                                            <button type="submit" class="btn btn-primary btn-lg" name="submit"
                                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                                            <p class="h6 fw-bold mt-3 pt-1 mb-0">already have account?
                                                <a href="../PHP/login.php" class="link-danger">Login</a>
                                            </p>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-6 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">

                                </div>

                            </div>

                        </div>
                        <p style="text-align: center; margin-top: 10px;">copyright &copy; 2023</p>
                    </div>
                </div>
            </div>
        </div>
    </section>













    <script src="../JS/bootstrap-js/jquery-3.2.1.slim.min.js"></script>
    <script src="../JS/bootstrap-js/popper.min.js"></script>
    <script src="../JS/bootstrap-js/bootstrap.min.js"></script>
    <script src="../JS/bootstrap-js/bootstrap.js"></script>
</body>

</html>