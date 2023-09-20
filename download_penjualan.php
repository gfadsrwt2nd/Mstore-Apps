<?php
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 10, 'Laporan Penjualan', 0, 0, 'C');
        $this->Ln(20);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(20, 10, 'ID Penjualan', 1);
        $this->Cell(40, 10, 'Nama Pelanggan', 1);
        $this->Cell(40, 10, 'Produk', 1);
        $this->Cell(20, 10, 'Kuantitas Terjual', 1);
        $this->Cell(30, 10, 'Total Harga', 1);
        $this->Cell(30, 10, 'Metode Pembayaran', 1);
        $this->Cell(20, 10, 'Status Pembayaran', 1);
        $this->Cell(30, 10, 'Tanggal Penjualan', 1);
        $this->Ln();
    }

    function Footer()
    {
        // Tidak perlu footer pada laporan penjualan
    }
}

$pdf = new PDF('L'); // 'P' adalah orientasi potret, ganti menjadi 'L' untuk lanskap (vertikal)
$pdf->AddPage();
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "mstorenew");
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk menampilkan laporan penjualan
$sql = "SELECT * FROM penjualan"; // Ganti dengan nama tabel penjualan yang sesuai
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(20, 10, $row['id_penjualan'], 1);
        $pdf->Cell(40, 10, $row['nama_pelanggan'], 1);
        $pdf->Cell(40, 10, $row['produk'], 1);
        $pdf->Cell(20, 10, $row['kuantitas_terjual'], 1);
        $pdf->Cell(30, 10, $row['total_harga'], 1);
        $pdf->Cell(30, 10, $row['metode_pembayaran'], 1);
        $pdf->Cell(20, 10, $row['status_pembayaran'], 1);
        $pdf->Cell(30, 10, $row['tanggal_penjualan'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(190, 10, 'Tidak ada data penjualan.', 1, 0, 'C');
}

mysqli_close($koneksi);

$pdf->Output('Laporan20%Penjualan.pdf', 'D'); // 'D' untuk mengunduh file


mysqli_close($koneksi);
?>
