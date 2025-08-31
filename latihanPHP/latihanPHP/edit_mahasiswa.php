<?php

require_once __DIR__ . "/koneksi.php";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error)
    die("Koneksi gagal: " . $conn->connect_error);

$nim = $_GET['nim'] ?? '';
$result = $conn->query("SELECT * FROM mahasiswa WHERE nim='$nim'");
$mahasiswa = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $sql = "UPDATE mahasiswa SET nama='$nama', umur='$umur' WHERE nim='$nim'";
    if ($conn->query($sql)) {
        header("Location: latihan9.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Mahasiswa</title>
</head>

<body>
    <h2>Edit Mahasiswa</h2>
    <?php if ($mahasiswa): ?>
        <form method="post">
            NIM: <strong><?= $mahasiswa['nim']; ?></strong><br>
            Nama: <input type="text" name="nama" value="<?= $mahasiswa['nama']; ?>" required><br>
            Umur: <input type="number" name="umur" value="<?= $mahasiswa['umur']; ?>" required><br>
            <button type="submit">Update</button>
        </form>
    <?php else: ?>
        <p>Data tidak ditemukan.</p>
    <?php endif; ?>
    <a href="Latihan9.php">Kembali</a>
</body>

</html>
<?php $conn->close(); ?>