
<style>
    .divDibuat {
        text-align: right;
        background: #f5f5f5;
        padding: 10px;
        font-size: 12px;
    }
    #divLoadSOal a {
        text-decoration: none;
        cursor: pointer;
    }

    .jawabanBenar {
        background: #d1ffd1;
    }
</style>


<!--<h4 style="border-left: 7px solid orangered;padding-left: 10px;">List Indikator</h4>-->

<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">List Indikator</h4>
        <div class="btn-group pull-right">
            <a href="#" class="btn btn-success btn-sm btnActIndikator" data-type="insert" data-id="">Tambah Indikator</a>
        </div>
    </div>insert
    <div class="panel-body">
        <div id="viewTableIndikator"></div>
    </div>
</div>

<hr/>

<!--<div class="well" style="padding: 15px;text-align: center;">-->
<!--    <a href="--><?php //echo base_url('guru/buatsoal'); ?><!--" class="btn btn-success"><b>Buat Soal</b></a>-->
<!--</div>-->
<!--<hr/>-->



<div id="divLoadSOal"></div>



<script>



    $(document).ready(function () {
       // loadListSoal();

       loadListIndikator();
    });

    function loadListIndikator() {

        $('#viewTableIndikator').html('<table class="table table-striped" id="tableIndikator">' +
            '                <thead>' +
            '                <tr>' +
            '                    <th style="width: 2%;">No</th>' +
            '                    <th>Indikator</th>' +
            '                    <th style="width: 40%;">Action</th>' +
            '                </tr>' +
            '                </thead>' +
            '                <tbody id="listIndikator"></tbody>' +
            '            </table>');

        var url = base_url_js+'__crudSoal';
        var data = {
            action : 'listIndikator',
            ID : sessionID
        };
        $('#divLoadSOal').empty();
        $.post(url,{formData:data},function (jsonResult) {
            // console.log(jsonResult);

            if(jsonResult.length>0){
                var no =1;
                $.each(jsonResult,function (i,v) {

                    // var dataSoal = ;

                    var btnSoal1 = (v.Soal1.length>0)
                        ? '<a href="'+base_url_js+'guru/editsoal/'+v.ID+'/1" class="btn btn-sm btn-primary">Soal 1</a>'
                        : '<a href="'+base_url_js+'guru/buatsoal/'+v.ID+'/1" class="btn btn-sm btn-primary">Soal 1</a>';

                    var btnSoal2 = (v.Soal2.length>0)
                        ? '<a href="'+base_url_js+'guru/editsoal/'+v.ID+'/2" class="btn btn-sm btn-warning">Soal 2</a>'
                        : '<a href="'+base_url_js+'guru/buatsoal/'+v.ID+'/2" class="btn btn-sm btn-warning">Soal 2</a>';



                    $('#listIndikator').append('<tr>' +
                        '<td style="border-right: 1px solid #ccc;">'+no+'</td>' +
                        '<td>'+v.Indikator+'</td>' +
                        '<td>'+btnSoal1+' '+btnSoal2+' | ' +
                        '<button class="btn btn-default btn-sm btnActIndikatorRemove" data-id="'+v.ID+'" style="color: red;"><i class="fa fa-trash"></i> Indikator</button> ' +
                        '<button class="btn btn-default btn-sm btnActIndikator" data-indikator="'+v.Indikator+'" data-id="'+v.ID+'"><i class="fa fa-edit"></i> Indikator</button>' +
                        '</td>' +
                        '</tr>');

                    no++;
                })
            }

            $('#tableIndikator').dataTable({
                ordering : false
            });
        });

    };

    function loadListSoal() {
        var url = base_url_js+'__crudSoal';
        var data = {
           action : 'readSoal',
           ID : sessionID
        };
        $('#divLoadSOal').empty();
        $.post(url,{formData:data},function (jsonResult) {
            if(jsonResult.length>0){
                $.each(jsonResult,function (i,v) {
                    $('#divLoadSOal').append('<div class="thumbnail" style="padding: 15px;">' +
                        '<a href="javascript:void(0);" class="swDetailSoal" data-id="'+v.ID+'">'+v.Soal+'</a>' +
                        '<div class="divDibuat">Dibuat : '+moment(v.CreatedAt).format('dddd, DD MMM YYYY')+' | ' +
                        '<button class="btn btn-sm btn-danger btnDeleteSoal" data-id="'+v.ID+'"><i class="fa fa-trash"></i></button></div>' +
                        '</div>');
                });
            } else {
                $('#divLoadSOal').html('<div class="thumbnail" style="text-align: center;"><h4>--- Belum ada soal ---</h4></div>');
            }
        });
    }

    $(document).on('click','.swDetailSoal',function () {

        var IDSoal = $(this).attr('data-id');

        var url = base_url_js+'__crudSoal';
        var data = {
            action : 'readDetailsSoal',
            IDSoal : IDSoal
        };
        $.post(url,{formData:data},function (jsonResult) {

            var d = jsonResult;

            $('#myModal .modal-dialog').removeClass('modal-sm modal-lg');

            $('#myModal .modal-header').addClass('hide');
            $('#myModal .modal-footer').addClass('hide');

            var vewHtml = '<div class="row">' +
                '    <div class="col-md-12">' +
                '        <div style="background: lightyellow;padding: 15px;margin-bottom: 15px;border: 1px solid #ccc;">'+d.Soal+'</div>' +
                '        <table class="table table-bordered">' +
                '            <tr>' +
                '                <th style="text-align: center;width: 1%;">No</th>' +
                '                <th style="text-align: center;">Pilihan Jawaban</th>' +
                '            </tr>' +
                '           <tbody id="listJawaban"></tbody>' +
                '        </table>' +
                '        <div class="well">Pembahasan : -</div>' +
                '        <table class="table table-bordered">' +
                '            <tr>' +
                '                <th style="text-align: center;width: 1%;">No</th>' +
                '                <th style="text-align: center;">Pilihan Alasan</th>' +
                '            </tr>' +
                '           <tbody id="listAlasan"></tbody>' +
                '        </table>' +
                '        <div style="text-align: right;">' +
                '            <button class="btn btn-default btn-act" data-dismiss="modal">Tutup</button>' +
                '        </div>' +
                '    </div>' +
                '</div>';

            $('#myModal .modal-body').html(vewHtml);

            var no = 1;
            for(var i=0;i<d.Details.length;i++){
                var j = d.Details[i];

                var cl = (d.Jawaban==j.Urutan) ? 'class="jawabanBenar"' : '';

                $('#listJawaban').append('<tr '+cl+'>' +
                    '<td style="text-align: center;">'+(no)+'</td>' +
                    '<td>'+j.Keterangan+'</td>' +
                    '</tr>');

                no += 1;
            }

            // ------ Alasan

            var no = 1;
            for(var i=0;i<d.DetailsAlasan.length;i++){
                var j = d.DetailsAlasan[i];

                var cl = (d.JawabanAlasan==j.Urutan) ? 'class="jawabanBenar"' : '';

                $('#listAlasan').append('<tr '+cl+'>' +
                    '<td style="text-align: center;">'+(no)+'</td>' +
                    '<td>'+j.Keterangan+'</td>' +
                    '</tr>');

                no += 1;
            }

            $('#myModal').modal('show');



        });
    });

    $(document).on('click','.btnDeleteSoal',function () {

        if(confirm('Hapus soal?')){
            var IDSoal = $(this).attr('data-id');

            var url = base_url_js+'__crudSoal';
            var data = {
                action : 'deleteSoal',
                IDSoal : IDSoal
            };

            loadingButtonSM('button[data-id='+IDSoal+']');
            $('.btnDeleteSoal').prop('disabled',true);
            $.post(url,{formData:data},function (result) {
                setTimeout(function () {
                    alert('Soal berhasil dihapus');
                    loadListSoal();
                },500);
            });
        }



    });

    // ======= Indikator
    $(document).on('click','.btnActIndikator',function () {

        var ID = $(this).attr('data-id');
        var indikator = (ID!='')
            ? $(this).attr('data-indikator') : '';

        $('#myModal .modal-title').html('Indikator');

        $('#myModal .modal-body').html('<div class="form-group">' +
            '    <label>Indikator</label>' +
            '    <input class="hide" id="formID" value="'+ID+'" >' +
            '    <input class="form-control" id="formIndokator" value="'+indikator+'" autofocus>' +
            '</div>');

        $('#myModal .modal-footer').html('<button type="button" id="btnIndikator" class="btn btn-success">Simpan</button> ' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>');

        $('#myModal').modal({
            show : true,
            backdrop : 'static'
        });

        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });

        $('#btnIndikator').click(function () {

            var formIndokator = $('#formIndokator').val();

            if(formIndokator!=''){

                loadingButton('#btnIndikator');
                $('button[data-dismiss=modal],#formIndokator').prop('disabled',true);

                var formID = $('#formID').val();

                var data = {
                    action : 'crudIndikator',
                    ID : formID,
                    Indikator : formIndokator,
                    CreatedBy : sessionID
                };

                var url = base_url_js+'__crudSoal';

                $.post(url,{formData:data},function (result) {

                    toastr.success('Data saved','Success');
                    loadListIndikator();
                    setTimeout(function () {
                        $('#myModal').modal('hide');
                    },500);
                });

            } else {
                toastr.error('Indikator harus di isi');
            }

        });


    });

    $(document).on('click','.btnActIndikatorRemove',function () {

        if(confirm('Jika indikator dihapus, maka soal didalamnya juga akan ' +
            'terhapus, anda yakin hapus?')){
            var ID = $(this).attr('data-id');

            var data = {
              action : 'removeIndikator',
              ID : ID
            };
            var url = base_url_js+'__crudSoal';

            $.post(url,{formData:data},function (result) {
                toastr.success('Data terhapus','Success');
                setTimeout(function () {
                    loadListIndikator();
                },500);
            });
        }

    });
</script>