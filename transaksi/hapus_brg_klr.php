<?php
    require_once "../koneksi.php";

    if(isset($_GET["id"])){
        // Prepared statement untuk menghapus data
        $query = $db->prepare("DELETE FROM `barang_klr` WHERE no_klr=:no_klr");
        $query->bindParam(":no_klr", $_GET["id"]);
        // Jalankan Perintah SQL
        $query->execute();
        // Alihkan ke index.php
        header("location: brg_klr.php");
    }
?>
