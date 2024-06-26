<?php
if (!isset($_SESSION['U']) and (!isset($_SESSION['P']))) {
    header("location:../pages/login.php");
}
include("../configs/connection.php");

$id = $_GET['id']; // untuk mengambil variabel id di URL
$sql = mysqli_query($connect, "delete from portfolio where id_port = '$id'");

header("location:../pages/polio.php");
