<?php  
    require_once "../../koneksi.php";

    if(isset($_GET["id"])){
        // Prepared statement untuk menghapus data
        $query = $db->prepare("DELETE FROM `barang` WHERE kd_brg=:kd_brg");
        $query->bindParam(":kd_brg", $_GET["id"]);
        // Jalankan Perintah SQL
        $query->execute();
        // Alihkan ke index.php
        header("location: barang.php");
    }
?>