<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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
        <h1>Data Penjualan</h1>
        <hr>
        <a href="tambah_penjualan.php" class="btn btn-primary" style="margin-bottom: 7px;">ADD</a>
        <input type="text" id="searchInput" placeholder="Cari (Pelanggan, Produk, Status, Tanggal)" style="width: 30%; margin-left: 30%;">
        <table class="table">
            <thead>
                <tr>
                    <th>ID Penjualan</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Total Harga</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Tanggal Penjualan</th>
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

                // Query database untuk mendapatkan data penjualan
                $sql = "SELECT * FROM penjualan";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id_penjualan']; ?></td>
                            <td><?php echo $row['nama_pelanggan']; ?></td>
                            <td><?php echo $row['produk']; ?></td>
                            <td><?php echo $row['kuantitas_terjual']; ?></td>
                            <td>Rp.<?php echo $row['harga_produk']; ?></td>
                            <td><?php echo $row['metode_pembayaran']; ?></td>
                            <td><?php echo $row['status_pembayaran']; ?></td>
                            <td><?php echo $row['tanggal_penjualan']; ?></td>
                            <td>
                                <a style="margin-bottom: 5px;" class="btn btn-warning" href="edit_penjualan.php?id=<?php echo $row['id_penjualan']; ?>">Edit</a>
                                <a class="btn btn-danger" href="hapus_penjualan.php?id=<?php echo $row['id_penjualan']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data penjualan.</td></tr>";
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
</body>
</html>
