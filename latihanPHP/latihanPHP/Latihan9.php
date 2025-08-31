<?php

require_once __DIR__ . "/koneksi.php";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error)
    die("Koneksi gagal: " . $conn->connect_error);

// Ambil kata kunci pencarian
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : "";

// Buat query
if ($search !== "") {
    $sql = "SELECT nim, nama, umur FROM mahasiswa 
            WHERE nim LIKE '%$search%' 
               OR nama LIKE '%$search%' 
               OR umur LIKE '%$search%'
            ORDER BY nim ASC";
} else {
    $sql = "SELECT nim, nama, umur FROM mahasiswa ORDER BY nim ASC";
}


$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <h2>Daftar Mahasiswa</h2>
    <a href="tambah_mahasiswa.php">+ Tambah Mahasiswa</a>
    <br><br>

    <!-- Form Search -->
    <form method="get" action="">
        <input type="text" name="search" placeholder="Cari mahasiswa..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Cari</button>
        <?php if ($search !== ""): ?>
            <a href="latihan9.php">Reset</a>
        <?php endif; ?>
    </form>
    <br>

    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['umur']; ?></td>
                    <td>
                        <a href="detail_mahasiswa.php?nim=<?= urlencode($row['nim']); ?>">View</a> |
                        <a href="edit_mahasiswa.php?nim=<?= urlencode($row['nim']); ?>">Edit</a> |
                        <a href="hapus_mahasiswa.php?nim=<?= urlencode($row['nim']); ?>"
                            onclick="return confirm('Yakin hapus data?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Tidak ada data mahasiswa.</p>
    <?php endif; ?>
</body>

</html>
<?php $conn->close(); ?>    