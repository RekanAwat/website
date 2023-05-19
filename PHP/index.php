<?php include '../PHP/dbconnect.php'; ?>
<?php include '../PHP/navbar.php' ?>



<?php

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    if ($sort == 'product name') {
        $query = mysqli_query($db, "SELECT * FROM `product` ORDER BY `Pname`");
    } else if ($sort == 'product code') {
        $query = mysqli_query($db, "SELECT * FROM `product` ORDER BY `Pcode`");
    } else if ($sort == 'price') {
        $query = mysqli_query($db, "SELECT * FROM `product` ORDER BY `Pprice`");
    } else if ($sort == 'quantity') {
        $query = mysqli_query($db, "SELECT * FROM `product` ORDER BY `Pquantity`");
    } else if ($sort == 'description') {
        $query = mysqli_query($db, "SELECT * FROM `product` ORDER BY `Pdescription`");
    } else {
        $query = mysqli_query($db, "SELECT * FROM `product` ORDER BY `PID` DESC");
    }
}

?>




<?php

if (isset($_GET['delete'])) {
    $id = x($_GET['delete']);
    $deleteImg = mysqli_query($db, "SELECT * FROM `product` WHERE `PID` = $id");
    while ($row = mysqli_fetch_assoc($deleteImg)) {
        $img = x($row['Pimage']);
    }

    $query = mysqli_query($db, "DELETE FROM `product` WHERE `PID` = $id");
    if ($query) {
        unlink("../IMG/Pimage/$img");
    }
}

if (isset($_GET['search'])) {
    $data = x($_GET['search']);
    if (strlen($data) >= 1) {
        $query = mysqli_query($db, "SELECT * FROM `product` WHERE `Pcode` LIKE '%$data%' OR `Pname` LIKE '%$data%' OR `Pdescription` LIKE '%$data%' ");
    } else {
        $query = mysqli_query($db, "SELECT * FROM `product`");
    }
?>

    <body style="background-color: #eee;">

        <form method="get">
            <div class="container d-flex justify-content-center align-items-center mb-4">
                <div>
                    <div class="input-group">
                        <div class="row">
                            <select name="sort" id="" class="form-control col" style="width: 175px;  height: 45px ; border-radius:5px; margin-right: 10px">
                                <option value="">Sort by ...</option>
                                <option value="product name">product name</option>
                                <option value="product code">product code</option>
                                <option value="price">price</option>
                                <option value="quantity">quantity</option>
                                <option value="description">description</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="input-group">
                        <select name="view" id="" class="form-control ml-3" style="width: 175px; height: 45px ; border-radius:5px; margin-right: 10px">
                            <option value="">View ...</option>
                            <option value="all">All</option>
                            <option value="available">available</option>
                            <option value="unavailable">unavailable</option>
                        </select>

                    </div>
                </div>
                <div>
                    <button class="btn btn-outline-secondary ml-2 " style="width: 150px; height:45px" type="submit" id="button-addon2">Filter</button>
                </div>
            </div>
        </form>

        <?php if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) { ?>


                <!-- Modal -->
                <div class="modal fade" id="post<?php echo x($row['PID']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">



                                <form action="index.php" method="POST">
                                    <input type="text" value="<?php echo x($row['PID']); ?>" hidden name="id">
                                    <input name="pcode" type="text" class="form-control mb-2" value="<?php echo x($row['Pcode']) ?> " placeholder="product code">
                                    <input name="price" type="text" class="form-control mb-2" value="<?php echo x($row['Pprice']) ?>$" placeholder="price">
                                    <input name="quantity" type="text" class="form-control mb-2" value="<?php echo x($row['Pquantity']) ?>" placeholder="quantity">
                                    <input name="description" type="text" rows="2" cols="25" class="form-control form-control mb-1" style="font-size: 12.5px;" value="<?php echo x($row['Pdescription']) ?>" placeholder="description">



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button name="update" type="submit" class="btn btn-primary">Update</button>
                            </div>



                            </form>
                        </div>
                    </div>
                </div>






                <!-- card -->
                <div class="card mb-3 col-11" style="max-height: 200px;">
                    <div class="row ">
                        <div class="col-md-3 align-item-left">
                            <img src="../IMG/Pimage/<?php echo x($row['Pimage']) ?>" style="max-width: 250px; height: 190px" class="img-fluid rounded-start" alt="...">
                        </div>




                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title text-left">
                                    <?php echo $row['Pname'] ?>
                                </h5>

                                <p class="card-text text-left">
                                    <?php echo $row['Pdescription'] ?>
                                </p>
                                <div>
                                    <table>
                                        <tr>
                                            <th width=100px>
                                                <p class="card-text ">
                                                    code:
                                                </p>

                                            </th>
                                            <th width=100px>
                                                <p class="card-text ml-5">
                                                    Price:
                                                </p>
                                            </th>
                                            <th width=100px>
                                                <p class="card-text ml-5">
                                                    Quantity:
                                                </p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td width=100px>
                                                <p class="card-text ">

                                                    <?php echo $row['Pcode'] ?>
                                                </p>

                                            </td>
                                            <td width=100px>
                                                <p class="card-text ml-5">

                                                    <?php echo $row['Pprice'] ?>$
                                                </p>
                                            </td>
                                            <td width=100px>
                                                <p class="card-text ml-5">

                                                    <?php echo $row['Pquantity'] ?>
                                                </p>
                                            </td>

                                        </tr>

                                    </table>
                                </div>
                                <div class="row text-left">

                                </div>
                                <p class="card-text text-left mt-1"><small class="text-body-secondary">Last updated 3 mins
                                        ago</small></p>

                            </div>
                        </div>
                        <?php

                        if ($curUser == 1) {
                            if ($row['Pquantity'] == 0) { ?>
                                <a href="../PHP/index.php?delete=<?php echo x($row['PID']) ?>" class="btn border-0 btn-danger " style="position: absolute;  top: 0; right:0; margin: 12.5px; border-radius: 25% ; padding: 5px; " width="40">
                                    <img src=" ../IMG/icon/delete.png" alt="delete.png" width="20" height="20px">
                                </a>
                        <?php }
                        } ?>




                        <?php if ($curUser == 1) { ?>
                            <span class="btn border-0 btn-light p-1 " data-toggle="modal" data-target="#post<?php echo x($row['PID']); ?>" style="position: absolute;  bottom: 0; right:0; margin: 12.5px;  border-radius: 25%; margin-right: 12.5px; padding: 5px; ">
                                <img src=" ../IMG/icon/edit.png" alt="delete.png" width="20" height="20px">
                            </span>
                        <?php } ?>
                    </div>
                </div>
    </body>


<?php

            }
            include("../PHP/footer.php");
            exit();
        } else {
            echo '<h5 class="text-dark text-center mt-5 mb-2 ">no data found</h5>';
            exit(include("../PHP/footer.php"));
        }
    }

