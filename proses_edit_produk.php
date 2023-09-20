<?php
// Hubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "mstorenew");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $id_produk = $_POST["id_produk"]; // ID produk yang akan diubah
    $kode_produk = $_POST["kode_produk"];
    $nama_produk = $_POST["nama_produk"];
    $deskripsi = $_POST["deskripsi"];
    $kategori_produk = $_POST["kategori_produk"];
    $harga_jual = $_POST["harga_jual"];
    $harga_beli = $_POST["harga_beli"];
    $stok = $_POST["stok"];

    // Query untuk memperbarui data produk berdasarkan ID produk
    $sql = "UPDATE produk SET kode_produk='$kode_produk', nama_produk='$nama_produk', deskripsi='$deskripsi', kategori_produk='$kategori_produk', harga_jual='$harga_jual', harga_beli='$harga_beli', stok='$stok' WHERE id_produk=$id_produk";

    if (mysqli_query($koneksi, $sql)) {
        // Redirect ke halaman sukses atau halaman lain sesuai kebutuhan
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
