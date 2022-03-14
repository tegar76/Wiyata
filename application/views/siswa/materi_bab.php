<div class="container">
	<div class="main-body p-0">
		<?php if(empty($materi)) : ?>
			<h5>KOSONG LUR</h5>
		<?php else : ?>
		<div class="row gutters-sm">
		<?php foreach ($materi as $row) : ?>
            <!-- Loop Disini-->
            <div class="col-md-4 py-2">

                <div class="card text-white" style="border-radius: 10px 10px 0px 0px; background: url('<?= base_url()?>assets/siswa/img/bgTitle.png') ;height: 85px;">
                    <h4 class="text-center font-weight-bold"><?= 'BAB ' . $row['bab_ke'] ?></h4>
                    <h5 class="text-center font-weight-bold"><?= $row['bab_judul'] ?></h5>
                </div>

                <div class="card mb-3 p-0">
                    <div class="card-body">

                        <div class="row">

                            <div class="row pl-2 pr-2">

                                <div class="col-xl-6 col-md-6 mb-2">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mr-2">
                                                    <h5 class="font-weight-bold"><?= $datakelas['guru_nama'] ?></h5>
                                                    <h6>Guru</h6>
                                                </div>
                                                <div class="col-auto">
                                                    <i><img src="<?= base_url() ?>assets/siswa/img/gr.png" class="mt-2" width="40px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 mb-2">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <h5 class="font-weight-bold"><?= $datakelas['kelas_nama'] ?></h5>
                                                    <h6 class="mr-2">Kelas</h6>
                                                </div>
                                                <div class="col-auto">
                                                    <i><img src="<?= base_url() ?>assets/siswa/img/kls.png" class="mt-2" width="40px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 pr-2 pl-2 mt-3">
                                <div id="title2" class="text-center">
                                    <h4 class="text-black">Pemberitahuan
                                        <img src="<?= base_url() ?>assets/siswa/img/lampu.png" class="mb-1" width="20px">
                                    </h4>
                                    <hr>
                                </div>
                                <div class="card border-left-primary shadow py-2 overflow-auto" style="overflow: auto; height:60px; margin-top: -10px">
                                    <div class="card-body p-0">
                                        <?php
											$ci = get_instance();
											$ci->load->model('SiswaModel', 'siswa', true);
											$where_pemb = array(
												'id_bab' => $row['id_bab'],
												'id_kelas' => $this->session->userdata('kelas')
											);
											$pemberitahuan = $ci->siswa->getPemberitahuanBAB($where_pemb)->row_array();
										?>
										<?php if($pemberitahuan) : ?>
											<p class="text-justify"><?= $pemberitahuan['pemberitahuan']; ?></p>
										<small><a target="blank" href="<?= $pemberitahuan['link_pemberitahuan']?>"><?= $pemberitahuan['link_pemberitahuan'] ?></a></small>
										<?php else : ?>
											<p class="text-center ">Tidak Ada Pemberitahuan</p>
										<?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 pr-2 pl-2 mt-3">
                                <button class="btn text-white btn-primary btn-rm btn-bg-rm bouton-image w-100 border-0" type="button" data-toggle="collapse" data-target="#collapseExample<?= $row['id_bab'] ?>" aria-expanded="false" aria-controls="collapseExample<?= $row['id_bab'] ?>">
                                    Ruang Materi
                                </button>
                            </div>

                            <div class="col-md-12 pr-2 pl-2 mt-1">
                                <div class="collapse" id="collapseExample<?= $row['id_bab'] ?>">
                                    <div class="card p-0">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row"> <?php
													$ci = get_instance();
													$ci->load->model('SiswaModel', 'siswa', true);
													$result_unit = $ci->siswa->getUnitByBab($row['id_bab']);
                                                    ?>
													<?php foreach ($result_unit as $unit) : ?>
													<div class="col-4">
                                                        <div class="card p-0">
                                                            <div class="m-auto">
                                                                <a href="<?= base_url('ruang_materi/BahanAjar/unit_materi/' . $this->secure->encrypt_url($unit['id_unit_bab'])) ?>">
                                                                    <img class="mt-3 mb-1" src="<?= base_url() ?>assets/siswa/img/unit.png" width="25px">
                                                                    <p class=""><?= $unit['unit_ke'] ?></p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
													<?php endforeach; ?>
                                                    <div class="col-4">
                                                        <div class="card p-0">
                                                            <div class="m-auto">
                                                                <a href="<?= base_url('ruang_materi/BahanAjar/rangkuman_bab/' .$this->secure->encrypt_url($row['id_bab'])) ?>">
                                                                    <img class="mt-3 mb-1" src="<?= base_url() ?>assets/siswa/img/rangkuman.png" width="20px" style="margin-left:18px">
                                                                    <p class="">Rangkuman</p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-4">
                                                        <div class="card p-0">
                                                            <div class="m-auto">
                                                                <a href="<?= base_url('ruang_materi/BahanAjar/latihan_tugas/'.$this->secure->encrypt_url($row['id_bab'])) ?>">
                                                                    <img class="mt-3 mb-1" src="<?= base_url() ?>assets/siswa/img/tugas.png" width="20px" style="margin-left:10px">
                                                                    <p class="">Latihan</p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="card p-0">
                                                            <div class="m-auto">
                                                                <a href="<?= base_url('uji_kompetensi/ujian/index/' .$this->secure->encrypt_url($row['id_bab'])) ?>">
                                                                    <img class="mt-3 mb-1" src="<?= base_url() ?>assets/siswa/img/ujikompetensi.png" width="25px" style="margin-left:10px">
                                                                    <p class="">Evaluasi</p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 pr-2 pl-2 mt-1">
                                <a href="<?= base_url('ruang_materi/videoPembelajaran/index/' .$this->secure->encrypt_url($row['id_bab']))?>" class="text-white btn btn-primary btn-vp btn-bg-vp bouton-image w-100 border-0">
                                    Video Pembelajaran
                                </a>
                            </div>

                            <div class="col-md-12 pr-2 pl-2 mt-2">
                                <a href="<?= base_url('ruang_diskusi/Diskusi/index/' .$this->secure->encrypt_url($row['id_bab']))?>" class="text-white btn btn-primary btn-rd btn-bg-rd bouton-image w-100 border-0">
                                    Ruang Diskusi
                                </a>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
			<?php endforeach; ?>
        </div>
		<?php endif; ?>
    </div>
</div>
