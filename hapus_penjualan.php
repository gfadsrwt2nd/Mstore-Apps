<?php
// Hubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "mstorenew");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Inisialisasi variabel ID penjualan dari parameter URL
if (isset($_GET["id"])) {
    $id_penjualan = $_GET["id"];
} else {
    die("ID penjualan tidak ditemukan.");
}

if (isset($_GET["confirm"]) && $_GET["confirm"] === "yes") {
    // Jika konfirmasi "ya", maka hapus data penjualan
    $sql = "DELETE FROM penjualan WHERE id_penjualan=$id_penjualan";

    if (mysqli_query($koneksi, $sql)) {
        // Redirect ke halaman penjualan setelah berhasil menghapus data
        header("Location: penjualan.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
} elseif (isset($_GET["confirm"]) && $_GET["confirm"] === "no") {
    // Jika konfirmasi "tidak", maka kembali ke halaman penjualan tanpa menghapus
    header("Location: penjualan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Penjualan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="penjualan.php">Penjualan</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="laporan.php">Laporan</a></li>
        </ul>
    </div>

    <br><br><br>
    <center>
        <h1>Konfirmasi Hapus Penjualan</h1>
        <p>Anda yakin ingin menghapus data penjualan ini?</p>
        <a class="btn btn-success" href="hapus_penjualan.php?id=<?php echo $id_penjualan; ?>&confirm=yes">Iya</a> | 
        <a class="btn btn-danger" href="hapus_penjualan.php?id=<?php echo $id_penjualan; ?>&confirm=no">Tidak</a>
    </center>

    <div class="footer">
        Copyrights &copy; Mstore 2023 All rights Reserved | Made by <a href="https://instagram.com/mhdrusdik">Rusdi</a>.
    </div>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($koneksi);
?>
