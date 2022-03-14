<div class="none mt-3 mb-5 mr-4">
    <h6 class="text-right">
		<a href="<?= base_url('Siswa/Materi')?>" style="text-decoration: none;">Ruang Materi </a>/
		<a href="<?= base_url('uji_kompetensi/Ujian/index/' . $this->secure->encrypt_url($get_bab['id_bab']))?>" style="text-decoration: none;"> Bab <?= $get_bab['bab_ke'] ?> Evaluasi </a> /
		Soal Evaluasi
	</h6>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-xs-6 col-sm-12">
            
            <div class="card shadow mb-4 bg-white">
                <div class="justify-content-center">

                    <div class="title">
                        <h3>BAB <?= $get_bab['bab_ke'] ?> Soal Evaluasi</h3>
                        <h4>Materi <?= $get_bab['bab_judul'] ?> </h4>
                    </div>

                    <div class="container mt-sm-5 my-1">
						<?php $no = 1; foreach($soal_ujian as $row => $value) : ?>
                        <form action="<?= base_url('uji_kompetensi/Ujian/submit_ujian')?>" method="POST">
							<input type="hidden" name="id_ujian[]" value="<?= $value->id_ujian ?>">
                			<input type="hidden" name="jumlah_soal" value="<?= $jumlah_soal ?>">
							<input type="hidden" name="id_bab" value="<?= $value->id_bab ?>">
                            <div class="pt-2">
                                <div class="py-2 h5">
                                    <b id="question">
                                        <?= $no++ .'.'?>
										<?= $value->soal_ujian ?> <br>
										<?php if(!empty($value->gambar)) : ?>
										<img src="<?= base_url('storage/bahanajar/BAB_' . $get_bab['bab_ke'] . '/uk/'. $value->gambar)?>" alt=""  width="220px">
										<?php endif; ?>
                                    </b>
                                </div>

                                <div id="options" class="pl-3">
                                    <label class="options">
                                        a. <?= $value->a ?> 
                                        <input type="radio"  name="pilihan[<?= $value->id_ujian ?>]" value="A"> 
                                        <span class="checkmark"></span> 
                                    </label> 
                                    <label class="options">
                                        b. <?= $value->b ?> 
                                        <input type="radio"  name="pilihan[<?= $value->id_ujian ?>]" value="B"> 
                                        <span class="checkmark"></span> 
                                    </label> 
                                    <label class="options">
                                        c. <?= $value->c ?> 
                                        <input type="radio"  name="pilihan[<?= $value->id_ujian ?>]" value="C"> 
                                        <span class="checkmark"></span> 
                                    </label> 
                                    <label class="options">
                                        d. <?= $value->d ?> 
                                        <input type="radio"  name="pilihan[<?= $value->id_ujian ?>]" value="D"> 
                                        <span class="checkmark"></span> 
                                    </label> 
                                    
                                </div>
                            </div>
							<?php endforeach; ?>
							<button type="sumbit" class="btn btn-info">Selesai Evaluasi</button>
                        </form>
                        <!-- Next feature enable -->
                        <!-- <div class="d-flex align-items-center pt-3">
                            <div id="prev"> <button class="btn btn-primary">Previous</button> </div>
                            <div class="ml-auto mr-sm-5"> <button class="btn btn-success">Next</button> </div>
                        </div> -->
                    </div>
                    
	
                </div>											   
            </div>
            

        </div>
    </div>
</div>
            