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
                                <img src="<?php echo base_url('images/icon/man.png'); ?>" style="width: 100%;max-width: 100px;">
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
                        <li role="presentation" class="<?php if($this->uri->segment(2)=='list-siswa'){echo 'active';} ?>"><a href="<?php echo base_url('guru/list-siswa'); ?>">Siswa</a></li>
                    </ul>

                    <?php echo $page; ?>
                </div>
            </div>

        </div>
    </div>
</div>