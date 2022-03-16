 <!-- Footer -->
 <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> &copy; 2021 Team Paradoks Technology</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin akan logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih Logout jika ingin melanjutkan</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout')?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url()?>assets/guru/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/guru/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()?>assets/guru/js/main.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url()?>assets/guru/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url()?>assets/guru/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url()?>assets/guru/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url()?>assets/guru/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url()?>assets/guru/js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>

	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    
    <!-- Pilih Kelas -->
    <script src="<?= base_url()?>assets/pilih_kelas_templatejs/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/pilih_kelas_template/js/popper.js"></script>
    <script src="<?= base_url()?>assets/pilih_kelas_template/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="<?= base_url()?>assets/pilih_kelas_template/js/main.js"></script>
    <!-- End Pilih kelas -->

	<!-- Date Timepicker -->
	<script src="<?= base_url()?>assets/guru/vendor/datetimepicker/jquery.datetimepicker.full.min.js"></script>

	<!-- SweetAlert -->
	<script src="<?= base_url() ?>assets/admin/vendor/sweetalert2/sweetalert2.all.min.js"></script>
		<!-- End SweetAlert -->
	<script	script type="text/javascript">
		$(function(){
			var title = '<?= $this->session->flashdata("title") ?>';
			var text = '<?= $this->session->flashdata("text") ?>';
			var type = '<?= $this->session->flashdata("type") ?>';
			if (title) {
				swal.fire({
					icon: type,	
					title: title,
					text: text,
					type: type,
					button: true,
				});
			};
		});
		
		$(document).ready(function () {
			$("#show_hide_password button").on("click", function (event) {
				event.preventDefault();
				if ($("#show_hide_password input").attr("type") == "text") {
					$("#show_hide_password input").attr("type", "password");
					$("#show_hide_password span").addClass("fa-eye-slash");
					$("#show_hide_password span").removeClass("fa-eye");
				} else if ($("#show_hide_password input").attr("type") == "password") {
					$("#show_hide_password input").attr("type", "text");
					$("#show_hide_password span").removeClass("fa-eye-slash");
					$("#show_hide_password span").addClass("fa-eye");
				}
			});
		});
	</script>
	<script>
		// Logout Guru
		$(".logout").click(function(event) {
			event.preventDefault();
			Swal.fire({
				title: 'Anda Yakin Keluar?',
				text: 'Anda yakin ingin keluar dari aplikasi ini!',
				icon: 'warning',
				showConfirmButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Logout'
			}).then((result) => {
				if(result.value) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('auth/logout'); ?>",
						beforeSend: function() {
							swal.fire({
								imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
								title: "Logging Out",
								text: "Please wait",
								showConfirmButton: false,
								allowOutsideClick: false
							});
						},
						success: function(data) {
							swal.fire({
								icon: 'success',
								title: 'Logout',
								text: 'Anda Telah Keluar!',
								showConfirmButton: false,
								allowOutsideClick: false
							});
							window.location.href = "<?= base_url() ?>";
						}
					});
				}
			});
		});
	</script>
	<script>
		function load_process() {
            swal.fire({
                imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                title: "Refresh Data",
                text: "Silahkan Tunggu",
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 1500
            });
        }
	</script>
	<script>
		$('#tabel_pemberitahuan').DataTable({
			"lengthMenu": [[5, 7, 10, -1], [5, 7, 10, "All"]],
			"language" : {
				"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
				"sEmptyTables" : "Tidads"
			},
			"ajax": {
                url: "<?= base_url('Guru/Dashboard/get_tabelpemberitahuan'); ?>",
                type: 'GET',
                async: true,
                "processing": true,
                "serverSide": true,
                dataType: 'json',
                "bDestroy": true,
            },
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
		});

		$("#submitpemberitahuan").submit(function(e){
			e.preventDefault();
			var form = this;
			$("#addpemberitahua-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disable", true);
			var formdata = new FormData(form);
			$.ajax({
				url: "<?= base_url('Guru/Dashboard/crud_pemberitahuan?type=tambah') ?>",
				type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
				beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Menambahkan Pemberitahuan",
                        text: "Silahkan Tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(response) {
                    $("#info-data").html(response.messages).attr("disabled", false).show();
                    if (response.success == true) {
                        $('.text-danger').remove();
                        swal.fire({
                            icon: 'success',
                            title: 'Penambahan Pemberitahuan Berhasil',
                            text: 'Penambahan pemberitahuan sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#tabel_pemberitahuan').DataTable().ajax.reload();
                        $('#addPemberitahuanmodal').modal('hide');
                        form.reset();
                        $("#addpemberitahua-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addpemberitahua-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Data Pemberitahuan Gagal", "Ada Kesalahan Saat penambahan pemberitahuan!", "error");
                    $("#addpemberitahua-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
			});
		});

		// Hapus Pemberitahuan
		$("#tabel_pemberitahuan").on('click', '.hapus-pemberitahuan', function(e) {
			e.preventDefault();
            var id_pemberitahuan = $(e.currentTarget).attr('data-pemberitahuan-id');
            if (id_pemberitahuan === '') return;
			Swal.fire({
                title: 'Hapus Pemberitahuan Ini?',
                text: "Anda yakin ingin menghapus pemberitahuan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('Guru/Dashboard/crud_pemberitahuan?type=hapus'); ?>',
                        data: {
                            id_pemberitahuan: id_pemberitahuan
                        },
						beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                title: "Menghapus Pemberitahuan",
                                text: "Silahkan Tunggu!",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
						success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Pemberitahuan Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Pemberitahuan Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#tabel_pemberitahuan').DataTable().ajax.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Pemberitahuan Gagal", "Ada Kesalahan Saat menghapus pemberitahuan!", "error");
                        }
					});
                }
            })
        });


		$("#tabel_pemberitahuan").on('click', '.edit-pemberitahuan', function(e) {
			e.preventDefault();
			var id_pemberitahuan = $(e.currentTarget).attr("data-pemberitahuan-id");
			console.log(id_pemberitahuan);
			if (id_pemberitahuan === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('Guru/Dashboard/crud_pemberitahuan?type=update') ?>",
				data: {
					id_pemberitahuan: id_pemberitahuan
				},
				beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Update Pemberitahuan",
                        text: "silahkan tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(data) {
					swal.close();
					$('#editPemberitahuanmodal').modal('show');
					$('#editpemberitahuan').html(data);

					$('#updatepemberitahuan').submit(function(e) {
						e.preventDefault();
						var form = this;
						$("#editpemberitahuan-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
						var formdata = new FormData(form);
						$.ajax({
							url: "<?= base_url('Guru/Dashboard/update_pemberitahuan?type=update') ?>",
							type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                    title: "Mengupdate Pemberitahuan",
                                    text: "silahkan tunggu",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },success: function(response) {
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Update Pemberitahuan Berhasil',
                                        text: 'Update pemberitahuan telah berhasil!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });	
									$('#tabel_pemberitahuan').DataTable().ajax.reload();
									$('#editPemberitahuanmodal').modal('hide');
									form.reset();
									$("#editpemberitahuan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
								} else {
									swal.close()
                                    $("#editpemberitahuan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
								}
							},
							error: function() {
                                swal.fire("Update Pemberitahuan Gagal", "Ada Kesalahan Saat Update Pemberitahuan!", "error");
                                $("#editpemberitahuan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
						});
					});
				}
			})
		});
	</script>

	<script>
		$('#tabelsiswa').DataTable({
			aLengthMenu: [
				[25, 50, 100, 200, -1],
				[25, 50, 100, 200, "All"]
			],
			iDisplayLength: -1,
			"language" : {
				"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
				"sEmptyTables" : "Tidads"
			},
		});
		// view data siswa
		$("#tabelsiswa").on('click', '.view-siswa', function(e) {
            e.preventDefault();
            var id_siswa = $(e.currentTarget).attr('data-siswa-id');
			console.log(id_siswa);
            if (id_siswa === '') return;
            $.ajax({
               	type: "POST",
                url: '<?= base_url('Guru/Dashboard/detail_siswa?type=view'); ?>',
                data: {
                    id_siswa: id_siswa
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Preview Siswa",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#viewsiswamodal').modal('show');
                    $('#viewdatasiswa').html(data);

                },
                error: function() {
                    swal.fire("Preview Siswa Gagal", "Ada Kesalahan Saat menampilkan data siswa!", "error");
                }
            });
        });
	</script>

	<script>
        
        $('#cek-tugas').DataTable({
			"lengthMenu": [[20, 40, 80, -1], [20, 40, 80, "All"]],
			"language" : {
				"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
				"sEmptyTables" : "Tidads"
			},
			"ajax": {
                url: "<?= base_url('Guru/DataTugas/get_datatable?type=cek_tugas'); ?>",
                type: 'GET',
                async: true,
                "processing": true,
                "serverSide": true,
                dataType: 'json',
                "bDestroy": true,
            },
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
		});
        

		$("#cek_tugas").submit(function(e){
			e.preventDefault();
			var form = this;
			$("#cektugas-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disable", true);
			var formdata = new FormData(form);
			$.ajax({
				url: "<?= base_url('Guru/DataTugas/cek_latihan_siswa?type=cek_tugas') ?>",
				type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
				beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mengecek Tugas Siswa",
                        text: "Silahkan Tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(response) {
                    $("#info-data").html(response.messages).attr("disabled", false).show();
                    if (response.success == true) {
                        $('.text-danger').remove();
                        swal.fire({
                            icon: 'success',
                            title: 'Penambahan Pemberitahuan Berhasil',
                            text: 'Penambahan pemberitahuan sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1000
                        });
						$('#cek-tugas').DataTable().ajax.reload();
                        $('#cekLatihanSiswamodal').modal('hide');
                        form.reset();
                        $("#cektugas-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#cektugas-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Data Pemberitahuan Gagal", "Ada Kesalahan Saat penambahan pemberitahuan!", "error");
                    $("#cektugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
			});
		});
        
        // refresh table pemberitahuan tugas
		$("#refresh-pemb").click(function(e) {
            e.preventDefault();
            load_process();
			$('#cek-tugas').DataTable().ajax.reload();
        });

		$(document).ready(function() {
			var id_pemb = $("#pemb_tugas").val();
			console.log(id_pemb);
			$('#pemberitahuan-tugas').DataTable({
				destroy: true,
				"lengthMenu": [[1, 3, 7, -1], [1, 3, 7, "All"]],
				"language" : {
					"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
					"sEmptyTables" : "Tidads"
				},
				"ajax": {
					url: "<?= base_url('Guru/DataTugas/get_datatable?type=pemb_tugas'); ?>",
					type: 'POST',
					data : {
						id_pemb : id_pemb
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
				},
				rowCallback: function(row, data, iDisplayIndex) {
						$('td:eq(0)', row).html();
				},
			});
		});

		function chg_pembtugas(id_pemb) {
			$('#data-tugas-siswa').DataTable({
				destroy: true,
				"lengthMenu": [[10, 15, 25, -1], [10, 15, 25, "All"]],
				"language" : {
					"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
					"sEmptyTables" : "Tidads"
				},
				"ajax": {
					url: "<?= base_url('Guru/DataTugas/get_datatable?type=pemb_tugas'); ?>",
					type: 'POST',
					data : {
						id_pemb : id_pemb
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				},
			});
		}

		// refresh table pemberitahuan tugas
		$("#refresh-table-pemb").click(function(e) {
            e.preventDefault();
			var id_pemb = $(e.currentTarget).attr('data-pemb-id');
			console.log(id_pemb);
            load_process();
			chg_pembtugas(id_pemb);
        });

        
		$("#pemberitahuan-tugas").on('click', '.edit-pemb-tugas', function(e) {
			e.preventDefault();
			var id_pemb_tugas = $(e.currentTarget).attr("data-tugas-id");
			console.log(id_pemb_tugas);
			if (id_pemb_tugas === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('Guru/DataTugas/cek_latihan_siswa?type=update_pemb') ?>",
				data: {
					id_pemb_tugas: id_pemb_tugas
				},
				beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Update Pemberitahuan",
                        text: "silahkan tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(data) {
					swal.close();
					$('#editPemberitahuanTugasModal').modal('show');
					$('#edit_pembtugas').html(data);

					$('#edit_cektugas').submit(function(e) {
						e.preventDefault();
						var form = this;
						$("#editpembtugas-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
						var formdata = new FormData(form);
						$.ajax({
							url: "<?= base_url('Guru/DataTugas/update_pemberitahuan?type=update_pemb') ?>",
							type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                    title: "Mengupdate Pemberitahuan",
                                    text: "silahkan tunggu",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },success: function(response) {
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Update Pemberitahuan Berhasil',
                                        text: 'Update pemberitahuan telah berhasil!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });	
								    chg_pembtugas(id_pemb_tugas);
									$('#pemberitahuan-tugas').DataTable().ajax.reload();
									$('#editPemberitahuanTugasModal').modal('hide');
									form.reset();
									$("#editpembtugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
								} else {
									swal.close()
                                    $("#editpembtugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
								}
							},
							error: function() {
                                swal.fire("Update Pemberitahuan Gagal", "Ada Kesalahan Saat Update Pemberitahuan!", "error");
                                $("#editpembtugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
						});
					});
				}
			})
		});


	$(document).ready(function() {
			var id_pemb = $("#pemb_tugas").val();
			console.log(id_pemb);
			$('#tugas_siswa').DataTable({
				"language" : {
					"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
					"sEmptyTables" : "Tidads"
				},
				destroy: true,
				aLengthMenu: [
					[25, 50, 100, 200, -1],
					[25, 50, 100, 200, "All"]
				],
				iDisplayLength: -1,
				"ajax": {
					url: "<?= base_url('Guru/DataTugas/get_datatable?type=tugas_siswa'); ?>",
					type: 'POST',
					data : {
						id_pemb : id_pemb
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				},
			});
		});

		function chg_tugassiswa(id_pemb) {
			$('#tugas_siswa').DataTable({
				"language" : {
					"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
					"sEmptyTables" : "Tidads"
				},
				destroy: true,
				aLengthMenu: [
					[25, 50, 100, 200, -1],
					[25, 50, 100, 200, "All"]
				],
				iDisplayLength: -1,
				"ajax": {
					url: "<?= base_url('Guru/DataTugas/get_datatable?type=tugas_siswa'); ?>",
					type: 'POST',
					data : {
						id_pemb : id_pemb
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				},
			});
		}

		// refresh table tugas siswa
		$("#refresh-tugas-siswa").click(function(e) {
            e.preventDefault();
			var id_pemb = $(e.currentTarget).attr('data-pemb-id');
			console.log(id_pemb);
            load_process();
			chg_tugassiswa(id_pemb)
        });

		$("#tugas_siswa").on('click', '.nilai-siswa', function(e) {
			e.preventDefault();
			var id_tugas_siswa = $(e.currentTarget).attr("tugas-siswa-id");
			console.log(id_tugas_siswa);
			if (id_tugas_siswa === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('Guru/DataTugas/nilai_tugas_siswa?type=view_nilai01') ?>",
				data: {
					id_tugas_siswa: id_tugas_siswa
				},
				beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Latihan Siswa",
                        text: "silahkan tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(data) {
					swal.close();
					$('#tambahNilaimodal').modal('show');
					$('#nilai-tugas-siswa').html(data);

					$('#submit-nilai').submit(function(e) {
						e.preventDefault();
						var form = this;
						$("#nilaisiswa-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
						var formdata = new FormData(form);
						$.ajax({
							url: "<?= base_url('Guru/DataTugas/nilai_tugas_siswa?type=input_nilai01') ?>",
							type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                    title: "Input Nilai Siswa",
                                    text: "silahkan tunggu",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },success: function(response) {
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Input Nilai Siswa Berhasil',
                                        text: 'Input Nilai Siswa telah berhasil!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });	
                                    chg_tugassiswa(id_pemb);
								// 	$('#tugas_siswa').DataTable().ajax.reload();
									$('#tambahNilaimodal').modal('hide');
									form.reset();
									$("#nilaisiswa-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
								} else {
									swal.close()
                                    $("#nilaisiswa-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
								}
							},
							error: function() {
                                swal.fire("Input Nilai Siswa Gagal", "Ada Kesalahan Saat Input Nilai Siswa!", "error");
                                $("#nilaisiswa-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
						});
					});
				}
			})
		});

		$("#tugas_siswa").on('click', '.tambah-nilai', function(e) {
			e.preventDefault();
			var id_tugas = $(e.currentTarget).attr("tugas-id");
			var nis_siswa = $(e.currentTarget).attr("data-siswa-id");
			console.log(id_tugas);
			console.log(nis_siswa);
			if(nis_siswa === '') return;
			if(id_tugas === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('Guru/DataTugas/nilai_tugas_siswa?type=view_nilai02') ?>",
				data: {
					id_tugas : id_tugas,
					nis_siswa : nis_siswa
				},
				beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Latihan Siswa",
                        text: "silahkan tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(data) {
					swal.close();
					$('#inputnilaikosongModal').modal('show');
					$('#nilaisiswakosong').html(data);
					$('#beri-nilai-tugas').submit(function(e) {
						e.preventDefault();
						var form = this;
						$("#tambahnilai-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
						var formdata = new FormData(form);
						$.ajax({
							url: "<?= base_url('Guru/DataTugas/nilai_tugas_siswa?type=input_nilai02') ?>",
							type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                    title: "Input Nilai Siswa",
                                    text: "silahkan tunggu",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            }, success: function(response) {
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Input Nilai Siswa Berhasil',
                                        text: 'Input Nilai Siswa telah berhasil!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });	
									chg_tugassiswa(id_pemb);
									$('#tugas_siswa').DataTable().ajax.reload();
									$('#tambahNilaimodal').modal('hide');
									form.reset();
									$("#tambahnilai-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
								} else {
									swal.close()
                                    $("#tambahnilai-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-nilai").html(response.messages);
								}
							},
							error: function() {
                                swal.fire("Input Nilai Siswa Gagal", "Ada Kesalahan Saat Input Nilai Siswa!", "error");
                                $("#tambahnilai-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
						});
					});
				}

			});

		});
	</script>

	<script>
        $('#cek-uk').DataTable({
			"lengthMenu": [[5, 15, 30, -1], [5, 15, 30, "All"]],
			"language" : {
				"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
				"sEmptyTables" : "Tidads"
			},
			"ajax": {
                url: "<?= base_url('Guru/DataTugas/get_tabeluk?type=info_uk'); ?>",
                type: 'GET',
                async: true,
                "processing": true,
                "serverSide": true,
                dataType: 'json',
                "bDestroy": true,
            },
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
		});

		// refresh table pemberitahuan uk
		$("#refresh-uk").click(function(e) {
            e.preventDefault();
            load_process();
			$('#cek-uk').DataTable().ajax.reload();
        });

		$("#refresh-pemb-uk").click(function(e) {
            e.preventDefault();
            load_process();
			$('#tabel-pemb-uk').DataTable().ajax.reload();
        });

		$("#refresh-uk-siswa").click(function(e) {
            e.preventDefault();
            load_process();
			$('#table-result-uk').DataTable().ajax.reload();
        });
        
		$("#cek_uk").submit(function(e){
			e.preventDefault();
			var form = this;
			$("#cekkompetensi-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disable", true);
			var formdata = new FormData(form);
			$.ajax({
				url: "<?= base_url('Guru/DataTugas/cek_ujikompetensi?type=cek_uk') ?>",
				type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
				beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mengecek Uji Kompetensi Siswa",
                        text: "Silahkan Tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(response) {
                    $("#info-data").html(response.messages).attr("disabled", false).show();
                    if (response.success == true) {
                        $('.text-danger').remove();
                        swal.fire({
                            icon: 'success',
                            title: 'Penambahan Uji Kompetensi Berhasil',
                            text: 'Penambahan Uji Kompetensi sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#cek-uk').DataTable().ajax.reload();
                        $('#cekUjiKompetensimodal').modal('hide');
                        form.reset();
                        $("#cekkompetensi-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#cekkompetensi-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Uji Kompetensi Gagal", "Ada Kesalahan Saat penambahan pemberitahuan Uji Kompetensi!", "error");
                    $("#cekkompetensi-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
			});
		});

		$("#tabel-pemb-uk").on('click', '.edit-pemb-uk', function(e) {
			e.preventDefault();
			var id_pemb_uk = $(e.currentTarget).attr("data-uk-id");
			console.log(id_pemb_uk);
			if (id_pemb_uk === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('Guru/DataTugas/cek_ujikompetensi?type=update_uk') ?>",
				data: {
					id_pemb_uk: id_pemb_uk
				},
				beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Update Pemberitahuan",
                        text: "silahkan tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(data) {
					swal.close();
					$('#editPemberitahuanmodal').modal('show');
					$('#edit_pemberitahuan_uk').html(data);

					$('#edit_uk').submit(function(e) {
						e.preventDefault();
						var form = this;
						$("#editpemb_uk-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
						var formdata = new FormData(form);
						$.ajax({
							url: "<?= base_url('Guru/DataTugas/cek_ujikompetensi?type=do_updateuk') ?>",
							type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                    title: "Mengupdate Pemberitahuan",
                                    text: "silahkan tunggu",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },success: function(response) {
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Update Pemberitahuan Berhasil',
                                        text: 'Update pemberitahuan telah berhasil!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });	
									$('#tabel-pemb-uk').DataTable().ajax.reload();
									$('#editPemberitahuanmodal').modal('hide');
									form.reset();
									$("#editpemb_uk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
								} else {
									swal.close()
                                    $("#editpemb_uk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
								}
							},
							error: function() {
                                swal.fire("Update Pemberitahuan Gagal", "Ada Kesalahan Saat Update Pemberitahuan!", "error");
                                $("#editpemb_uk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
						});
					});
				}
			})
		});
		
		$(document).ready(function() {
			var id_uk = $("#pemb_uk").val();
			console.log(id_uk);
			$('#table-result-uk').DataTable({
				aLengthMenu: [
					[25, 50, 100, 200, -1],
					[25, 50, 100, 200, "All"]
				],
				iDisplayLength: -1,
				"language" : {
					"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
					"sEmptyTables" : "Tidads"
				},
				"ajax": {
					url: "<?= base_url('Guru/DataTugas/get_tabeluk?type=data_uk_siswa'); ?>",
					type: 'POST',
					data : {
						id_uk : id_uk
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				},
			});
			$('#tabel-pemb-uk').DataTable({
				destroy: true,
				"language" : {
					"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
					"sEmptyTables" : "Tidads"
				},
				"lengthMenu": [[1, 3, 7, -1], [1, 3, 7, "All"]],
				"ajax": {
					url: "<?= base_url('Guru/DataTugas/get_tabeluk?type=info_uk_detail'); ?>",
					type: 'POST',
					data : {
						id_uk : id_uk
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				},
			});
		});

		$(document).ready(function() {
			var id_uk = $("#pemb_uk").val();
			console.log(id_uk);
			$('#table-result-ev-essay').DataTable({
				aLengthMenu: [
					[25, 50, 100, 200, -1],
					[25, 50, 100, 200, "All"]
				],
				iDisplayLength: -1,
				"language" : {
					"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
					"sEmptyTables" : "Tidads"
				},
				"ajax": {
					url: "<?= base_url('Guru/DataTugas/get_tabel_ev_essay?type=data_uk_siswa'); ?>",
					type: 'POST',
					data : {
						id_uk : id_uk
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				},
			});
			$('#tabel-pemb-uk').DataTable({
				destroy: true,
				"language" : {
					"url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
					"sEmptyTables" : "Tidads"
				},
				"lengthMenu": [[1, 3, 7, -1], [1, 3, 7, "All"]],
				"ajax": {
					url: "<?= base_url('Guru/DataTugas/get_tabel_ev_essay?type=info_uk_detail'); ?>",
					type: 'POST',
					data : {
						id_uk : id_uk
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				},
			});
		});
	</script>

	<script>
		// table data video pembelajaran
		$('#table_video').DataTable({
			"lengthMenu": [[10, 15, 25, -1], [10, 15, 25, "All"]],
			"ajax": {
                url: "<?= base_url('Guru/DataMateri/get_tablevideo'); ?>",
                type: 'GET',
                async: true,
                "processing": true,
                "serverSide": true,
                dataType: 'json',
                "bDestroy": true,
            },
			
            rowCallback: function(row, data, iDisplayIndex) {
				$('td:eq(0)', row).html();
            },
		});

		// crud tambah video pembelajaran
		$("#submit-video").submit(function(e){
			e.preventDefault();
			var form = this;
			$("#submitvideo-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disable", true);
			var formdata = new FormData(form);
			$.ajax({
				url: "<?= base_url('Guru/DataMateri/crud_datavideo?type=tambah_video') ?>",
				type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
				beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Menambahkan Video Pembelajaran",
                        text: "Silahkan Tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(response) {
                    $("#info-data").html(response.messages).attr("disabled", false).show();
                    if (response.success == true) {
                        $('.text-danger').remove();
                        swal.fire({
                            icon: 'success',
                            title: 'Penambahan Video Pembelajaran Berhasil',
                            text: 'Penambahan data video pembelajaran sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#table_video').DataTable().ajax.reload();
                        $('#addVideomodal').modal('hide');
                        form.reset();
                        $("#submitvideo-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#submitvideo-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Video Pembelajaran Gagal", "Ada Kesalahan Saat penambahan Video Pembelajaran!", "error");
                    $("#submitvideo-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
			});
		});
		// update data video pembelajaran
		$("#table_video").on('click', '.edit-video', function(e) {
			e.preventDefault();
			var id_video = $(e.currentTarget).attr("data-video-id");
			if (id_video === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('Guru/DataMateri/crud_datavideo?type=update') ?>",
				data: {
					id_video: id_video
				},
				beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Edit Video Pembelajaran",
                        text: "Silahkan Tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(data) {
					swal.close();
					$('#editVideomodal').modal('show');
					$('#updateVideoPembelajaran').html(data);

					$('#editvideo').submit(function(e) {
						e.preventDefault();
						var form = this;
						$("#editvideo-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
						var formdata = new FormData(form);
						$.ajax({
							url: "<?= base_url('Guru/DataMateri/do_updatevideo?type=update_video') ?>",
							type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                    title: "Menyimpan Video Pembelajaran",
                                    text: "Silahkan Tunggu",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },success: function(response) {
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Update Video Pembelajaran Berhasil',
                                        text: 'Update video pembelajaran sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });	
									$('#table_video').DataTable().ajax.reload();
									$('#editVideomodal').modal('hide');
									form.reset();
									$("#editvideo-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
								} else {
									swal.close()
                                    $("#editvideo-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
								}
							},
							error: function() {
                                swal.fire("Update Video Pembelajaran Gagal", "Ada kesalahan saat update video pembelajaran!", "error");
                                $("#editvideo-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
						});
					});
				}
			})
		});
		
		// Hapus Data Video
		$("#table_video").on('click', '.hapus-video', function(e) {
			e.preventDefault();
            var id_video = $(e.currentTarget).attr('data-video-id');
            if (id_video === '') return;
			Swal.fire({
                title: 'Hapus Video Pembelajaran Ini?',
                text: "Anda yakin ingin menghapus video ini!",
        	 	icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('Guru/DataMateri/crud_datavideo?type=hapus_video'); ?>',
                        data: {
                            id_video: id_video
                        },
						beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                title: "Menghapus Video Pembelajaran",
                                text: "Silahkan Tunggu",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
						success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Video Pembelajaran Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Video Pembelajaran Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#table_video').DataTable().ajax.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Video Pembelajaran Gagal", "Ada Kesalahan Saat menghapus video pembelajaran!", "error");
                        }
					});
                }
            })
        });
	</script>
	<script>
		$("#refresh-diskusi").click(function(e) {
            e.preventDefault();
            load_process();
			load_comment();
        });

		$('#berdiskusi').submit(function(e) {
            e.preventDefault();
            var form = this;
            var formdata = new FormData(form);
            $.ajax({
                url: "<?= base_url('Guru/RuangDiskusi/submit_diskusi'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    $("#info-data").html(response.messages).attr("disabled", false).show();
                    if (response.success == true) {
                        $('.text-danger').remove();
                        swal.fire({
                            icon: 'success',
                            title: 'Komentar Berhasil',
                            text: 'Penambahan komentar sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
    					$('#diskusi_id').val('0');
    					load_comment();
						form.reset();

                    }
                },
                error: function() {
                    swal.fire("Penambahan Komentar Gagal", "Ada Kesalahan Saat penambahan Komentar!", "error");
                }
            });
        });

		load_comment();

		function load_comment(){
			var id_info = $("#id_forum").val();
			console.log(id_info);
				$.ajax({
					type:"POST",
					url:"<?= base_url('Guru/RuangDiskusi/get_komentar') ?>",
					data: {
						id_info : id_info
					},
					dataType: 'json',
					success:function(reponse){
						$('#display_forum').html(reponse);
					}, error: function(reponse) {
		            	console.log(reponse.responseText)
		            }
				})
			}
			$(document).on('click', '.reply', function(e){
				var id_forum = $(e.target).attr("id-forum");
				$('#diskusi_id').val(id_forum);
				$('#isi_diskusi').focus();
			});
	</script>
	</body>
</html>