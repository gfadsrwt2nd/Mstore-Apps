<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style type="text/css">
/* CSS untuk kontainer laporan */
.content {
    background-color: #f4f4f4;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 20px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th,
table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

table th {
    background-color: #f2f2f2;
}

table-striped tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
}

table-striped tbody tr:hover {
    background-color: #ddd;
}
</style>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="penjualan.php">Penjualan</a></li>
            <li><a href="laporan.php">Laporan</a></li>
        </ul>
    </div>

    <br><br><br>
    <div class="content">
        <h1>Laporan</h1>
        <a class="btn btn-primary" href="laporan.php?jenis=produk" style="margin-bottom: 5px;">Laporan Produk</a>
        <br>
        <a class="btn btn-primary" href="laporan.php?jenis=penjualan">Laporan Penjualan</a>

        <?php
        if (isset($_GET['jenis'])) {
            $jenis = $_GET['jenis'];

            if ($jenis == 'produk') {

                // Koneksi ke database
                $koneksi = mysqli_connect("localhost", "root", "", "mstorenew");
                if (!$koneksi) {
                    die("Koneksi database gagal: " . mysqli_connect_error());
                }

                // Query untuk menampilkan laporan produk
                $sql = "SELECT * FROM produk";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table class='table'>";
                    echo "<a class='btn btn-success' href='download_produk.php' style='margin-right:100%; margin-bottom:5px;'>Download</a>";
                    echo "<thead><tr><th>ID Produk</th><th>Kode Produk</th><th>Nama Produk</th><th>Deskripsi</th><th>Kategori Produk</th><th>Harga Jual</th><th>Harga Beli</th><th>Stok</th><th>Tanggal Upload</th></tr></thead>";
                    echo "<tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_produk'] . "</td>";
                        echo "<td>" . $row['kode_produk'] . "</td>";
                        echo "<td>" . $row['nama_produk'] . "</td>";
                        echo "<td>" . $row['deskripsi'] . "</td>";
                        echo "<td>" . $row['kategori_produk'] . "</td>";
                        echo "<td>" . $row['harga_jual'] . "</td>";
                        echo "<td>" . $row['harga_beli'] . "</td>";
                        echo "<td>" . $row['stok'] . "</td>";
                        echo "<td>" . $row['tanggal_upload'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "Tidak ada data produk.";
                }
                mysqli_close($koneksi);
            } elseif ($jenis == 'penjualan') {

            // Koneksi ke database
            $koneksi = mysqli_connect("localhost", "root", "", "mstorenew");
            if (!$koneksi) {
                die("Koneksi database gagal: " . mysqli_connect_error());
            }

            // Query untuk menampilkan laporan penjualan
            $sql = "SELECT * FROM penjualan"; // Ganti dengan nama tabel penjualan yang sesuai
            $result = mysqli_query($koneksi, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table'>";
                echo "<a class='btn btn-success' href='download_penjualan.php' style='margin-right:100%; margin-bottom:5px;'>Download</a>";
                echo "<thead><tr><th>ID Penjualan</th><th>Nama Pelanggan</th><th>Produk</th><th>Kuantitas Terjual</th><th>Total Harga</th><th>Metode Pembayaran</th><th>Status Pembayaran</th><th>Tanggal Penjualan</th></tr></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_penjualan'] . "</td>";
                    echo "<td>" . $row['nama_pelanggan'] . "</td>";
                    echo "<td>" . $row['produk'] . "</td>";
                    echo "<td>" . $row['kuantitas_terjual'] . "</td>";
                    echo "<td>" . $row['total_harga'] . "</td>";
                    echo "<td>" . $row['metode_pembayaran'] . "</td>";
                    echo "<td>" . $row['status_pembayaran'] . "</td>";
                    echo "<td>" . $row['tanggal_penjualan'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "Tidak ada data penjualan.";
            }
            mysqli_close($koneksi);
        }
 else {
                echo "<p>Pilih jenis laporan di atas.</p>";
            }
        } else {
            echo "<p>Pilih jenis laporan di atas.</p>";
        }
        ?>

    </div>
</body>
</html>
