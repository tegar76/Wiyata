<!-- Style ruang tugas -->
<link rel="stylesheet" href="<?= base_url() ?>assets/siswa/bootstrap/css/latihan.css" />

<div class="none mt-3 mb-5 mr-4">
	<h6 class="text-right"> <a href="<?= base_url('Siswa/Materi') ?>" style="text-decoration: none;">Ruang Materi</a> /  Bab <?= $data_bab['bab_ke'] ?> Evaluasi</h6>
</div>

<div class="tr-job-posted section-padding">
	<div class="container p-0">
		<div class="job-tab text-center">
			<div class="row">
				<div class="col-xs-6 col-sm-12">
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">EVALUASI BAB <?= $data_bab['bab_ke'] ?></h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="info-uk-siswa" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Kelas</th>
											<th>Bab</th>
											<th>Mapel</th>
											<th>Tanggal Mulai</th>
											<th>Waktu Mulai</th>
											<th>Waktu Selesai</th>
											<th>Jenis</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>
												<?php if($info_uk) : 
													echo $info_uk['kelas_nama'];
												else :
													echo $siswa['kelas_nama'];
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo 'BAB '. $info_uk['bab_ke'];
												else :
													echo 'BAB '. $data_bab['bab_ke'];
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo $info_uk['mapel'];
												else :
													echo 'Bahasa Indonesia';
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo (empty($info_uk['tanggal_mulai'])) ? '-' : date('d-m-Y', strtotime($info_uk['tanggal_mulai']));
												else :
													echo '-';
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo (empty($info_uk['waktu_mulai'])) ? '-' : date('H:i', strtotime($info_uk['waktu_mulai'])) . ' WIB';
												else :
													echo '-';
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo (empty($info_uk['waktu_selesai'])) ? '-' : date('H:i', strtotime($info_uk['waktu_selesai'])) . ' WIB';
												else :
													echo '-';
												endif;
												?>
											</td>
											<td>Pilgan</td>
											<td style="width: 10%"> <?php if($info_uk) : ?>
											<?php $ci = get_instance();
												$query = $this->db->get_where('tb_uk_siswa', [
													'id_siswa' => $siswa['id_siswa'],
													'id_bab' => $info_uk['id_bab']
												]);
												$cek = $query->num_rows(); ?>
											<?php if($cek) : ?>
												<button class="btn btn-sm btn-outline-primary btn-block cek-nilai" data-bab-id="<?= $this->secure->encrypt_url($info_uk['id_bab']) ?>">Sudah Mengerjakan</button>
											<?php else: ?>
												<button class="btn btn-sm btn-primary btn-block mulai-ujian-essay px-0" data-bab-id="<?= $this->secure->encrypt_url($info_uk['id_bab']) ?>">Mulai</button>
											<?php endif; ?>
											<?php else : ?>
												<button class="btn btn-sm btn-secondary btn-block" disabled="disabled">Belum Tersedia</button>
											<?php endif; ?>
											<a href="<?= base_url('uji_kompetensi/Ujian/nilai_ujian_pilgan')?>" class="btn btn-sm btn btn-info btn-block mt-3">Lihat Nilai</a href="<?= base_url('uji_kompetensi/Ujian/nilai_ujian_essay')?>">
											</td>
										</tr>
										<tr>
											<td>2</td>
											<td>
												<?php if($info_uk) : 
													echo $info_uk['kelas_nama'];
												else :
													echo $siswa['kelas_nama'];
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo 'BAB '. $info_uk['bab_ke'];
												else :
													echo 'BAB '. $data_bab['bab_ke'];
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo $info_uk['mapel'];
												else :
													echo 'Bahasa Indonesia';
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo (empty($info_uk['tanggal_mulai'])) ? '-' : date('d-m-Y', strtotime($info_uk['tanggal_mulai']));
												else :
													echo '-';
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo (empty($info_uk['waktu_mulai'])) ? '-' : date('H:i', strtotime($info_uk['waktu_mulai'])) . ' WIB';
												else :
													echo '-';
												endif;
												?>
											</td>
											<td>
												<?php if($info_uk) :
													echo (empty($info_uk['waktu_selesai'])) ? '-' : date('H:i', strtotime($info_uk['waktu_selesai'])) . ' WIB';
												else :
													echo '-';
												endif;
												?>
											</td>
											<td>Essay</td>
											<td style="width: 10%"> <?php if($info_uk) : ?>
											<?php $ci = get_instance();
												$query = $this->db->get_where('tb_uk_siswa', [
													'id_siswa' => $siswa['id_siswa'],
													'id_bab' => $info_uk['id_bab']
												]);
												$cek = $query->num_rows(); ?>
											<?php if($cek) : ?>
												<button class="btn btn-sm btn-outline-primary btn-block cek-nilai" data-bab-id="<?= $this->secure->encrypt_url($info_uk['id_bab']) ?>">Sudah Mengerjakan</button>
											<?php else: ?>
												<button class="btn btn-sm btn-primary btn-block mulai-ujian px-0" data-bab-id="<?= $this->secure->encrypt_url($info_uk['id_bab']) ?>">Mulai</button>
											<?php endif; ?>
											<?php else : ?>
												<button class="btn btn-sm btn-secondary btn-block" disabled="disabled">Belum Tersedia</button>
											<?php endif; ?>
											<a href="<?= base_url('uji_kompetensi/Ujian/nilai_ujian_essay')?>" class="btn btn-sm btn btn-info btn-block mt-3">Lihat Nilai</a href="<?= base_url('uji_kompetensi/Ujian/nilai_ujian_pilgan')?>">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

