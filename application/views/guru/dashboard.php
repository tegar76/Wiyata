<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Guru</h1>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-12">
            
            <div class="card shadow mb-2 border-primary">
                                                
            <div class="card-body" id="cr2">
                    <h4>Pesan Singkat <img src="<?= base_url()?>assets/guru/icons/lamp.png" style="width: 20px; margin-top: -10px"></h4>

                    <p>
                        Selamat datang di E-learning Wiyata <strong><?= $data_guru['guru_nama'] ?></strong> selaku guru mata pelajaran Bahasa Indonesia di SMP N 01 Kalibagor, berikut adalah  data mengajar anda sesuai jadwal yang berlaku saat ini :  
                    </p>

                <div class="table-responsive" id="trs2">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP/NUPTK</th>
                                <th>Mengajar Mapel</th>
                                <th>Kelas Yang Diajar</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Diupdate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php $no = 1;  echo $no++ ?></td>
                                <td><?= $data_guru['guru_nama'] ?></td>
                                <td><?= $data_guru['guru_nip'] ?></td>
                                <td><?= $data_guru['mapel_nama'] ?></td>
								<?php 
									$ci = get_instance();
									$guru_kelas = $this->db->get_where('tb_kelas', ['id_guru' => $data_guru['id_guru'] ])->result_array();
								?>
                                <td style='text-align:center; vertical-align:middle'>
									<?php foreach($guru_kelas as $kelas) echo $kelas['kelas_nama'] . '<br>' ?>
								</td>                                                    
                                <td style='text-align:center;'>
									<?= date('d-m-Y', strtotime($data_guru['created_at'])) ?>
								</td>
                                <td style='text-align:center;'>
									<?= ($data_guru['update_at'] == '0000-00-00 00:00:00') ? ' - ' : date('d-m-Y', strtotime($data_guru['update_at'])) ?>
								</td>
                            </tr>                                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-12 mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    
                    <h6 class="m-0 font-weight-bold text-primary">
                        <img src="<?= base_url()?>assets/guru/icons/pemberitahuan.png" width="15px">
                        Pemberitahuan</h6>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addPemberitahuanmodal" id="addPemberitahuan">+ Pemberitahuan</a>
                        <table id="tabel_pemberitahuan" class="table table-striped table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Bab</th>
                                    <th>Mapel</th>
                                    <th>Pemberitahuan</th>
                                    <th>Link</th>
                                    <th>Dibuat</th>
                                    <th>Diedit</th>
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


<!-- Modal Tambah Pemberitahuan-->
<div class="modal fade" id="addPemberitahuanmodal" tabindex="-1" role="dialog" aria-labelledby="addPemberitahuanmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addPemberitahuanmodallabel"><img src="<?= base_url('assets/guru/icons/tambahPemberitahuan.png')?>" width="18px"> Tambah Pemberitahuan</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'submitpemberitahuan']) ?>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-8 col-md-10">
                                <select id="kelas" name="kelas[]" class="js-select2" multiple="multiple">
									<?php foreach($guru_kelas as $row => $value) : ?>
                                    <option value="<?= $value['id_kelas'] ?>" data-badge=""><?= $value['kelas_nama'] ?></option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bab" class="col-sm-2 col-form-label">Bab</label>
                            <div class="col-sm-8 col-md-10">
                                <select class="form-control" id="bab" name="bab">
                                    <option selected>Pilih Bab</option>
									<?php foreach($getBab as $row => $value) : ?>
                                    <option value="<?= $value->id_bab ?>" ><?= 'BAB ' . $value->bab_ke ?></option1>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                            <div class="col-sm-8 col-md-10">
                                <input id="mapel" class="form-control" type="text" placeholder="Bahasa Indonesia" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pemberitahuan" class="col-sm-2 col-form-label">Pemberitahuan</label>
                            <div class="col-sm-8 col-md-10">
                                <textarea class="form-control" placeholder="Masukan pemberitahuan" name="pemberitahuan" id="pemberitahuan"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-sm-2 col-form-label">Link</label>
                            <div class="col-sm-8 col-md-10">
                                <input id="link" class="form-control" name="link_pemberitahuan" type="text" placeholder="Masukan link yang terkait dengan pemberitahuan">
                            </div>
                        </div>
                       
                        <div class="my-2" id="info-edit"></div>                      
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
                            <button type="submit" class="btn btn-primary" id="addpemberitahua-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit Pemberitahuan-->
    <div class="modal fade" id="editPemberitahuanmodal" tabindex="-1" role="dialog" aria-labelledby="editPemberitahuanmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editPemberitahuanmodallabel"><img src="<?= base_url()?>assets/guru/icons/edit.png" width="18px"> Edit Pemberitahuan</h5>
                </div>
                <div class="modal-body">
					<div id="editpemberitahuan"></div>
                </div>
            </div>
        </div>
    </div>
