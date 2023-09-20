<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style type="text/css">
#searchInput {
    width: 30%; /* Lebar elemen input */
    margin-left: 30%; /* Margin kiri untuk posisi input di tengah */
    padding: 10px; /* Padding untuk menambah ruang di dalam input */
    border: 1px solid #ccc; /* Garis tepi input */
    border-radius: 3px; /* Sudut border dibulatkan */
    font-size: 16px; /* Ukuran font teks dalam input */
    background-color: #f4f4f4; /* Warna latar belakang input */
    color: #333; /* Warna teks dalam input */
    margin-bottom: 5px;
}

/* Efek hover saat kursor berada di atas input */
#searchInput:hover {
    border-color: #007bff; /* Ubah warna border saat dihover */
}

/* Efek saat input dalam fokus (terpilih) */
#searchInput:focus {
    outline: none; /* Hilangkan border biru saat input dalam fokus */
    border-color: #007bff; /* Ubah warna border saat dalam fokus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Efek bayangan saat dalam fokus */
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
    <div class="container">
        <h1>Data Produk</h1>
        <hr>
        <a href="tambah_produk.php" class="btn btn-primary" style="margin-bottom: 7px;">Add</a>
        <input type="text" id="searchInput" placeholder="Cari produk (Nama, Kode, Desk, Tanggal)" style="width: 30%; margin-left: 30%;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Kategori Produk</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Hubungkan ke database
                $koneksi = mysqli_connect("localhost", "root", "", "mstorenew");

                if (!$koneksi) {
                    die("Koneksi database gagal: " . mysqli_connect_error());
                }

                // Query database
                $sql = "SELECT * FROM produk";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_produk'] . "</td>";
                        echo "<td>" . $row['kode_produk'] . "</td>";
                        echo "<td>" . $row['nama_produk'] . "</td>";
                        echo "<td>" . $row['deskripsi'] . "</td>";
                        echo "<td>" . $row['kategori_produk'] . "</td>";
                        echo "<td>Rp." . $row['harga_jual'] . "</td>";
                        echo "<td>Rp." . $row['harga_beli'] . "</td>";
                        echo "<td>" . $row['stok'] . "</td>";
                        echo "<td>" . $row['tanggal_upload'] . "</td>";
                        echo "<td>";
                        echo "<a style='margin-bottom: 5px;' class='btn btn-warning' href='edit_produk.php?id=" . $row['id_produk'] . "'>Edit</a><br>";
                        echo "<a class='btn btn-danger' href='hapus_produk.php?id=" . $row['id_produk'] . "'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Tidak ada data produk.</td></tr>";
                }

                // Tutup koneksi database
                mysqli_close($koneksi);
                ?>
            </tbody>
        </table>
    </div>

    <br><br>
    <div class="footer">
        Copyrights &copy; Mstore 2023 All rights Reserved | Made by <a href="https://instagram.com/mhdrusdik">Rusdi</a>.
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const tableBody = document.querySelector("tbody");
        
        searchInput.addEventListener("input", function() {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = tableBody.querySelectorAll("tr");
            
            rows.forEach(row => {
                const cells = row.querySelectorAll("td");
                let match = false;
                
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        match = true;
                    }
                });
                
                row.style.display = match ? "table-row" : "none";
            });
        });
    });
    </script>
    <!-- Mengimpor Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
