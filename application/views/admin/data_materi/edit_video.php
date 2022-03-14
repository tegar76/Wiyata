<?= form_open_multipart('#', ['id' =>'editvideo']) ?>
	<input type="hidden" name="id_video_edit" value="<?= $video['id_video'] ?>">
	<div class="form-group row">
		<label for="judul_video_edit" class="col-sm-2 col-form-label">Judul</label>
		<div class="col-sm-8 col-md-10">
			<input type="text" id="judul_video_edit" name="judul_video_edit" class="form-control" value="<?= $video['judul_video'] ?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="bab" class="col-sm-2 col-form-label">Bab</label>
		<div class="col-sm-8 col-md-10">
			<input id="bab" class="form-control" type="text" value="<?= 'Bab ' . $video['bab_ke']?>" readonly>
		</div>
	</div>
	<div class="form-group row">
		<label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
		<div class="col-sm-8 col-md-10">
			<input id="mapel" class="form-control" type="text" placeholder="Bahasa Indonesia" readonly>
		</div>
	</div>
	<div class="form-group row">
		<label for="link_video_edit" class="col-sm-2 col-form-label">Link Video</label>
		<div class="col-sm-8 col-md-10">
			<textarea name="link_video_edit" id="link_video_edit" class="form-control"><?= $video['link_video'] ?></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="video_pem" class="col-sm-2 col-form-label">Video</label>
		<div class="col-sm-8 col-md-10">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="youtube-video" src="<?= $video['link_video'] ?>" allowfullscreen></iframe>
			</div>
		</div>
	</div>

	<div class="my-2" id="info-edit"></div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
		<button type="submit" class="btn btn-primary" id="editvideo-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
	</div>
</form>