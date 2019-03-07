
<style>
    body {
        /*background-color: #8ba8af;*/
    }

    .navbar-default {
        background-color: #8ba8af;
    }
</style>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: #FFFFFF;">
                E-Diagnostic Test
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container" style="margin-top: 70px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Profil</h4>
                        </div>
                        <div class="panel-body">
                            <div style="text-align: center;">
                                <img src="<?php echo base_url('images/icon/man.png'); ?>" style="width: 100%;max-width: 100px;">
                                <h3>Nandang Mulyadi <br/><small><a>nndg.ace3@gmail.com</a><br/>20199080<hr/>username : ndang17</small></h3>
                                <button class="btn btn-danger">Keluar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">

                    <ul class="nav nav-tabs" style="margin-bottom: 30px;">
                        <li role="presentation" class="active"><a href="#">Soal</a></li>
                        <li role="presentation"><a href="#">Siswa</a></li>
                    </ul>

                    <div class="well" style="padding: 15px;text-align: center;">
                        <button class="btn btn-success"><b>Buat Soal</b></button>
                    </div>
                    <hr/>
                    <div class="thumbnail" style="padding: 15px;">
                        <h4>Senin, 9 Januari 2019</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>