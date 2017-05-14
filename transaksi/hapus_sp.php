<?php
    require_once "../koneksi.php";

    if(isset($_GET["id"])){
        // Prepared statement untuk menghapus data
        $query = $db->prepare("DELETE FROM `surat_pesan` WHERE no_sp=:no_sp");
        $query->bindParam(":no_sp", $_GET["id"]);
        // Jalankan Perintah SQL
        $query->execute();
        // Alihkan ke index.php
        header("location: sp.php");
    }
?>
