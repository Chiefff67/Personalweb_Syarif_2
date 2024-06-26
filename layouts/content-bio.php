<?php

include("../configs/bio-name.php");
include("../configs/connection.php");
error_reporting(0);

$user = $_SESSION['U'];
$sql = mysqli_query($connect, "SELECT * FROM user WHERE username = '$user'");
$data = mysqli_fetch_array($sql);

$iduser = $data['id_user'];
$bio = mysqli_query($connect, "SELECT * FROM biography JOIN user ON user.id_user = biography.id_user WHERE user.id_user = '$iduser'");
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
    $nama = $data['name'];
    $image = '<img src="../uploads/' . $biodat['photo'] . '" width="200px">';
    $table_status = "hidden";
}

// Pagination settings
$limit = 3; // Number of entries to show in a page.
if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
} else {
    $page = 1; 
};
$start_from = ($page-1) * $limit;

// Fetch total records
$result = mysqli_query($connect, "SELECT COUNT(biography.id_bio) FROM biography JOIN user ON user.id_user = biography.id_user");
$row = mysqli_fetch_row($result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);

// Fetch records for current page
$sql = mysqli_query($connect, "SELECT name, biography, photo FROM user JOIN biography ON user.id_user = biography.id_user LIMIT $start_from, $limit");

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
    $nomor = $start_from + 1;
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
    <?php 
        $nomor++;
    } 
    ?>
</table>

<!-- Pagination Links -->
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if($page > 1){ ?>
      <li class="page-item"><a class="page-link" href="?page=<?php echo ($page-1); ?>">Previous</a></li>
    <?php } ?>
    
    <?php for ($i=1; $i<=$total_pages; $i++) { ?>
      <li class="page-item <?php if($page == $i) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } ?>
    
    <?php if($page < $total_pages){ ?>
      <li class="page-item"><a class="page-link" href="?page=<?php echo ($page+1); ?>">Next</a></li>
    <?php } ?>
  </ul>
</nav>

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
