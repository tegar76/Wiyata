<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="none mt-3 mb-5 mr-4">
		<h6 class="text-right"> <a class="text-primary" href="<?= base_url('Guru/DataTugas/latihanSiswa') ?>" style="text-decoration: none;">Cek Data Latihan Siswa</a> / Data Latihan Siswa Detail</h6>
	</div>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h5 class="mb-0 text-gray-800">Data Latihan Siswa Kelas <?=  $get_tugas['kelas_nama'] . ' Bab ' . $get_tugas['bab_ke'] . ' ' . $get_tugas['latihan_tugas_ke'] ?></h5>
	</div>
	<?php //var_dump($get_tugas) ?>
	<!-- Content Row -->
	<div class="row">

		<!-- Jumlah Siswa -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-primary  mb-1">
								Jumlah Siswa</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_siswa ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Jumlah Siswa Mengumpulkan-->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-success  mb-1">
								Siswa yang Sudah Mengumpulkan Latihan</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mengumpulkan ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Latihan Dinilai-->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-info  mb-1">Latihan Yang Sudah Dinilai
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $dinilai ?></div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Jumlah Siswa Yang Belum Mengumpulkan Tugas -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-warning mb-1">
								Siswa Yang Belum Mengumpulkan Latihan</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $belum_mengumpulkan ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-12">
			<input type="hidden" name="pemb_tugas" id="pemb_tugas" value="<?= $get_tugas['id_pemb_tugas'] ?>">
			<div class="card shadow mb-2 border-primary">
                <div class="col-md-12 text-right">
					<button class="btn btn-sm btn-primary mt-2" id="refresh-table-pemb" data-pemb-id="<?= $get_tugas['id_pemb_tugas'] ?>">refresh</button>
				</div>
				<div class="col-md-12 text-left">
					<h6 class="text-primary mt-n4"><img src="<?= base_url() ?>assets/guru/icons/pemberitahuan.png" width="15px" class="mr-2">Pemberitahuan</h6>
				</div>
				<div class="card-body" id="cr2">
			

					<div class="table-responsive" id="trs2">
						<table class="table table-bordered" id="pemberitahuan-tugas" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Kelas</th>
									<th>Mapel</th>
									<th>Bab</th>
									<th>Latihan</th>
									<th>Pemberitahuan</th>
									<th>Deadline</th>
									<th>Tanggal Dibuat</th>
									<th>Tanggal Diupdate</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="row mt-3">
		<div class="col-xs-6 col-sm-12">
			<!-- Kelas -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<div class="col-md-12 text-right">
						<a target="_blank" href="<?= base_url('Guru/Docs/export_latihan/pdf/' . $this->secure->encrypt_url($get_tugas['id_pemb_tugas'])) ?>"><img src="<?= base_url() ?>assets/guru/icons/printpdf.png" width="25px"></a> &ensp;
						<a href="<?= base_url('Guru/Docs/export_latihan/excel/' . $this->secure->encrypt_url($get_tugas['id_pemb_tugas'])) ?>"><img src="<?= base_url() ?>assets/guru/icons/exel.png" width="25px"></a>
					</div>
				</div>
				<div class="col-md-12 text-right">
					<button class="btn btn-sm btn-primary mt-2" id="refresh-tugas-siswa" data-pemb-id="<?= $get_tugas['id_pemb_tugas'] ?>">refresh</button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="tugas_siswa" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Siswa</th>
									<th>NIS</th>
									<th>Jenis Kelamin</th>
									<th>Tanggal Pengumpulan</th>
									<th>File Tugas</th>
									<th>Komentar</th>
									<th>Nilai</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>

	</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- View File Tugas -->
<div class="modal fade" id="detailTugas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" data-dismiss="modal">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<img src="<?= base_url() ?>assets/guru/icons/imgTugas.png" class="imagepreview" style="width: 100%;">
			</div>
		</div>
	</div>
</div>


<!-- Modal Edit Pemberitahuan-->
<div class="modal fade" id="editPemberitahuanTugasModal" tabindex="-1" role="dialog" aria-labelledby="editPemberitahuanTugasModal" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center " id="editPemberitahuanTugasModallabel">
					<img src="<?= base_url() ?>assets/guru/icons/edit.png" width="20px">
					Form Edit Pemberitahuan Dan Tambah Deadline
				</h5>
			</div>
			<div class="modal-body">
				<div id="edit_pembtugas"></div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah Nilai-->
<div class="modal fade" id="tambahNilaimodal" tabindex="-1" role="dialog" aria-labelledby="tambahNilaimodal" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center " id="tambahNilaimodallabel">
					<i class="fa fa-plus"></i>
					Tambah Nilai Dan Komentar
				</h5>
			</div>
			<div class="modal-body">
				<div id="nilai-tugas-siswa"> </div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Tambah Nilai-->
<div class="modal fade" id="inputnilaikosongModal" tabindex="-1" role="dialog" aria-labelledby="inputnilaikosongModal" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center " id="inputnilaikosongModallabel">
					<i class="fa fa-plus"></i>
					Tambah Nilai Dan Komentar
				</h5>
			</div>
			<div class="modal-body">
				<div id="nilaisiswakosong"> </div>
			</div>
		</div>
	</div>
</div>
