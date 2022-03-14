<?= form_open_multipart('#', ['id' => 'editsiswa']) ?>
	<label>
		<h5>Data Siswa</h5>
	</label>
	<input type="hidden" name="id_siswa_edit" class="form-control" value="<?= $datasiswa->id_siswa ?>">
	<div class="form-group row">
		<label for="nama_siswa_edit" class="col-sm-4 col-form-label">Nama Siswa</label>
		<div class="col-sm-8 col-md-8">
			<input id="nama_siswa_edit" type="text" name="nama_siswa_edit" value="<?= $datasiswa->siswa_nama ?>" class="form-control">
		</div>
	</div>
	<div class="form-group row">
		<label for="nis_siswa_edit" class="col-sm-4 col-form-label">NIS</label>
		<div class="col-sm-8 col-md-8">
			<input id="nis_siswa_edit" type="text" name="nis_siswa_edit" value="<?= $datasiswa->siswa_nis ?>" class="form-control">
		</div>
	</div>
	<div class="form-group row">
		<label for="nisn_siswa_edit" class="col-sm-4 col-form-label">NISN</label>
		<div class="col-sm-8 col-md-8">
			<input id="nisn_siswa_edit" type="text" name="nisn_siswa_edit" value="<?= $datasiswa->siswa_nisn ?>" class="form-control">
		</div>
	</div>
	<div class="form-group row">
		<label for="tempat_lahir_edit" class="col-sm-4 col-form-label">Tempat Lahir</label>
		<div class="col-sm-8 col-md-8">
			<input id="tempat_lahir_edit" type="text" name="tempat_lahir_edit" value="<?= $datasiswa->siswa_tempat_lahir ?>" class="form-control">
		</div>
	</div>
	<div class="form-group row">
		<label for="tanggal_lahir_edit" class="col-sm-4 col-form-label">Tanggal Lahir</label>
		<div class="col-sm-4 col-md-8">
			<input id="tanggal_lahir_edit" type="date" name="tanggal_lahir_edit" value="<?= $datasiswa->siswa_tanggal_lahir ?>" class="form-control">
		</div>
	</div>
	<div class="form-group row">
		<label for="jenis_kelamin_siswa_edit" class="col-sm-4 col-form-label">Jenis Kelamin</label>
		<div class="col-sm-8 col-md-8">
			<div class="form-check form-check-inline">
				<?= form_radio('jenis_kelamin_siswa_edit', 'laki-laki', set_value('jenis_kelamin_siswa_edit[]', ($datasiswa->siswa_jenis_kelamin == "laki-laki") ? true : false ), "id='jenis_kelamin_siswa1' class='form-check-input'"); ?>
				<label class="form-check-label" for="jenis_kelamin_siswa1">laki-laki</label>
			</div>
			<div class="form-check form-check-inline">
				<?= form_radio('jenis_kelamin_siswa_edit', 'perempuan', set_value('jenis_kelamin_siswa_edit[]', ($datasiswa->siswa_jenis_kelamin == "perempuan") ? true : false ), "id='jenis_kelamin_siswa2' class='form-check-input'"); ?>
				<label class="form-check-label" for="jenis_kelamin_siswa2">perempuan</label>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="agama_siswa_edit" class="col-sm-4 col-form-label">Agama</label>
		<div class="col-sm-8 col-md-8">
			<div class="form-check form-check-inline">
				<?= form_radio('agama_siswa_edit', 'Islam', set_value('agama_siswa_edit[]', ($datasiswa->siswa_agama == "Islam") ? true : false ), "id='agama_siswa_edit1' class='form-check-input'"); ?>
				<label class="form-check-label" for="agama_siswa_edit1">Islam</label>
			</div>
			<div class="form-check form-check-inline">
				<?= form_radio('agama_siswa_edit', 'Kristen', set_value('agama_siswa_edit[]',($datasiswa->siswa_agama == "Kristen") ? true : false ), "id='agama_siswa_edit2' class='form-check-input'"); ?>
				<label class="form-check-label" for="agama_siswa_edit2">Kristen</label>
			</div>
			<div class="form-check form-check-inline">
				<?= form_radio('agama_siswa_edit', 'Katolik', set_value('agama_siswa_edit[]', ($datasiswa->siswa_agama == "Katolik") ? true : false ), "id='agama_siswa_edit3' class='form-check-input'"); ?>
				<label class="form-check-label" for="agama_siswa_edit3">Katolik</label>
			</div>
			<div class="form-check form-check-inline">
				<?= form_radio('agama_siswa_edit', 'Hindu', set_value('agama_siswa_edit[]', ($datasiswa->siswa_agama == "Hindu") ? true : false ), "id='agama_siswa_edit4' class='form-check-input'"); ?>
				<label class="form-check-label" for="agama_siswa_edit4">Hindu</label>
			</div>
			<div class="form-check form-check-inline">
				<?= form_radio('agama_siswa_edit', 'Budha', set_value('agama_siswa_edit[]', ($datasiswa->siswa_agama == "Budha") ? true : false ), "id='agama_siswa_edit5' class='form-check-input'"); ?>
				<label class="form-check-label" for="agama_siswa_edit5">Budha</label>
			</div>
			<div class="form-check form-check-inline">
				<?= form_radio('agama_siswa_edit', 'Konghucu', set_value('agama_siswa_edit[]', ($datasiswa->siswa_agama == "Konghucu") ? true : false ), "id='agama_siswa_edit6' class='form-check-input'"); ?>
				<label class="form-check-label" for="agama_siswa_edit6">Konghucu</label>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="alamat_siswa_edit" class="col-sm-4 col-form-label">Alamat</label>
		<div class="col-sm-8 col-md-8">
			<textarea id="alamat_siswa_edit" type="text" name="alamat_siswa_edit" value="<?= $datasiswa->siswa_alamat ?>" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="no_telp_siswa_edit" class="col-sm-4 col-form-label">No Telepon</label>
		<div class="col-sm-8 col-md-8">
			<input id="no_telp_siswa_edit" type="text" name="no_telp_siswa_edit" value="<?= $datasiswa->siswa_phone ?>" class="form-control">
		</div>
	</div>
	<div class="form-group row">
		<label for="kelas_siswa_edit" class="col-sm-4 col-form-label">Pilih Kelas</label>
		<div class="col-sm-8 col-md-8">
			<select id="kelas_siswa_edit" name="kelas_siswa_edit" class="form-control">
				<option selected value="">Pilih Kelas Siswa</option>
				<?php foreach ($datakelas as $row => $value) : ?>
					<?php if( $value->id_kelas == $datasiswa->id_kelas) : ?>
						<option value="<?= $value->id_kelas ?>" selected><?= $value->kelas_nama ?></option>
					<?php else : ?>
							<option value="<?= $value->id_kelas ?>"><?= $value->kelas_nama ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="foto_siswa" class="col-sm-4 col-form-label">Foto Siswa</label>
		<div class="col-sm-8 col-md-8">
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="foto_siswa" name="foto_siswa">
				<label class="custom-file-label" for="foto_siswa">Choose file. Max 2 MB</label>
			</div>
		</div>
	</div>
	<label>
		<h5>Data Orang Tua</h5>
	</label>
	<div class="form-group row">
		<label for="nama_ortu_siswa_edit" class="col-sm-4 col-form-label">Nama Orang Tua/Wali</label>
		<div class="col-sm-8 col-md-8">
			<input id="nama_ortu_siswa_edit" type="text" name="nama_ortu_siswa_edit" value="<?= $datasiswa->siswa_ortu ?>" class="form-control">
		</div>
	</div>
	<div class="form-group row">
		<label for="telp_ortu_edit" class="col-sm-4 col-form-label">No Telepon</label>
		<div class="col-sm-8 col-md-8">
			<input id="telp_ortu_edit" type="number" name="telp_ortu_edit" value="<?= $datasiswa->siswa_ortu_phone ?>" class="form-control">
		</div>
	</div>
	<div class="form-group row">
		<label for="alamat_ortu_edit" class="col-sm-4 col-form-label">Alamat</label>
		<div class="col-sm-8 col-md-8">
			<textarea id="alamat_ortu_edit" type="text" name="alamat_ortu_edit" value="<?= $datasiswa->siswa_ortu_alamat ?>" class="form-control"></textarea>
		</div>
	</div>
	<label>
		<h5>Password Siswa</h5>
	</label>
	<div class="form-group row">
		<label for="pass_siswa" class="col-sm-4 col-form-label">Password</label>
		<div class="col-sm-8 col-md-8">
			<div class="input-group" id="show_hide_password">
				<input id="pass_siswa" type="password" name="pass_siswa" class="form-control">
				<div class="input-group-append">
					<button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="pass_siswa_conf" class="col-sm-4 col-form-label">Konfirmasi Password</label>
		<div class="col-sm-8 col-md-8">
			<div class="input-group" id="show_hide_password">
				<input id="pass_siswa_conf" type="password" name="pass_siswa_conf" class="form-control">
				<div class="input-group-append">
					<button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
				</div>
			</div>
		</div>
	</div>
	<div class="my-2" id="info-edit"></div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
		<button type="submit" class="btn btn-primary" id="addsiswa-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
	</div>
</form>
