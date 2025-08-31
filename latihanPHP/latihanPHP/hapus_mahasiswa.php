<?php

require_once __DIR__ . "/koneksi.php";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error)
    die("Koneksi gagal: " . $conn->connect_error);

$nim = $_GET['nim'] ?? '';
if ($nim) {
    $conn->query("DELETE FROM mahasiswa WHERE nim='$nim'");
}
header("Location: Latihan9.php");

exit;