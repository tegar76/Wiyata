<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="none mt-3 mb-5 mr-4">
		<h6 class="text-right"> <a class="text-primary" href="<?= base_url('Guru/DataTugas/UjiKompetensi') ?>" style="text-decoration: none;">Data Tugas / Cek Data Uji Kompetensi</a> / Data Uji Kompetensi Detail</h6>
	</div>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h5 class="mb-0 text-gray-800">Data Uji Kompetensi Siswa <?= 'Bab ' . $get_uk['bab_ke'] . ' Kelas ' . $get_uk['kelas_nama']  ?></h5>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Jumlah Siswa -->
		<div class="col-xl-4 col-md-6 mb-4">
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
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-success  mb-1">
								Siswa yang Sudah Mengerjakan UK</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $siswa_mengerjakan ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Latihan Dinilai-->
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-info  mb-1">Siswa Yang Tidak Mengerjakan UK
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $belum_mengerjakan ?></div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-xs-6 col-sm-12">
			<input type="hidden" name="pemb_uk" id="pemb_uk" value="<?= $get_uk['id_pemb_uk'] ?>">
			<div class="card shadow mb-2 border-primary">
				<div class="col-md-12 text-right">
					<button class="btn btn-sm btn-primary mt-2" id="refresh-pemb-uk" pemb-uk-id="<?= $get_uk['id_pemb_uk'] ?>">refresh</button>
				</div>
				<div class="col-md-12 text-left">
					<h6 class="text-primary mt-n4"><img src="<?= base_url() ?>assets/guru/icons/pemberitahuan.png" width="15px" class="mr-2">Pemberitahuan</h6>
				</div>
				<div class="card-body" id="cr2">
					<div class="table-responsive" id="trs2">
						<table class="table table-bordered" id="tabel-pemb-uk" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Kelas</th>
									<th>Mapel</th>
									<th>Bab</th>
									<th>Tanggal UK</th>
									<th>Mulai</th>
									<th>Selesai</th>
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
						<a target="_blank" href="<?= base_url('Guru/Docs/export_kompetensi/pdf/' . $this->secure->encrypt_url($get_uk['id_pemb_uk'])) ?>"><img src="<?= base_url() ?>assets/guru/icons/printpdf.png" width="25px"></a> &ensp;
						<a href="<?= base_url('Guru/Docs/export_kompetensi/excel/' . $this->secure->encrypt_url($get_uk['id_pemb_uk'])) ?>"><img src="<?= base_url() ?>assets/guru/icons/exel.png" width="25px"></a>
					</div>
				</div>
				<div class="col-md-12 text-right">
					<button class="btn btn-sm btn-primary mt-2" id="refresh-uk-siswa" pemb-uk-id="<?= $get_uk['id_pemb_uk'] ?>">refresh</button>
				</div>
				
				<div class="card-body">
					<div class="table-responsive">
						<table id="table-result-uk" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Siswa</th>
									<th>NIS</th>
									<th>Jenis Kelamin</th>
									<th>Jumlah Soal</th>
									<th>Jawab Benar</th>
									<th>Jawab Salah</th>
									<th>Tidak Dijawab</th>
									<th>Nilai</th>
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


<!-- Modal Edit Pemberitahuan dan Tambah Waktu UK-->
<div class="modal fade" id="editPemberitahuanmodal" tabindex="-1" role="dialog" aria-labelledby="editPemberitahuanmodal" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center " id="editPemberitahuanmodallabel">
					<img src="<?= base_url() ?>assets/guru/icons/edit.png" width="20px">
					Edit Pemberitahuan dan Tambah Waktu UK
				</h5>
			</div>
			<div class="modal-body">
				<div id="edit_pemberitahuan_uk"></div>
			</div>
		</div>
	</div>
</div>
