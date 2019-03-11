
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
<div class="well" style="padding: 15px;text-align: center;">
    <a href="<?php echo base_url('guru/buatsoal'); ?>" class="btn btn-success"><b>Buat Soal</b></a>
</div>
<hr/>

<div id="divLoadSOal"></div>



<script>

    $(document).ready(function () {
       loadListSoal();
    });

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
</script>