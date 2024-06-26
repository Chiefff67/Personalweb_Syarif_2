<!-- content bio -->
<?php
include("../configs/bio-name.php");
include("../configs/connection.php");
error_reporting(0);

$user = $_SESSION['U'];
$sql = mysqli_query($connect, "select * from user where username = '$user'");
$data = mysqli_fetch_array($sql);

$iduser = $data['id_user'];
$bio = mysqli_query($connect, "SELECT * FROM biography JOIN user on user.id_user = biography.id_user WHERE user.id_user = '$iduser'");
$biodat = mysqli_fetch_array($bio);

if (!isset($_SESSION['U']) and (!isset($_SESSION['P']))) {
    $btn_status = "hidden";
    $hr = "";
    $nama = '';
    $image = "";
    $table_status = "";
} else {
    $btn_status = "";
    $hr = "<hr>";
    $nama = $data2['name'];
    $image = '<img src="../uploads/' . $biodat['photo'] . '" width="200px">';
    $table_status = "hidden";
}
$sql = mysqli_query($connect, "SELECT name, biography, photo FROM user JOIN biography ON user.id_user = biography.id_user;");

?>

<table class="table table-striped" <?php echo $table_status ?>>
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama</th>
            <th scope="col">Biografi</th>
            <th scope="col">Foto</th>
        </tr>
    </thead>

    <?php
    $nomor = 1;
    while ($data = mysqli_fetch_array($sql)) {
    ?>
        <tbody>
            <tr>
                <td scope="row"> <?php echo $nomor; ?> </td>
                <td> <?php echo $data['name']; ?> </td>
                <td> <?php echo $data['biography']; ?> </td>
                <td> <img src="../uploads/<?php echo $data['photo'] ?>" width="100px"></td>
            </tr>
        </tbody>
    <?php $nomor++;
    } ?>
</table>

<button class="btn btn-info" <?php echo $btn_status; ?> onclick="location.href='bio-form.php?id=<?php echo $biodat['id_bio']; ?>'">Edit Data</button>

<?php echo $hr; ?>

<h3>
    <center><?php echo $nama ?></center>
</h3>

<center>
    <?php echo $image; ?>
</center>

<p style="text-align: center; margin-top:30px">
    <?php echo $biodat["biography"]; ?>
</p>
<!-- content bio end -->