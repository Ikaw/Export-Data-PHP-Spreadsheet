<!DOCTYPE html>
<html>
<head>
	<title>Export Data</title>
</head>
<body>
	<table>
	<?php
		$id_wilayah = $_GET['id_wilayah'] ?? "";
		$koneksi = mysqli_connect("172.18.0.13","root","123456","kesra");

		$data_kecamatan = mysqli_query($koneksi,"select * from kecamatan where id_wilayah = ".$id_wilayah);
		$datas_kecamatan = mysqli_fetch_all($data_kecamatan);

		foreach ($datas_kecamatan as $key => $a) {
	?>
		<tr>
			<td>
				<a target="_blank" href="export_excel.php?id_wilayah=<?php echo $id_wilayah; ?>&id_kecamatan=<?php echo $a['0'];?>&nama_kecamatan=<?php echo $a['2'];?>">EXPORT KE EXCEL <?php echo $a['2'];?></a>
			</td>
		</tr>
	<?php
		}
	?>
	</table>
</body>
</html>