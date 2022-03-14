<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bahan Ajar</h1>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-12 mt-4">
        
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    
                    <h6 class="m-0">
                        Bahan Ajar Kelas VIII Bahasa Indonesia
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
                                    <th>Judul</th>
                                    <th>Materi Unit 1</th>
                                    <th>Materi Unit 2</th>
                                    <th>Rangkuman</th>
                                    <th>Tanggal Input</th>
                                    <th>Tanggal update</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $no = 1; foreach ($data_materi as $row => $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= 'BAB ' . $value->bab_ke ?></td>
                                    <td><?= $value->bab_judul ?></td>
									<?php 
										$ci = get_instance();
										$unitBAB = $ci->admin->getUnitByBAB($value->id_bab);
										if(empty($unitBAB->result_object())) {
											echo '<td style="text-align:center;"> - </td>';
											echo '<td style="text-align:center;"> - </td>';
										} else if($unitBAB->num_rows() == 2) {
											foreach($unitBAB->result() as $row => $unit) {
												echo '<td style="text-align:center;"><a target="blank" href="'. base_url('Guru/DataMateri/unitbab/' . $this->secure->encrypt_url($unit->id_unit_bab)). '"><img src="'. base_url('assets/guru/icons/pdficon.png') .'"width="25px" class="ml-2"></a></td>';
											}
										} else if($unitBAB->num_rows() == 1) {
											foreach($unitBAB->result() as $row => $unit) {
												if($unit->unit_ke == 'Unit 1') {
													echo '<td style="text-align:center;">' . $unit->unit_ke .'<a target="blank" href="'. base_url('Guru/DataMateri/unitbab/' . $this->secure->encrypt_url($unit->id_unit_bab)). '"><img src="'. base_url('assets/guru/icons/pdficon.png') .'"width="25px" class="ml-2"></a></td>';
													echo '<td style="text-align:center;"> - </td>';
												} else if($unit->unit_ke == 'Unit 2') {
													echo '<td style="text-align:center;"> - </td>';
													echo '<td style="text-align:center;">' . $unit->unit_ke .'<a target="blank" href="'. base_url('Guru/DataMateri/unitbab/' . $this->secure->encrypt_url($unit->id_unit_bab)). '"><img src="'. base_url('assets/guru/icons/pdficon.png') .'"width="25px" class="ml-2"></a></td>';
												}
											}

										}
									?>
									<td  style="text-align:center;">
										<a target="blank" href="<?= base_url('Guru/DataMateri/rangkuman/' . $this->secure->encrypt_url($value->id_bab))?>">
											<img src="<?= base_url('assets/guru/icons/pdficon.png')?>" width="25px" class="ml-2">
										</a>
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
