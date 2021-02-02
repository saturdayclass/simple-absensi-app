<?php

try {
  session_start();
  // buat koneksi dengan database
  $conn = new PDO('mysql:host=localhost;dbname=db_otis', "root", "");
  
  // set error mode
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $directoryURI = $_SERVER['REQUEST_URI'];
  $path = parse_url($directoryURI, PHP_URL_PATH);
  $components = explode('/', $path);
  $first_part = $components[2];

} catch (PDOException $e) {
  // tampilkan pesan kesalahan jika koneksi gagal
  print "Koneksi atau query bermasalah: " . $e->getMessage() . "<br/>";
  die();
}
?>