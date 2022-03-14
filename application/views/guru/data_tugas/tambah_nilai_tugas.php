<?= form_open_multipart('#', ['id' => 'beri-nilai-tugas']) ?>
	<input type="hidden" name="id_tugas" value="<?= $tugas ?>">
	<input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa'] ?>">
	<div class="form-group row">
		<label for="nama" class="col-sm-4 col-form-label">Nama</label>
		<div class="col-sm-8 col-md-8">
			<input id="nama" class="form-control" type="text" value="<?= $siswa['siswa_nama'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="nis" class="col-sm-4 col-form-label">Nis</label>
		<div class="col-sm-8 col-md-8">
			<input id="nis" class="form-control" type="text" value="<?= $siswa['siswa_nis'] ?>" placeholder="9550" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="jenisKelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
		<div class="col-sm-8 col-md-8">
			<input id="jenisKelamin" class="form-control" type="text" value="<?= $siswa['siswa_jenis_kelamin'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
		<div class="col-sm-8 col-md-8">
			<input id="kelas" class="form-control" type="text" placeholder="<?= $siswa['kelas_nama'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
		<div class="col-sm-8 col-md-8">
			<input id="mapel" class="form-control" type="text" placeholder="Bahasa Indonesia" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="bab" class="col-sm-4 col-form-label">Bab</label>
		<div class="col-sm-8 col-md-8">
			<input id="bab" class="form-control" type="text" value="<?= 'BAB ' . $latihan_tugas['bab_ke'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="latihan" class="col-sm-4 col-form-label">Latihan</label>
		<div class="col-sm-8 col-md-8">
			<input id="latihan" class="form-control" type="text" value="<?= $latihan_tugas['latihan_tugas_ke'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
		<div class="col-sm-8 col-md-8">
			<input id="keterangan" class="form-control" type="text" value="Belum Mengumpulkan Tugas" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="input_nilai_tugas" class="col-sm-4 col-form-label">Nilai</label>
		<div class="col-sm-8 col-md-8">
			<input id="input_nilai_tugas" class="form-control" type="text" name="input_nilai_tugas" placeholder="Input Nilai dengan Akumulasi 0-100">
		</div>
	</div>

	<div class="form-group row">
		<label for="input_komentar_guru" class="col-sm-4 col-form-label">Komentar</label>
		<div class="col-sm-8 col-md-8">
			<textarea  name="input_komentar_guru" id="input_komentar_guru" class="form-control" placeholder="Masukan Komentar"></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="komentar" class="col-sm-4 col-form-label">File Latihan</label>
		<div class="col-sm-8 col-md-8">
			<img src="<?= base_url() ?>assets/guru/icons/imgTugas.png" alt="Gambar Tugas">
		</div>
	</div>

	<div class="my-2" id="info-nilai"></div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
		<button type="submit" class="btn btn-primary" id="tambahnilai-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
	</div>
</form>
