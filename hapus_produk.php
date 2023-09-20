<?php
// Hubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "mstorenew");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil ID produk yang akan dihapus dari parameter URL
if (isset($_GET["id"])) {
    $id_produk = $_GET["id"];
} else {
    die("ID produk tidak ditemukan.");
}

// Cek apakah tombol "Hapus" telah diklik
if (isset($_POST["hapus"])) {
    // Query untuk menghapus produk dari database
    $sql = "DELETE FROM produk WHERE id_produk = $id_produk";

    if (mysqli_query($koneksi, $sql)) {
        // Redirect ke halaman data produk setelah menghapus
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="penjualan.php">Penjualan</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="pengguna.php">Pengguna</a></li>
            <li><a href="laporan.php">Laporan</a></li>
        </ul>
    </div>

    <br><br><br>
    <center>
        <h2>Konfirmasi Hapus Produk</h2>
        <p>Anda yakin ingin menghapus produk ini?</p>
        <form method="POST">
            <input class="btn btn-success" type="submit" name="hapus" value="Hapus"> |
            <a class="btn btn-danger" href="index.php">Batal</a>
        </form>
    </center>

    <div class="footer">
        Copyrights &copy; Mstore 2023 All rights Reserved | Made by <a href="https://instagram.com/mhdrusdik">Rusdi</a>.
    </div>
</body>
</html>
