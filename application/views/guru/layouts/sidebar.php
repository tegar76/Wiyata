<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <!-- <div class="sidebar-brand-icon rotate-n-15">
        <i><img src="img/iconMiniNoBg.png" alt="Wiyata" width="50px"></i>
    </div> -->
    <div class="sidebar-brand-text mx-3"><img src="<?= base_url()?>assets/guru/img/Wiyata.png" alt="Wiyata" width="100px"></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?php if($this->uri->segment(3)=="index"){echo 'active"';} ?>">
      <a class="nav-link" href="<?= base_url('Guru/Dashboard/index')?>">
          <i><img src="<?= base_url()?>assets/guru/icons/db.png" width="15px" class="mt-n1"></i>
          <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Charts -->
  <li class="nav-item <?php if($this->uri->segment(3)=="data_siswa"){echo 'active"';} ?>">
      <a class="nav-link" href="<?= base_url('Guru/Dashboard/data_siswa')?>">
          <i><img src="<?= base_url()?>assets/guru/icons/ds.png" width="15px" class="mt-n1"></i>
          <span>Data Siswa</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

   <!-- Nav Item - Tables -->
   <li class="nav-item <?php if($this->uri->segment(2)=="DataMateri"){echo 'active"';} ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
          aria-expanded="true" aria-controls="collapseUtilities">
          <i><img src="<?= base_url()?>assets/guru/icons/dm.png" width="15px" class="mt-n1"></i>
          <span>Data Materi</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item <?php if($this->uri->segment(3)=="bahanajar"){echo 'active"';} ?>" href="<?= base_url('Guru/DataMateri')?>">Bahan Ajar</a>
              <a class="collapse-item <?php if($this->uri->segment(3)=="videoPembelajaran"){echo 'active"';} ?>" href="<?= base_url('Guru/DataMateri/videoPembelajaran')?>">Video Pembelajaran</a>
          </div>
      </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

   <!-- Nav Item - Tables -->
   <li class="nav-item <?php if($this->uri->segment(2)=="DataTugas"){echo 'active"';} ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
          aria-expanded="true" aria-controls="collapseUtilities2">
          <i><img src="<?= base_url()?>assets/guru/icons/dt.png" width="15px" class="mt-n1"></i>
          <span>Data Tugas</span>
      </a>
      <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item <?php if($this->uri->segment(3)=="latihansiswa"){echo 'active"';} ?>" href="<?= base_url('Guru/DataTugas/latihansiswa') ?>">Latihan Siswa</a>
              <a class="collapse-item <?php if($this->uri->segment(3)=="ujikompetensi"){echo 'active"';} ?>" href="<?= base_url('Guru/DataTugas/ujikompetensi')?>">Uji Kompetensi</a>
          </div>
      </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item <?php if($this->uri->segment(2)=="RuangDiskusi"){echo 'active"';} ?>">
      <a class="nav-link" href="<?= base_url('Guru/RuangDiskusi/')?>">
          <i><img src="<?= base_url()?>assets/guru/icons/rd.png" width="15px" class="mt-n1"></i>
          <span>Ruang Diskusi</span>
      </a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">  

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
