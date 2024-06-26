<?php

include("../configs/connection.php");

$id = $_GET['id'];
$idUser = $_GET['sessionId'];

echo '<pre>';
print_r(isset($_SESSION));
echo '</pre>';

if ($id === $idUser) {
    header("Location: ../pages/user.php?pesan=gagal");
    exit();
} else {
    $sql1 = mysqli_query($connect, "DELETE FROM biography WHERE id_user = '$id'");

    if ($sql1) {
        $sql2 = mysqli_query($connect, "DELETE FROM user WHERE id_user = '$id'");

        if ($sql2) {
            header("Location: ../pages/user.php");
            exit();
        }
    }
}
