<?= form_open_multipart('#', ['id' => 'editbahanajar']) ?>
<input type="hidden" name="id_bab_edit" value="<?= $bahan_ajar['id_bab'] ?>">
<label>
	<h5>Deskripsi BAB</h5>
</label>
<div class="form-group row">
	<label for="mapel_bab" class="col-sm-4 col-form-label">Mata Pelajaran</label>
	<div class="col-sm-8 col-md-8">
		<input id="mapel_bab" type="text" name="mapel_bab" class="form-control" value="Bahasa Indonesia" readonly>
	</div>
</div>
<div class="form-group row">
	<label for="judul_bab_edit" class="col-sm-4 col-form-label">Judul BAB</label>
	<div class="col-sm-8 col-md-8">
		<input id="judul_bab_edit" type="text" name="judul_bab_edit" class="form-control" value="<?= $bahan_ajar['bab_judul'] ?>">
	</div>
</div>
<div class="form-group row">
	<label for="bab_ke_edit" class="col-sm-4 col-form-label">BAB</label>
	<div class="col-sm-8 col-md-8">
		<input type="text" name="bab_ke_edit" id="bab_ke_edit" class="form-control" value="BAB <?= $bahan_ajar['bab_ke'] ?>" readonly>
	</div>
</div>
<label>
	<h5>Materi Bahan Ajar</h5>
</label>
<?php $ci = get_instance();
$query_unit = $this->db->get_where('tb_unit_bab', ['id_bab' => $bahan_ajar['id_bab']])->result_array();
foreach ($query_unit as $unit) :
?>
	<input type="hidden" name="id_unit_edit[]" value="<?= $unit['id_unit_bab'] ?>">
	<div class="form-group row">
		<label for="unit_bab_<?= $unit['id_unit_bab'] ?>" class="col-sm-4 col-form-label">Upload Materi <?= $unit['unit_ke'] ?></label>
		<div class="col-sm-8 col-md-8">
			<a target="blank" href="<?= base_url('Admin/DataMateri/unitBab/' . $this->secure->encrypt_url($unit['id_unit_bab'])) ?>"><img src="<?= base_url('assets/guru/icons/pdficon.png') ?>" width="30px" class="mb-2"></a>
			<small><?= $unit['unit_upload'] ?></small>
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="unit_bab_<?= $unit['id_unit_bab'] ?>" name="unit_bab[]">
				<label class="custom-file-label" for="unit_bab_<?= $unit['id_unit_bab'] ?>">Pilih File Max 2 MB</label>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<div class="form-group row">
	<label for="rangkuman_bab" class="col-sm-4 col-form-label">Upload Rangkuman</label>
	<div class="col-sm-8 col-md-8">
		<a target="blank" href="<?= base_url('Admin/DataMateri/rangkumanBab/' . $this->secure->encrypt_url($bahan_ajar['id_bab'])) ?>"><img src="<?= base_url('assets/guru/icons/pdficon.png') ?>" width="30px" class="mb-2"></a>
		<small><?= $bahan_ajar['rangkuman_bab'] ?></small>
		<div class="custom-file">
			<input type="file" class="custom-file-input" id="rangkuman_bab" name="rangkuman_bab">
			<label class="custom-file-label" for="rangkuman_bab">Pilih File Max 2 MB</label>
		</div>
	</div>
</div>
<label>
	<h5>Latihan Tugas</h5>
</label>
<?php $ci = get_instance();
$latihan_tugas = $ci->admin->getLatihanByBAB($bahan_ajar['id_bab'])->result_array();
foreach ($latihan_tugas as $tugas) : ?>
	<input type="hidden" name="id_tugas[]" value="<?= $tugas['id_tugas'] ?>">
	<div class="form-group row">
		<label for="latihan<?= $tugas['id_tugas'] ?>" class="col-sm-4 col-form-label">Upload <?= $tugas['latihan_tugas_ke'] ?></label>
		<div class="col-sm-8 col-md-8">
			<a target="blank" href="<?= base_url('Admin/DataMateri/latihan/' . $this->secure->encrypt_url($tugas['id_tugas'])) ?>"><img src="<?= base_url('assets/guru/icons/pdficon.png') ?>" width="30px" class="mb-2"></a>
			<small><?= $tugas['file_tugas'] ?></small>
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="latihan<?= $tugas['id_tugas'] ?>" name="latihan_bab[]">
				<label class="custom-file-label" for="latihan<?= $tugas['id_tugas'] ?>">Pilih File Max 2 MB</label>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="deskripsi_latihan_<?= $tugas['id_tugas'] ?>" class="col-sm-4 col-form-label">Deskripsi <?= $tugas['latihan_tugas_ke'] ?></label>
		<div class="col-sm-8 col-md-8">
			<textarea id="deskripsi_latihan_<?= $tugas['id_tugas'] ?>" type="text" name="deskripsi_latihan[]" class="form-control"><?= $tugas['deskripsi_tugas'] ?></textarea>
		</div>
	</div>
<?php endforeach; ?>
<div class="my-2" id="info-edit"></div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
	<button type="submit" class="btn btn-primary" id="editbahanajar-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
</div>
</form>

<script>
	$(".custom-file-input").on("change", function() {
		let fileName = $(this).val().split("\\").pop();
		$(this).next(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
