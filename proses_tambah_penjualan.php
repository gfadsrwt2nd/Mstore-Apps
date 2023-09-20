<?php
// Hubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "mstorenew");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST["nama_pelanggan"]);
    $produk = mysqli_real_escape_string($koneksi, $_POST["produk"]);
    $kuantitas_terjual = intval($_POST["kuantitas_terjual"]);
    $harga_produk = floatval($_POST["harga_produk"]);
    $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST["metode_pembayaran"]);

    // Hitung total harga
    $total_harga = $kuantitas_terjual * $harga_produk;

    // Query untuk menyimpan data penjualan ke dalam tabel penjualan
    $sql = "INSERT INTO penjualan (nama_pelanggan, produk, kuantitas_terjual, harga_produk, total_harga, metode_pembayaran, status_pembayaran, tanggal_penjualan) VALUES ('$nama_pelanggan', '$produk', $kuantitas_terjual, $harga_produk, $total_harga, '$metode_pembayaran', 'Belum Lunas', NOW())";

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
