<div class="mt-3 mb-5 mr-4">
	<h6 class="text-right"> <a href="<?= base_url('Siswa/Profile') ?>" style="text-decoration:none">Profile </a>/ Update Password</h6>
</div>

<div class="container">
	<div class="main-body p-0">

		<div class="row gutters-sm">
			<div class="col-md-6 mb-3 mx-auto">
				<div class="card">
					<div class="card-body">
						<center>
							<h4>Data Untuk Login</h4>
						</center><br>
						<?= form_open_multipart('Siswa/Profile/update_password'); ?>
						<div class="form-group">
							<label for="nis_siswa">NIS</label>
							<input type="text" id="nis_siswa" name="nis_siswa" class="form-control" value="<?= $profile_siswa['siswa_nis'] ?>" readonly>
						</div>
						<div class="form-group">
							<label for="pass_lama" class="col-form-label">Password Lama</label>
							<div class="input-group" id="show_hide_password">
								<input class="form-control py-3 <?= (form_error('pass_lama')) ? 'is-invalid' : '' ?>" name="pass_lama" id="pass_lama" type="password" placeholder="Masukan Password Lama" value="<?= set_value('pass_lama') ?>">
								<div class="input-group-append">
									<button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
								</div>
								<div id="pass_lamaFeedback" class="invalid-feedback">
									<?= form_error('pass_lama', '<div class="text-danger">', '</div>') ?>
								</div>
							</div>
						</div>
						<div class="form-group" id="show_hide_password">
							<label for="new_pass" class="col-form-label">Password Baru</label>
							<input type="password" id="new_pass" name="new_pass" class="form-control <?= (form_error('new_pass')) ? 'is-invalid' : '' ?>">
							<div id="new_passFeedback" class="invalid-feedback">
								<?= form_error('new_pass', '<div class="text-danger">', '</div>') ?>
							</div>
						</div>
						<div class="form-group" id="show_hide_password">
							<label for="conf_pass" class="col-form-label">Konfirmasi Password</label>
							<input type="password" id="conf_pass" name="conf_pass" class="form-control">

						</div>
						<div class="text-center">
							<button type="reset" class="btn btn-secondary pl-4 pr-4">Reset</button> &ensp;
							<button type="submit" class="btn btn-info pl-4 pr-4">Update</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
