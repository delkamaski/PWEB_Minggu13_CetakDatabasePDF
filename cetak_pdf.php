<?php
require('fpdf.php');

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'DAFTAR SISWA TERDAFTAR', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'SEKOLAH SEPULUH NOPEMEBER', 0, 1, 'C');

$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 7, 'No', 1, 0, 'C');
$pdf->Cell(40, 7, 'Nama', 1, 0, 'C');
$pdf->Cell(70, 7, 'Alamat', 1, 0, 'C');
$pdf->Cell(30, 7, 'Jenis Kelamin', 1, 0, 'C');
$pdf->Cell(30, 7, 'Agama', 1, 1, 'C');

include 'koneksi.php';
$siswa = mysqli_query($conn, "SELECT * FROM siswa");
$no = 1;

$pdf->SetFont('Arial', '', 10);
while ($row = mysqli_fetch_array($siswa)) {
    $pdf->Cell(20, 7, $no++, 1, 0, 'C');
    $pdf->Cell(40, 7, $row['nama'], 1, 0, 'L');
    $pdf->Cell(70, 7, $row['alamat'], 1, 0, 'L');
    $pdf->Cell(30, 7, $row['jenis_kelamin'], 1, 0, 'L');
    $pdf->Cell(30, 7, $row['agama'], 1, 1, 'L');
}

$pdf->Output('I', 'Daftar_Siswa.pdf');
?>
