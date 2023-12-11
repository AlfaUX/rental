    <?php
    $id = $_GET['id'];
    mysqli_query($koneksi,"DELETE FROM user WHERE id='$id'");

    header("location:edituser.php");
?>