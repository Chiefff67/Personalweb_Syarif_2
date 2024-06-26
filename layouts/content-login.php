<!-- login form -->
<?php
if (isset($_GET['pesan'])) {
?>
    <div class="alert alert-warning" role="alert">
        Username Atau Password Anda Salah!
    </div>
<?php
}
?>

<form name="loginform" method="post" action="../configs/login-check.php" onsubmit="return validasi()">
    <div class=" form-group">
    <label for="userID">Username</label>
    <input type="text" class="form-control" name="user" id="userID" placeholder="type username here">
    <span id="username-error" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="passID">Password</label>
        <input type="password" class="form-control" name="pass" id="passID" placeholder="type password here">
        <span id="password-error" class="error-message"></span>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-info" value="login">
    </div>
</form>

<script type="text/javascript">
    function validasi() {
        const username = document.getElementById("userID").value;
        const usernameError = document.getElementById("username-error");
        const password = document.getElementById("passID").value;
        const passwordError = document.getElementById("password-error");

        usernameError.textContent = "";
        passwordError.textContent = "";
        let isValid = true;
        if (username === "" || username.length > 10) {
            usernameError.textContent =
                "Masukan username tidak lebih dari 10 karakter";
            isValid = false;
        }
        if (password === "" || password.length < 8) {
            passwordError.textContent =
                "Masukan password tidak boleh kurang dari 8 karakter";
            isValid = false;
        }
        return isValid;
    }
</script>

<!-- end login form -->