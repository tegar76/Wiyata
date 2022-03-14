          <a class="navbar-brand" href="#"><img src="<?= base_url()?>assets/siswa/img/WIyataDark.png" alt="" width="100px"></a>

<input type="checkbox" id="lua-navbar-toggler" class="d-none" />

<label for="lua-navbar-toggler" class="navbar-toggler" data-toggle="collapse" data-target="#lua-navbar-content" aria-controls="lua-navbar-content" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</label>

<div class="collapse navbar-collapse" id="lua-navbar-content">
    <ul class="navbar-nav mr-auto"> </ul>
    <ul class="navbar-nav">
        <li class="nav-item <?php if($this->uri->segment(2)=="Profile"){echo 'active"';} ?>">
            <a class="nav-link " href="<?= base_url('Siswa/Profile')?>" >Profile</a>
        </li>
        <li class="nav-item <?php if($this->uri->segment(2)=="Materi" || $this->uri->segment(1) =="ruang_materi" ){echo 'active';} ?>">
            <a class="nav-link" href="<?= base_url('Siswa/Materi')?>">Materi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link logout" href="">Logout</a>
        </li>
    </ul>
</div>
</nav>

