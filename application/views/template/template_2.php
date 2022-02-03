<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/theme/'); ?>img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('images/icon/favicon.png'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>E-diagnostic Test</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!--     Fonts and icons     -->
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

    <!-- CSS Files -->
    <link href="<?= base_url('assets/theme/'); ?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/theme/'); ?>css/gsdk-bootstrap-wizard.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?= base_url('assets/theme/'); ?>css/demo.css" rel="stylesheet" />
</head>

<style>
    .nav-pills>li>a {
        background-color: #53514f !important;
        text-transform: none;
        font-weight: bold;
    }

    .wizard-card[data-color="orange"] .moving-tab {
        text-transform: none;
        font-weight: bold;
        /* width: 0% !important; */
    }

    @media only screen and (max-device-width: 599px) {
        .nav-pills>li {
            width: 25% !important;
        }
    }

    /* @media (min-width: @screen-sm-min) {
        
    } */

    .set-full-height {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 100vh;
    }

    .c-corner-label {
        position: fixed;
        top: 0;
        right: 0;
        height: 50px;
        width: 200px;
        background-color: #ff5722;
        font-size: 25px;
        color: #ffffff;
        text-align: center;
        padding: 5px 0px 0px 0px;

    }
</style>

<body>


    <?php
    if (IS_TESTING) {
        echo '<div class="c-corner-label">
        TESTING
    </div>';
    }
    ?>

    <div class="image-container set-full-height" style="background-image: url('<?= base_url('assets/theme/'); ?>img/wizard.jpg')">


        <!--   Creative Tim Branding   -->
        <a href="<?= base_url(); ?>">
            <div class="logo-container">
                <div class="logo" style="border-radius:0px;border:none;">
                    <img src="<?= base_url('images/'); ?>unnes.png" style="width:50px;" />
                </div>
                <div class="brand" style="width:121px;">
                    E-diagnostic Test
                </div>
            </div>
        </a>



        <!--  Made With Get Shit Done Kit  -->
        <!-- <a href="" class="made-with-mk">
            <div class="brand">
                <div class="logo">
                    <img style="width: 25px;margin-left:3px;" src="<?= base_url('assets/theme/'); ?>img/user.png">
                </div>
            </div>
            <div class="made-with">Login <strong>Admin</strong></div>
        </a> -->

        <!--   Big container   -->
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">

                    <!--      Wizard container        -->
                    <div class="wizard-container">

                        <div class="card wizard-card" data-color="orange" id="wizardProfile">
                            <form action="" method="">
                                <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

                                <div class="wizard-header">
                                    <h3>

                                        <b>E-diagnostic</b> test<br>
                                        <small style="padding: 15px;">Merupakan sebuah tes untuk mengetahui pemahaman dan<br />
                                            miskonsepsi siswa terhadap materi yang dipelajari di sekolah
                                        </small>
                                    </h3>
                                </div>

                                <div class="wizard-navigation">
                                    <ul>
                                        <li style="width:25% !important;"><a href="#about" data-toggle="tab">Tentang</a></li>
                                        <li style="width:25% !important;"><a href="#account" data-toggle="tab">Siswa</a></li>
                                        <li style="width:25% !important;"><a href="#address" data-toggle="tab">Guru</a></li>
                                        <li style="width:25% !important;"><a href="#admin" data-toggle="tab">Admin</a></li>
                                    </ul>

                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane" id="about">
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <h4 class="info-text"> Kenapa menggunakan e-diagnotic test ?</h4>
                                                <table class="table">
                                                    <tr>
                                                        <td>1.</td>
                                                        <td>E-diagnostic test dapat digunakan oleh guru dan siswa</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2.</td>
                                                        <td>Penggunaanya sangat simpel</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3.</td>
                                                        <td>Siswa bisa langsung mengetahui hasil tes dan menerima umpan balik remediasi</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4.</td>
                                                        <td>Guru dapat membuat soal kapanpun dan dimanapun serta hasil analisis didapatkan secara instan</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5.</td>
                                                        <td>wizard-footer height-wizard</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h4 class="info-text"> Biodata</h4>
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div id="biodata"></div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="tab-pane" id="account">

                                        <div class="row">

                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div style="background: #f6f6f6;padding: 15px;border-radius: 4%;">
                                                    <h4 class="info-text"> Login Siswa </h4>
                                                    <div class="form-group">
                                                        <label for="">Username / E-mail</label>
                                                        <input type="text" id="f_User" class="form-control" placeholder="Username / E-mail">
                                                        <input class="hide" id="f_Sebagai" value="siswa" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" id="f_Password" class="form-control" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-right">
                                                            <button type="button" onclick="login()" class="btn btn-fill btn-warning btn-wd btn-sm">Login Sebagai Siswa</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-5" style="border-left: 1px solid #eaeaea;">
                                                <h4 class="info-text"> Daftar Sebagai Siswa </h4>
                                                <div class="form-group">
                                                    <label for="">Nama Lengkap</label>
                                                    <input type="text" class="form-control" placeholder="Nama Lengkap" id="r_Nama" style="text-transform:uppercase">
                                                    <input class="hide" id="r_Sebagai" value="siswa" type="text">
                                                    <p class="help-block">Menggunakan Huruf Kapital</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">NIS</label>
                                                    <input type="number" class="form-control" placeholder="Nomor Induk Siswa" id="r_NIS">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Kelas</label>
                                                    <select class="form-control" id="r_Kelas">
                                                        <option value="1">Kelas 1</option>
                                                        <option value="2">Kelas 2</option>
                                                        <option value="3">Kelas 3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Nama Sekolah</label>
                                                    <select id="r_Sekolah" class="form-control"></select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Nama Pengguna (Username)</label>
                                                    <input type="text" placeholder="Nama Pengguna" id="r_Username" class="form-control">
                                                    <p class="help-block">Tidak boleh menggunakan spasi</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">E-mail</label>
                                                    <input type="email" placeholder="E-mail" id="r_Email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <input type="text" class="form-control" placeholder="Password" id="r_Password">
                                                    <p class="help-block">Minimal 6 karakter</p>
                                                </div>
                                                <div class="form-group">
                                                    <div class="text-right">
                                                        <button type="button" onclick="registrasi()" class="btn btn-fill btn-warning btn-wd btn-sm">Kirim</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="address">
                                        <div class="row">
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div style="background: #f6f6f6;padding: 15px;border-radius: 4%;">
                                                    <h4 class="info-text"> Login Guru </h4>
                                                    <div class="form-group">
                                                        <label for="">Username / E-mail</label>
                                                        <input type="text" id="g_User" class="form-control" placeholder="Username / E-mail">
                                                        <input class="hide" id="g_Sebagai" value="guru" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" id="g_Password" class="form-control" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-right">
                                                            <button type="button" onclick="loginGuru()" class="btn btn-fill btn-warning btn-wd btn-sm">Login Sebagai Guru</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-5" style="border-left: 1px solid #eaeaea;">
                                                <h4 class="info-text"> Daftar Sebagai Guru </h4>

                                                <div>
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input class="form-control" autofocus="" placeholder="Nama Lengkap" id="s_Nama" style="text-transform:uppercase">
                                                        <p class="help-block">Menggunakan Huruf Kapital</p>
                                                        <input class="hide" value="guru" id="s_Sebagai">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Pengguna (Username)</label>
                                                        <input class="form-control" placeholder="Nama Pengguna" id="s_Username">
                                                        <p class="help-block">Tidak boleh menggunakan spasi</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>E-mail</label>
                                                        <input type="email" class="form-control" placeholder="E-mail" id="s_Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input class="form-control" placeholder="Password" id="s_Password">
                                                        <p class="help-block">Minimal 6 karakter</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="text-right">
                                                            <button type="button" onclick="registrasiGuru()" class="btn btn-fill btn-warning btn-wd btn-sm">Kirim</button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="admin">

                                        <div class="row">
                                            <div class="col-sm-5 col-sm-offset-4">
                                                <div style="background: #f6f6f6;padding: 15px;border-radius: 4%;">
                                                    <h4 class="info-text"> Login Admin </h4>
                                                    <div class="form-group">
                                                        <label for="">Username</label>
                                                        <input class="form-control" placeholder="Username" id="formAdminUsername">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" class="form-control" placeholder="Password" id="formAdminPassword">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-right">
                                                            <button type="button" onclick="loginAdmin()" class="btn btn-fill btn-warning btn-wd btn-sm">Login Sebagai Admin</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="wizard-footer height-wizard">
                                    <!-- <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Saya Siswa' />
                                        <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Finish' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                                    </div> -->
                                    <div class="clearfix"></div>
                                </div>

                            </form>
                        </div>
                    </div> <!-- wizard container -->
                </div>
            </div><!-- end row -->
        </div> <!--  big container -->

        <div class="footer">
            <div class="container">
                Made with <i class="fa fa-heart heart"></i> | <i class="fa fa-copyright" aria-hidden="true"></i> 2018 - 2023
            </div>
        </div>

    </div>

