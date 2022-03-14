<?= form_open_multipart('#', ['id' => 'submit-nilai']) ?>
	<input type="hidden" name="id_tugas_siswa" value="<?= $tugas_siswa['id_tugas_siswa'] ?>">
	<div class="form-group row">
		<label for="nama" class="col-sm-4 col-form-label">Nama</label>
		<div class="col-sm-8 col-md-8">
			<input id="nama" class="form-control" type="text" value="<?= $tugas_siswa['siswa_nama'] ?>" placeholder="ABHIMANYU WIJIL PRATISTHA " readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="nis" class="col-sm-4 col-form-label">Nis</label>
		<div class="col-sm-8 col-md-8">
			<input id="nis" class="form-control" type="text" value="<?= $tugas_siswa['siswa_nis'] ?>" placeholder="9550" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="jenisKelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
		<div class="col-sm-8 col-md-8">
			<input id="jenisKelamin" class="form-control" type="text" value="<?= $tugas_siswa['siswa_jenis_kelamin'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
		<div class="col-sm-8 col-md-8">
			<input id="kelas" class="form-control" type="text" value="<?= $kelas_siswa['kelas_nama'] ?>" readonly>
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
			<input id="keterangan" class="form-control" type="text" value="<?= $ket = ($tugas_siswa['keterangan'] == 1 || $tugas_siswa['keterangan'] == 2) ? 'Tugas Sudah Dikumpulkan' : 'Tugas Belum Dikumpulkan' ?>"  readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="nilai" class="col-sm-4 col-form-label">Nilai</label>
		<div class="col-sm-8 col-md-8">
			<input id="nilai" class="form-control" type="text" name="nilai_tugas" value="<?= (empty($tugas_siswa['nilai_tugas'])) ? '' : $tugas_siswa['nilai_tugas'] ?>" placeholder="Input Nilai dengan Akumulasi 0-100">
		</div>
	</div>

	<div class="form-group row">
		<label for="komentar_guru" class="col-sm-4 col-form-label">Komentar</label>
		<div class="col-sm-8 col-md-8">
			<textarea  name="komentar_guru" id="komentar_guru" class="form-control" placeholder="Masukan Komentar"><?= (empty($tugas_siswa['komentar_guru'])) ? '' : $tugas_siswa['komentar_guru'] ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="komentar" class="col-sm-4 col-form-label">File Latihan</label>
		<?php if($tugas_siswa['tipe_file'] == '.pdf') : ?>
			<div class="col-sm-8 col-md-8">
				<a target="blank" href="<?= base_url('Guru/DataTugas/lihat_tugas_siswa/' . $this->secure->encrypt_url($tugas_siswa['id_tugas_siswa'])) ?>"><img src="<?= base_url('assets/guru/icons/pdficon.png') ?>"width="25px" class="ml-2"></a>
				<small><?= $tugas_siswa['file_tugas'] ?></small>
			</div>
		<?php else : ?>
			<div class="col-sm-8 col-md-8">
				<img src="<?= base_url('storage/tugas_siswa/'. $tugas_siswa['file_tugas']) ?>" class="img-fluid img-thumbnail" width="100px" alt="Gambar Tugas">
			</div>
		<?php endif; ?>
	</div>

	<div class="my-2" id="info-edit"></div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
		<button type="submit" class="btn btn-primary" id="nilaisiswa-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
	</div>
</form>
