<!-- Style ruang tugas -->
<link rel="stylesheet" href="<?= base_url() ?>assets/siswa/bootstrap/css/latihan.css" />

<div class="none mt-3 mb-5 mr-4">
	<h6 class="text-right"> <a href="<?= base_url('Siswa/Materi') ?>" style="text-decoration: none;">Ruang Materi</a> / <a href="">Evaluasi Bab.. </a> / Nilai Evaluasi (Essay)</h6>
</div>

<div class="tr-job-posted section-padding">
	<div class="container p-0">
		<div class="job-tab text-center">
			<div class="row">
				<div class="col-xs-6 col-sm-12">
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h5 class="m-0 font-weight-bold text-primary">Data Nilai Evaluasi (Essay) BAB ...</h5>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="info-uk-siswa" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Bab</th>
											<th>Tanggal Evaluasi</th>
											<th>Waktu Mulai</th>
											<th>Waktu Selesai</th>
											<th>Waktu Pengumpulan</th>
                                            <th>File</th>
											<th>Nilai</th>
                                            <th>Keterangan</th>
										</tr>
									</thead>
									<tbody>
                                        <tr>
											<td>1</td>
											<td>I</td>
											<td>01-01-2022</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
                                            <td><img src="<?= base_url('assets/siswa/img/UserDefault.png')?>" alt=""></td>
											<td>100</td>
                                            <td>Sudah Mengerjakan</td>
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

