<?php
include("../configs/connection.php");
if (!isset($_SESSION['U'])) {
    $data2= [''];
}else {
    $usr = $_SESSION['U'];

    $sql2 = mysqli_query($connect, "select * from user where username = '$usr'");
    $data2 = mysqli_fetch_array($sql2);
}

?>