<!-- Time Picker -->
<link rel="stylesheet" href="<?= base_url() ?>assets/guru/vendor/datetimepicker/jquery.datetimepicker.min.css">

<?= form_open_multipart('#', ['id' => 'edit_uk']) ?>
<input type="hidden" name="id_pemb_uk" value="<?= $pemb_uk['id_pemb_uk'] ?>">
<div class="form-group row">
	<label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
	<div class="col-sm-8 col-md-8">
		<input id="kelas" class="form-control" type="text" value="<?= $pemb_uk['kelas_nama'] ?>" placeholder="VIII A" readonly>
	</div>
</div>

<div class="form-group row">
	<label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
	<div class="col-sm-8 col-md-8">
		<input id="mapel" class="form-control" type="text" value="<?= $pemb_uk['mapel'] ?>" placeholder="Bahasa Indonesia" readonly>
	</div>
</div>

<div class="form-group row">
	<label for="bab" class="col-sm-4 col-form-label">Bab</label>
	<div class="col-sm-8 col-md-8">
		<input id="bab" class="form-control" type="text" value="<?= 'Bab ' . $pemb_uk['bab_ke'] ?>" placeholder="I (Satu)" readonly>
	</div>
</div>

<div class="form-group row">
	<label for="tanggal_mulai" class="col-sm-4 col-form-label">Tanggal Mulai</label>
	<div class="col-sm-8 col-md-8">
		<input type="date" name="tanggal_mulai" id="tanggal_mulai" value="<?= $pemb_uk['tanggal_mulai'] ?>" class="form-control">
	</div>
</div>

<div class="form-group row">
	<label for="jam_mulai" class="col-sm-4 col-form-label">Jam Mulai</label>
	<div class="col-sm-8 col-md-8">
		<div class="input-group">
			<input id="jam_mulai" type="text" name="jam_mulai" value="<?= (empty($pemb_uk['waktu_mulai'])) ? '00:00' :  date('H:i', strtotime($pemb_uk['waktu_mulai']))?>" class="form-control timepicker">
			<div class="input-group-prepend">
				<button type="button" id="toggle01" class="input-group-text"><i class="far fa-clock"></i></button>
			</div>
		</div>
	</div>
</div>

<div class="form-group row">
	<label for="jam_selesai" class="col-sm-4 col-form-label">Jam Selesai</label>
	<div class="col-sm-8 col-md-8">
		<div class="input-group">
			<input id="jam_selesai" type="text" name="jam_selesai" value="<?= (empty($pemb_uk['waktu_mulai'])) ? '00:00' : date('H:i', strtotime($pemb_uk['waktu_selesai'])) ?>" class="form-control timepicker">
			<div class="input-group-prepend">
				<button type="button" id="toggle02" class="input-group-text"><i class="far fa-clock"></i></button>
			</div>
		</div>
	</div>
</div>

<div class="my-2" id="info-edit"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
	<button type="submit" class="btn btn-primary" id="editpemb_uk-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
</div>
</form>

<!-- Date Timepicker -->
<script src="<?= base_url()?>assets/guru/vendor/datetimepicker/jquery.datetimepicker.full.min.js"></script>
<script>
// ---------------------------------------- Time Picker --------------------------------------------
		jQuery.datetimepicker.setLocale('id')
		$('#jam_mulai, #jam_selesai').datetimepicker({
			timepicker: true,
			datepicker: false,
			format: 'H:i',
			// value: '00:00',
			hours12: false,
			step: 5,
			lang : 'id',
		});

		$('#toggle01').on('click', function() {
			$('#jam_mulai').datetimepicker('toggle')
		});

		$('#toggle02').on('click', function() {
			$('#jam_selesai').datetimepicker('toggle')
		});
		// ---------------------------------------- Time Picker -------------------------------------------------
</script>
