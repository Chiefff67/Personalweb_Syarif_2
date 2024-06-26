<?php
include("connection.php");
$usr = $_POST['user'];
$pss = md5($_POST['pass']);

$sql = mysqli_query($connect, "select * from user where username = '$usr' and password ='$pss'");





$rowcount = mysqli_fetch_object($sql);
if ($rowcount) {
    session_start();
    $_SESSION['I'] = $rowcount->id_user;
    $_SESSION['U'] = $rowcount->username;
    $_SESSION['P'] = $rowcount->password;
    header("location:../pages/home.php");
} else {

    echo "<script>
    window.location.href = '../pages/login.php';
     function loginFailed() {
        alert('Username atau password salah');
    }
    loginFailed();
</script>";
}
