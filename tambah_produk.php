<?php
// Hubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "mstorenew");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $kode_produk = $_POST["kode_produk"];
    $nama_produk = $_POST["nama_produk"];
    $deskripsi = $_POST["deskripsi"];
    $kategori_produk = $_POST["kategori_produk"];
    $harga_jual = $_POST["harga_jual"];
    $harga_beli = $_POST["harga_beli"];
    $stok = $_POST["stok"];
    $tanggal_upload = date("Y-m-d"); // Tanggal upload saat ini

    // Query untuk memasukkan data ke dalam tabel produk
    $sql = "INSERT INTO produk (kode_produk, nama_produk, deskripsi, kategori_produk, harga_jual, harga_beli, stok, tanggal_upload) VALUES ('$kode_produk', '$nama_produk', '$deskripsi', '$kategori_produk', '$harga_jual', '$harga_beli', '$stok', '$tanggal_upload')";

    if (mysqli_query($koneksi, $sql)) {
        echo "Produk berhasil ditambahkan.";
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
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style type="text/css">
    /* CSS untuk form */
form {
    max-width: 400px; /* Maksimum lebar form */
    margin: 0 auto; /* Posisi form di tengah halaman */
    padding: 20px;
    background-color: #f4f4f4; /* Warna latar belakang form */
    border: 1px solid #ddd;
    border-radius: 5px;
}

label {
    display: block; /* Menampilkan label sebagai blok agar ada jarak vertikal antara label dan input */
    margin-bottom: 5px; /* Jarak vertikal antara label dan input */
}

input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

textarea {
    resize: vertical; /* Biarkan textarea dapat diubah ukurannya secara vertikal */
}

input[type="submit"] {
    background-color: #007bff; /* Warna latar belakang tombol submit */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3; /* Warna latar belakang tombol submit saat dihover */
}

/* Opsi tambahan jika ingin mengatur style "required" */
input:required {
    border-color: #d9d7d7; /* Ubah warna border untuk input yang wajib diisi */
}

textarea:required {
    border-color: #d9d7d7; /* Ubah warna border untuk textarea yang wajib diisi */
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
    <h1 style="text-align: center;">Tambah Produk</h1>
    <form method="POST" action="proses_tambah_produk.php">
        <label for="kode_produk">Kode Produk:</label>
        <input type="text" name="kode_produk" id="kode_produk" required>
        
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" id="nama_produk" required>
        
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi" required></textarea>
        
        <label for="kategori_produk">Kategori Produk:</label>
        <input type="text" name="kategori_produk" id="kategori_produk" required>
        
        <label for="harga_jual">Harga Jual:</label>
        <input type="number" name="harga_jual" id="harga_jual" required>
        
        <label for="harga_beli">Harga Beli:</label>
        <input type="number" name="harga_beli" id="harga_beli" required>
        
        <label for="stok">Stok:</label>
        <input type="number" name="stok" id="stok" required>
        
        <input type="submit" value="ADD">
        <a class="btn btn-warning" href="index.php" style="height: 42px;">BACK<br></a>
    </form>
    <br><br><br>

    <div class="footer">
        Copyrights &copy; Mstore 2023 All rights Reserved | Made by <a href="https://instagram.com/mhdrusdik">Rusdi</a>.
    </div>
</body>
</html>
