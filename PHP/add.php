<?php
include("../PHP/dbconnect.php");
?>
<?php include "../PHP/navbar.php" ?>


<?php

$errors['result'] = "";
$success = "";
if (isset($_POST['add'])) {


    $pcode = $_POST['code'];
    $pname = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $pdescirption = $_POST['description'];

    $query = mysqli_query($db, "SELECT * FROM `product` WHERE `Pcode` = '$pcode'");
    if (mysqli_num_rows($query) > 0) {
        $errors['result'] = "this Product Code already exist ";
    } else {

        //image information
        $file = $_FILES['image'];
        $file_name = $file['name'];
        $file_type = $file['type'];
        $file_tmpname = $file['tmp_name'];
        $file_error = $file['error'];
        $file_size = $file['size'];

        $fileExt = explode('.', $file_name);
        $fileActualExt = strtolower(end($fileExt));
        $allow_types = array('png', 'jpeg', 'jpg');

        if (in_array($fileActualExt, $allow_types)) {
            if ($file_error == 0) {
                if ($file_size < 10000000) {
                    $pimage = rand() . "." . $fileActualExt;
                    $file_dest = "../IMG/Pimage/$pimage";
                    move_uploaded_file($file_tmpname, $file_dest);

                    $query = mysqli_query($db, "INSERT INTO `product`(`Pcode`,`Pname`,`Pprice`,`Pquantity`,`Pdescription`,`Pimage`) 
            VALUES ('$pcode' , '$pname' , '$price' ,'$quantity' , '$pdescirption' ,'$pimage')");
                    $success = "Product added to list successfully!";
                    $errors['result'] = "";
                } else {
                    $errors['result'] = "image size not compatable";
                    $success = "";
                }
            } else {
                $errors['result'] = "change this image please";
                $success = "";
            }
        } else {
            $errors['result'] = "file not compatable";
            $success = "";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">






<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="../CSS/add.css">
    <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.css">
    <title>Add</title>
</head>

<body style="background-color: #eee;">



    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <p class="text-center h2 fw-bold mb-3 mx-1 mx-md-4 mt-5 pt-3">Add new Product</p>
                        <span class="text-center h6 text-success">
                            <?php echo $success ?>
                        </span>
                        <span class="text-center h6 mb-0 text-danger">
                            <?php echo $errors['result'] ?>
                        </span>
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-8 col-xl-10 ">

                                    <form class="mx-1 mx-md-4" method="post" enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="form-outline mb-4 col-md-10 col-lg-12 col-xl-6">
                                                <input type="text" style="font-size: 18px;" id="form3Example3" name="code" class="form-control form-control-lg" pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$" title="must contain letters and numbers" placeholder=" Product code" required />
                                            </div>
                                            <div class="form-outline mb-4 col-md-10 col-lg-12 col-xl-6">
                                                <input type="text" style="font-size: 18px;" id="form3Example3" name="name" class="form-control form-control-lg" placeholder=" Product name" required />
                                            </div>
                                        </div>


                                        <div class="row ">
                                            <div class="form-outline mb-4 col-md-10 col-lg-12 col-xl-6">
                                                <input type="number" style="font-size: 18px;" id="form3Example3" name="price" class="form-control form-control-lg" min="0" placeholder=" Price" required />
                                            </div>
                                            <div class="form-outline mb-4 col-md-10 col-lg-12 col-xl-6">
                                                <input type="number" style="font-size: 18px;" id="form3Example3" name="quantity" class="form-control form-control-lg" min="0" placeholder="Quantity" required />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" cols="50" maxlength="100"></textarea>
                                        </div>

                                        <div class="mb-3 mt-4">
                                            <label for="formFile" class="form-label mr-1">Image:</label>
                                            <input class="" name="image" type="file" id="formFile" style="margin-left: 10px;  " required>
                                        </div>

                                        <div class="text-center text-lg-start mt-4 pt-2">
                                            <button type="submit" class="btn btn-primary btn-lg" name="add" style="padding-left: 3.5rem; padding-right: 3.5rem;">Add</button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
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