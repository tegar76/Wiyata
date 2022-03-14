<?= form_open_multipart('#', ['id' => 'editguru']) ?>
	<input type="hidden" name="id_guru_edit" class="form-control" value="<?= $dataguru['id_guru'] ?>">
	<div class="form-group row">
        <label for="nama_guru_edit" class="col-sm-4 col-form-label">Nama Guru</label>
            <div class="col-sm-8 col-md-8">
			<input id="nama_guru_edit" type="text" name="nama_guru_edit" class="form-control" value="<?= $dataguru['guru_nama'] ?>" >
		</div>
    </div>
	<div class="form-group row">
        <label for="nip_guru_edit" class="col-sm-4 col-form-label">NIP</label>
            <div class="col-sm-8 col-md-8">
			<input id="nip_guru_edit" type="text" name="nip_guru_edit" class="form-control" value="<?= $dataguru['guru_nip'] ?>">
		</div>
    </div>
	<div class="form-group row">
        <label for="guru_mapel_edit" class="col-sm-4 col-form-label">Mata Pelajaran</label>
        <div class="col-sm-8 col-md-8">
			<select class="form-control" id="guru_mapel_edit" name="guru_mapel_edit">
				<option selected value="">Mengajar  Mata Pelajaran</option>
					<?php foreach($datamapel as $mapel) : ?>
						<?php if($mapel['mapel'] == $dataguru['mapel']) : ?>
							<option value="<?= $mapel['id_mapel'] ?>" selected ><?= $mapel['mapel_nama'] ?></option>
						<?php else : ?>
							<option value="<?= $mapel['id_mapel'] ?>" ><?= $mapel['mapel_nama'] ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
			</select>
		</div>
    </div>
	<div class="form-group row">
        <label for="guru_kelas_edit" class="col-sm-4 col-form-label">Kelas yang diajar</label>
		<div class="col-sm-8 col-md-8">
			<select class="form-control" id="guru_kelas_edit" name="guru_kelas_edit[]" data-live-search="true" multiple>
				<?php foreach($datakelas as $kelas) : ?>
					<?php if($kelas->id_guru == $dataguru['id_guru']) : ?>
						<option value="<?= $kelas->id_kelas ?>" selected ><?= $kelas->kelas_nama ?></option>
					<?php else : ?>
						<option value="<?= $kelas->id_kelas ?>"><?= $kelas->kelas_nama ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
    </div>	
	<div class="form-group row">
		<label for="jenis_kelamin_guru_edit" class="col-sm-4 col-form-label">Jenis Kelamin</label>
		<div class="col-sm-8 col-md-8">
			<div class="form-check form-check-inline">
				<?= form_radio('jenis_kelamin_guru_edit', 'laki-laki', set_value('jenis_kelamin_guru_edit[]', ($dataguru['guru_jenis_kelamin'] == "laki-laki") ? true : false ), "id='jenis_kelamin_guru_edit1' class='form-check-input'"); ?>
				<label class="form-check-label" for="jenis_kelamin_guru_edit1">Laki - Laki</label>
			</div>
			<div class="form-check form-check-inline">
				<?= form_radio('jenis_kelamin_guru_edit', 'perempuan', set_value('jenis_kelamin_guru_edit[]', ($dataguru['guru_jenis_kelamin'] == "perempuan") ? true : false  ), "id='jenis_kelamin_guru_edit2' class='form-check-input'"); ?>
				<label class="form-check-label" for="jenis_kelamin_guru_edit2">Perempuan</label>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="tempat_lahir_edit" class="col-sm-4 col-form-label">Tempat Lahir</label>
		<div class="col-sm-8 col-md-8">
			<input id="tempat_lahir_edit" type="text" name="tempat_lahir_edit" class="form-control" value="<?= $dataguru['guru_tempat_lahir'] ?>" >
		</div>
	</div>
	<div class="form-group row">
		<label for="tanggal_lahir_edit" class="col-sm-4 col-form-label">Tanggal Lahir</label>
		<div class="col-sm-4 col-md-8">
			<input id="tanggal_lahir_edit" type="date" name="tanggal_lahir_edit" class="form-control" value="<?= $dataguru['guru_tanggal_lahir'] ?>" >
		</div>
	</div>
	<div class="form-group row">
        <label for="agama_guru_edit" class="col-sm-4 col-form-label">Agama</label>
        <div class="col-sm-8 col-md-8">
			<div class="form-check form-check-inline">
                <?= form_radio('agama_guru_edit', 'Islam', set_value('agama_guru_edit[]', ($dataguru['guru_agama'] == "Islam") ? true : false ), "id='agama_guru_edit1' class='form-check-input'"); ?>
                <label class="form-check-label" for="agama_guru_edit1">Islam</label>
            </div>
            <div class="form-check form-check-inline">
                <?= form_radio('agama_guru_edit', 'Kristen', set_value('agama_guru_edit[]', ($dataguru['guru_agama'] == "kristen") ? true : false ), "id='agama_guru_edit2' class='form-check-input'"); ?>
                <label class="form-check-label" for="agama_guru_edit2">Kristen</label>
            </div>
            <div class="form-check form-check-inline">
                <?= form_radio('agama_guru_edit', 'Katolik', set_value('agama_guru_edit[]', ($dataguru['guru_agama'] == "Katolik") ? true : false ), "id='agama_guru_edit3' class='form-check-input'"); ?>
                <label class="form-check-label" for="agama_guru_edit3">Katolik</label>
            </div>
            <div class="form-check form-check-inline">
                <?= form_radio('agama_guru_edit', 'Hindu', set_value('agama_guru_edit[]', ($dataguru['guru_agama'] == "Hindu") ? true : false ), "id='agama_guru_edit4' class='form-check-input'"); ?>
                <label class="form-check-label" for="agama_guru_edit4">Hindu</label>
            </div>
            <div class="form-check form-check-inline">
                <?= form_radio('agama_guru_edit', 'Budha', set_value('agama_guru_edit[]', ($dataguru['guru_agama'] == "Budha") ? true : false ), "id='agama_guru_edit5' class='form-check-input'"); ?>
                <label class="form-check-label" for="agama_guru_edit5">Budha</label>
            </div>
            <div class="form-check form-check-inline">
                <?= form_radio('agama_guru_edit', 'Konghucu', set_value('agama_guru_edit[]', ($dataguru['guru_agama'] == "Konghucu") ? true : false ), "id='agama_guru_edit6' class='form-check-input'"); ?>
                <label class="form-check-label" for="agama_guru_edit6">Konghucu</label>
            </div>
		</div>
    </div>
	<div class="form-group row">
        <label for="alamat_guru_edit" class="col-sm-4 col-form-label">Alamat</label>
        <div class="col-sm-8 col-md-8">
			<input id="alamat_guru_edit" type="text" name="alamat_guru_edit" class="form-control" value="<?= $dataguru['guru_alamat'] ?>">
		</div>
    </div>
	<div class="form-group row">
        <label for="telp_guru_edit" class="col-sm-4 col-form-label">No Telepon</label>
        <div class="col-sm-8 col-md-8">
			<input id="telp_guru_edit" type="text" name="telp_guru_edit" class="form-control" value="<?= $dataguru['guru_phone'] ?>" >
		</div>
    </div>
	<div class="form-group row">
        <label for="pass_guru_edit" class="col-sm-4 col-form-label">Password Baru</label>
        <div class="col-sm-8 col-md-8">
			<div class="input-group" id="show_hide_password">
				<input id="pass_guru_edit" type="password" name="pass_guru_edit" class="form-control">
				<div class="input-group-append">
					<button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
        <label for="pass_guru_conf" class="col-sm-4 col-form-label">Konfirmasi Password</label>
        <div class="col-sm-8 col-md-8">
			<div class="input-group" id="show_hide_password">
				<input id="pass_guru_conf" type="password" name="pass_guru_conf" class="form-control">
				<div class="input-group-append">
					<button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="foto_guru" class="col-sm-4 col-form-label">Foto Guru</label>
		<div class="col-sm-8 col-md-8">
			<div class="custom-file">
				<input type="file" class="form-control-file" id="foto_guru" name="foto_guru">
				<small>Choose file. Max 2 MB</small>
			</div>
		</div>
	</div>
	<div class="my-2" id="info-edit"></div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
	<button type="submit" class="btn btn-primary" id="editguru-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
</div>
</form>
