<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Video Pembelajaran</h1>
	</div>
	<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addVideomodal" id="addVideo">+ Video Pembelajaran</a>

	<div class="row">
		<div class="col-xs-6 col-sm-12">
			<!-- Data Siswa -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">

					<h6 class="m-0 text-primary">
						Video Pembelajaran Kelas VIII Bahasa Indonesia
					</h6>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table id="table_video" class="table table-striped table-bordered" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Bab</th>
									<th>Judul</th>
									<th>Video Pembelajaran</th>
									<th>Tanggal Input</th>
									<th>Tanggal update</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Tambah Video-->
<div class="modal fade" id="addVideomodal" tabindex="-1" role="dialog" aria-labelledby="addVideomodal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="addVideomodallabel"><img src="<?= base_url() ?>assets/guru/icons/video.png" width="24px"> Tambah Video Pembelajaran</h5>
			</div>
			<div class="modal-body">
				<?= form_open_multipart('#', ['id' => 'submit-video']) ?>
					<div class="form-group row">
						<label for="judul_video" class="col-sm-2 col-form-label">Judul Video</label>
						<div class="col-sm-8 col-md-10">
							<input id="judul_video" name="judul_video" class="form-control" type="text" placeholder="Masukan Judul Video Pembelajaran">
						</div>
					</div>
					<div class="form-group row">
						<label for="video_bab" class="col-sm-2 col-form-label">Bab</label>
						<div class="col-sm-8 col-md-10">
                        	<select class="form-control" id="video_bab" name="video_bab">
								<option selected>Pilih Bab</option>
								<?php foreach($getBab as $row => $value) : ?>
									<option value="<?= $value->id_bab ?>" ><?= 'BAB ' . $value->bab_ke ?></option1>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="video_mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
						<div class="col-sm-8 col-md-10">
							<input id="video_mapel" name="video_mapel" class="form-control" type="text" placeholder="Bahasa Indonesia" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="link_video" class="col-sm-2 col-form-label">Link</label>
						<div class="col-sm-8 col-md-10">
							<textarea name="link_video" id="link_video" class="form-control" placeholder="Input Link Video Pembelajaran Source Of Youtube"></textarea>
						</div>
					</div>
					<div class="my-2" id="info-data"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
						<button type="submit" class="btn btn-primary" id="submitvideo-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit Video-->
<div class="modal fade" id="editVideomodal" tabindex="-1" role="dialog" aria-labelledby="editVideomodal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="editVideomodallabel"><img src="<?= base_url() ?>assets/guru/icons/video.png" width="24px"> Edit Video Pembelajaran</h5>
			</div>
			<div class="modal-body">
				<div id="updateVideoPembelajaran"></div>
			</div>
		</div>
	</div>
</div>
