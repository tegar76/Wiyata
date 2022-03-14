<div class="none mt-3 mb-5 mr-4">
	<h6 class="text-right"> <a href="<?= base_url('Siswa/Materi') ?>" style="text-decoration: none;">Ruang Materi </a> / Bab <?= $bab['bab_ke'] ?> Video Pembelajaran</h6>
</div>

<div class="container mt-5">
	<div class="row">
		<div class="col-xs-6 col-sm-12">
			<!-- Daftar Guru -->
			<div class="card shadow mb-4 bg-white">
				<div class="row">
					<?php if ($video) : ?>
						<?php foreach ($video as $row => $value) : ?>
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card h-100 py-2">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
													<div class="embed-responsive embed-responsive-16by9">
														<iframe class="youtube-video" src="<?= $value['link_video'] ?>" allowfullscreen></iframe>
													</div>
												</div>
												<div class="mt-3">
													<h4 class="font-weight-bold">BAB <?= $value['bab_ke'] . ' ' . $value['bab_judul'] ?></h4>
												</div>
												<div class="mt-3">
													<h4><?= $value['judul_video'] ?></h4>
												</div>
												<div>
													<h5><?= (empty($value['dibuat_pada'])) ? '-' : date('d-m-Y', strtotime($value['dibuat_pada'])) ?></h5>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="col-xl-3 col-md-6 mb-4">
							<h5 class="font-weight-bold text-center">Tidak Ada Video Pembelajaran</h5>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
