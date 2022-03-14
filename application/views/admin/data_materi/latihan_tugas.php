<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Latihan tugas</h1>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-12 mt-3">
        
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    
                    <h6 class="m-0 text-primary">
                        Latihan Tugas Kelas VIII Bahasa Indonesia
                    </h6>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="guru" class="table table-striped table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bab</th>
                                    <th style="width: 20%;">Latihan 1</th>
                                    <th>Latihan 2</th>
                                    <th>Latihan 3</th>
                                    <th>Latihan 4</th>
                                    <th>Tanggal Input</th>
                                    <th>Tanggal update</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $no = 1; foreach ($dataMateri as $row => $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= 'BAB ' . $value->bab_ke ?></td>
									<?php
										$ci = get_instance();
										$latihanTugas = $ci->admin->getLatihanByBAB($value->id_bab)->result_array();
									?>
                                    <td>
                                        <a target="blank" href="<?= base_url('Admin/DataMateri/latihan/'. $this->secure->encrypt_url($latihanTugas[0]['id_tugas']))?>"><img src="<?= base_url()?>assets/guru/icons/pdficon.png" width="25px" class="ml-2"></a>
                                        <p class=" mt-3"> 
                                        	<strong>Deskripsi : </strong> 
                                        	<?= $latihanTugas[0]['deskripsi_tugas'] ?>
                                        </p> 
                                    </td>
                                    <td>
                                        <a target="blank" href="<?= base_url('Admin/DataMateri/latihan/'. $this->secure->encrypt_url($latihanTugas[1]['id_tugas']))?>"><img src="<?= base_url()?>assets/guru/icons/pdficon.png" width="25px" class="ml-2"></a>
                                        <p class=" mt-3"> 
                                        	<strong>Deskripsi : </strong> 
                                        	<?= $latihanTugas[1]['deskripsi_tugas'] ?>
                                        </p> 
                                    </td>
                                    <td>
                                        <a target="blank" href="<?= base_url('Admin/DataMateri/latihan/'. $this->secure->encrypt_url($latihanTugas[2]['id_tugas']))?>"><img src="<?= base_url()?>assets/guru/icons/pdficon.png" width="25px" class="ml-2"></a>
                                        <p class=" mt-3"> 
                                        	<strong>Deskripsi : </strong> 
                                        	<?= $latihanTugas[2]['deskripsi_tugas'] ?>
                                        </p> 
                                    </td>
                                    <td>
                                        <a target="blank" href="<?= base_url('Admin/DataMateri/latihan/'. $this->secure->encrypt_url($latihanTugas[3]['id_tugas']))?>"><img src="<?= base_url()?>assets/guru/icons/pdficon.png" width="25px" class="ml-2"></a>
                                        <p class=" mt-3"> 
                                        	<strong>Deskripsi : </strong> 
											<?= $latihanTugas[3]['deskripsi_tugas'] ?>
                                        </p> 
                                    </td>
									<td><?= date('d-m-Y', strtotime($value->created_at)) ?></td>
                                    <td><?= date('d-m-Y', strtotime($value->update_at)) ?></td>
                                </tr>
								<?php endforeach; ?>
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

<!-- Modal Tambah bahan ajar -->
<div class="modal fade" id="addbahanajarmodal" tabindex="-1" role="dialog" aria-labelledby="addbahanajarmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addbahanajarmodallabel"><span class="fas fa-plus mr-1"></span>Tambah Bahan Ajar Dan Tugas</h5>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group row">
                        <label for="judul" class="col-sm-4 col-form-label">Judul</label>
                        <div class="col-sm-8 col-md-8">
                            <input id="judul" type="text" name="judul" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bab" class="col-sm-4 col-form-label">Pilih Bab</label>
                        <div class="col-sm-8 col-md-8">
                            <select id="bab" name="bab" class="form-control">
                                <option>Pilih Bab</option>
                                <option>Bab 1</option>
                                <option>Bab 2</option>
                                <option>Bab 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="materi_unit_1" class="col-sm-4 col-form-label">Upload Materi Unit 1</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="materi_unit_1" name="materi_unit_1">
                                <label class="custom-file-label" for="materi_unit_1">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="materi_unit_2" class="col-sm-4 col-form-label">Upload Materi Unit 2</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="materi_unit_2" name="materi_unit_2">
                                <label class="custom-file-label" for="materi_unit_1">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rangkuman" class="col-sm-4 col-form-label">Upload Rangkuman</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="rangkuman" name="rangkuman">
                                <label class="custom-file-label" for="rangkuman">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="latihan1" class="col-sm-4 col-form-label">Upload Latihan 1</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="latihan1" name="latihan1">
                                <label class="custom-file-label" for="latihan1">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_latihan_1" class="col-sm-4 col-form-label">Deskripsi Latihan 1</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="deskripsi_latihan_1" type="text" name="deskripsi_latihan_1" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="latihan2" class="col-sm-4 col-form-label">Upload Latihan 2</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="latihan2" name="latihan2">
                                <label class="custom-file-label" for="latihan2">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_latihan_2" class="col-sm-4 col-form-label">Deskripsi Latihan 2</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="deskripsi_latihan_2" type="text" name="deskripsi_latihan_2" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="latihan3" class="col-sm-4 col-form-label">Upload Latihan 3</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="latihan3" name="latihan3">
                                <label class="custom-file-label" for="latihan3">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_latihan_3" class="col-sm-4 col-form-label">Deskripsi Latihan 3</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="deskripsi_latihan_3" type="text" name="deskripsi_latihan_3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="latihan4" class="col-sm-4 col-form-label">Upload Latihan 4</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="latihan4" name="latihan4">
                                <label class="custom-file-label" for="latihan4">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_latihan_4" class="col-sm-4 col-form-label">Deskripsi Latihan 4</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="deskripsi_latihan_4" type="text" name="deskripsi_latihan_4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
                    <button type="submit" class="btn btn-primary" id="addsiswa-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah bahan ajar -->
<div class="modal fade" id="editbahanajarmodal" tabindex="-1" role="dialog" aria-labelledby="editbahanajarmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editbahanajarmodallabel"><span class="fas fa-edit mr-1"></span>Edit Bahan Ajar Dan Tugas</h5>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group row">
                        <label for="judul" class="col-sm-4 col-form-label">Judul</label>
                        <div class="col-sm-8 col-md-8">
                            <input id="judul" type="text" name="judul" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bab" class="col-sm-4 col-form-label">Pilih Bab</label>
                        <div class="col-sm-8 col-md-8">
                            <select id="bab" name="bab" class="form-control">
                                <option>Pilih Bab</option>
                                <option>Bab 1</option>
                                <option>Bab 2</option>
                                <option>Bab 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="materi_unit_1" class="col-sm-4 col-form-label">Upload Materi Unit 1</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="materi_unit_1" name="materi_unit_1">
                                <label class="custom-file-label" for="materi_unit_1">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="materi_unit_2" class="col-sm-4 col-form-label">Upload Materi Unit 2</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="materi_unit_2" name="materi_unit_2">
                                <label class="custom-file-label" for="materi_unit_1">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rangkuman" class="col-sm-4 col-form-label">Upload Rangkuman</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="rangkuman" name="rangkuman">
                                <label class="custom-file-label" for="rangkuman">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="latihan1" class="col-sm-4 col-form-label">Upload Latihan 1</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="latihan1" name="latihan1">
                                <label class="custom-file-label" for="latihan1">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_latihan_1" class="col-sm-4 col-form-label">Deskripsi Latihan 1</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="deskripsi_latihan_1" type="text" name="deskripsi_latihan_1" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="latihan2" class="col-sm-4 col-form-label">Upload Latihan 2</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="latihan2" name="latihan2">
                                <label class="custom-file-label" for="latihan2">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_latihan_2" class="col-sm-4 col-form-label">Deskripsi Latihan 2</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="deskripsi_latihan_2" type="text" name="deskripsi_latihan_2" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="latihan3" class="col-sm-4 col-form-label">Upload Latihan 3</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="latihan3" name="latihan3">
                                <label class="custom-file-label" for="latihan3">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_latihan_3" class="col-sm-4 col-form-label">Deskripsi Latihan 3</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="deskripsi_latihan_3" type="text" name="deskripsi_latihan_3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="latihan4" class="col-sm-4 col-form-label">Upload Latihan 4</label>
                        <div class="col-sm-8 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="latihan4" name="latihan4">
                                <label class="custom-file-label" for="latihan4">Choose file. Max 2 MB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_latihan_4" class="col-sm-4 col-form-label">Deskripsi Latihan 4</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="deskripsi_latihan_4" type="text" name="deskripsi_latihan_4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
                    <button type="submit" class="btn btn-primary" id="addsiswa-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
