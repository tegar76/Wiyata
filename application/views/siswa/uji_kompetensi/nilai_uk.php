<div class="none mt-3 mb-5 mr-4">
    <h6 class="text-right">
		<a href="<?= base_url('Siswa/Materi') ?>" style="text-decoration: none;">Ruang Materi /</a> 
		<a href="<?= base_url('uji_kompetensi/Ujian/index/' . $this->secure->encrypt_url($data_bab['id_bab'])) ?>" style="text-decoration: none;">Uji Kompetensi /</a> 
		Nilai Uji Kompetensi BAB <?= $data_bab['bab_ke']?>
	</h6>
</div>

<div class="container mt-5 p-0">
    <div class="col d-flex justify-content-center">

        <div class="card shadow w-75 mb-4 bg-white p-3">

            <div class="card pt-1 pb-1" style="background-color: #86A4B7;">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center pb-3 mt-1">
                        <img src="<?= base_url() ?>assets/siswa/img/Wiyata.png" alt="Wiyata Logo" width="80px">
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <h4 class="text-white">NILAI UJI KOMPETENSI</h4>
                    </div>
                </div>
            </div>
            <div class="card">
                <table class="table-responsive mt-3">
                    <tr>
                        <td>Nama</td>
                        <td>: <?= $siswa['siswa_nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Nis</td>
                        <td>: <?= $siswa['siswa_nis'] ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>: <?= $siswa['kelas_nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Bab UK</td>
                        <td>: BAB <?= $data_bab['bab_ke'] . ' ' . $data_bab['bab_judul'] ?> </td>
                    </tr>
                    <tr>
                        <td>Jumlah Soal</td>
                        <td>: <?= $hasil_uk['jumlah_soal'] ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Benar</td>
                        <td>: <?= $hasil_uk['jumlah_benar'] ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Salah</td>
                        <td>: <?= $hasil_uk['jumlah_salah'] ?></td>
                    </tr>
                    <tr>
                        <td class="pr-5">Tidak Dijawab</td>
                        <td>: <?= $hasil_uk['tidak_dijawab'] ?></td>
                    </tr>
                    <tr>
                        <td class="pr-5">Nilai</td>
                        <td>: <?= $hasil_uk['nilai_uk'] ?></td>
                    </tr>
                </table>
            </div>

            <div class="d-flex justify-content-center pt-3">
                <a target="_blank" href="<?= base_url('uji_kompetensi/Ujian/cetak_nilai/' . $this->secure->encrypt_url($hasil_uk['id_uk_siswa'])) ?>" class="btn btn-sm btn-primary btn-sk btn-ks text-white border-0 w-25">Unduh</a>
            </div>

        </div>

    </div>
</div>
