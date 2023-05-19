<?php
session_start();
$db = mysqli_connect('localhost' , 'root' , '' , 'website');
if(!$db){
    echo "not connect to database";
}


function x($data){
    global $db;
    $data = mysqli_real_escape_string($db , htmlspecialchars($data));
    return $data;
}


?>