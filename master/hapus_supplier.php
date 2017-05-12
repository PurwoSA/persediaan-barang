<?php  
    require_once "../koneksi.php";

    if(isset($_GET["id"])){
        // Prepared statement untuk menghapus data
        $query = $db->prepare("DELETE FROM `supplier` WHERE kd_supplier=:kd_supplier");
        $query->bindParam(":kd_supplier", $_GET["id"]);
        // Jalankan Perintah SQL
        $query->execute();
        // Alihkan ke index.php
        header("location: supplier.php");
    }
?>