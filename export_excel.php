<?php

require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as xlsx; 
use PhpOffice\PhpSpreadsheet\IOFactory as io_factory; 

$id_wilayah = $_GET['id_wilayah'] ?? "";
$id_kecamatan = $_GET['id_kecamatan'] ?? "";
$nama_kecamatan = $_GET['nama_kecamatan'] ?? "";

$koneksi = mysqli_connect("172.18.0.13","root","123456","kesra");
$arrData[] = [
	'no_registrasi',
	'nama',
	'alamat',
	'rt',
	'rw',
	'telp',
	'email',
	'website',
	'npwp',
	'facebook',
	'instagram',
	'twitter',
	'youtube',
	'catatan',
	'status',
	'logo',
	'status_simas',
	'jumlah_pengurus',
	'longitude',
	'latitude',
	'visi',
	'misi',
	
];
$data = mysqli_query($koneksi,"select * from lembaga where id_wilayah = ".$id_wilayah." and id_kecamatan = ".$id_kecamatan." order by id asc limit 500");
$no = 1;
while($d = mysqli_fetch_array($data)){
	$arrData[] = [
		$d['no_registrasi'],
		$d['nama'],
		$d['alamat'],
		$d['rt'],
		$d['rw'],
		$d['telp'],
		$d['email'],
		$d['website'],
		$d['npwp'],
		$d['facebook'],
		$d['instagram'],
		$d['twitter'],
		$d['youtube'],
		$d['catatan'],
		$d['status'],
		$d['logo'],
		$d['status_simas'],
		$d['jumlah_pengurus'],
		$d['longitude'],
		$d['latitude'],
		$d['visi'],
		$d['misi']
	];
}
$spreadsheet = new Spreadsheet();
$spreadsheet->getActiveSheet()
->fromArray(
	$arrData,
	NULL,
	'A1'
);

$objWriter = io_factory::createWriter($spreadsheet, 'Xlsx');
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=".$id_kecamatan.".".$nama_kecamatan.".xlsx");
header("Content-Transfer-Encoding: binary ");

ob_end_clean();
ob_start();
$objWriter->save('php://output');