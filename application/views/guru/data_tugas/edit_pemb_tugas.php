<?= form_open_multipart('#', ['id' => 'edit_cektugas']) ?>
	<input type="hidden" name="id_pemb_tugas" value="<?= $pemb_tugas['id_pemb_tugas'] ?>">
	<div class="form-group row">
		<label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
		<div class="col-sm-8 col-md-8">
			<input id="kelas" class="form-control" type="text" placeholder="kelas" value="<?= $pemb_tugas['kelas_nama'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
		<div class="col-sm-8 col-md-8">
			<input id="mapel" class="form-control" type="text" placeholder="Bahasa Indonesia" value="<?= $pemb_tugas['mapel'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="bab" class="col-sm-4 col-form-label">Bab</label>
		<div class="col-sm-8 col-md-8">
			<input id="bab" class="form-control" type="text" placeholder="I (Satu)"  value="<?= 'BAB '. $pemb_tugas['bab_ke'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="latihan" class="col-sm-4 col-form-label">Latihan</label>
		<div class="col-sm-8 col-md-8">
			<input id="latihan" class="form-control" type="text" placeholder="I (Satu)" value="<?= $pemb_tugas['latihan_tugas_ke'] ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label for="pemberitahuan" class="col-sm-4 col-form-label">Pemberitahuan</label>
		<div class="col-sm-8 col-md-8">
			<textarea class="form-control" name="pemberitahuan_edit" id="pemberitahuan" placeholder="Masukan Pemberitahuan"><?= $pemb_tugas['pemberitahuan'] ?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="deadline" class="col-sm-4 col-form-label">Deadline</label>
		<div class="col-sm-8 col-md-8">
			<input type="date" name="deadline_tugas" id="deadline" class="form-control" value="<?= $pemb_tugas['deadline_tugas'] ?>">
		</div>
	</div>
	<div class="my-2" id="info-edit"></div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
		<button type="submit" class="btn btn-primary" id="editpembtugas-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
	</div>
</form>
