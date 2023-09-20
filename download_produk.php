<?php
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(10, 10, 'ID', 1);
        $this->Cell(30, 10, 'Kode Produk', 1);
        $this->Cell(40, 10, 'Nama Produk', 1);
        $this->Cell(40, 10, 'Deskripsi', 1);
        $this->Cell(30, 10, 'Kategori Produk', 1);
        $this->Cell(20, 10, 'Harga Jual', 1);
        $this->Cell(20, 10, 'Harga Beli', 1);
        $this->Cell(20, 10, 'Stok', 1);
        $this->Cell(30, 10, 'Tanggal Upload', 1);
        $this->Ln();
    }

    function Footer()
    {
        // Tidak perlu footer pada laporan produk
    }
}

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "mstorenew");
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data produk
$sql = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $sql);

// Inisialisasi PDF
$pdf = new PDF('L');
$pdf->AddPage();

$pdf->SetFont('Arial', '', 12);

// Tampilkan data produk dalam PDF
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 10, $row['id_produk'], 1);
    $pdf->Cell(30, 10, $row['kode_produk'], 1);
    $pdf->Cell(40, 10, $row['nama_produk'], 1);
    $pdf->Cell(40, 10, $row['deskripsi'], 1);
    $pdf->Cell(30, 10, $row['kategori_produk'], 1);
    $pdf->Cell(20, 10, $row['harga_jual'], 1);
    $pdf->Cell(20, 10, $row['harga_beli'], 1);
    $pdf->Cell(20, 10, $row['stok'], 1);
    $pdf->Cell(30, 10, $row['tanggal_upload'], 1);
    $pdf->Ln();
}

// Output PDF ke browser
$pdf->Output('Laporan20%Produk.pdf', 'D');

mysqli_close($koneksi);
?>
