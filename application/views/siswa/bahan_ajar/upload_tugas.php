<div class="none mr-5">
	<?= form_open_multipart('#', ['id' => 'upload_tugas']) ?>
	<input type="hidden" name="id_siswa" value="<?= $data_siswa['id_siswa'] ?>">
	<input type="hidden" name="id_tugas" value="<?= $id_tugas ?>">
	<div class="form-group">
		<label for="file_tugas">Pilih File Tugas</label>
		<input type="file" name="file_tugas" class="form-control-file" id="file_tugas">
	</div>
	<p id="alertTugasInfo"></p>
	
	<div class="icon-info">
		<img src="<?= base_url() ?>assets/siswa/img/VectorInfo.png" alt="" width="22px" onclick="alertTugasInfo()" style="margin-left: 40px;">
	</div>
	<div id="info-upload"></div>
	
	<div class="modal-footer">
		<button type="reset" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
		<button type="submit" id="uploadtugas-btn" class="btn btn-info">Kumpulkan</button>
	</div>
	</form>
</div>

<script>
	function alertTugasInfo() {
		document.getElementById("alertTugasInfo").innerHTML =
			'<div class="alert alert-warning alert-dismissible fade show mr-5" role="alert">Catatan : <br> Upload File format jpg atau png,Jika upload lebih dari 1 file maka uploadnya dalam bentuk pdf <br><br><a target="_blank" href="<?= base_url('ruang_materi/BahanAjar/unduh_panduan') ?>"><strong>Berikut Panduannya</strong></a> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	}
</script>
