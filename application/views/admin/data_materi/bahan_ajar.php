<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bahan Ajar</h1>
    </div>

    <div class="textdecor-none mb-2">
		<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#addbahanajarmodal" id="addbahanajar">+ Bahan Ajar Dan Tugas</button>
	</div>

    <div class="row">
        <div class="col-xs-6 col-sm-12 mt-4">
        
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    
                    <h6 class="m-0 text-primary">
                        Bahan Ajar Kelas VIII Bahasa Indonesia
                    </h6>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_bahanajar" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bab</th>
                                    <th>Judul</th>
                                    <th>Materi Unit 1</th>
                                    <th>Materi Unit 2</th>
                                    <th>Rangkuman</th>
                                    <th>Tanggal Input</th>
                                    <th>Tanggal update</th>
                                    <td>Aksi</td>
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

<!-- Modal Tambah bahan ajar -->
<div class="modal fade" id="addbahanajarmodal" tabindex="-1" role="dialog" aria-labelledby="addbahanajarmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addbahanajarmodallabel"><span class="fas fa-plus mr-1"></span>Tambah Bahan Ajar Dan Tugas</h5>
            </div>
            <div class="modal-body">
				<?= form_open_multipart('#', ['id' => 'submitbahanajar']) ?>
					<label>
					    <h5>Deskripsi BAB</h5>
    				</label>
    				<div class="form-group row">
    					<label for="mapel_bab" class="col-sm-4 col-form-label">Mata Pelajaran</label>
    					<div class="col-sm-8 col-md-8">
    						<select id="mapel_bab" name="mapel_bab" class="form-control">
    							<option selected value="">Mata Pelajaran</option>
    							<?php foreach ($mapel as $row => $value) : ?>
    								<option value="<?= $value->id_mapel ?>"><?= $value->mapel_nama ?></option>
    							<?php endforeach; ?>
    						</select>
    					</div>
    				</div>
    				<div class="form-group row ">
    					<label for="judul_bab" class="col-sm-4 col-form-label">Judul BAB</label>
    					<div class="col-sm-8 col-md-8">
    						<input id="judul_bab" type="text" name="judul_bab" class="form-control" value="<?= set_value('judul_bab') ?>">
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="bab_ke" class="col-sm-4 col-form-label">Pilih BAB</label>
    					<div class="col-sm-8 col-md-8">
    						<select id="bab_ke" name="bab_ke" class="form-control">
    							<option selected value="">Pilih Bab</option>
    							<option value="I">Bab 1</option>
    							<option value="II">Bab 2</option>
    							<option value="III">Bab 3</option>
    							<option value="IV">Bab 4</option>
    							<option value="V">Bab 5</option>
    							<option value="VI">Bab 6</option>
    						</select>
    					</div>
    				</div>
    				<label>
    					<h5>Materi Bahan Ajar</h5>
    				</label>
    				<div class="form-group row">
    					<label for="unit_bab_1" class="col-sm-4 col-form-label">Upload Materi Unit 1</label>
    					<div class="col-sm-8 col-md-8">
    						<div class="custom-file">
    							<input type="file" class="custom-file-input" id="unit_bab_1" name="unit_bab[]">
    							<label class="custom-file-label" for="unit_bab_1">Pilih File Max 2 MB</label>
    
    						</div>
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="unit_bab_2" class="col-sm-4 col-form-label">Upload Materi Unit 2</label>
    					<div class="col-sm-8 col-md-8">
    						<div class="custom-file">
    							<input type="file" class="custom-file-input" id="unit_bab_2" name="unit_bab[]">
    							<label class="custom-file-label" for="unit_bab_2">Pilih File Max 2 MB</label>
    						</div>
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="rangkuman_bab" class="col-sm-4 col-form-label">Upload Rangkuman</label>
    					<div class="col-sm-8 col-md-8">
    						<div class="custom-file">
    							<input type="file" class="custom-file-input" id="rangkuman_bab" name="rangkuman_bab">
    							<label class="custom-file-label" for="rangkuman_bab">Pilih File Max 2 MB</label>
    						</div>
    					</div>
    				</div>
    				<label>
    					<h5>Latihan Tugas</h5>
    				</label>
    				<div class="form-group row">
    					<label for="latihan1" class="col-sm-4 col-form-label">Upload Latihan 1</label>
    					<div class="col-sm-8 col-md-8">
    						<div class="custom-file">
    							<input type="file" class="custom-file-input" id="latihan1" name="latihan_bab[]">
    							<label class="custom-file-label" for="latihan1">Pilih File Max 2 MB</label>
    						</div>
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="deskripsi_latihan_1" class="col-sm-4 col-form-label">Deskripsi Latihan 1</label>
    					<div class="col-sm-8 col-md-8">
    						<textarea id="deskripsi_latihan_1" type="text" name="deskripsi_latihan[]" class="form-control"><?= set_value('deskripsi_latihan') ?></textarea>
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="latihan2" class="col-sm-4 col-form-label">Upload Latihan 2</label>
    					<div class="col-sm-8 col-md-8">
    						<div class="custom-file">
    							<input type="file" class="custom-file-input" id="latihan1" name="latihan_bab[]">
    							<label class="custom-file-label" for="latihan2">Pilih File Max 2 MB</label>
    						</div>
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="deskripsi_latihan_2" class="col-sm-4 col-form-label">Deskripsi Latihan 2</label>
    					<div class="col-sm-8 col-md-8">
    						<textarea id="deskripsi_latihan_2" type="text" name="deskripsi_latihan[]" class="form-control"><?= set_value('deskripsi_latihan') ?></textarea>
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="latihan3" class="col-sm-4 col-form-label">Upload Latihan 3</label>
    					<div class="col-sm-8 col-md-8">
    						<div class="custom-file">
    							<input type="file" class="custom-file-input" id="latihan1" name="latihan_bab[]">
    							<label class="custom-file-label" for="latihan3">Pilih File Max 2 MB</label>
    						</div>
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="deskripsi_latihan_3" class="col-sm-4 col-form-label">Deskripsi Latihan 3</label>
    					<div class="col-sm-8 col-md-8">
    						<textarea id="deskripsi_latihan_3" type="text" name="deskripsi_latihan[]" class="form-control"><?= set_value('deskripsi_latihan') ?></textarea>
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="latihan4" class="col-sm-4 col-form-label">Upload Latihan 4</label>
    					<div class="col-sm-8 col-md-8">
    						<div class="custom-file">
    							<input type="file" class="custom-file-input" id="latihan1" name="latihan_bab[]">
    							<label class="custom-file-label" for="latihan4">Pilih File Max 2 MB</label>
    						</div>
    					</div>
    				</div>
    				<div class="form-group row">
    					<label for="deskripsi_latihan" class="col-sm-4 col-form-label">Deskripsi Latihan 4</label>
    					<div class="col-sm-8 col-md-8 ">
    						<textarea id="deskripsi_latihan[]" type="text" name="deskripsi_latihan[]" class="form-control"><?= set_value('deskripsi_latihan') ?></textarea>
    					</div>
    				</div>
                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitbahanajar-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
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
				<div id="editDataBahanAjar"></div>
			</div>
        </div>
    </div>
</div>