?>




<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="../CSS/add.css">
    <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap-css/bootstrap.css">
    <link rel="stylesheet" href="../CSS/index.css">

    <title>index page</title>

</head>





<body style="background-color: #eee;">



    <form method="get">
        <div class="container d-flex justify-content-center align-items-center mb-4">
            <div>
                <div class="input-group">
                    <div class="row">
                        <select name="sort" id="" class="form-control col" style="width: 175px;  height: 45px ; border-radius:5px; margin-right: 10px">
                            <option value="">Sort by ...</option>
                            <option value="product name">product name</option>
                            <option value="product code">product code</option>
                            <option value="price">price</option>
                            <option value="quantity">quantity</option>
                            <option value="description">description</option>
                        </select>
                    </div>

                </div>
            </div>
            <div>
                <div class="input-group">
                    <select name="view" id="" class="form-control ml-3" style="width: 175px; height: 45px ; border-radius:5px; margin-right: 10px">
                        <option value="">View ...</option>
                        <option value="all">All</option>
                        <option value="available">available</option>
                        <option value="unavailable">unavailable</option>
                    </select>

                </div>
            </div>
            <div>
                <button class="btn btn-outline-secondary ml-2 " style="width: 150px; height:45px" type="submit" id="button-addon2">Filter</button>
            </div>
        </div>
    </form>







    <?php

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if ($sort == 'product name') {
            $s = "`Pname`";
        } else if ($sort == 'product code') {
            $s = "`Pcode`";
        } else if ($sort == 'price') {
            $s = "`Pprice` DESC";
        } else if ($sort == 'quantity') {
            $s = "`Pquantity` DESC";
        } else if ($sort == 'description') {
            $s = "`Pdescription`";
        } else {
            $s = "`PID`";
        }
    } else {
        $s = "`PID`";
    }

    if (isset($_GET['view'])) {
        $view = $_GET['view'];
        if ($view == 'available') {
            $v = "  `Pquantity` > 0 ";
        } else if ($view == 'unavailable') {
            $v = "  `Pquantity` = 0 ";
        } else {
            $v = " `Pquantity` >= 0 ";
        }
    } else {
        $v = " `Pquantity` >= '0' ";
    }

    $query = mysqli_query($db, "SELECT * FROM `product` WHERE $v ORDER BY $s");
    if (mysqli_num_rows($query) == 0) {
        echo '<p class="text-center p-2 h4 text-dark m-auto"> you have no product to show</p>';
    } else {

        if (isset($_POST['update'])) {
            $pcode = x($_POST['pcode']);
            $price = x($_POST['price']);
            $quantity = x($_POST['quantity']);
            $description = x($_POST['description']);
            $id = x($_POST['id']);

            $query = mysqli_query($db, "UPDATE `product` SET `Pcode`='$pcode' , `Pprice`='$price' ,`Pquantity`='$quantity' , `Pdescription`='$description' WHERE `PID` = '$id'");
            if ($query) {
                $query = mysqli_query($db, "SELECT * FROM `product`");
                echo '<h5 class="text-success text-center mt-2 mb-3 ">product updated</h5>';
            }
        }
    ?>
        <div class="row text-center m-2 ml-3">
            <?php
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) { ?>


                    <!-- Modal -->
                    <div class="modal fade" id="post<?php echo x($row['PID']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">



                                    <form action="index.php" method="POST">
                                        <input type="text" value="<?php echo x($row['PID']); ?>" hidden name="id">
                                        <input name="pcode" type="text" class="form-control mb-2" value="<?php echo x($row['Pcode']) ?> " placeholder="product code">
                                        <input name="price" type="text" class="form-control mb-2" value="<?php echo x($row['Pprice']) ?>$" placeholder="price">
                                        <input name="quantity" type="text" class="form-control mb-2" value="<?php echo x($row['Pquantity']) ?>" placeholder="quantity">
                                        <input name="description" type="text" rows="2" cols="25" class="form-control form-control mb-1" style="font-size: 12.5px;" value="<?php echo x($row['Pdescription']) ?>" placeholder="description">



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button name="update" type="submit" class="btn btn-primary">Update</button>
                                </div>



                                </form>
                            </div>
                        </div>
                    </div>





                    <!-- card -->
                    <div class="card mb-3 col-11" style="max-height: 200px;">
                        <div class="row ">
                            <div class="col-md-3 align-item-left">
                                <img src="../IMG/Pimage/<?php echo x($row['Pimage']) ?>" style="max-width: 250px; height: 190px" class="img-fluid rounded-start" alt="...">
                            </div>




                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title text-left">
                                        <?php echo $row['Pname'] ?>
                                    </h5>

                                    <p class="card-text text-left">
                                        <?php echo $row['Pdescription'] ?>
                                    </p>
                                    <div>
                                        <table>
                                            <tr>
                                                <th width=100px>
                                                    <p class="card-text ">
                                                        code:
                                                    </p>

                                                </th>
                                                <th width=100px>
                                                    <p class="card-text ml-5">
                                                        Price:
                                                    </p>
                                                </th>
                                                <th width=100px>
                                                    <p class="card-text ml-5">
                                                        Quantity:
                                                    </p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td width=100px>
                                                    <p class="card-text ">

                                                        <?php echo $row['Pcode'] ?>
                                                    </p>

                                                </td>
                                                <td width=100px>
                                                    <p class="card-text ml-5">

                                                        <?php echo $row['Pprice'] ?>$
                                                    </p>
                                                </td>
                                                <td width=100px>
                                                    <p class="card-text ml-5">

                                                        <?php echo $row['Pquantity'] ?>
                                                    </p>
                                                </td>

                                            </tr>

                                        </table>
                                    </div>
                                    <div class="row text-left">

                                    </div>
                                    <p class="card-text text-left mt-1"><small class="text-body-secondary">Last updated 3 mins
                                            ago</small></p>

                                </div>
                            </div>




                            <?php
                            if ($curUser == 1) {
                                if ($row['Pquantity'] == 0) { ?>
                                    <a href="../PHP/index.php?delete=<?php echo x($row['PID']) ?>" class="btn border-0 btn-danger " style="position: absolute;  top: 0; right:0; margin: 12.5px; border-radius: 25% ; padding: 5px; " width="40">
                                        <img src=" ../IMG/icon/delete.png" alt="delete.png" width="20" height="20px">
                                    </a>
                            <?php }
                            } ?>




                            <?php if ($curUser == 1) { ?>
                                <span class="btn border-0 btn-light p-1 " data-toggle="modal" data-target="#post<?php echo x($row['PID']); ?>" style="position: absolute;  bottom: 0; right:0; margin: 12.5px;  border-radius: 25%; margin-right: 12.5px; padding: 5px; ">
                                    <img src=" ../IMG/icon/edit.png" alt="delete.png" width="20" height="20px">
                                </span>
                            <?php } ?>
                        </div>
                    </div>




        <?php

                }
            } else {
                echo '<h5 class="text-dark text-center mt-5 mb-2 ">no data found</h5>';
            }
        }
        ?>
        </div>























        <?php include("../PHP/footer.php"); ?>


        <script>
            function preventBack() {
                window.history.forward();
            }
            setTimeout("preventBack()", 0)
            window.onunload = function() {
                null;
            }
        </script>
        <script src="../JS/index.js"></script>
        <script src="../JS/bootstrap-js/jquery-3.2.1.slim.min.js"></script>
        <script src="../JS/bootstrap-js/popper.min.js"></script>
        <script src="../JS/bootstrap-js/bootstrap.min.js"></script>
        <script src="../JS/bootstrap-js/bootstrap.js"></script>

        <script>

        </script>
</body>

</html>