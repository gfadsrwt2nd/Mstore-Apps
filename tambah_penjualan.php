<?php
// Hubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "mstorenew");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Inisialisasi variabel
$nama_pelanggan = "";
$produk = "";
$kuantitas_terjual = "";
$total_harga = "";
$metode_pembayaran = "";
$status_pembayaran = "";

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST["nama_pelanggan"]);
    $produk = mysqli_real_escape_string($koneksi, $_POST["produk"]);
    $kuantitas_terjual = intval($_POST["kuantitas_terjual"]);
    $harga_produk = floatval($_POST["harga_produk"]); // Harga per produk
    $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST["metode_pembayaran"]);

    // Hitung total harga
    $total_harga = $harga_produk * $kuantitas_terjual;

    // Masukkan data ke dalam tabel penjualan
    $sql = "INSERT INTO penjualan (nama_pelanggan, produk, kuantitas_terjual, total_harga, metode_pembayaran, status_pembayaran, tanggal_penjualan)
            VALUES ('$nama_pelanggan', '$produk', $kuantitas_terjual, $total_harga, '$metode_pembayaran', 'Belum Lunas', NOW())";

    if (mysqli_query($koneksi, $sql)) {
        // Redirect ke halaman sukses atau halaman lain sesuai kebutuhan
        header("Location: penjualan.php");
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
    <title>Tambah Penjualan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style type="text/css">
    /* CSS untuk form penjualan */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f4f4f4;
    border: 1px solid #ddd;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Opsi tambahan jika ingin mengatur style "required" */
input:required {
    border-color: #d9d7d7;
}

</style>
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
    <h1 style="text-align: center;">Tambah Penjualan</h1>
    <form method="POST" action="proses_tambah_penjualan.php">
    <div class="form-group">
        <label for="nama_pelanggan">Nama Pelanggan:</label>
        <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" required>
    </div>
    
    <div class="form-group">
        <label for="produk">Produk:</label>
        <input type="text" class="form-control" name="produk" id="produk" required>
    </div>
    
    <div class="form-group">
        <label for="kuantitas_terjual">Kuantitas Terjual:</label>
        <input type="number" class="form-control" name="kuantitas_terjual" id="kuantitas_terjual" required>
    </div>
    
    <div class="form-group">
        <label for="harga_produk">Harga Produk:</label>
        <input type="number" class="form-control" name="harga_produk" id="harga_produk" required>
    </div>

    <div class="form-group">
        <label for="metode_pembayaran">Metode Pembayaran:</label>
        <select class="form-control" name="metode_pembayaran" id="status_pembayaran" required>
            <option value="Tunai">Tunai</option>
            <option value="Transfer">Transfer</option>
        </select>
    </div>

    <div class="form-group">
        <label for="status_pembayaran">Status Pembayaran:</label>
        <select class="form-control" name="status_pembayaran" id="status_pembayaran" required>
            <option value="Selesai">Selesai</option>
            <option value="Pending">Pending</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tanggal_penjualan">Tanggal Penjualan:</label>
        <input type="date" class="form-control" name="tanggal_penjualan" id="tanggal_penjualan" required>
    </div>
    
    <button type="submit" class="btn btn-primary">SAVE</button>
    <a class="btn btn-warning" href="penjualan.php">BACK</a>
</form>


    <div class="footer">
        Copyrights &copy; Mstore 2023 All rights Reserved | Made by <a href="https://instagram.com/mhdrusdik">Rusdi</a>.
    </div>
</body>
</html>
