<?php
if (!isset($_SESSION['U']) and (!isset($_SESSION['P']))) {
    header("location:login.php");
}
include("../configs/connection.php");
error_reporting(0);
$id = $_GET['id']; // mengambil id dri url

$sql = mysqli_query($connect, "select * from portfolio where id_port = '$id'");
$data = mysqli_fetch_array($sql);

if ($id == "") {
    $idport = "hidden";
    $actbtn = "addport";
    $actval = "Save Data";
} else {
    $idport = "readonly";
    $actbtn = "updateport";
    $actval = "Update Data";
}
error_reporting(0);
?>

<!-- form poertopolio -->
<form name="portform" method="post" action="" onsubmit="return validasi()">
    <div class="form-group" <?php echo $idport; ?>>
        <!-- <label for="portID">portfolio ID</label> -->
        <input type="hidden" class="form-control" name="port" id="portID" value="<?php echo $data['id_port']; ?>" <?php echo $idport; ?>>
    </div>
    <div class="form-group">
        <label for="projID">Project Name</label>
        <input type="text" class="form-control" name="proj" id="projID" value="<?php echo $data['project_name']; ?>" placeholder="type project here">
        <span id="proj-error" class="error-message"></span> <!--menampilkan eror wajib di isi-->
    </div>
    <div class="form-group">
        <label for="yearID">Year</label>
        <input type="number" class="form-control" name="year" id="yearID" value="<?php echo $data['year']; ?>" placeholder="type year here">
        <span id="year-error" class="error-message"></span>
    </div>
    <div class="form-group">
        <label for="descID">Description</label>
        <textarea class="form-control" name="desc" id="descID" rows="3" placeholder="type description here"><?php echo $data['description']; ?></textarea>
        <span id="desc-error" class="error-message"></span>
    </div>
    <div class="form-group">
        <input type="submit" name="<?php echo $actbtn; ?>" class="btn btn-info" value="<?php echo $actval; ?>">
        <input type="submit" class="btn btn-secondary" value="Reset Data">
        <input type="button" class="btn btn-secondary" onclick="location.href='polio.php'" value="Back">
    </div>
</form>
<!-- end form portfolio -->



<!-- jika submit diklik -->
<?php

if (isset($_POST['addport'])) {
    $proj = $_POST['proj'];
    $year = $_POST['year'];
    $desc = $_POST['desc'];

    $sql = "insert into portfolio (project_name, year, description) values ('$proj','$year','$desc')";
    $simpan = mysqli_query($connect, $sql);

    //bila berhasil simpan kembali ke halaman poertfolio
    if ($simpan) {
        header("location:../pages/polio.php");
    } else {
        echo "<script type='text/javascript'>onload = function(){ alert(data gagal disimpan!);}</script>";
    }
} elseif (isset($_POST['updateport'])) {
    $proj = $_POST['proj'];
    $year = $_POST['year'];
    $desc = $_POST['desc'];

    $sql = "update portfolio set project_name = '$proj', year ='$year', description = '$desc' where id_port = '$id'";
    $update = mysqli_query($connect, $sql);

    //bila berhasil update kembali ke halaman poertfolio
    if ($update) {
        header("location:../pages/polio.php");
    } else {
        echo "<script type='text/javascript'>onload = function(){ alert(data gagal disimpan!);}</script>";
    }
}

?>

<script type="text/javascript">
    function validasi() {
        const proj = document.getElementById("projID").value;
        const projError = document.getElementById("proj-error");
        const year = document.getElementById("yearID").value;
        const yearError = document.getElementById("year-error");
        const desc = document.getElementById("descID").value;
        const descError = document.getElementById("desc-error");

        projError.textContent = "";
        yearError.textContent = "";
        descError.textContent = "";
        let isValid = true;
        if (proj === "" || proj.length > 50) {
            projError.textContent =
                "Nama proyek terlalu panjang";
            isValid = false;
        }
        if (year === "" || year.length > 4) {
            yearError.textContent =
                "Tahun tidak masuk akal";
            isValid = false;
        }
        if (desc === "") {
            descError.textContent = "Masukan description"
            isValid = false;
        }
        return isValid;
    }
</script>