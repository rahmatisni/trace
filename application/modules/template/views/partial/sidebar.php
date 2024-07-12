<style>
.sidebar-img{
    width:auto;
    height:4rem !important;
    margin-left:1rem;
    margin: auto;
}

.sidebar-wrapper{
    background-color: #1f2d5a;
}
.sidebar-title {
    color:#ffffff !important;
}

.sidebar-wrapper .menu .sidebar-link span{
    color:#ffffff !important;
}

.sidebar-wrapper .menu .sidebar-link:hover {
    background-color: #EAC117 !important;
}

</style>
<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="<?=base_url()?>"><img class="sidebar-img" style="width:100%;" src="<?= base_url('assets/login-style/images/trace.png')?>" alt="Logo"></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <?php
            
            switch($this->session->role)
            {

                case '1' :
                    echo('<li class="sidebar-title">Menu CSO</li>

                        <li class="sidebar-item active">
                            <a href="'.base_url('cso').'" class="sidebar-link">
                                <i class="bi bi-stickies-fill"></i>
                                <span>Laporan Masuk</span>
                            </a>
                        </li>');
                break;
                case '2' :
                    echo('<li class="sidebar-title">Menu Command Center</li>

                        <li class="sidebar-item active">
                            <a href="'.base_url('commandcenter').'" class="sidebar-link">
                                <i class="bi bi-stickies-fill"></i>
                                <span>Laporan Masuk</span>
                            </a>
                        </li>');
                break;

                case '3' :
                    $tic=((($this->uri->segment(1)=='tic') && ($this->uri->segment(2)=='')) || ($this->uri->segment(2)=='index' || $this->uri->segment(1)=='dashboard'))?'active':'';
                    $formasi=(($this->uri->segment(1)=='tic') && ($this->uri->segment(2)=='formasi'))?'active':'';
                    $kendaraan=(($this->uri->segment(1)=='tic') && ($this->uri->segment(2)=='kendaraan'))?'active':'';
                    $petugas=(($this->uri->segment(1)=='tic') && ($this->uri->segment(2)=='petugas'))?'active':'';
                    $database=(($this->uri->segment(1)=='tic') && ($this->uri->segment(2)=='petugas'))?'active':'';
                    echo('<li class="sidebar-title">Menu TIC</li>

                            <li class="sidebar-item '.$tic.'">
                                <a href="'.base_url('tic').'" class="sidebar-link">
                                    <i class="bi bi-stickies-fill"></i>
                                    <span>Laporan Masuk</span>
                                </a>
                            </li>
                            <li class="sidebar-item '.$formasi.'">
                                <a href="'.base_url('tic/formasi').'" class="sidebar-link">
                                    <i class="bi bi-easel-fill"></i>
                                    <span>Formasi</span>
                                </a>
                            </li>

                            <li class="sidebar-item '.$kendaraan.'">
                                <a href="'.base_url('tic/kendaraan').'" class="sidebar-link">
                                    <i class="bi bi-exclude"></i>
                                    <span>Kendaraan</span>
                                </a>
                            </li> 
                            


                            <li class="sidebar-item '.$petugas.'">
                                <a href="'.base_url('tic/petugas').'" class="sidebar-link">
                                    <i class="bi bi-people-fill"></i>
                                    <span>Petugas</span>
                                </a>
                            </li>

                            
                          
                            
                        </li>');
                break;
//|| ($this->uri->segment(2)=='index'))
                case '4' :
                    $dashboard=((($this->uri->segment(1)=='management') && ( ($this->uri->segment(2)=='dashboard') || ($this->uri->segment(2)==''))))?'active':'';
                    $laporan=((($this->uri->segment(1)=='management') && ($this->uri->segment(2)=='laporan'))) ?'active':'';
                    $rekap=(($this->uri->segment(1)=='management') && ($this->uri->segment(2)=='rekapitulasi'))?'active':'';
                    $user=(($this->uri->segment(1)=='management') && ($this->uri->segment(2)=='user'))?'active':'';
                   
                    echo('<li class="sidebar-title">Menu Admin</li>
                        <li class="sidebar-item '.$dashboard.'">
                            <a href="'.base_url('management/dashboard').'" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item '.$laporan.'">
                            <a href="'.base_url('management/laporan').'" class="sidebar-link">
                                <i class="bi bi-stickies-fill"></i>
                                <span>Laporan Masuk</span>
                            </a>
                        </li>
                        <li class="sidebar-item '.$rekap.'">
                            <a href="'.base_url('management/rekapitulasi').'" class="sidebar-link">
                                <i class="bi bi-easel-fill"></i>
                                <span>Rekapitulasi</span>
                            </a>
                        </li>
                        <li class="sidebar-item '.$user.'">
                            <a href="'.base_url('management/user').'" class="sidebar-link">
                                <i class="bi bi-people-fill"></i>
                                <span>Management User</span>
                            </a>
                        </li>
                        
                       ');
                break;

            }
            

           

            
            
            
            ?>
            

        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>