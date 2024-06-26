<?php 
$servername = "localhost";
$dbuser = "syarif";
$dbpassword = "Tanjiro67";
$dbname = "personalweb_syarif";

$connect = mysqli_connect($servername,$dbuser,$dbpassword);

$connect_error ="koneksi gagal atau database tidak ada";
mysqli_select_db($connect,$dbname) or die($connect_error);

?>