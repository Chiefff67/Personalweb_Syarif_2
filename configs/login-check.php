<?php 
include("connection.php");
$usr = $_POST['user']; // mengambil inputan dari form bername user
$pss = md5($_POST['pass']);// mengambil inputan dari form bername pass

$sql = mysqli_query($connect, "select * from user where username = '$usr' and password ='$pss'");


    


    $rowcount = mysqli_fetch_object($sql);
if ($rowcount) {
    session_start();
    $_SESSION['I'] = $rowcount->id_user;
    $_SESSION['U'] = $rowcount->username;
    $_SESSION['P'] = $rowcount->password;
    header("location:../pages/home.php");
}else{
    header("location:../pages/login.php?pesan=gagal");
}

// $rowcount = mysqli_num_rows($sql);// menghitung jumlah record tabel

// if ($rowcount !=0) {
//     session_start();
//     $_SESSION['U'] = $usr;
//     $_SESSION['P'] = $pss;


//     header("location:../pages/home.php");
// }else{
//     header("location:../pages/login.php");
// }
?>