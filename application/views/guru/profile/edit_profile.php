<div class="mt-3 mb-5 mr-4">
	<h6 class="text-right"> <a class="text-primary" href="<?= base_url('Guru/Profile') ?>" style="text-decoration:none">Profile </a>/ Edit Profile</h6>
</div>

<div class="container">
	<div class="main-body p-0">

		<div class="row gutters-sm">
			<div class="col-md-4 mb-2">
				<div class="card">
					<div class="card-body">
						<?= form_open_multipart('Guru/Profile/editProfile') ?>
						<div class="d-flex flex-column align-items-center text-center">
							<img src="<?= ($data_guru['guru_image'] == 'default.png' ? base_url('assets/siswa/img/UserDefault.png') : base_url('storage/guru/profile/' . $data_guru['guru_image'])) ?>" alt="<?= $data_guru['guru_nama'] ?>" class="rounded-circle" width="150">
							<div class="mt-3">
							  <h5>Foto Profile</h5>
							  <input type="file" class="form-control-file form-control-sm" id="image" name="image">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-body">
						<center>
							<h5>Data Diri</h5>
						</center> <br>
						<div class="form-group">
							<label for="nama_guru_edit" class="col-form-label">Nama Guru</label>
							<input id="nama_guru_edit" type="text" name="nama_guru_edit" class="form-control" value="<?= $data_guru['guru_nama'] ?>" readonly>
						</div>
						<div class="form-group">
							<label for="nip_guru_edit" class="col-form-label">NIP/NUPTK</label>
							<input id="nip_guru_edit" type="text" name="nip_guru_edit" class="form-control" value="<?= $data_guru['guru_nip'] ?>" readonly>
						</div>
						<div class="form-group">
							<label for="guru_mapel_edit" class="col-form-label">Mengajar Mapel</label>
							<input id="guru_mapel_edit" type="text" name="guru_mapel_edit" class="form-control" value="Bahasa Indonesia" readonly>
						</div>
						<div class="form-group">
							<label for="guru_kelas_edit" class="col-form-label">Kelas Yang Diajar</label>
							<input id="guru_kelas_edit" type="text" name="guru_kelas_edit" class="form-control" value="<?php foreach ($data_kelas as $row => $value) echo $value['kelas_nama'] . ', ' ?>" readonly>
						</div>
						<div class="form-group">
							<label for="jenis_kelamin_guru_edit" class="col-form-label">Jenis Kelamin</label>
							<div class="col-sm-8 col-md-8">
								<div class="form-check form-check-inline">
									<?= form_radio('jenis_kelamin_guru_edit', 'laki-laki', set_value('jenis_kelamin_guru_edit[]', ($data_guru['guru_jenis_kelamin'] == "laki-laki") ? true : false), "id='jenis_kelamin_guru_edit1' class='form-check-input'"); ?>
									<label class="form-check-label" for="jenis_kelamin_guru_edit1">Laki - Laki</label>
								</div>
								<div class="form-check form-check-inline">
									<?= form_radio('jenis_kelamin_guru_edit', 'perempuan', set_value('jenis_kelamin_guru_edit[]', ($data_guru['guru_jenis_kelamin'] == "perempuan") ? true : false), "id='jenis_kelamin_guru_edit2' class='form-check-input'"); ?>
									<label class="form-check-label" for="jenis_kelamin_guru_edit2">Perempuan</label>
								</div>
							</div>
						</div>
						<?= form_error('jenis_kelamin_guru_edit', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>

						<div class="form-group">
							<label for="tempat_lahir_edit" class="col-form-label">Tempat Lahir</label>
							<input type="text" id="tempat_lahir_edit" name="tempat_lahir_edit" class="form-control" value="<?= $data_guru['guru_tempat_lahir'] ?>">
						</div>
						<?= form_error('tempat_lahir_edit', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>

						<div class="form-group">
							<label for="tanggal_lahir_edit" class="col-form-label">Tanggal Lahir</label>
							<input id="tanggal_lahir_edit" type="date" name="tanggal_lahir_edit" class="form-control" value="<?= $data_guru['guru_tanggal_lahir'] ?>">
						</div>
						<?= form_error('tanggal_lahir_edit', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>

						<div class="form-group">
							<label for="agama_guru_edit" class="col-form-label">Agama</label>
							<div class="col-sm-8 col-md-8">
								<div class="form-check form-check-inline">
									<?= form_radio('agama_guru_edit', 'Islam', set_value('agama_guru_edit[]', ($data_guru['guru_agama'] == "Islam") ? true : false), "id='agama_guru_edit1' class='form-check-input'"); ?>
									<label class="form-check-label" for="agama_guru_edit1">Islam</label>
								</div>
								<div class="form-check form-check-inline">
									<?= form_radio('agama_guru_edit', 'Kristen', set_value('agama_guru_edit[]', ($data_guru['guru_agama'] == "kristen") ? true : false), "id='agama_guru_edit2' class='form-check-input'"); ?>
									<label class="form-check-label" for="agama_guru_edit2">Kristen</label>
								</div>
								<div class="form-check form-check-inline">
									<?= form_radio('agama_guru_edit', 'Katolik', set_value('agama_guru_edit[]', ($data_guru['guru_agama'] == "Katolik") ? true : false), "id='agama_guru_edit3' class='form-check-input'"); ?>
									<label class="form-check-label" for="agama_guru_edit3">Katolik</label>
								</div>
								<div class="form-check form-check-inline">
									<?= form_radio('agama_guru_edit', 'Hindu', set_value('agama_guru_edit[]', ($data_guru['guru_agama'] == "Hindu") ? true : false), "id='agama_guru_edit4' class='form-check-input'"); ?>
									<label class="form-check-label" for="agama_guru_edit4">Hindu</label>
								</div>
								<div class="form-check form-check-inline">
									<?= form_radio('agama_guru_edit', 'Budha', set_value('agama_guru_edit[]', ($data_guru['guru_agama'] == "Budha") ? true : false), "id='agama_guru_edit5' class='form-check-input'"); ?>
									<label class="form-check-label" for="agama_guru_edit5">Budha</label>
								</div>
								<div class="form-check form-check-inline">
									<?= form_radio('agama_guru_edit', 'Konghucu', set_value('agama_guru_edit[]', ($data_guru['guru_agama'] == "Konghucu") ? true : false), "id='agama_guru_edit6' class='form-check-input'"); ?>
									<label class="form-check-label" for="agama_guru_edit6">Konghucu</label>
								</div>
							</div>
						</div>
						<?= form_error('agama_guru_edit', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>

						<div class="form-group">
							<label for="alamat_guru_edit" class="col-form-label">Alamat</label>
							<textarea id="alamat_guru_edit" name="alamat_guru_edit" class="form-control"><?= $data_guru['guru_alamat'] ?></textarea>
						</div>
						<?= form_error('alamat_guru_edit', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>

						<div class="form-group">
							<label for="telp_guru_edit" class="col-form-label">No Telepon</label>
							<input id="telp_guru_edit" type="text" name="telp_guru_edit" class="form-control" value="<?= $data_guru['guru_phone'] ?>">
						</div>
						<?= form_error('telp_guru_edit', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>
						
						<div class="text-center">
							<button type="reset" class="btn btn-secondary pl-4 pr-4">Reset</button> &ensp;
							<button type="submit" class="btn btn-info pl-4 pr-4">Update Profile</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<br><br>

	</div>
</div>
