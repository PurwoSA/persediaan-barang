<?php
    require_once "../koneksi.php";

    if(isset($_GET["id"])){
        // Prepared statement untuk menghapus data
        $query = $db->prepare("DELETE FROM `isi_sp` WHERE kd_isi=:kd_isi");
        $query->bindParam(":kd_isi", $_GET["id"]);
        // Jalankan Perintah SQL
        $query->execute();
        // Alihkan ke index.php
        header("location: isi_sp.php");
    }
?>
