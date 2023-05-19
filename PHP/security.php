<?php
if (!$_SESSION['email'] && !$_SESSION['password']) {
    header('location: login.php');
}
?>
