<div class="none mt-3 mb-5 mr-4">
	<h6 class="text-right"> <a href="<?= base_url('Siswa/Materi') ?>" style="text-decoration: none;">Ruang Materi /</a> Bab <?= $get_bab['bab_ke'] ?> Forum Diskusi</h6>
</div>

<div class="container mt-5">
	<div class="row">
		<div class="col-xs-6 col-sm-12">

			<div class="card shadow bg-white mb-4">
				<div class="col-md-12 text-right mt-2">
					<a href="" class="btn btn-sm btn-info mt-n3" data-toggle="modal" data-target="#tambahDiskusi">+ Diskusi Baru</a>
				</div>
				<div class="col-md-12 mb-4 mt-2 p-0">
					<?php if ($diskusi) : ?>
						<?php foreach ($diskusi as $row => $value) : ?>
							<?php $ci = get_instance();
							$query = $ci->db->get_where('tb_diskusi', ['id_info' => $value->id_info]);
							?>
							<div class="card shadow bg-white border-top border-left border-right border-bottom h-100 py-2 p-0 mb-4">
								<div class="card-body">
									<section>
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="row">
													<div class="h5 mb-4 ml-3 text-black"><?= $value->judul ?></div>
													<a href="<?= base_url('ruang_diskusi/diskusi/forum_diskusi/' . $this->secure->encrypt_url($value->id_info)) ?>" class="ml-3 mt-n2">
														<div class="card p-1 border border-primary rounded-pill">
															<div class="row no-gutters align-items-center">
																<div class="col">
																	<div class="text-xs ml-2 mr-2">
																		Komentar
																		<button class="btn-orange bg-info text-white border-0 rounded ml-1 mr-1 pr-1 pl-1"><?= ($query->num_rows() == null) ? '0' : $query->num_rows() ?></button>
																	</div>
																</div>
															</div>
														</div>
													</a>
												</div>
												<div class="info h6 mt-3"><?= $value->deskripsi ?></div>
											</div>
										</div>
									</section>
									<section class="mt-3">
										<div class="row no-gutters align-items-center">
											<div class="col-md-12 mr-2 ml-3">
												<div class="row" id="btnInfo">
													<div class="card p-1 bg-success rounded mr-2 mb-2">
														<div class="row no-gutters align-items-center">
															<div class="col">
																<div class="text-xs text-white ml-2 mr-2">
																	<i class="fa fa-user"></i>
																	<?= $value->pembuat ?>
																</div>
															</div>
														</div>
													</div>
													<div class="card p-1 bg-success rounded mr-2 mb-2">
														<div class="row no-gutters align-items-center">
															<div class="col">
																<div class="text-xs text-white ml-2 mr-2">
																	<i class="fa fa-calendar"></i>
																	<?= date('Y-m-d', strtotime($value->tanggal)) ?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="alert alert-info" role="alert">
							<h4 class="alert-heading">Belum Ada Forum Diskusi</h4>
							<hr>
							<p class="mb-0">Silahkan buat forum diskusi baru dengan klik tombol tambah diskusi</p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- Modal Tambah Diskusi -->
<div class="modal fade" id="tambahDiskusi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Tambah Diskusi Baru </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('ruang_diskusi/Diskusi/submit_forum') ?>
			<div class="modal-body">
				<input type="hidden" name="id_bab" value="<?= $get_bab['id_bab'] ?>">
				<input type="hidden" name="id_kelas" value="<?= $user_siswa->id_kelas ?>">
				<input type="hidden" name="nama_user" value="<?= $user_siswa->siswa_nama ?>">
				<div class="form-group">
					<label for="judul_diskusi">Judul</label>
					<input type="text" id="judul_diskusi" name="judul_diskusi" class="form-control" placeholder="Ex : BAB 1 Text Berita">
				</div>
	
				<div class="form-group">
					<label for="deskripsi_diskusi">Deskripsi</label>
					<textarea id="deskripsi_diskusi" name="deskripsi_diskusi" class="form-control" placeholder="Input Deskripsi"></textarea>
				</div>

			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-sm btn-info">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>
