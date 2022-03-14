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
			/* margin: 50px 200px 100px 200px; */
			background-color: #FFF;
			border: 1px solid #C0C0C0;
			border-radius: 3px;
		}

		.header h2 {
			text-align: center;
			color: #010101;
			text-shadow: 3px 3px 4px #C0C0C0;
		}

		.header h3 {
			text-align: center;
			color: #010101;
			text-shadow: 3px 3px 4px #C0C0C0;
		}


		.tcontent {
			border-collapse: collapse;
		}

		.tcontent td {
			font-size: 15px;
			text-align: center;
		}

		.tcontent th {
			font-size: 15px;
			text-align: center;
		}

		.tcontent .tdcon,
		th {
			border: 1px solid #C0C0C0;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="header">
			<h2>Laporan Nilai Tugas Latihan PerBab</h2>
			<h3>SMP Negeri 01 Kalibagor Tahun <?= date('Y') ?></h3>
		</div>

		<hr>

		<div class="row">
			<div class="col-xs-5 col-sm-6">
				<table class="table table-borderless">
					<thead>
						<tr>
							<td>Kelas</td>
							<td>:</td>
							<td><?= $tugas['kelas_nama'] ?></td>
						</tr>
						<tr>
							<td>Bab</td>
							<td>:</td>
							<td>Bab <?= $tugas['bab_ke'] . ' (' . $tugas['bab_judul'] . ')' ?></td>
						</tr>
						<tr>
							<td>Latihan</td>
							<td>:</td>
							<td><?= $tugas['latihan_tugas_ke'] ?></td>
						</tr>
						<tr>
							<td>Mapel</td>
							<td>:</td>
							<td><?= $tugas['mapel'] ?></td>
						</tr>
					</thead>
				</table>
			</div>
			<div class="col-xs-6 col-sm-6">
				<table class="table table-borderless">
					<thead>
						<tr>
							<td>Guru Pengajar</td>
							<td>:</td>
							<td><?= $guru['guru_nama'] ?></td>
						</tr>
						<tr>
							<td>Nip</td>
							<td>:</td>
							<td><?= $guru['guru_nip'] ?></td>
						</tr>
						<tr>
							<td>Tanggal Cetak</td>
							<td>:</td>
							<td><?= date('Y-m-d H:i:s') ?></td>
						</tr>
					</thead>
				</table>
			</div>
		</div>

		<!-- <div class="pengantar">


		</div> -->

		<!--Tabel Untuk Menampilkan Data Nilai -->
		<div class="content">
			<table class="table tcontent" cellpadding="7" cellspacing="2">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Nis</th>
						<th>Jenis Kelamin</th>
						<th>Tanggal Upload</th>
						<th>Nilai</th>
					</tr>
				</thead>

				<tbody>
					<?php $no = 1;
					foreach ($siswa as $row => $value) : ?>
						<?php $nilai = $this->db->get_where('tb_tugas_siswa', [
							'id_tugas' => $tugas['id_tugas'],
							'id_siswa' => $value->id_siswa
						])->row_object(); ?>
						<tr>
							<td class="tdcon"><?= $no++ ?></td>
							<td class="tdcon" style="text-align: left;"><?= $value->siswa_nama ?></td>
							<td class="tdcon"><?= $value->siswa_nis ?></td>
							<td class="tdcon"><?= $value->siswa_jenis_kelamin ?></td>
							<?php if (!empty($nilai)) :  ?>
								<td class="tdcon"><?= ($nilai->tanggal_upload == '0000-00-00') ? '-' : date('d-m-Y', strtotime($nilai->tanggal_upload)) ?></td>
								<td class="tdcon"><?= $nilai->nilai_tugas ?></td>
							<?php else : ?>
							<td class="tdcon"></td>
							<td class="tdcon"></td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<h4>Keterangan :</h4>
			<p>Jumlah Siswa : <?= $num_siswa ?></p>
			<p>Siswa Yang Mengumpulkan Tugas : <?= $mengumpulkan ?></p>
			<p>Siswa Yang Tidak Mengumpulkan Tugas : <?= $belum ?></p>
		</div>
	</div>
</body>

</html>
