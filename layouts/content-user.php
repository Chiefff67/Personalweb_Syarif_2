<?php
if (!isset($_SESSION['U']) and (!isset($_SESSION['P']))) {
    $hidestatus = "hidden";
    $hr = "";
} else {
    $hidestatus = "";
    $hr = "<hr>";
}
include("../configs/connection.php");

// Pagination settings
$limit = 3; // Number of entries to show in a page.
if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
} else {
    $page = 1; 
};
$start_from = ($page-1) * $limit;

// Fetch total records
$result = mysqli_query($connect, "SELECT COUNT(id_user) FROM user");
$row = mysqli_fetch_row($result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);

// Fetch records for current page
$sql = mysqli_query($connect, "SELECT * FROM user LIMIT $start_from, $limit");

if (isset($_GET['pesan'])) {
?>
    <div class="alert alert-warning" role="alert">
        Tidak Bisa Menghapus Akun Yang Sedang Digunakan!
    </div>
    <?php
}
?>

<button class="btn btn-info" <?php echo $hidestatus; ?> onclick="location.href='user-form.php'">Add Data</button>
<?php echo $hr; ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Username</th>
            <th scope="col" <?php echo $hidestatus; ?>>Action</th>
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
                <td> <?php echo $data['username']; ?> </td>
                <td <?php echo $hidestatus; ?>>
                    <a class="btn btn-warning" href="user-form.php?id=<?php echo $data['id_user']; ?>">Edit</a>
                    <a class="btn btn-danger" href="../layouts/content-user-delete.php?id=<?php echo $data['id_user']; ?>&sessionId=<?php echo $_SESSION['I']; ?>" onclick="return KonfirmasiHapus()">Delete</a>
                </td>
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

<script>
    function alert() {
        alert("Anda yakin data ini akan dihapus?")
    }

    function KonfirmasiHapus() {
        if (confirm("Anda yakin data ini akan dihapus?"))
            return true;
        else
            return false;
    }
</script>
