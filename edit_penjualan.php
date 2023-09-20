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

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST["nama_pelanggan"]);
    $produk = mysqli_real_escape_string($koneksi, $_POST["produk"]);
    $kuantitas_terjual = intval($_POST["kuantitas_terjual"]);
    $harga_produk = floatval($_POST["harga_produk"]);
    $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST["metode_pembayaran"]);
    $status_pembayaran = mysqli_real_escape_string($koneksi, $_POST["status_pembayaran"]);
    $tanggal_penjualan = $_POST["tanggal_penjualan"];

    // Query untuk memperbarui data penjualan berdasarkan ID penjualan
    $sql = "UPDATE penjualan SET
            nama_pelanggan='$nama_pelanggan',
            produk='$produk',
            kuantitas_terjual=$kuantitas_terjual,
            harga_produk=$harga_produk,
            metode_pembayaran='$metode_pembayaran',
            status_pembayaran='$status_pembayaran',
            tanggal_penjualan='$tanggal_penjualan'
            WHERE id_penjualan=$id_penjualan";

    if (mysqli_query($koneksi, $sql)) {
        // Redirect ke halaman sukses atau halaman lain sesuai kebutuhan
        header("Location: penjualan.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

// Query untuk mendapatkan data penjualan berdasarkan ID penjualan
$sql = "SELECT * FROM penjualan WHERE id_penjualan = $id_penjualan";
$result = mysqli_query($koneksi, $sql);

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("Data penjualan tidak ditemukan.");
}

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penjualan</title>
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
    input[type="date"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
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
    input:required,
    select:required {
        border-color: #d9d7d7; /* Ubah warna border untuk input yang wajib diisi */
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
    <h1 style="text-align: center;">Edit Penjualan</h1>
    <form method="POST" action="edit_penjualan.php?id=<?php echo $id_penjualan; ?>">
        <div class="form-group">
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?php echo htmlspecialchars($row['nama_pelanggan']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="produk">Produk:</label>
            <input type="text" class="form-control" name="produk" id="produk" value="<?php echo htmlspecialchars($row['produk']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="kuantitas_terjual">Kuantitas Terjual:</label>
            <input type="number" class="form-control" name="kuantitas_terjual" id="kuantitas_terjual" value="<?php echo $row['kuantitas_terjual']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="harga_produk">Harga Produk:</label>
            <input type="number" class="form-control" name="harga_produk" id="harga_produk" value="<?php echo $row['harga_produk']; ?>" required>
        </div>

        <div class="form-group">
            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <input type="text" class="form-control" name="metode_pembayaran" id="metode_pembayaran" value="<?php echo htmlspecialchars($row['metode_pembayaran']); ?>" required>
        </div>

        <div class="form-group">
            <label for="status_pembayaran">Status Pembayaran:</label>
            <select class="form-control" name="status_pembayaran" id="status_pembayaran" required>
                <option value="Selesai" <?php if ($row['status_pembayaran'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                <option value="Pending" <?php if ($row['status_pembayaran'] == 'Pending') echo 'selected'; ?>>Pending</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_penjualan">Tanggal Penjualan:</label>
            <input type="date" class="form-control" name="tanggal_penjualan" id="tanggal_penjualan" value="<?php echo $row['tanggal_penjualan']; ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-warning" href="penjualan.php">Back</a>
    </form>

    <div class="footer">
        Copyrights &copy; Mstore 2023 All rights Reserved | Made by <a href="https://instagram.com/mhdrusdik">Rusdi</a>.
    </div>
</body>
</html>
