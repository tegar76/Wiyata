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

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url()?>assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()?>assets/admin/js/main.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url()?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url()?>assets/admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url()?>assets/admin/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url()?>assets/admin/js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>

	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Pilih Kelas -->
    <script src="<?= base_url()?>assets/pilih_kelas_templatejs/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/pilih_kelas_template/js/popper.js"></script>
    <script src="<?= base_url()?>assets/pilih_kelas_template/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="<?= base_url()?>assets/pilih_kelas_template/js/main.js"></script>
    <!-- End Pilih kelas -->

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
        
    	$(".custom-file-input").on("change", function() {
			let fileName = $(this).val().split("\\").pop();
			$(this).next(".custom-file-label").addClass("selected").html(fileName);
		});
    </script>

	<!-- Script Ajax Logout Admin -->
	<script>
		// Logout Admin
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
						url: "<?= base_url(); ?>Admin/AuthAdmin/logout",
						beforeSend: function() {
							swal.fire({
								imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
								title: "Logging Out",
								text: "Silahkan Tunggu",
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

	<!-- Script Ajax menampilkan data tabel pada halaman admin -->
	<script>
		// Tabel Guru Dashboard
		$('#tabelgurudsb').DataTable({
			"lengthMenu": [[5, 7, 10, -1], [5, 7, 10, "All"]],
			"ajax": {
                url: "<?= base_url('Admin/Dashboard/table_dashboard?type=tabel_guru'); ?>",
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
		// Tabel Kelas Dashboard
		$('#tabelkelas').DataTable({
			"lengthMenu": [[5, 7, 10, -1], [5, 7, 10, "All"]],
			"ajax": {
                url: "<?= base_url('Admin/Dashboard/table_dashboard?type=tabel_kelas'); ?>",
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
		// Tabel Pesan Dashboard
		$('#tabelpesan').DataTable({
			"lengthMenu": [[5, 7, 10, -1], [5, 7, 10, "All"]],
			"ajax": {
                url: "<?= base_url('Admin/Dashboard/table_dashboard?type=tabel_pesan'); ?>",
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
	</script>

	<!-- Script Ajax Hapus Pesan Aduan -->
	<script>
		$("#tabelpesan").on('click', '.hapus-pesan', function(e) {
			e.preventDefault();
            var id_pesan = $(e.currentTarget).attr('data-pesan-id');
            if (id_pesan === '') return;
			Swal.fire({
                    title: 'Hapus Data Pesan Aduan Ini?',
                    text: "Anda yakin ingin menghapus pesan aduan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('Home/crud_pesan_aduan?type=deletepesan'); ?>',
                        data: {
                            id_pesan: id_pesan
                        },
						beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                title: "Menghapus Pesan Aduan",
                                text: "Silahkan Tunggu",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
						success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Pesan Aduan Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Pesan Aduan Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#tabelpesan').DataTable().ajax.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Pesan Aduan Gagal", "Ada Kesalahan Saat menghapus pesanaduan!", "error");
                        }
					});
                }
            })
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
		// table data guru
		$('#tabelguru').DataTable({
			"lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
			"ajax": {
                url: "<?= base_url('Admin/DataGuru/get_dataguru'); ?>",
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

		// refresh table data guru
		$("#refresh-tabel-guru").click(function(e) {
            e.preventDefault();
            load_process();
            $('#tabelguru').DataTable().ajax.reload();
        });

		// crud tambah data guru
		$("#tambahguru").submit(function(e){
			e.preventDefault();
			var form = this;
			$("#addguru-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disable", true);
			var formdata = new FormData(form);
			$.ajax({
				url: "<?= base_url('Admin/DataGuru/crud_dataguru?type=addguru') ?>",
				type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
				beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Menambahkan Data Guru",
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
                            title: 'Penambahan Guru Berhasil',
                            text: 'Penambahan data guru sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#tabelguru').DataTable().ajax.reload();
                        $('#addgurumodal').modal('hide');
                        form.reset();
                        $("#addguru-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addguru-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Data Guru Gagal", "Ada Kesalahan Saat penambahan data guru!", "error");
                    $("#addguru-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
			});
		});
		// Hapus Data Guru
		$("#tabelguru").on('click', '.hapus-guru', function(e) {
			e.preventDefault();
            var guru_id = $(e.currentTarget).attr('data-guru-id');
            if (guru_id === '') return;
			Swal.fire({
                title: 'Hapus Data Guru Ini?',
                text: "Anda yakin ingin menghapus guru ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('Admin/DataGuru/crud_dataguru?type=hapusguru'); ?>',
                        data: {
                            guru_id: guru_id
                        },
						beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                title: "Menghapus Data Guru",
                                text: "Silahkan Tunggu",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
						success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Guru Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Guru Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#tabelguru').DataTable().ajax.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Guru Gagal", "Ada Kesalahan Saat menghapus guru!", "error");
                        }
					});
                }
            })
        });
		// view data guru
		$("#tabelguru").on('click', '.view-guru', function(e) {
                e.preventDefault();
                var guru_id = $(e.currentTarget).attr('data-guru-id');
				console.log(guru_id);
                if (guru_id === '') return;
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('Admin/DataGuru/crud_dataguru?type=viewguru'); ?>',
                    data: {
                        guru_id: guru_id
                    },
                    beforeSend: function() {
                        swal.fire({
                            imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                            title: "Mempersiapkan Preview Guru",
                            text: "Silahkan Tunggu",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function(data) {
                        swal.close();
                        $('#viewgurumodal').modal('show');
                        $('#viewdataguru').html(data);

                    },
                    error: function() {
                        swal.fire("Preview Guru Gagal", "Ada Kesalahan Saat menampilkan data guru!", "error");
                    }
                });
            });
		// edit data guru
		$("#tabelguru").on('click', '.edit-guru', function(e) {
			e.preventDefault();
			var guru_id = $(e.currentTarget).attr("data-guru-id");
			if (guru_id === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('Admin/DataGuru/crud_dataguru?type=updateguru') ?>",
				data: {
					guru_id: guru_id
				},
				beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Edit Guru",
                        text: "Silahkan Tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(data) {
					swal.close();
					$('#editgurumodal').modal('show');
					$('#editdataguru').html(data);

					$('#editguru').submit(function(e) {
						e.preventDefault();
						var form = this;
						$("#editguru-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
						var formdata = new FormData(form);
						$.ajax({
							url: "<?= base_url('Admin/DataGuru/do_updateguru?type=updatedataguru') ?>",
							type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                    title: "Menyimpan Data Guru",
                                    text: "Silahkan Tunggu",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },success: function(response) {
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Edit Guru Berhasil',
                                        text: 'Edit guru sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });	
									$('#tabelguru').DataTable().ajax.reload();
									$('#editgurumodal').modal('hide');
									form.reset();
									$("#editguru-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
								} else {
									swal.close()
                                    $("#editguru-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
								}
							},
							error: function() {
                                swal.fire("Edit Guru Gagal", "Ada Kesalahan Saat pengeditan data guru!", "error");
                                $("#editguru-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
						});
					});
				}
			})
		});
	</script>
	<script>
		// table data siswa
		$("#id_kelas").on("change", function (e) {
			e.preventDefault();
			var id_kelas = $(e.currentTarget).val();
			if (id_kelas === '') return;
			$('#tabelsiswa').DataTable({
				destroy: true,
				"aLengthMenu": [
					[25, 50, 100, 200, -1],
					[25, 50, 100, 200, "All"]
				],
				iDisplayLength: -1,
				"ajax": {
					url: "<?= base_url('Admin/DataSiswa/get_datasiswa'); ?>",
					type: 'POST',
					data : {
						id_kelas : id_kelas
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
					
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				}
			});
		});

		function change_class(id_kelas) {
			$('#tabelsiswa').DataTable({
				destroy: true,
				"aLengthMenu": [
					[25, 50, 100, 200, -1],
					[25, 50, 100, 200, "All"]
				],
				iDisplayLength: -1,
				"ajax": {
					url: "<?= base_url('Admin/DataSiswa/get_datasiswa'); ?>",
					type: 'POST',
					data : {
						id_kelas : id_kelas
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,				
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				}
			});
		}
		// crud tambah data siswa
		$("#submitsiswa").submit(function(e){
			e.preventDefault();
			var form = this;
			$("#submitsiswa-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disable", true);
			var formdata = new FormData(form);
			var id_kelas = $('#kelas_siswa').val();
			$.ajax({
				url: "<?= base_url('Admin/DataSiswa/crud_datasiswa?type=tambahsiswa') ?>",
				type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
				beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Menambahkan Data Siswa",
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
                            title: 'Penambahan Siswa Berhasil',
                            text: 'Penambahan data siswa sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1000
                        });
						change_class(id_kelas);
                        $('#tabelsiswa').DataTable().ajax.reload();
                        $('#tambahsiswamodal').modal('hide');
                        form.reset();
                        $("#submitsiswa-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#submitsiswa-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Data Siswa Gagal", "Ada Kesalahan Saat penambahan data siswa!", "error");
                    $("#submitsiswa-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
			});
		});

		// view data siswa
		$("#tabelsiswa").on('click', '.view-siswa', function(e) {
            e.preventDefault();
            var id_siswa = $(e.currentTarget).attr('data-siswa-id');
			console.log(id_siswa);
            if (id_siswa === '') return;
            $.ajax({
               	type: "POST",
                url: '<?= base_url('Admin/DataSiswa/crud_datasiswa?type=viewsiswa'); ?>',
                data: {
                    id_siswa: id_siswa
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Preview Siswa",
                        text: "Silahkan Tunggu",
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

		// update data siswa
		$("#tabelsiswa").on('click', '.edit-siswa', function(e) {
			e.preventDefault();
			var id_siswa = $(e.currentTarget).attr("data-siswa-id");
			if (id_siswa === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('Admin/DataSiswa/crud_datasiswa?type=updatesiswa') ?>",
				data: {
					id_siswa: id_siswa
				},
				beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Edit Siswa",
                        text: "Silahkan Tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(data) {
					swal.close();
					$('#editsiswamodal').modal('show');
					$('#updatedatasiswa').html(data);

					$('#editsiswa').submit(function(e) {
						e.preventDefault();
						var form = this;
						$("#editsiswa-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
						var formdata = new FormData(form);
						$.ajax({
							url: "<?= base_url('Admin/DataSiswa/do_updatesiswa?type=updatedatasiswa') ?>",
							type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                    title: "Menyimpan Data Siswa",
                                    text: "Silahkan Tunggu",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },success: function(response) {
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Edit Siswa Berhasil',
                                        text: 'Edit siswa sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });	
									$('#tabelsiswa').DataTable().ajax.reload();
									$('#editsiswamodal').modal('hide');
									form.reset();
									$("#editsiswa-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
								} else {
									swal.close()
                                    $("#editsiswa-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
								}
							},
							error: function() {
                                swal.fire("Edit Siswa Gagal", "Ada Kesalahan Saat pengeditan data siswa!", "error");
                                $("#editsiswa-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
						});
					});
				}
			})
		});

		// Hapus Data Siswa
		$("#tabelsiswa").on('click', '.hapus-siswa', function(e) {
			e.preventDefault();
            var id_siswa = $(e.currentTarget).attr('data-siswa-id');
            if (id_siswa === '') return;
			Swal.fire({
                title: 'Hapus Data Siswa Ini?',
                text: "Anda yakin ingin menghapus siswa ini!",
        	 	icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('Admin/DataSiswa/crud_datasiswa?type=hapussiswa'); ?>',
                        data: {
                            id_siswa: id_siswa
                        },
						beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                title: "Menghapus Siswa",
                                text: "Silahkan Tunggu",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
						success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Siswa Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Siswa Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#tabelsiswa').DataTable().ajax.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Siswa Gagal", "Ada Kesalahan Saat menghapus siswa!", "error");
                        }
					});
                }
            })
        });
	</script>
	<script>
		// table data video pembelajaran
		$('#table_bahanajar').DataTable({
			"lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
			"ajax": {
                url: "<?= base_url('Admin/DataMateri/get_datatable?type=tb_bahanajar'); ?>",
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
		// crud tambah data siswa
		$("#submitbahanajar").submit(function(e){
			e.preventDefault();
			var form = this;
			$("#submitbahanajar-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disable", true);
			var formdata = new FormData(form);
			$.ajax({
				url: "<?= base_url('Admin/DataMateri/crud_bahanajar?type=tambah') ?>",
				type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
				beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Upload Bahan Ajar",
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
                            title: 'Upload Bahan Ajar Berhasil',
                            text: 'Upload bahan ajar sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#table_bahanajar').DataTable().ajax.reload();
                        $('#addbahanajarmodal').modal('hide');
                        form.reset();
                        $("#submitbahanajar-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close();
                        swal.fire({
                            icon: 'error',
                            title: 'Upload Bahan Ajar Gagal',
                            text: 'ada kesalahan saat upload bahan ajar!',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $("#submitbahanajar-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Upload Bahan Ajar Gagal", "Ada Kesalahan Saat Upload Bahan Ajar!", "error");
                    $("#submitbahanajar-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
			});
		});

		// update data bahan ajar
		$("#table_bahanajar").on('click', '.edit-bab', function(e) {
			e.preventDefault();
			var id_bab = $(e.currentTarget).attr("data-bab-id");
			if (id_bab === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('Admin/DataMateri/crud_bahanajar?type=update') ?>",
				data: {
					id_bab: id_bab
				},
				beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                        title: "Mempersiapkan Update Materi Bahan Ajar",
                        text: "Silahkan Tunggu",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
				success: function(data) {
					swal.close();
					$('#editbahanajarmodal').modal('show');
					$('#editDataBahanAjar').html(data);

					$('#editbahanajar').submit(function(e) {
						e.preventDefault();
						var form = this;
						$("#editbahanajar-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
						var formdata = new FormData(form);
						$.ajax({
							url: "<?= base_url('Admin/DataMateri/do_update_bahanajar?type=update') ?>",
							type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                    title: "Menyimpan Bahan Ajar",
                                    text: "Silahkan Tunggu",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },success: function(response) {
                                $("#info-edit").html(response.messages).attr("disabled", false).show();
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Update Bahan Ajar Berhasil',
                                        text: 'Update materi bahan ajar sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });	
									$('#table_bahanajar').DataTable().ajax.reload();
									$('#editbahanajarmodal').modal('hide');
									form.reset();
									$("#editbahanajar-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
								} else {
									swal.close();
									swal.fire({
										icon: 'error',
										title: 'Update Bahan Ajar Gagal',
										text: 'ada kesalahan saat update bahan ajar!',
										showConfirmButton: false,
										timer: 1000
									});
                                    $("#editbahanajar-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    // $("#info-edit").html(response.messages);
								}
							},
							error: function() {
                                swal.fire("Update Materi Bahan Ajar Gagal", "Ada kesalahan saat update Materi Bahan Ajar !", "error");
                                $("#editbahanajar-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
						});
					});
				}
			})
		});

		// Hapus Data Bahan Ajar
		$("#table_bahanajar").on('click', '.hapus-bab', function(e) {
			e.preventDefault();
            var id_bab = $(e.currentTarget).attr('data-bab-id');
            if (id_bab === '') return;
			Swal.fire({
                title: 'Hapus Semua Bahan Ajar Ini?',
                text: "Anda yakin ingin menghapus semua bahan ajar pada BAB ini!",
        	 	icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('Admin/DataMateri/crud_bahanajar?type=hapus'); ?>',
                        data: {
                            id_bab: id_bab
                        },
						beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                                title: "Menghapus Materi Bahan Ajar",
                                text: "Silahkan Tunggu",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
						success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Materi Bahan Ajar Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Materi Bahan Ajar Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#table_bahanajar').DataTable().ajax.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Materi Bahan Ajar Gagal", "Ada Kesalahan Saat menghapus Materi Bahan Ajar!", "error");
                        }
					});
                }
            })
        });
	</script>

	<script>
		// table data video pembelajaran
		$('#table_video').DataTable({
			"lengthMenu": [[10, 15, 25, -1], [10, 15, 25, "All"]],
			"ajax": {
                url: "<?= base_url('Admin/DataMateri/get_datatable?type=tb_video'); ?>",
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
				url: "<?= base_url('Admin/DataMateri/crud_datavideo?type=tambah_video') ?>",
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
				url: "<?= base_url('Admin/DataMateri/crud_datavideo?type=update') ?>",
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
							url: "<?= base_url('Admin/DataMateri/do_updatevideo?type=update_video') ?>",
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
                        url: '<?= base_url('Admin/DataMateri/crud_datavideo?type=hapus_video'); ?>',
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
</body>
</html>
