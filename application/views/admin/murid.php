

<?php print_r($this->session->all_userdata()); ?>

<div class="row">


    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th style="width: 1%">No</th>
                <th style="width: 15%">Nama</th>
                <th>Username</th>
                <th style="width: 15%"><i class="fa fa-cog"></i></th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach ($dataMurid as $item){ ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $item['Nama']; ?></td>
                    <td><?= $item['Username'].'<br/>'.$item['Email']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-default btnReset" data-id="<?= $item['ID']; ?>"><i class="fa fa-refresh"></i></button>
                        <!--                        <button class="btn btn-sm btn-danger btnDelete" data-id="--><?//= $item['ID']; ?><!--"><i class="fa fa-trash"></i></button>-->
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<script>

    $(document).on('click','.btnReset',function () {
        var ID = $(this).attr('data-id');

        $('#myModal .modal-header').html('<h4 class="modal-title">Reset Password</h4>');
        $('#myModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button> ' +
            '<button type="button" id="btnSavePasswordBaru" class="btn btn-success">Simpan</button>');
        $('#myModal .modal-body').html('<div class="row"><div class="col-md-6 col-md-offset-3">' +
            '<input class="hide" value="'+ID+'" id="formUserID" />' +
            '<input class="form-control" type="password" id="formPassword" placeholder="Password baru" />' +
            '<div class="checkbox">' +
            '  <label>' +
            '    <input onclick="showPassword()" type="checkbox" value="1"> Tampilkan password' +
            '  </label>' +
            '</div>' +
            '</div></div>');
        $('#myModal').modal('show');

        $('#btnSavePasswordBaru').click(function () {

            var formUserID = $('#formUserID').val();
            var formPassword = $('#formPassword').val();

            if(formPassword!='' && formPassword!=null){
                var formData = {
                    action : 'updateNewPassword',
                    ID : formUserID,
                    Password : formPassword
                };

                var url = base_url_js+'__crudMenuAdmin';

                $.post(url,{formData:formData},function (jsonResult) {
                    alert('Passeword berhasil dirubah');
                    setTimeout(function () {
                        $('#myModal').modal('hide');
                    },500);
                });
            } else {
                alert('Password baru tidak boleh kosong');
            }

        });

    });

    $(document).on('click','.btnDelete',function () {

        if(confirm('Menghapus guru, akan mengha'))

            var ID = $(this).attr('data-id');

    });

    function showPassword(){
        var x = document.getElementById('formPassword');
        if(x!=null){
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }


    }

</script>
