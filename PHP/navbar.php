<html lang="en">


<?php
include('../PHP/security.php');
?>
<?php

if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: login.php");
}

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/navbar.css">
  <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.css">
  <title>Home</title>

  <script src="../JS/app.js" defer></script>
</head>

<body>





  <nav class="navbar bg-dark mb-3" data-bs-theme="dark">
    <div class="container-fluid">
      <div class="image-container">
        <a class="navbar-brand ml-3 mb-3" href="../PHP/index.php" style="max-width: 50px; height:50px ">
          <img src="../IMG/logo/logo.png" class="zoom-image" alt="error" width="50" height="50" style="border-radius: 15px;" id="logo">
        </a>
        <a href="../PHP/index.php" class="h6 navbar-brand text-light" style="font-size: 18px;">Home</a>


        <?php
        $curUser = $_SESSION['state'];
        if ($curUser == 1) { ?>
          <a href="../PHP/add.php" class="h6 navbar-brand text-light" style="font-size: 18px;">Add</a>
        <?php } ?>

        <a href="../PHP/about.php" class="h6 navbar-brand text-light" style="font-size: 18px;">About</a>
        <a href="../PHP/contactus.php" class="h6 navbar-brand text-light" style="font-size: 18px;">Contact us</a>
      </div>
      <form action="POST">
        <div class=" mr-5">
          <span class="container-fluid">
            <h6 class="text-bold text-light mr-3 mt-3" style="display: inline; font-size:17px;">  
              <?php
              if ($curUser == 1) {
                echo "Admin";
              } else {
                echo "User";
              }
              ?>
            </h6>
            <a class="navbar-brand  " href="../PHP/login.php" style="max-width: 50px; height:50px" name="logout">
              <img src="../IMG/icon/logout.png" alt="error" class="zoom-image" width="50" height="50" style="border-radius: 15px;" id="logout">
            </a>
          </span>
        </div>
      </form>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="d-flex mt-1 mb-0 w-25 " role="search">
        <input name="search" class="form-control me-2 w-100" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light ml-3" type="submit">Search</button>
      </form>

    </div>
  </nav>








  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../JS/index.js"></script>
  <script src="../JS/bootstrap-js/jquery-3.2.1.slim.min.js"></script>
  <script src="../JS/bootstrap-js/popper.min.js"></script>
  <script src="../JS/bootstrap-js/bootstrap.min.js"></script>
  <script src="../JS/bootstrap-js/bootstrap.js"></script>
  <script src="../JS/app.js"></script>

  <script>
    const logo = document.getElementById('logo');
    logo.addEventListener('mouseenter', zoomIn);
    logo.addEventListener('mouseleave', zoomOut);

    const logout = document.getElementById('logout');
    logout.addEventListener('mouseenter', zoomIn);
    logout.addEventListener('mouseleave', zoomOut);

    function zoomIn() {
      image.style.transform = 'scale(1.2)';
    }

    function zoomOut() {
      image.style.transform = 'scale(1)';
    }
  </script>





</body>


</html>