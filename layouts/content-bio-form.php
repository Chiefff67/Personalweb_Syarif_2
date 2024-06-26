<?php

if (!isset($_SESSION['U']) and (!isset($_SESSION['P']))) {
    header("location:login.php");
}

include("../configs/connection.php");

$idbio = $_GET['id'];
$sql = mysqli_query($connect, "Select * from biography where id_bio='$idbio'");

$data = mysqli_fetch_array($sql);

?>

<!-- biography form -->
<form name="bioform" method="post" enctype="multipart/form-data" action="" onsubmit="return validasi()">
    <div class=" form-group">
        <label for="bioID">Biography Edit Form</label>
        <textarea class="form-control" name="bio" id="bioID" rows="10"><?php echo $data['biography']; ?></textarea>
        <span id="bio-error" class="error-message"></span>
    </div>
    <div class="form-group">
        <label for="fotoID">Foto Profil</label>
        <input type="file" name="foto" id="fotoID">
        <span id="foto-error" class="error-message"></span>
    </div>
    <div class="form-group">
        <input type="submit" name="updatebio" class="btn btn-info" value="Update Data">
        <input type="reset" class="btn btn-secondary" value="Reset Data">
        <input type="button" class="btn btn-secondary" onclick="location.href='bio.php'" value="Back">
    </div>
</form>
<!-- end of biography form -->

<?php
if (isset($_POST['updatebio'])) {
    $bioaja = $_POST['bio'];

    $dir = "../uploads/";
    $filename = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $filename);

    $update = mysqli_query($connect, "update biography set biography='$bioaja', photo='$filename' where id_bio='$idbio'");

    if ($update) {
        header("location:../pages/bio.php");
    } else {
        echo "<script type='text/javascript'>onload=function(){alert('Data gagal disimpan');}</script>";
    }
}
?>

<script type="text/javascript">
    function validasi() {
        const bio = document.getElementById("bioID").value;
        const bioError = document.getElementById("bio-error");
        const foto = document.getElementById("fotoID").files[0];
        const fotoError = document.getElementById("foto-error");

        bioError.textContent = "";
        fotoError.textContent = "";

        let isValid = true;

        if (bio === "") {
            bioError.textContent = "Masukan Biography";
            isValid = false;
        }
        if (foto) {
            const maxSize = 2 * 1024 * 1024; // 2 MB
            const validImageTypes = ["image/jpeg", "image/png"];
            if (foto.size > maxSize) {
                fotoError.textContent = "Ukuran foto tidak boleh lebih dari 2MB.";
                isValid = false;
            } else if (!validImageTypes.includes(foto.type)) {
                fotoError.textContent = "File yang diunggah harus berupa gambar (jpeg, png).";
                isValid = false;
            }
        } else {
            fotoError.textContent = "Harap unggah foto.";
            isValid = false;
        }
        return isValid;
    }
</script>