</body>

<!--   Core JS Files   -->
<script src="<?= base_url(); ?>assets/theme/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/theme/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/theme/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="<?= base_url(); ?>assets/theme/js/gsdk-bootstrap-wizard.js"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="<?= base_url(); ?>assets/theme/js/jquery.validate.min.js"></script>

<script>
    const base_url_js = '<?= base_url(); ?>';
    const validateEmail = (email) => {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };

    $(document).ready(function() {
        loadBiodata();
        loadSekolah();
    });

    function loadSekolah() {
        var url = base_url_js + '__crudMenuAdmin';

        var formData = {
            action: 'readSekolah'
        };

        $.post(url, {
            formData: formData
        }, function(jsonResult) {
            // console.log(jsonResult);
            let sekolah = '';
            if (jsonResult.length) {
                $.each(jsonResult, function(i, v) {
                    sekolah = sekolah + '<option value="' + v.ID + '">' + v.Name + '</option>';
                })
            }

            $('#r_Sekolah').html(sekolah);
        });
    }

    function loadBiodata() {
        var url = base_url_js + '__crudMenuAdmin';

        var formData = {
            action: 'readBiodata'
        };

        $.post(url, {
            formData: formData
        }, function(jsonResult) {
            var bd = (jsonResult.length > 0) ?
                jsonResult[0].Biodata : 'Belum ada biodata';
            // console.log(bd);
            $('#biodata').html(bd);
        });
    }

    function login() {
        var Sebagai = $('#f_Sebagai').val();
        var User = $('#f_User').val();
        var Password = $('#f_Password').val();

        if (User != '' && User != null &&
            Password != '' && Password != null) {

            // loadingButtonSM('#btnModalLogin');
            // $('.form-act, .btn-act').prop('disabled', true);


            var data = {
                action: 'checkLogin',
                Sebagai: Sebagai,
                User: User,
                Password: Password
            };

            var url = base_url_js + '__crudUser';

            $.post(url, {
                formData: data
            }, function(result) {

                setTimeout(function() {
                    if (result == 1 || result == '1') {
                        if (Sebagai == 'siswa') {
                            window.location.replace(base_url_js + 'siswa');
                        } else if (Sebagai == 'guru') {
                            window.location.replace(base_url_js + 'guru/list-soal');
                        } else {
                            window.location.replace(base_url_js);
                        }
                    } else {

                        alert('Username / EMail & Password tidak cocok');
                        // window.location.replace(base_url_js);

                        $('#btnModalLogin').html('Masuk');
                        $('.form-act, .btn-act').prop('disabled', false);
                    }
                }, 500);
            });
        }
    }

    function loginGuru() {
        var Sebagai = $('#g_Sebagai').val();
        var User = $('#g_User').val();
        var Password = $('#g_Password').val();

        if (User != '' && User != null &&
            Password != '' && Password != null) {

            // loadingButtonSM('#btnModalLogin');
            // $('.form-act, .btn-act').prop('disabled', true);


            var data = {
                action: 'checkLogin',
                Sebagai: Sebagai,
                User: User,
                Password: Password
            };

            var url = base_url_js + '__crudUser';

            $.post(url, {
                formData: data
            }, function(result) {

                setTimeout(function() {
                    if (result == 1 || result == '1') {
                        if (Sebagai == 'siswa') {
                            window.location.replace(base_url_js + 'siswa');
                        } else if (Sebagai == 'guru') {
                            window.location.replace(base_url_js + 'guru/list-soal');
                        } else {
                            window.location.replace(base_url_js);
                        }
                    } else {

                        alert('Username / EMail & Password tidak cocok');
                        // window.location.replace(base_url_js);

                        $('#btnModalLogin').html('Masuk');
                        $('.form-act, .btn-act').prop('disabled', false);
                    }
                }, 500);
            });
        }
    }

    function registrasi() {

        var Nama = $('#r_Nama').val();
        var Sebagai = $('#r_Sebagai').val();
        var NIS = $('#r_NIS').val();
        var Kelas = $('#r_Kelas').val();
        var Sekolah = $('#r_Sekolah').val();
        var Username = $('#r_Username').val();
        var Email = $('#r_Email').val();
        var Password = $('#r_Password').val();

        var fill = false;
        if (Sebagai == 'siswa') {
            if (Nama != '' && Nama != null &&
                NIS != '' && NIS != null &&
                Kelas != '' && Kelas != null &&
                Sekolah != '' && Sekolah != null &&
                Username != '' && Username != null &&
                Email != '' && Email != null &&
                Password != '' && Password != null && Password.length >= 6) {
                if (validateEmail(Email)) {
                    fill = true;
                } else {
                    alert('Format e-mail tidak sesuai');
                }
            }
        }

        if (fill) {

            // loadingPage('#mainModal');

            var data = {
                action: 'insertNewUser',
                dataInsert: {
                    Nama: Nama,
                    Sebagai: Sebagai,
                    NIS: NIS,
                    Kelas: Kelas,
                    Sekolah: Sekolah,
                    Username: Username.replaceAll(/\s/g, ''),
                    Email: Email,
                    Password: Password
                }
            };

            var url = base_url_js + '__crudUser';

            $.post(url, {
                formData: data
            }, function(result) {

                setTimeout(function() {
                    // $('#myModal').modal('hide');
                    alert('Pendaftaran berhasil');
                }, 500);

            });
        } else {
            alert('Semua form wajib diisi');
        }

    }

    function registrasiGuru() {

        var Nama = $('#s_Nama').val();
        var Sebagai = $('#s_Sebagai').val();
        var Username = $('#s_Username').val();
        var Email = $('#s_Email').val();
        var Password = $('#s_Password').val();

        console.log('Nama', Nama);
        console.log('Sebagai', Sebagai);
        console.log('Username', Username);
        console.log('Email', Email);
        console.log('Password', Password);

        var fill = false;
        if (Nama != '' && Nama != null &&
            Username != '' && Username != null &&
            Email != '' && Email != null &&
            Password != '' && Password != null && Password.length >= 6) {
            if (validateEmail(Email)) {
                fill = true;
            } else {
                alert('Format e-mail tidak sesuai');
            }
        }

        if (fill) {

            // loadingPage('#mainModal');

            var data = {
                action: 'insertNewUser',
                dataInsert: {
                    Nama: Nama,
                    Sebagai: Sebagai,
                    Username: Username,
                    Email: Email,
                    Password: Password
                }
            };

            var url = base_url_js + '__crudUser';

            $.post(url, {
                formData: data
            }, function(result) {

                setTimeout(function() {
                    // $('#myModal').modal('hide');
                    alert('Pendaftaran berhasil');

                    $('#s_Nama').val('');
                    $('#s_Username').val('');
                    $('#s_Email').val('');
                    $('#s_Password').val('');
                }, 500);

            });
        } else {
            alert('Semua form wajib diisi');
        }

    }

    function loginAdmin() {
        var formAdminUsername = $('#formAdminUsername').val();
        var formAdminPassword = $('#formAdminPassword').val();

        if (formAdminUsername != '' && formAdminUsername != null &&
            formAdminPassword != '' && formAdminPassword != null) {

            var url = base_url_js + '__crudMenuAdmin';

            var formData = {
                action: 'loginAdmin',
                Username: formAdminUsername,
                Password: formAdminPassword
            };

            $.post(url, {
                formData: formData
            }, function(jsonResult) {

                console.log(jsonResult);
                if (jsonResult.Status == 0 || jsonResult.Status == '0') {
                    alert('Username & Password tidak cocok');
                } else {
                    window.location.replace(base_url_js + 'admin/biodata');
                }

            });

        } else {
            alert('Username & Password harus diisi');
        }
    }
</script>

</html>