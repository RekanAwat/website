<?php
include("../PHP/dbconnect.php");
?>

<?php
$error = "";
    if (isset($_POST['submit'])) {

        $email = x($_POST['email']);
        $password = x($_POST['password']);
        $query = mysqli_query($db, "SELECT * FROM `administration`");

        while ($row = mysqli_fetch_assoc($query)) {
            if (x($row['email']) == $email && x($row['password']) == $password) {
                $error = "";
                $_SESSION['email'] = true;
                $_SESSION['password'] = true;
                if(x($row['state'] == '1')){
                    $_SESSION['state'] = true;   // state : 1 = admin , 2 = user
                }else{
                    $_SESSION['state'] = false;
                }
                exit(header("location:../PHP/index.php"));
            } else {
                $error = "Email or Password Incorrect";
            }
        }
    }






?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.css">
    <title>Login Page</title>
</head>

<body style="background-color: #eee;">








    <section style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">







                                <div class="col-md-10 col-lg-6 col-xl-6 d-flex align-items-center order-2 order-lg-1">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">

                                </div>






                                <div class="col-md-10 col-lg-6 col-xl-6 order-1 order-lg-2">

                                    <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4  mt-4" id="signin">Sign in</p>

                                    <form class="mx-1 mx-md-4" method="POST">

                                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                                <i class="fab fa-facebook-f"></i>
                                            </button>

                                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                                <i class="fab fa-twitter"></i>
                                            </button>

                                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                                <i class="fab fa-google"></i>
                                            </button>
                                        </div>










                                        <div class="divider d-flex align-items-center my-3">
                                            <p class="text-center fw-bold mx-3 mb-0">Or</p>
                                        </div>








                                        <!-- Email input -->
                                        <div class="form-outline mb-3">
                                            <input type="email" id="form3Example3" name="email" style="font-size: 18px;" class="form-control form-control-lg" placeholder="Enter a valid email address" required />
                                        </div>

                                        <!-- Password input -->
                                        <div class="form-outline mb-3">
                                            <input type="password" id="form3Example4" name="password" style="font-size: 18px;" class="form-control form-control-lg" placeholder="Enter password" required />
                                        </div>

                                        <?php if (isset($_POST['submit'])) { ?>
                                            <p class="text-danger" id="error">
                                                <?php echo $error ?>
                                            </p>
                                        <?php } ?>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- Checkbox -->
                                            <div class="form-check mb-0">
                                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                                <label class="form-check-label" for="form2Example3">
                                                    Remember me
                                                </label>
                                            </div>
                                            <a href="#!" class="text-body">Forgot password?</a>
                                        </div>

                                        <div class="text-center text-lg-start mt-4 pt-2">
                                            <button type="submit" name="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" id="submit">Login</button>
                                            <p class="h6 fw-bold mt-3 pt-1 mb-0">Don't have an account?
                                                <a href="../PHP/signup.php" class="link-danger">Register</a>
                                            </p>
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>
                        <p style="text-align: center;">copyright &copy; 2023</p>
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