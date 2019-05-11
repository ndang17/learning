
<?php echo $header; ?>

<div class="container" style="margin-top: 70px;">

    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <a href="http://localhost:8080/learning/guru/list-soal" class="btn btn-warning"><i class="fa fa-arrow-circle-left margin-right"></i> Kembali ke halaman Guru</a>

            <div style="margin-top: 15px;background: lightyellow;border: 1px solid orangered;min-height: 50px;"></div>
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
            <table class="table">

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
                    detail = '<a>'+v.File+'</a>';
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
                '<form id="formFile" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="">' +
                '<div class="form-group">' +
                '<label>Pilih file (.pdf)</label>' +
                '<label class="btn btn-default btn-default-warning btn-block">   Browse ( pdf ) … <input type="file" id="form_File" name="userfile" style="display: none;" accept="application/pdf"></label>' +
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

        var File = '';

        var data = {
            action : 'insertPembahasan',
            dataInsert : {
                IDIndikator : IDIndikator,
                Type : Type,
                Penjelasan : Penjelasan,
                File : File,
                Link : Link
            }
        };

        var url = base_url_js+'__crudPembahasan';
        
        $.post(url,{formData : data},function (jsonResult) {
            toastr.success('Pembahasan ditambahkan','Sukses');
           if(Type==2 || Type=='2'){
               console.log(jsonResult);
               console.log('Lakukan Upload');
           } else {
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


    function uploadIjazah(id,Type,Name) {

        var TypeFiles = ($('#TypeFiles').val()!=''
            && $('#TypeFiles').val()!=null)
            ? $('#TypeFiles').val() : '';

        var formData = new FormData( $("#formFile")[0]);

        console.log(Type);

        var name = Name+'_'+TypeFiles+'_'+sessionNIP+'_'+moment().unix()+'.pdf';

        var url = base_url_js_server_ws+'human-resources/employees/upload_files2?name='+name+'&id='+id;

        $.ajax({
            url : url,  // Controller URL
            type : 'POST',
            data : formData,
            async : false,
            cache : false,
            contentType : false,
            processData : false,
            success : function(data) {
                // toastr.success(TypeFiles+' Uploaded','Success');
                alert(data);

                loadDocument();
            }
        });
    }


    function readURL(input) {

        $('#UpdateEditFile').val(1);
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#viewFile').html('<iframe src="'+e.target.result+'" height="150" style="width: 100%;"></iframe>');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>