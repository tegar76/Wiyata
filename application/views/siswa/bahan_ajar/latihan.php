<!-- Style ruang tugas -->
<link rel="stylesheet" href="<?= base_url() ?>assets/siswa/bootstrap/css/latihan.css" />

<div class="none mt-3 mb-5 mr-4">
	<h6 class="text-right"> <a href="<?= base_url('Siswa/Materi') ?>" style="text-decoration: none;">Ruang Materi /</a> Bab I Latihan</h6>
</div>

<div class="tr-job-posted section-padding">
	<div class="container p-0">
		<div class="job-tab text-center">
			<ul class="nav nav-tabs justify-content-center mb-3" role="tablist">
				<li role="presentation" class="active">
					<a class="active show" href="#hot-jobs" aria-controls="hot-jobs" role="tab" data-toggle="tab" aria-selected="true">
						<h6 class="mb-1 font-weight-bold">Tugas Latihan</h6>
					</a>
				</li>
				<li role="presentation" id="tugas-siswa-table"><a href="#data-latihan-siswa" data-bab-id="<?= $id_bab ?>" aria-controls="data-latihan-siswa" role="tab" data-toggle="tab" class="" aria-selected="false">
						<h6 class="mb-1 font-weight-bold">Data Nilai Latihan</h6>
					</a></li>
			</ul>
			<div class="tab-content text-left">
				<!-- Tab latihan -->
				<div role="tabpanel" class="tab-pane fade active show" id="hot-jobs">
					<div class="container">
						<div class="row">
							<div class="col-xs-6 col-sm-12 p-2">
								<div class="row ml-1 mr-1 mt-3">
									<div class="col-lg-12 p-0">
										<div class="accordion" id="accordionExample">
											<div class="card p-2">
												<!-- Bab 1 Looping disini -->
												<?php foreach ($get_latihan as $row => $value) : ?>
													<div class="section">
														<div class="card-header mb-3" id="headingOne">
															<div class="clearfix mb-0">
																<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#LatihanTugasKe<?= $value->id_tugas ?>" aria-expanded="false" aria-controls="LatihanTugasKe<?= $value->id_tugas ?>">
																	<h4>Tugas <?= 'BAB ' . $value->bab_ke ?> - <?= $value->latihan_tugas_ke ?> - <?= date('d-m-Y', strtotime($value->created_at)) ?></h4>
																	<?php $ci = get_instance();
																	$deadline = $ci->db->get_where('tb_pemb_tugas', [
																		'id_kelas' => $data_siswa['id_kelas'],
																		'id_tugas' => $value->id_tugas
																	])->row_array();
																	?>
																	<small class="text-danger">
																		Deadline : <?php
																					if (empty($deadline['deadline_tugas'])) {
																						echo '-';
																					} else {
																						echo $dl = ($deadline['deadline_tugas'] == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($deadline['deadline_tugas']));
																					}
																					?>
																	</small>
																	<i class="material-icons">add</i>
																</a>
															</div>
														</div>
														<div id="LatihanTugasKe<?= $value->id_tugas ?>" class="collapse show mb-4" aria-labelledby="headingOne" data-parent="#accordionExample">
															<div class="card-body">
																<div class="row">
																	<div class="col-xs-6 col-sm-12 bg-gray-300">
																		<div class="p-1">
																			<h5 style="line-height: 25px;">
																			<?php
																				if (empty($deadline['pemberitahuan'])) {
																					echo $value->deskripsi_tugas;
																				} else {
																					echo $deadline['pemberitahuan'];
																			} ?></h5>
																		</div>
																		<div class="d-flex justify-content-center m-3">
																			<a href="<?= base_url('ruang_materi/BahanAjar/unduh_tugas/' . $value->id_bab . '/' . $this->secure->encrypt_url($value->id_tugas)) ?>" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Unduh Latihan</a>
																			&ensp;
																			<?php
																			$tugas = $ci->db->get_where('tb_tugas_siswa', [
																				'id_tugas' => $value->id_tugas,
																				'id_siswa' => $data_siswa['id_siswa']
																			])->row_array();
																			?>
																			<?php if($deadline)  :?>
																			<?php if (empty($tugas)) :  ?>
																				<button id="submit-tugas-btn" class="btn btn-sm btn-primary upload-tugas" data-tugas-id="<?= $value->id_tugas ?>" deadline-tugas-id="<?= $deadline['id_pemb_tugas'] ?>"  title="Upload Latihan Tugas">
																					<i class="fa fa-upload"></i>
																					Kumpulkan Latihan
																				</button>
																			<?php else :  ?>
																				<p class="font-weight-normal">sudah mengumpukan</p>
																			<?php endif; ?>
																			<?php else : ?>
																				<button id="cek-tugas-btn" class="btn btn-sm btn-primary cek-tugas" title="Upload Latihan Tugas">
																					<i class="fa fa-upload"></i>
																					Kumpulkan Latihan
																				</button>
																			<?php endif; ?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Tab Data Latihan -->
				<div role="tabpanel" class="tab-pane fade in p-3" id="data-latihan-siswa">
					<div class="row">
						<div class="col-xs-6 col-sm-12">
							<div class="card shadow mb-4">
							    <div class="col-md-12 text-right">
									<button class="btn btn-sm btn-primary mt-n2" id="refresh-table-tugas" data-bab-id="<?= $id_bab ?>">refresh</button>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="data-tugas-siswa" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Bab</th>
													<th>Tugas Latihan</th>
													<th>Deskripsi</th>
													<th>Deadline</th>
													<th>Tanggal Pengumpulan</th>
													<th>Tanggal Diedit</th>
													<th>Tugas</th>
													<th>Komentar Guru</th>
													<th>Nilai</th>
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
				</div><!-- /.tab-pane -->

			</div>
		</div><!-- /.job-tab -->
	</div><!-- /.container -->
</div>

<div class="modal fade" id="imagetugas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" data-dismiss="modal">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<img src="<?= base_url() ?>assets/siswa/img/img.png" class="imagepreview" style="width: 100%;">
			</div>
		</div>
	</div>
</div>


<!-- Modal kumpulkan tugas -->
<div class="modal fade" id="kumpulkanTugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Pengumpulan Tugas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="uploadtugasmodal"></div>
			</div>
		</div>
	</div>
</div>

<!-- Modal edit tugas -->
<div class="modal fade" id="editTugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Edit Tugas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="updatetugassiswa"></div>
			</div>
		</div>
	</div>
</div>
