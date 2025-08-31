<?php

require_once __DIR__ . '/koneksi.php';

//Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

//Cek Koneksi
if ($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

//Query ambil semua data mahasiswa
$sql = "SELECT nim, nama, umur FROM mahasiswa ORDER BY nim ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Daftar Mahasiswa</title>
    </head>

    <body>
        <h2>Daftar Mahasiswa</h2>

        <!-- Form Pencarian -->
        <form method="get" action="">
            <input type="text" name="search" placeholder="Cari NIM atau Nama..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Cari</button>
        </form>
        <br>

        <?php if ($result->num_rows > 0): ?>
            <table border="1" cellpaddind="5" cellspacing="0">
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Umur</th>
                </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['umur']; ?></td>
                </tr>
            <?php endwhile; ?>
            </table>

        <?php else: ?>
            <p>Tidak ada data mahasiswa.</p>
        <?php endif; ?>

    </body>
</html>

        <?php
            $conn->close();
        ?>