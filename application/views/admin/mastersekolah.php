
<style>
    #tableSekolah th, #tableSekolah td {
        text-align: center;
    }
</style>

<div class="row">

    <div class="col-md-12">
        <div style="text-align: right;">
            <button class="btn btn-primary" id="btnTambahSekolah">Tambah Sekolah</button>
        </div>
        <div id="loadSekolah"></div>
    </div>

</div>





<script>
    
    $('#btnTambahSekolah').click(function () {
        $('#myModal .modal-dialog').removeClass('modal-sm modal-lg');
        $('#myModal .modal-dialog').addClass('modal-sm');


        $('#myModal .modal-header').addClass('hide');
        $('#myModal .modal-footer').addClass('hide');

        $('#myModal .modal-body').html('<div class="row">' +
            '    <div class="col-md-12">' +
            '       <h3>Tambah data sekolah</h3><hr/>' +
            '        <div class="form-group">' +
            '            <label>Sekolah</label>' +
            '            <input class="form-control" id="formAddSekolah">' +
            '        </div>' +
            '        <div class="form-group">' +
            '            <label>Alamat</label>' +
            '            <textarea class="form-control" rows="3" id="formAddAlamat"></textarea>' +
            '        </div>' +
            '        <div class="form-group" style="text-align: right;">' +
            '            <button class="btn btn-default" data-dismiss="modal">Tutup</button> | ' +
            '            <button class="btn btn-primary" id="btnSimpanSekolah">Simpan</button>' +
            '        </div>' +
            '    </div>' +
            '</div>');

        $('#myModal').modal('show');


        $('#btnSimpanSekolah').click(function () {
            var formAddSekolah = $('#formAddSekolah').val();
            var formAddAlamat = $('#formAddAlamat').val();

            if(formAddSekolah!='' && formAddSekolah!=null &&
                formAddAlamat!='' && formAddAlamat!=null){

                loadingButton('#btnSimpanSekolah');


                var url = base_url_js+'__crudMenuAdmin';

                var formData = {
                    action : 'addDataSekolah',
                    dataInsert : {
                        Name : formAddSekolah,
                        Alamat : formAddAlamat
                    }
                };

                $.post(url,{formData:formData},function (jsonResult) {
                    toastr.success('Data Tersimpan','Sukses');
                    setTimeout(function () {
                        readSekolah();
                        $('#myModal').modal('hide');
                    },500);
                });
            }

        });

    });

    $(document).ready(function () {

        readSekolah();

    });

    function readSekolah() {

        var url = base_url_js+'__crudMenuAdmin';

        var formData = {
            action : 'readSekolah'
        };

        $.post(url,{formData:formData},function (jsonResult) {
            console.log(jsonResult);
            if(jsonResult.length>0){
                $('#loadSekolah').html('<table id="tableSekolah" class="table table-striped">' +
                    '    <thead>' +
                    '    <tr>' +
                    '        <th style="width: 5%;">No</th>' +
                    '        <th style="width: 25%;">Sekolah</th>' +
                    '        <th>Alamat</th>' +
                    '        <th style="width: 3%;"><i class="fa fa-cog"></i></th>' +
                    '    </tr>' +
                    '    </thead>' +
                    '    <tbody id="listSklh"></tbody>' +
                    '</table>');
                $.each(jsonResult,function (i,v) {
                    var alamat = (v.Alamat!=null && v.Alamat!='') ? v.Alamat : '';
                    $('#listSklh').append('<tr><td>'+(i+1)+'</td>' +
                        '<td style="text-align: left;">'+v.Name+'</td>'+
                        '<td style="text-align: left;">'+alamat+'</td>' +
                        '<td><button class="btn btn-sm btn-danger btnDelSekolah" data-id="'+v.ID+'" ><i class="fa fa-trash"></i></button></td>' +
                        '</tr>');
                });

            }
        });

    }

    // Remove Sekolah
    $(document).on('click','.btnDelSekolah',function () {

        if(confirm('Yakin hapus?')){
            var ID = $(this).attr('data-id');

            var url = base_url_js+'__crudMenuAdmin';

            var formData = {
                action : 'delDataSekolah',
                ID : ID
            };

            $.post(url,{formData:formData},function (jsonResult) {
                toastr.success('Data Terhapus','Sukses');
                setTimeout(function () {
                    readSekolah();
                },500);
            });

        }


    });

</script>