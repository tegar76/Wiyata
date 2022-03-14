<div class="none mt-3 mb-5 mr-4">
	<h6 class="text-right"> <a href="<?= base_url('Siswa/Materi') ?>" style="text-decoration: none;">Ruang Materi</a> / <a href="<?= base_url('ruang_diskusi/Diskusi/index/' .$this->secure->encrypt_url($diskusi->id_bab)) ?>" style="text-decoration: none;">Ruang Diskusi</a> / Bab 1 Diskusi Detail</h6>
</div>

<div class="container mt-5">
	<div class="row">
		<div class="col-xs-6 col-sm-12">

			<div class="card shadow mb-4 bg-white">
				<div class="row">

					<div class="col-md-12 mb-4">

						<table style="height: 3px;">
							<tbody>
								<tr>
									<td><button class="btn btn-sm btn-success p-0 pl-3 pr-3 pt-2 pb-2"><?= $diskusi->pembuat ?></button></td>
									<td class="p-3">
										<div class="h5 font-weight-bold mt-3"><?= $diskusi->judul ?></div>
										<h5><?= $diskusi->deskripsi ?></h5>
									</td>
								</tr>
							</tbody>
						</table>

					</div>

	
					<div class="col-xs-6 col-sm-12">
						<div class="card shadow mb-4 bg-white">
						<?= form_open_multipart('#' , ['id' => 'berdiskusi']) ?>
								<div class="form-group">
									<textarea name="diskusi" id="isi_diskusi" placeholder="Input Deskripsi" class="form-control" rows="3"></textarea>
								</div>
								<input type="hidden" name="id_info" id="id_forum" value="<?= $diskusi->id_info ?>">
								<input type="hidden" name="id_user" value="<?= $user_siswa->siswa_nis ?>">
								<input type="hidden" name="nama_user" value="<?= $user_siswa->siswa_nama ?>">
								<input type="hidden" name="parent_diskusi_id" id="diskusi_id" value="0" />
								<div class="form-group">
									<button type="submit" class="btn btn-info">Submit</button>
								</div>
							</form>
						</div>
					</div>

					<div class="col-xs-6 col-sm-12">
						<div class="d-flex">
							<div>
							<h4 class="font-weight-bold">Komentar : </h4>
							</div>
							<div class="ml-auto">
								<button class="btn btn-sm btn-info mt-2" id="refresh-diskusi"><i class="fas fa-sync-alt"></i></button>
							</div>
						</div>
						<!-- Display komentar -->
						<div id="display_forum" class="pt-3"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
