<?= form_open_multipart('#', ['id' => 'updatepemberitahuan']) ?>
<input type="hidden" name="id_pemberitahuan_edit" value="<?= $pemberitahuan->id_pemberitahuan ?>">
<div class="form-group row">
    <label for="kelas_edit" class="col-sm-2 col-form-label">Kelas</label>
    <div class="col-sm-8 col-md-10">
		<input id="kelas" class="form-control" type="text" value="<?= $pemberitahuan->kelas_nama ?>" readonly>
	</div>
</div>
<div class="form-group row">
	<label for="bab" class="col-sm-2 col-form-label">Bab</label>
	<div class="col-sm-8 col-md-10">
		<select class="form-control" id="bab" name="bab_edit">
			<option selected>Pilih Bab</option>
			<?php foreach ($getBab as $row => $value) : ?>
				<?php if( $value->id_bab == $pemberitahuan->id_bab ) : ?>
					<option value="<?= $value->id_bab ?>" selected><?= 'BAB ' . $value->bab_ke ?></option>
				<?php else : ?>
					<option value="<?= $value->id_bab ?>"><?= 'BAB ' . $value->bab_ke ?></option>
				<?php endif; ?>
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
		<textarea class="form-control" placeholder="Masukan pemberitahuan" name="pemberitahuan_edit" id="pemberitahuan"><?= htmlspecialchars($pemberitahuan->pemberitahuan) ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label for="link" class="col-sm-2 col-form-label">Link</label>
	<div class="col-sm-8 col-md-10">
		<input id="link" class="form-control" name="link_pemberitahuan_edit" type="text" placeholder="Masukan link yang terkait dengan pemberitahuan" value="<?= $pemberitahuan->link_pemberitahuan ?>">
	</div>
</div>

<div class="my-2" id="info-edit"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
	<button type="submit" class="btn btn-primary" id="editpemberitahuan-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
</div>
</form>

 	<!-- Pilih Kelas -->
 	<script src="<?= base_url()?>assets/pilih_kelas_templatejs/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/pilih_kelas_template/js/popper.js"></script>
    <script src="<?= base_url()?>assets/pilih_kelas_template/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="<?= base_url()?>assets/pilih_kelas_template/js/main.js"></script>
    <!-- End Pilih kelas -->
