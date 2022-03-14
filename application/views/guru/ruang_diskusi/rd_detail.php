<div class="container-fluid">

    <div class="none mt-3 mb-5 mr-4">
        <h6 class="text-right"> <a class="text-primary" href="<?= base_url('Guru/RuangDiskusi/cekRuangDiskusi/'. $bab['bab_ke'] . '/' . $kelas['kelas_nama'])?>" style="text-decoration: none;">Cek Ruang Diskusi</a> / Ruang diskusi Detail</h6>
    </div>

    <div class="row">
		<div class="col-xs-6 col-sm-12">

			<div class="card shadow mb-4 bg-white px-3">
				<div class="row">

					<div class="col-md-12 px-3 mb-4">

						<table style="height: 3px;">
							<tbody>
								<tr>
									<td><button class="btn btn-sm btn-success p-0 pl-3 pr-3 pt-2 pb-2"><?= $diskusi->pembuat ?></button></td>
									<td class="p-3">
										<div class="h5 font-weight-bold mt-3"><?= $diskusi->judul ?></div>
										<h6><?= $diskusi->deskripsi ?></h6>
									</td>
								</tr>
							</tbody>
						</table>

					</div>

	
					<div class="col-xs-6 col-sm-12">
						
						<?= form_open_multipart('#' , ['id' => 'berdiskusi']) ?>
								<div class="form-group">
									<textarea name="diskusi" id="isi_diskusi" placeholder="Input Deskripsi" class="form-control" rows="3"></textarea>
								</div>


								<input type="hidden" name="id_info" id="id_forum" value="<?= $diskusi->id_info ?>">
								<input type="hidden" name="id_user" value="<?= $data_guru['sub_nip']?>">
								<input type="hidden" name="nama_user" value="<?= $data_guru['guru_nama'] ?>">
								<input type="hidden" name="parent_diskusi_id" id="diskusi_id" value="0" />
								<div class="form-group">
									<button type="submit" class="btn btn-info">Submit</button>
								</div>
							</form>
						
					</div>

					<div class="col-xs-6 col-sm-12">
						<div class="d-flex">
							<h6 class="font-weight-bold">Komentar : </h6>
							<div class="ml-auto">
								<button class="btn btn-sm btn-info mt-2" id="refresh-diskusi"><i class="fas fa-sync-alt"></i></button>
							</div>
						</div>
						<div id="display_forum" class="pt-3"></div>
					</div>

				</div>
			</div>


		</div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

