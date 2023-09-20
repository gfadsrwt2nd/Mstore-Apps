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
        // Redirect ke halaman berhasil atau halaman lain sesuai kebutuhan
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
