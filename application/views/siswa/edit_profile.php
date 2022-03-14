<div class="mt-3 mb-5 mr-4">
	<h6 class="text-right"> <a href="<?= base_url('Siswa/Profile') ?>" style="text-decoration:none">Profile </a>/ Edit Profile</h6>
</div>

<div class="container">
	<div class="main-body p-0">

		<div class="row gutters-sm">
			<div class="col-md-4 mb-3">
				<div class="card">
					<div class="card-body">
						<?= form_open_multipart('Siswa/Profile/update_profile'); ?>
                        <div class="d-flex flex-column align-items-center text-center">
							<img src="<?= ($profile_siswa['siswa_image'] == 'default.png' ? base_url('assets/siswa/img/UserDefault.png') : base_url('./storage/siswa/profile/' . $profile_siswa['siswa_image'])) ?>" alt="<?= $profile_siswa['siswa_nama'] ?>" class="rounded-circle" width="150">
							<div class="mt-3">
								<h5>Foto Profile</h5>
							 	<input type="file" class="form-control-file form-control-sm" id="profile_siswa" name="profile_siswa">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-body">
						<center>
							<h4>Data Diri</h4>
						</center><br>
							<div class="form-group">
								<label for="nama_siswa" >Nama Lengkap</label>
								<input type="text" id="nama_siswa" name="nama_siswa"class="form-control" value="<?= $profile_siswa['siswa_nama'] ?>" readonly>
							</div>
							<div class="form-group">
								<label for="kelas_siswa">Kelas</label>
								<input type="text" id="kelas_siswa" name="kelas_siswa" class="form-control" readonly value="<?= $profile_siswa['kelas_nama'] ?>">
							</div>
							<div class="form-group">
								<label for="jenis_kelamin_siswa">Jenis Kelamin</label>
								<input type="text" id="jenis_kelamin_siswa" name="jenis_kelamin_siswa"class="form-control" name="kelamin" value="<?= $profile_siswa['siswa_jenis_kelamin'] ?>" readonly>
							</div>
							<div class="form-group">
								<label for="tempat_lahir_siswa">Tempat Lahir</label>
								<input type="text" id="tempat_lahir_siswa" name="tempat_lahir_siswa" class="form-control" value="<?= $profile_siswa['siswa_tempat_lahir'] ?>">
								<?= form_error('tempat_lahir_siswa', '<small class="text-danger pl-3">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="tanggal_lahir_siswa">Tanggal Lahir</label>
								<input type="date" id="tanggal_lahir_siswa" name="tanggal_lahir_siswa" class="form-control" value="<?= $profile_siswa['siswa_tanggal_lahir'] ?>">
								<?= form_error('tanggal_lahir_siswa', '<small class="text-danger pl-3">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="agama_siswa">Agama</label>
								<div class="col-sm-12 col-md-12">
									<div class="form-check form-check-inline">
										<?= form_radio('agama_siswa', 'Islam', set_value('agama_siswa[]', ($profile_siswa['siswa_agama'] == "Islam") ? true : false), "id='agama_siswa1' class='form-check-input'"); ?>
										<label class="form-check-label" for="agama_siswa1">Islam</label>
									</div>
									<div class="form-check form-check-inline">
										<?= form_radio('agama_siswa', 'Kristen', set_value('agama_siswa[]', ($profile_siswa['siswa_agama'] == "Kristen") ? true : false), "id='agama_siswa2' class='form-check-input'"); ?>
										<label class="form-check-label" for="agama_siswa2">Kristen</label>
									</div>
									<div class="form-check form-check-inline">
										<?= form_radio('agama_siswa', 'Katolik', set_value('agama_siswa[]', ($profile_siswa['siswa_agama'] == "Katolik") ? true : false), "id='agama_siswa3' class='form-check-input'"); ?>
										<label class="form-check-label" for="agama_siswa3">Katolik</label>
									</div>
									<div class="form-check form-check-inline">
										<?= form_radio('agama_siswa', 'Hindu', set_value('agama_siswa[]', ($profile_siswa['siswa_agama'] == "Hindu") ? true : false), "id='agama_siswa4' class='form-check-input'"); ?>
										<label class="form-check-label" for="agama_siswa4">Hindu</label>
									</div>
									<div class="form-check form-check-inline">
										<?= form_radio('agama_siswa', 'Budha', set_value('agama_siswa[]', ($profile_siswa['siswa_agama'] == "Budha") ? true : false), "id='agama_siswa5' class='form-check-input'"); ?>
										<label class="form-check-label" for="agama_siswa5">Budha</label>
									</div>
									<div class="form-check form-check-inline">
										<?= form_radio('agama_siswa', 'Konghucu', set_value('agama_siswa[]', ($profile_siswa['siswa_agama'] == "Konghucu") ? true : false), "id='agama_siswa6' class='form-check-input'"); ?>
										<label class="form-check-label" for="agama_siswa6">Konghucu</label>
									</div>
								</div>
								<?= form_error('agama_siswa', '<small class="text-danger pl-3">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="telepon_siswa">No Telepon</label>
								<input type="text" id="telepon_siswa" name="telepon_siswa" class="form-control" value="<?= $profile_siswa['siswa_phone'] ?>">
								<?= form_error('telepon_siswa', '<small class="text-danger pl-3">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="alamat_siswa">Alamat</label>
								<textarea name="alamat_siswa" id="alamat_siswa" class="form-control"><?= $profile_siswa['siswa_alamat'] ?></textarea>
								<?= form_error('alamat_siswa', '<small class="text-danger pl-3">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="nama_ortu_siswa">Nama Orang Tua</label>
								<input type="text" id="nama_ortu_siswa" name="nama_ortu_siswa" class="form-control" value="<?= $profile_siswa['siswa_ortu'] ?>">
								<?= form_error('nama_ortu_siswa', '<small class="text-danger pl-3">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="no_telp_ortu">Nomor Telepon Orang Tua</label>
								<input type="text" id="no_telp_ortu" name="no_telp_ortu" class="form-control" value="<?= $profile_siswa['siswa_ortu_phone'] ?>">
								<?= form_error('no_telp_ortu', '<small class="text-danger pl-3">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="alamat_ortu">Alamat Orang Tua</label>
								<textarea name="alamat_ortu" id="alamat_ortu" class="form-control"><?= $profile_siswa['siswa_ortu_alamat'] ?></textarea>
								<?= form_error('alamat_ortu', '<small class="text-danger pl-3">', '</small>') ?>
							</div>
							<div class="text-center">
								<button type="reset" class="btn btn-sm btn-secondary pl-4 pr-4">Reset</button> &ensp;
								<button type="submit" class="btn btn-sm btn-info pl-4 pr-4">Update Profile</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<br><br>

	</div>
</div>
