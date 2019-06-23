
<?php echo $header; ?>

<div class="container" style="margin-top: 70px;">

    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <a href="http://localhost:8080/learning/guru/list-soal" class="btn btn-warning"><i class="fa fa-arrow-circle-left margin-right"></i> Kembali ke halaman Guru</a>

            <div style="margin-top: 15px;background: lightyellow;
            border: 1px solid orangered;min-height: 50px;padding: 15px;"><h3 style="margin-top: 10px;"><?= $dataIndikator[0]['Indikator']; ?></h3></div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Tambah Pembahasan</h3>
            <div class="well">
                <div class="form-group">
                    <label>Tipe</label>
                    <select id="Type" class="form-control">
                        <option disabled selected>-- Pilih Tipe --</option>
                        <option value="1">Penjelasan</option>
                        <option value="2">Upload PDF</option>
                        <option value="3">URL Youtube</option>
                    </select>
                </div>

                <div id="viewForm"></div>

                <div class="form-group" style="text-align: right;">
                    <button class="btn btn-success" id="savePenjelasan" disabled>Simpan</button>
                </div>
            </div>
        </div>

        <div class="col-md-6" style="border-left: 1px solid #CCCCCC;">
            <h3>List Pembahasan</h3>
            <table class="table table-striped">

                <thead>
                <tr>
                    <th>No</th>
                    <th>Tipe</th>
                    <th>Detail</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="listPembahasan"></tbody>
            </table>
        </div>
    </div>

</div>

<script>

    $(document).ready(function () {
        loadPembahasan();
    });

    function loadPembahasan(){
        var IDIndikator = "<?= $IDIndikator; ?>";
        var data = {
            action : 'showPembahasan',
            IDIndikator : IDIndikator
        };

        var url = base_url_js+'__crudPembahasan';

        $.post(url,{formData : data},function (jsonResult) {

            $('#listPembahasan').empty();
            var no = 1;
            $.each(jsonResult,function (i,v) {

                var tipe = 'Link Youtube';
                var detail = '<a href="'+v.Link+'" target="_blank">'+v.Link+'</a>';
                if(v.Type==1 || v.Type=='1'){
                    tipe = 'Penjelasan';
                    detail = '<div style="overflow: auto;max-height: 100px;">'+v.Penjelasan+'</div>';
                } else if(v.Type==2 || v.Type=='2'){
                    tipe = 'PDF';
                    detail = '<b>'+v.FileDesc+'</b><br/><a class="btn btn-sm btn-default" href="'+base_url_js+'uploads/pembahasan/'+v.File+'" target="_blank">Download File</a>';
                }

                $('#listPembahasan').append('<tr>' +
                    '<td>'+(no++)+'</td>' +
                    '<td>'+tipe+'</td>' +
                    '<td>'+detail+'</td>' +
                    '<td><button data-id="'+v.ID+'" data-type="'+v.Type+'" class="btn btn-danger btndeletePembahasan"><i class="fa fa-trash"></i></button></td>' +
                    '</tr>');
            });

        });
    }

    $('#Type').change(function () {
        var Type = $('#Type').val();
        var ds = true;
        if(Type==1 || Type=='1'){
            $('#viewForm').html('<div class="form-group">' +
                '<label>Penjelasan</label>' +
                '<textarea id="Penjelasan"></textarea>' +
                '</div>');
            $('#Penjelasan').summernote({
                height : 200,
                // width : 700,
                airMode : false
            });
            ds = false;
        }
        else if(Type==2 || Type=='2'){
            $('#viewForm').html('' +
                '<div class="form-group">' +
                '<label>Keterangan</label>' +
                '<input type="text" class="form-control" id="form_file_desc" />' +
                '</div>' +
                '<form id="formFile" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="">' +
                '<div class="form-group">' +
                '<label>Pilih file (.pdf)</label>' +
                '<label class="btn btn-default btn-default-warning btn-block">   Browse ( pdf )' +
                '<input type="file" id="form_File" name="userfile" style="display: none;" accept="application/pdf"></label>' +
                '<p class="help-block">Maximum : 5Mb</p>' +
                '<div id="viewFile"></div>' +
                '</div>' +
                '</form>');
            ds = false;
        }
        else if(Type==3 || Type=='3'){
            $('#viewForm').html('<div class="form-group">' +
                '<label>Lint Youtube</label>' +
                '<input type="text" class="form-control" id="Link" />' +
                '</div>');
            ds = false;
        }

        $('#savePenjelasan').prop('disabled',ds);

    });

    $('#savePenjelasan').click(function () {

        loadingButton('#savePenjelasan');

        var IDIndikator = "<?= $IDIndikator; ?>";
        var Type = $('#Type').val();

        var Penjelasan = $('#Penjelasan').val();
        var Link = $('#Link').val();

        var form_file_desc = $('#form_file_desc').val();
        var FileDesc = (form_file_desc!='' && form_file_desc!=null
            && form_file_desc!== 'undefined')
            ? form_file_desc : '';

        var File = '';

        var data = {
            action : 'insertPembahasan',
            dataInsert : {
                IDIndikator : IDIndikator,
                Type : Type,
                Penjelasan : Penjelasan,
                File : File,
                FileDesc : FileDesc,
                Link : Link
            }
        };

        var url = base_url_js+'__crudPembahasan';
        
        $.post(url,{formData : data},function (jsonResult) {

           if(Type==2 || Type=='2'){
               uploadFile(jsonResult.insert_id);
           } else {
               toastr.success('Pembahasan ditambahkan','Sukses');
               setTimeout(function () {
                   window.location.href=''
               },500);
           }


        });

    });

    $(document).on('click','.btndeletePembahasan',function () {

        if(confirm('Apakah anda yakin?')){

            $('.btndeletePembahasan').prop('disabled',true);


            var ID = $(this).attr('data-id');
            var Type = $(this).attr('data-type');

            var data = {
                action : 'removePembahasan',
                ID : ID,
                Type : Type
            };

            var url = base_url_js+'__crudPembahasan';

            $.post(url,{formData : data},function (result) {
                toastr.success('Pembahasan terhapus','Sukses');
                setTimeout(function () {
                    window.location.href = '';
                },500);
            });


        }

    });

    $(document).on('change','#form_File',function () {
        readURL(this);
    });

    function readURL(input) {

        $('#UpdateEditFile').val(1);
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            console.log(input.files[0]);

            reader.onload = function(e) {
                // console.log(e.target.result);
                $('#viewFile').html('<div><b>Nama File : '+input.files[0].name+'</b><br/><b>Size : '+input.files[0].size+'</b></div>');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


    function uploadFile(InsertID) {


        var formData = new FormData( $("#formFile")[0]);

        var name = moment().unix()+'.pdf';

        var url = base_url_js+'upload_files?name='+name+'&id='+InsertID;

        $.ajax({
            url : url,  // Controller URL
            type : 'POST',
            data : formData,
            async : false,
            cache : false,
            contentType : false,
            processData : false,
            success : function(data) {

                console.log(data);
                if(data.Status ==0 || data.Status =='0'){
                    alert(data);
                    toastr.error(data.error,'Error');
                } else {
                    toastr.success('Pembahasan ditambahkan','Sukses');
                }
                window.location.href = '';
            }
        });
    }


</script>