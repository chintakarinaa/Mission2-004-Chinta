<?php

require_once __DIR__ . "/koneksi.php";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error)
    die("Koneksi gagal: " . $conn->connect_error);

$nim = $_GET['nim'] ?? '';
$sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
$result = $conn->query($sql);
$mahasiswa = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Detail Mahasiswa</title>
</head>

<body>
    <h2>Detail Mahasiswa</h2>
    <?php if ($mahasiswa): ?>
        <p><strong>NIM:</strong> <?= $mahasiswa['nim']; ?></p>
        <p><strong>Nama:</strong> <?= $mahasiswa['nama']; ?></p>
        <p><strong>Umur:</strong> <?= $mahasiswa['umur']; ?></p>
    <?php else: ?>
        <p>Data tidak ditemukan.</p>
    <?php endif; ?>
    <a href="latihan9.php">Kembali</a>
</body>

</html>

<?php $conn->close(); ?>