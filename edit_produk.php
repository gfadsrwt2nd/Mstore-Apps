<?php
// Hubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "mstorenew");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Inisialisasi variabel ID produk dari parameter URL
if (isset($_GET["id"])) {
    $id_produk = $_GET["id"];
} else {
    die("ID produk tidak ditemukan.");
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $kode_produk = mysqli_real_escape_string($koneksi, $_POST["kode_produk"]);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST["nama_produk"]);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST["deskripsi"]);
    $kategori_produk = mysqli_real_escape_string($koneksi, $_POST["kategori_produk"]);
    $harga_jual = floatval($_POST["harga_jual"]);
    $harga_beli = floatval($_POST["harga_beli"]);
    $stok = intval($_POST["stok"]);

    // Query untuk memperbarui data produk berdasarkan ID produk
    $sql = "UPDATE produk SET
            kode_produk='$kode_produk',
            nama_produk='$nama_produk',
            deskripsi='$deskripsi',
            kategori_produk='$kategori_produk',
            harga_jual=$harga_jual,
            harga_beli=$harga_beli,
            stok=$stok
            WHERE id_produk=$id_produk";

    if (mysqli_query($koneksi, $sql)) {
        // Redirect ke halaman sukses atau halaman lain sesuai kebutuhan
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

// Query untuk mendapatkan data produk berdasarkan ID produk
$sql = "SELECT * FROM produk WHERE id_produk = $id_produk";
$result = mysqli_query($koneksi, $sql);

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("Data produk tidak ditemukan.");
}

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
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
    <h1 style="text-align: center;">Edit Produk</h1>
    <form method="POST" action="edit_produk.php?id=<?php echo $id_produk; ?>">
        <label for="kode_produk">Kode Produk:</label>
        <input type="text" name="kode_produk" id="kode_produk" value="<?php echo htmlspecialchars($row['kode_produk']); ?>" required>
        
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" id="nama_produk" value="<?php echo htmlspecialchars($row['nama_produk']); ?>" required>
        
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
        
        <label for="kategori_produk">Kategori Produk:</label>
        <input type="text" name="kategori_produk" id="kategori_produk" value="<?php echo htmlspecialchars($row['kategori_produk']); ?>" required>
        
        <label for="harga_jual">Harga Jual:</label>
        <input type="number" name="harga_jual" id="harga_jual" value="<?php echo $row['harga_jual']; ?>" required>
        
        <label for="harga_beli">Harga Beli:</label>
        <input type="number" name="harga_beli" id="harga_beli" value="<?php echo $row['harga_beli']; ?>" required>
        
        <label for="stok">Stok:</label>
        <input type="number" name="stok" id="stok" value="<?php echo $row['stok']; ?>" required>
        
        <input class="btn-sm btn-primary" type="submit" value="Simpan">
        <a class="btn btn-warning" href="penjualan.php" style="height: 40px;">Back</a>
    </form>

    <div class="footer">
        Copyrights &copy; Mstore 2023 All rights Reserved | Made by <a href="https://instagram.com/mhdrusdik">Rusdi</a>.
    </div>
</body>
</html>
