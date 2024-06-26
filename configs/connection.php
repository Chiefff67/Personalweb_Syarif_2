<?php 
$servername = "localhost";
$dbuser = "root";
$dbpassword = "root";
$dbname = "personal_web_db";

$connect = mysqli_connect($servername,$dbuser,$dbpassword);

$connect_error ="koneksi gagal atau database tidak ada";
mysqli_select_db($connect,$dbname) or die($connect_error);

?>