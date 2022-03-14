<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Daftar Siswa Kelas </h1>
	</div>

	<div class="row">
		<div class="form-group col-md-3">
			<div class="input-group mb-2">
				<select id="id_kelas" class="form-control" onchange="chclass(this.value)">
					<option value="null">Pilih Kelas</option>
					<?php foreach ($kelas as $row) : ?>
						<?php if ($row['id_kelas'] == $class) : ?>
							<option value="<?= $this->secure->encrypt_url($row['id_kelas']) ?>" selected><?= $row['kelas_nama'] ?></option>
						<?php else : ?>
							<option value="<?= $this->secure->encrypt_url($row['id_kelas']) ?>"><?= $row['kelas_nama'] ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-filter"></i></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-12">
			<!-- Daftar Siswa -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Tabel Siswa</h6>
				</div>

				<div class="card-body">
					<div class="table-responsive">
					<table class="table table-striped table-bordered" id="tabelsiswa" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th style="width:5%">No</th>
									<th>Nama</th>
									<th>NIS</th>
									<th>NISN</th>
									<th>Kelas</th>
									<th>Telepon</th>
									<th>Terakhir Aktif</th>
									<th style="width:10%">Status</th>
									<th>Action</th>
								</tr>						
							</thead>
							<tbody>
								<?php foreach ($dataSiswa as $row => $value): ?>
									<tr>
										<td><?= $row + 1 ?></td>
										<td><?= $value->siswa_nama ?></td>
										<td><?= $value->siswa_nis ?></td>
										<td><?= $value->siswa_nisn ?></td>
										<td><?= $value->kelas_nama ?></td>
										<td class="text-center"><?= (empty($value->siswa_phone)) ? " - " : $value->siswa_phone  ?></td>
										<td class="text-center"><?= ($value->last_login == '0000-00-00 00:00:00') ? " - " : date('d-m-Y H:i:s', strtotime($value->last_login)) ?></td>
										<td class="text-center">
											<?= ($value->siswa_online == 1) ? '<p class="text-primary font-weight-bold">Online</p>' : '<p class="text-danger font-weight-bold">Offline</p>' ?>
										</td>
										<td class="text-center">
											<button class="btn btn-sm btn-info view-siswa" data-siswa-id="<?= $value->id_siswa ?>" title="View Siswa">Detail</button>
										</td>
									</tr>
								<?php endforeach; ?>
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


<!-- Modal View Siswa -->
<div class="modal fade" id="viewsiswamodal" tabindex="-1" role="dialog" aria-labelledby="viewsiswamodal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="viewsiswamodallabel"><span class="fas fa-user-tie mr-1"></span>Detail Siswa</h5>
			</div>
			<div class="modal-body">
				<div id="viewdatasiswa"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Tutup</button>
			</div>
		</div>
	</div>
</div>

<script>
	function chclass(id) {
		window.location = "<?=base_url('Guru/Dashboard/data_siswa')?>/"+id;
	}
</script>
