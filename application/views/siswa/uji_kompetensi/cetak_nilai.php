<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title_pdf ?></title>
	<link rel="stylesheet" href="<?= base_url('assets/guru/css/mpdf-boostrap.css') ?>">

	<style rel="stylesheet" type="text/css">
		body {
			background-color: #FFF;
			font-family: 'Times New Roman', Times, serif;
		}

		.container {
			margin: 20px 50px 0px 50px;
			background-color: #FFF;
			border: 1px solid #86A4B7;
			border-radius: 10px;
		}

		.header {
			margin: 25px 38px 0px 38px;
			background-color: #86A4B7;
			border-radius: 10px;
			height: 120px;
		}

		.header h2 {
			text-align: center;
			color: #fff;
		}

		.header img {
			display: block;
			margin-right: auto;
			margin-left: auto;
			padding-top: 20px;
		}

		.content {
			margin: 30px 30px 30px 30px;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="header">
			<div class="text-center">
				<img src="<?= base_url() ?>assets/siswa/img/Wiyata.png" alt="Logo" width="100" higth="100">
				<h2>Nilai Uji Kompetensi</h2>
			</div>
		</div>
		<div class="content">
			<table cellpadding="8">
				<thead>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><?= $siswa['siswa_nama'] ?></td>
					</tr>
					<tr>
						<td>Nis</td>
						<td>:</td>
						<td><?= $siswa['siswa_nis'] ?></td>
					</tr>
					<tr>
						<td>Kelas</td>
						<td>:</td>
						<td><?= $siswa['kelas_nama'] ?></td>
					</tr>
					<tr>
						<td>Bab Kompetensi</td>
						<td>:</td>
						<td><?= 'BAB ' . $bab['bab_ke'] . ' (' . $bab['bab_judul'] . ')' ?></td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>:</td>
						<td><?= date('d-m-Y', strtotime($nilai['tanggal_uk'])) ?></td>
					</tr>
					<tr>
						<td>Jumlah Soal</td>
						<td>:</td>
						<td><?= $nilai['jumlah_soal'] ?></td>
					</tr>
					<tr>
						<td>Jumlah Benar</td>
						<td>:</td>
						<td><?= $nilai['jumlah_benar'] ?></td>
					</tr>
					<tr>
						<td>Jumlah Salah</td>
						<td>:</td>
						<td><?= $nilai['jumlah_salah'] ?></td>
					</tr>
					<tr>
						<td>Tidak Dijawab</td>
						<td>:</td>
						<td><?= $nilai['tidak_dijawab'] ?></td>
					</tr>
					<tr>
						<td>Nilai</td>
						<td>:</td>
						<td><?= $nilai['nilai_uk'] ?></td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</body>

</html>
