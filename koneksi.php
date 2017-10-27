<?php
// Membangun koneksi ke database
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "umar_bakery";
try {
  // Buat Object PDO baru dan simpan ke variable $db
  $db = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
  // Mengatur Error Mode di PDO untuk segera menampilkan exception ketika ada kesalahan
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
  die("Connection error: " . $exception->getMessage());
}
