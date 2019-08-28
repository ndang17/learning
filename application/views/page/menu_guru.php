<?php echo $header; ?>

<div class="container-fluid" style="margin-top: 70px;">
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Profil</h4>
                        </div>
                        <div class="panel-body">

<!--                                        --><?php //print_r($this->session->userdata); ?>

                            <div style="text-align: center;">
                                <div style="margin-bottom: 10px;"><img src="<?php echo base_url('images/icon/man.png'); ?>" style="width: 100%;max-width: 100px;"></div>
                                <button class="btn btn-sm btn-default">Ganti Foto</button>
                                <h3><?php echo $this->session->userdata('Nama'); ?><br/>
                                    <small><a><?php echo $this->session->userdata('Email'); ?></a>
                                        <br/>User ID : <?php echo $this->session->userdata('ID'); ?>
                                        <hr/>Username : <?php echo $this->session->userdata('Username'); ?></small></h3>
                                <a href="<?php echo base_url('logOut'); ?>" class="btn btn-danger">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">

                    <ul class="nav nav-tabs" style="margin-bottom: 30px;">
                        <li role="presentation" class="<?php if($this->uri->segment(2)=='list-soal'){echo 'active';} ?>"><a href="<?php echo base_url('guru/list-soal'); ?>">Soal</a></li>
                        <li role="presentation" class="<?php if($this->uri->segment(2)=='list-siswa'){echo 'active';} ?>"><a href="<?php echo base_url('guru/list-siswa'); ?>">Analisa 1</a></li>
                        <li role="presentation" class="<?php if($this->uri->segment(2)=='analisis-2'){echo 'active';} ?>"><a href="<?php echo base_url('guru/analisis-2'); ?>">Analisa 2</a></li>
                        <li role="presentation" class="<?php if($this->uri->segment(2)=='analisis-3'){echo 'active';} ?>"><a href="<?php echo base_url('guru/analisis-3/1'); ?>">Analisa 3</a></li>
                        <li role="presentation" class="<?php if($this->uri->segment(2)=='analisis-4'){echo 'active';} ?>"><a href="<?php echo base_url('guru/analisis-4'); ?>">Analisa 4</a></li>
                        <li role="presentation" class="<?php if($this->uri->segment(2)=='analisis-5'){echo 'active';} ?>"><a href="<?php echo base_url('guru/analisis-5'); ?>">Analisa 5</a></li>
                        <li role="presentation" class="<?php if($this->uri->segment(2)=='analisis-6'){echo 'active';} ?>"><a href="<?php echo base_url('guru/analisis-6'); ?>">Analisa 6</a></li>
                    </ul>

                    <?php echo $page; ?>
                </div>
            </div>

        </div>
    </div>
</div>