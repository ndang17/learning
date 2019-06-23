<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #f4f4f4;
    }

    .thumbnail{

        text-align: center;

        padding: 20px;

        border-radius: 0px;

        -webkit-box-shadow: -1px -1px 9px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px -1px 9px 0px rgba(0,0,0,0.75);
        box-shadow: -1px -1px 9px 0px rgba(0,0,0,0.75);
    }
    .thumbnail h3 {
        font-weight: bold;
        /*text-shadow: 1px 1px 1px #5E5E5E;*/
    }

    .thumbnail:hover {
        border: 1px solid #333333;
        background: #fdffea;
        cursor: pointer;
    }
    #main a {
        text-decoration: none;
    }
    .margin-right {
        margin-right: 5px;
    }
</style>

<div style="min-height: 100px;background: #8ba8af;text-align: center;padding: 20px;border-bottom: 9px solid #ffc107;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo base_url('images/unnes.png') ?>" style="max-width: 100%;max-width: 100px;">
                <h1 style="color: #FFFFFF;font-weight: bold;text-shadow: 2px 2px 2px #5E5E5E;">E-Diagnostic Test</h1>
            </div>
        </div>
    </div>
</div>

<div class="container" id="main" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-3">
            <a href="javascript:void(0);" id="btnSiswa">
                <div class="thumbnail">
                    <img src="<?php echo base_url('images/icon/siswa.png'); ?>" style="width: 100%;max-width: 100px;">
                    <h3>Saya Siswa</h3>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="javascript:void(0);" id="btnGuru">
                <div class="thumbnail">
                    <img src="<?php echo base_url('images/icon/guru.png'); ?>" style="width: 100%;max-width: 100px;">
                    <h3>Saya Guru</h3>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="javascript:void(0);" id="btnBiodata">
                <div class="thumbnail">
                    <img src="<?php echo base_url('images/icon/info.png'); ?>" style="width: 100%;max-width: 100px;">
                    <h3>Biodata</h3>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="javascript:void(0);" id="btnAdmin">
                <div class="thumbnail">
                    <img src="<?php echo base_url('images/icon/admin.png'); ?>" style="width: 100%;max-width: 100px;">
                    <h3>Admin</h3>
                </div>
            </a>
        </div>
    </div>

</div>




