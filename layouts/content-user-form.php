<?php
if (!isset($_SESSION['U']) and (!isset($_SESSION['P']))) {
    header("location:login.php");
}
include("../configs/connection.php");
error_reporting(0);
$id = $_GET['id']; // mengambil id dri url

$sql = mysqli_query($connect, "select * from user where id_user = '$id'");
$data = mysqli_fetch_array($sql);


if ($id == "") {
    $iduser = "hidden";
    $actbtn = "adduser";
    $actval = "Save Data";
} else {
    $iduser = "readonly";
    $actbtn = "updateuser";
    $actval = "Update Data";
}
error_reporting(0);
?>

<!-- form poertopolio -->
<form name="userform" method="post" action="" onsubmit="return validasi()">
    <div class="form-group" <?php echo $iduser; ?>>
        <label for="userID">User ID</label>
        <input type="text" class="form-control" name="user" id="userID" value="<?php echo $data['id_user']; ?>" <?php echo $iduser; ?>>
    </div>
    <div class="form-group">
        <label for="nameID">Nama</label>
        <input type="text" class="form-control" name="name" id="nameID" value="<?php echo $data['name']; ?>" placeholder="type name here">
        <span id="name-error" class="error-message"></span> <!--menampilkan eror wajib di isi-->
    </div>
    <div class="form-group">
        <label for="UsernameID">Username</label>
        <input type="text" class="form-control" name="username" id="UsernameID" value="<?php echo $data['username']; ?>" placeholder="type username here">
        <span id="username-error" class="error-message"></span>
    </div>
    <div class="form-group">
        <label for="passID">Password</label>
        <input type="password" class="form-control" name="password" id="passID" value="<?php echo $data['password']; ?>" placeholder="type password here">
        <span id="password-error" class="error-message"></span>
    </div>
    <div class="form-group">
        <input type="submit" name="<?php echo $actbtn; ?>" class="btn btn-info" value="<?php echo $actval; ?>">
        <input type="submit" class="btn btn-secondary" value="Reset Data">
        <input type="button" class="btn btn-secondary" onclick="location.href='user.php'" value="Back">
    </div>
</form>
<!-- end form portfolio -->


<!-- jika submit diklik -->
<?php

if (isset($_POST['adduser'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "insert into user (name, username, password) values ('$name','$username','$password')";
    $simpan = mysqli_query($connect, $sql);

    //bila berhasil simpan kembali ke halaman poertfolio
    if ($simpan) {
        header("location:../pages/user.php");
    } else {
        echo "<script type='text/javascript'>onload = function(){ alert(data gagal disimpan!);}</script>";
    }
} elseif (isset($_POST['updateuser'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "update user set name = '$name', username ='$username', password = '$password' where id_user = '$id'";
    $update = mysqli_query($connect, $sql);

    //bila berhasil update kembali ke halaman poertfolio
    if ($update) {
        header("location:../pages/user.php");
    } else {
        echo "<script type='text/javascript'>onload = function(){ alert(data gagal disimpan!);}</script>";
    }
}

?>

<script type="text/javascript">
    function validasi() {
        const name = document.getElementById("nameID").value;
        const nameError = document.getElementById("name-error");
        const username = document.getElementById("UsernameID").value;
        const usernameError = document.getElementById("username-error");
        const password = document.getElementById("passID").value;
        const passwordError = document.getElementById("password-error");

        nameError.textContent = "";
        usernameError.textContent = "";
        passwordError.textContent = "";
        let isValid = true;
        if (name === "" || name.length > 50) {
            nameError.textContent =
                "Masukan nama tidak lebih dari 50 karakter";
            isValid = false;
        }
        if (username === "" || username.length > 10) {
            usernameError.textContent =
                "Masukan username tidak lebih dari 10 karakter";
            isValid = false;
        }
        if (password === "" || password.length < 8) {
            passwordError.textContent =
                "Password tidak boleh kurang dari 8 karakter";
            isValid = false;
        }
        return isValid;
    }
</script>