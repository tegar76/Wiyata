<div class="none mr-5">
	<?= form_open_multipart('#', ['id' => 'update_tugas']) ?>
	<input type="hidden" name="id_tugas_siswa_edit" value="<?= $id_tugas_siswa ?>">

	<div class="form-group">
		<label for="update_file">Pilih File Tugas Baru</label>
		<input id="update_file" name="update_file" class="form-control-file" type="file">
	</div>

	<p id="alertTugasInfo2"></p>
	<div id="info-update"></div>
	<div class="icon-info">
		<img src="<?= base_url() ?>assets/siswa/img/VectorInfo.png" alt="" width="22px" onclick="alertTugasInfo2()" style="margin-left: 40px;">
	</div>
	<div class="modal-footer">
		<button type="reset" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
		<button type="submit" id="updatetugas-btn" class="btn btn-info">Update</button>
	</div>
	</form>
</div>
<script>
	function alertTugasInfo2() {
		document.getElementById("alertTugasInfo2").innerHTML =
			'<div class="alert alert-warning alert-dismissible fade show mr-5" role="alert">Catatan : <br> Upload File format jpg atau png,Jika upload lebih dari 1 file maka uploadnya dalam bentuk pdf <br><br><a target="_blank" href="<?= base_url('ruang_materi/BahanAjar/unduh_panduan') ?>"><strong>Berikut Panduannya</strong></a> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	}
</script>