<script>

    $('#btnSiswa').click(function () {
        loadModalUser('siswa');
    });
    $('#btnGuru').click(function () {
        loadModalUser('guru');
    });

    $('#btnBiodata').click(function () {

        var url = base_url_js+'__crudMenuAdmin';

        var formData = {
            action : 'readBiodata'
        };

        $.post(url,{formData:formData},function (jsonResult) {
            $('#myModal .modal-dialog').removeClass('modal-sm modal-lg');
            // $('#myModal .modal-dialog').addClass('modal-lg');

            $('#myModal .modal-header').removeClass('hide');
            $('#myModal .modal-footer').removeClass('hide');
            $('#myModal .modal-header .modal-title').html('Biodata');

            var bd = (jsonResult.length>0) ? jsonResult[0].Biodata : 'Belum ada biodata';
            $('#myModal .modal-body').html(bd);

            $('#myModal').modal('show');

            // $('#myModal .modal-footer').addClass('hide');
        });

    });

    $('#btnAdmin').click(function () {
        $('#myModal .modal-dialog').removeClass('modal-sm modal-lg');
        $('#myModal .modal-dialog').addClass('modal-sm');


        $('#myModal .modal-header').addClass('hide');
        $('#myModal .modal-footer').addClass('hide');

        $('#myModal .modal-body').html('<h3>Login Admin</h3><table class="table">' +
            '    <tr>' +
            '        <td style="width: 20%;">Username</td>' +
            '        <td style="width: 1%;">:</td>' +
            '        <td>' +
            '            <input class="form-control" id="formAdminUsername">' +
            '        </td>' +
            '    </tr>' +
            '    <tr>' +
            '        <td>Password</td>' +
            '        <td>:</td>' +
            '        <td>' +
            '            <input type="password" class="form-control" id="formAdminPassword">' +
            '        </td>' +
            '    </tr>' +
            '    <tr>' +
            '        <td colspan="3" style="text-align: right;">' +
            '            <button class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button> | ' +
            '            <button class="btn btn-sm btn-primary" id="btnAdminLogin">Masuk</button>' +
            '        </td>' +
            '    </tr>' +
            '</table>');


        $('#myModal').modal('show');

        $('#btnAdminLogin').click(function () {
            var formAdminUsername = $('#formAdminUsername').val();
            var formAdminPassword = $('#formAdminPassword').val();

            if(formAdminUsername !='' && formAdminUsername!=null &&
                formAdminPassword !='' && formAdminPassword!=null){

                var url = base_url_js+'__crudMenuAdmin';

                var formData = {
                    action : 'loginAdmin',
                    Username : formAdminUsername,
                    Password : formAdminPassword
                };

                $.post(url,{formData:formData},function (jsonResult) {

                    console.log(jsonResult);
                    if(jsonResult.Status==0 || jsonResult.Status=='0'){
                        alert('Username & Password tidak cocok');
                    } else {
                        window.location.replace(base_url_js+'admin/biodata');
                    }

                });

            } else {
                alert('Username & Password harus diisi');
            }
        });

    });


    function loadModalUser(user){
        $('#myModal .modal-dialog').removeClass('modal-sm modal-lg');
        $('#myModal .modal-dialog').addClass('modal-sm');


        $('#myModal .modal-header').addClass('hide');
        $('#myModal .modal-footer').addClass('hide');

        $('#myModal .modal-body').html('<div id="mainModal">' +
            '<div class="row" style="text-align: center;">' +
            '    <div class="col-md-12">' +
            '       <h3 style="margin-top: 5px;margin-bottom: 15px;padding-bottom: 15px;border-bottom: 1px solid #ccc;">'+ucWord(user)+'</h3>' +
            '   </div>' +
            '    <div class="col-md-6">' +
            '        <button class="btn btn-primary btn-block" data-usr="'+user+'" id="loginAct">Masuk</button>' +
            '    </div>' +
            '    <div class="col-md-6">' +
            '        <button class="btn btn-success btn-block" data-usr="'+user+'" id="RegistrasiAct">Daftar</button>' +
            '    </div>' +
            '    </div>' +
            '</div>');

        $('#myModal').modal('show');

    }


    $(document).on('click','#loginAct',function () {
        var user = $(this).attr('data-usr');

        loadingPage('#mainModal');

        setTimeout(function () {
            $('#mainModal').html('<div class="row">' +
                '    <div class="col-md-12">' +
                '        <div class="form-group">' +
                '            <label>Username / E-mail</label>' +
                '            <input class="form-control form-act" autofocus placeholder="Username / E-mail" id="f_User" type="text">' +
                '            <input class="hide" id="f_Sebagai" value="'+user+'" type="text">' +
                '        </div>' +
                '        <div class="form-group">' +
                '            <label>Password</label>' +
                '            <input class="form-control form-act" placeholder="Password" id="f_Password" type="password">' +
                '        </div>' +
                '        <div style="text-align: right;">' +
                '            <button class="btn btn-default btn-act" data-usr="'+user+'" id="RegistrasiAct" style="float: left;"><i class="fa fa-chevron-left margin-right"></i> Daftar</button>' +
                '            <button class="btn btn-default btn-act" data-dismiss="modal">Tutup</button>' +
                '            <button class="btn btn-primary btn-act" id="btnModalLogin">Masuk</button>' +
                '        </div>' +
                '    </div>' +
                '</div>');
        },500);
    });

    $(document).on('click','#RegistrasiAct',function () {

        loadingPage('#mainModal');
        // Get sekolah

        var user = $(this).attr('data-usr');

        var url = base_url_js+'__crudMenuAdmin';

        var formData = {
            action : 'readSekolah'
        };

        $.post(url,{formData:formData},function (jsonResult) {


            var sekolah = '';
            if(jsonResult.length>0){
                $.each(jsonResult,function (i,v) {
                   sekolah = sekolah + '<option value="'+v.ID+'">'+v.Name+'</option>';
                });
            }


            var formNIS = (user=='siswa') ? '' : 'hide';
            setTimeout(function () {
                $('#mainModal').html('<div class="row">' +
                    '    <div class="col-md-12">' +
                    '        <div class="form-group">' +
                    '            <label>Nama Lengkap</label>' +
                    '            <input class="form-control" autofocus placeholder="Nama Lengkap" id="f_Nama">' +
                    '            <input class="hide" value="'+user.toLowerCase()+'" id="f_Sebagai">' +
                    '        </div>' +
                    '        <div class="form-group '+formNIS+'">' +
                    '            <label>NIS</label>' +
                    '            <input class="form-control" placeholder="Nomor Induk Siswa" id="f_NIS">' +
                    '        </div>' +
                    '        <div class="form-group '+formNIS+'">' +
                    '            <label>Kelas</label>' +
                    '            <input class="form-control" placeholder="Kelas" type="number" id="f_Kelas">' +
                    '        </div>' +
                    '        <div class="form-group '+formNIS+'">' +
                    '            <label>Nama Sekolah</label>' +
                    '            <select class="form-control" id="f_Sekolah">'+sekolah+'</select>' +
                    // '            <input class="form-control" placeholder="Nama Sekolah" type="text" id="f_Sekolah">' +
                    '        </div>' +
                    '        <div class="form-group">' +
                    '            <label>Nama Pengguna (Username)</label>' +
                    '            <input class="form-control" placeholder="Nama Pengguna" id="f_Username">' +
                    '            <p class="help-block">Tidak boleh menggunakan spasi</p>' +
                    '        </div>' +
                    '        <div class="form-group">' +
                    '            <label>E-mail</label>' +
                    '            <input class="form-control" placeholder="E-mail" id="f_Email">' +
                    '        </div>' +
                    '        <div class="form-group">' +
                    '            <label>Password</label>' +
                    '            <input class="form-control" placeholder="Password" id="f_Password">' +
                    '        </div>' +
                    '        <div style="text-align: right;">' +
                    '            <button class="btn btn-default" data-usr="'+user+'" id="loginAct" style="float: left;"><i class="fa fa-chevron-left margin-right"></i> Masuk</button>' +
                    '            <button class="btn btn-default" data-dismiss="modal">Tutup</button>' +
                    '            <button class="btn btn-success" id="btnInModalDaftar">Daftar</button>' +
                    '        </div>' +
                    '    </div>' +
                    '</div>');
            },500);

        });


        
    });

    $(document).on('click','#btnInModalDaftar',function () {

        var Nama = $('#f_Nama').val();
        var Sebagai = $('#f_Sebagai').val();
        var NIS = $('#f_NIS').val();
        var Kelas = $('#f_Kelas').val();
        var Sekolah = $('#f_Sekolah').val();
        var Username = $('#f_Username').val();
        var Email = $('#f_Email').val();
        var Password = $('#f_Password').val();

        var fill = true;
        if(Sebagai=='siswa'){
            if(Nama !='' && Nama!=null &&
            NIS !='' && NIS!=null &&
            Kelas !='' && Kelas!=null &&
            Sekolah !='' && Sekolah!=null &&
            Username !='' && Username!=null &&
            Email !='' && Email!=null &&
            Password !='' && Password!=null){
                fill = true;
            } else {
                fill = false;
            }
        } else {
            if(Nama !='' && Nama!=null &&
                Username !='' && Username!=null &&
                Email !='' && Email!=null &&
                Password !='' && Password!=null){
                fill = true;
            } else {
                fill = false;
            }
        }

        if(fill){

            loadingPage('#mainModal');

            var data = {
                action : 'insertNewUser',
                dataInsert : {
                    Nama : Nama,
                    Sebagai : Sebagai,
                    NIS : NIS,
                    Kelas : Kelas,
                    Sekolah : Sekolah,
                    Username : Username,
                    Email : Email,
                    Password : Password
                }
            };

            var url = base_url_js+'__crudUser';

            $.post(url,{formData : data},function (result) {

                setTimeout(function () {
                    $('#myModal').modal('hide');
                    alert('Pendaftaran berhasil');
                },500);

            });
        } else {
            alert('Semua form wajib diisi');
        }


    });

    $(document).on('click','#btnModalLogin',function () {
        var Sebagai = $('#f_Sebagai').val();
        var User = $('#f_User').val();
        var Password = $('#f_Password').val();

        if(User!='' && User!=null &&
            Password!='' && Password!=null){

            loadingButtonSM('#btnModalLogin');
            $('.form-act, .btn-act').prop('disabled',true);


            var data = {
                action : 'checkLogin',
                Sebagai : Sebagai,
                User : User,
                Password : Password
            };

            var url = base_url_js+'__crudUser';

            $.post(url,{formData:data},function (result) {

                setTimeout(function () {
                    if(result==1 || result=='1'){
                        if(Sebagai=='siswa'){
                            window.location.replace(base_url_js+'siswa');
                        } else if (Sebagai=='guru') {
                            window.location.replace(base_url_js+'guru/list-soal');
                        } else {
                            window.location.replace(base_url_js);
                        }
                    } else {

                        alert('Username / EMail & Password tidak cocok');
                        // window.location.replace(base_url_js);

                        $('#btnModalLogin').html('Masuk');
                        $('.form-act, .btn-act').prop('disabled',false);
                    }
                },500);
            });
        }

    });




</script>