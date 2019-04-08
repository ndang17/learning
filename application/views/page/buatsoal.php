<?php echo $header; ?>



<?php $Indikator = (count($dataIndikator)>0)
    ? $dataIndikator[0]['Indikator'] : '-'; ?>

<div class="container" style="margin-top: 70px;">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a href="<?php echo base_url('guru/list-soal'); ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left margin-right"></i> Kembali ke halaman Guru</a>

            <h3 style="text-align: center;margin-bottom: 25px;font-weight: bold;">-- Soal <?= $TypeSoal ?> --</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div style="padding: 3px 15px 3px 15px;background: #f5f5f5;border: 1px solid #CCCCCC;">
                <h4><?=$Indikator;?></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <hr/>
            <div class="well" style="padding: 15px;">
                <div class="form-group">
                    <label>Soal</label>
                    <textarea rows="5" class="form-control" id="formSoal"></textarea>
                </div>
                <div style="text-align: right;">
                    <button class="btn btn-success" id="add">Tambah Pilihan Jawaban</button>
                    <button class="btn btn-danger" id="remv">Hapus Pilihan Jawaban</button>
                    <input id="totalPilihan" class="hide" readonly value="1">
                </div>

                <div class="form-group">
                    <label>Pilihan Jawaban 1</label>
                    <textarea id="formPilihan_1"></textarea>
                </div>
                <div id="addPilihanJawaban"></div>

                <hr/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color: green;">Pilihan Jawaban Benar</label>
                            <select class="form-control" id="formJawabanBenar"></select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group hide">
                            <label style="color: green;">Pembahasan</label>
                            <select class="form-control" id="formTypePembahasan">
                                <option value="1">Link URL</option>
                                <option value="2" class="hide">Unggah File</option>
                            </select>

                        </div>
                        <div id="viewTypePembahasan"></div>

                    </div>
                </div>


                <div style="text-align: right;">
                    <button class="btn btn-success" id="addAlasan">Tambah Pilihan Alasan</button>
                    <button class="btn btn-danger" id="remvAlasan">Hapus Pilihan Alasan</button>
                    <input id="totalPilihanAlasan" class="hide" readonly value="1">
                </div>

                <div class="form-group">
                    <label>Pilihan Alasan 1</label>
                    <textarea id="formAlasan_1"></textarea>
                </div>
                <div id="addPilihanAlasan"></div>

                <hr/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color: green;">Pilihan Jawaban Alasan Benar</label>
                            <select class="form-control" id="formJawabanBenarAlasan"></select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div style="text-align: right;">
                        <button id="btnSimpanSoal" class="btn btn-lg btn-primary">Simpan Soal</button>
                    </div>
                </div>
            </div>
            <hr/>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        loadJawaban();
        loadJawabanAlasan();
        typeBahasan();

        $('#formSoal').summernote({
            height : 200,
            // width : 700,
            airMode : false,
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }
        });
        $('#formPilihan_1,#formAlasan_1').summernote({
            height : 100,
            // width : 700,
            airMode : false,
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }
        });
    });

    function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data: data,
            type: "POST",
            url: base_url_js+"upload_files",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                editor.insertImage(welEditable, url);
            }
        });
    }

    $('#formTypePembahasan').change(function () {
        typeBahasan();
    });

    function typeBahasan(){
        var formTypePembahasan = $('#formTypePembahasan').val();

        var v = '<div class="form-group">' +
            '                            <label>Link URL Pembahasan</label>' +
            '                            <input class="form-control" id="formPembahasan">' +
            '                        </div>';

        if(formTypePembahasan==2 || formTypePembahasan=='2'){
            v = '<div class="form-group">' +
                '                            <label>Unggah File</label>' +
                '                            <input class="form-control" type="file">' +
                '                        </div>';
        }

        $('#viewTypePembahasan').html(v);
    }

    $('#add').click(function () {

        var totalPilihan = $('#totalPilihan').val();
        var newTotal = parseInt(totalPilihan) + 1;

        var divPilihan = '<div class="form-group" id="divPilihan'+newTotal+'">' +
            '                    <label>Pilihan Jawaban '+newTotal+'</label>' +
            '                    <textarea id="formPilihan_'+newTotal+'"></textarea>' +
            '                </div>'
        $('#addPilihanJawaban').append(divPilihan);

        $('#totalPilihan').val(newTotal);

        $('#formPilihan_'+newTotal).summernote({
            height : 100,
            // width : 700,
            airMode : false
        });

        loadJawaban();

    });

    $('#remv').click(function () {
        var totalPilihan = $('#totalPilihan').val();

        if(parseInt(totalPilihan)>1){
            $('#divPilihan'+totalPilihan).remove();

            var newTotal = parseInt(totalPilihan) - 1;

            $('#totalPilihan').val(newTotal);
        } else {
            alert('Pilihan jawaban 1 tidak dapat dihapus');
        }

        loadJawaban();

    });


    $('#addAlasan').click(function () {

        var totalPilihanAlasan = $('#totalPilihanAlasan').val();
        var newTotal = parseInt(totalPilihanAlasan) + 1;

        var divPilihan = '<div class="form-group" id="divAlasan'+newTotal+'">' +
            '                    <label>Pilihan Alasan '+newTotal+'</label>' +
            '                    <textarea id="formAlasan_'+newTotal+'"></textarea>' +
            '                </div>'
        $('#addPilihanAlasan').append(divPilihan);

        $('#totalPilihanAlasan').val(newTotal);

        $('#formAlasan_'+newTotal).summernote({
            height : 100,
            // width : 700,
            airMode : false
        });

        loadJawabanAlasan();

    });

    $('#remvAlasan').click(function () {

        var totalPilihanAlasan = $('#totalPilihanAlasan').val();

        if(parseInt(totalPilihanAlasan)>1){
            $('#divAlasan'+totalPilihanAlasan).remove();

            var newTotal = parseInt(totalPilihanAlasan) - 1;

            $('#totalPilihanAlasan').val(newTotal);
        } else {
            alert('Pilihan alasan 1 tidak dapat dihapus');
        }

        loadJawabanAlasan();


    });

    function loadJawaban() {
        var totalPilihan = $('#totalPilihan').val();

        $('#formJawabanBenar').empty();
        for(var i=1;i<=parseInt(totalPilihan);i++){
            $('#formJawabanBenar').append('<option value="'+i+'">Pilihan '+i+'</option>');
        }

    }

    function loadJawabanAlasan(){
        var totalPilihanAlasan = $('#totalPilihanAlasan').val();

        $('#formJawabanBenarAlasan').empty();
        for(var i=1;i<=parseInt(totalPilihanAlasan);i++){
            $('#formJawabanBenarAlasan').append('<option value="'+i+'">Alasan '+i+'</option>');
        }
    }


    // Save Jawaban ===
    $('#btnSimpanSoal').click(function () {

        var formSoal = $('#formSoal').val();
        var IDIndikator = "<?=$IDIndikator; ?>";
        var TypeSoal = "<?=$TypeSoal; ?>";
        var formJawabanBenar = $('#formJawabanBenar').val();
        var formJawabanBenarAlasan = $('#formJawabanBenarAlasan').val();
        var formTypePembahasan = $('#formTypePembahasan').val();

        var totalPilihan = $('#totalPilihan').val();
        var totalPilihanAlasan = $('#totalPilihanAlasan').val();

        var formPembahasan = $('#formPembahasan').val();

        var arrPilihan = [];
        for(var i=1;i<=parseInt(totalPilihan);i++){
            var arr = {
                Urutan : i,
                Keterangan : $('#formPilihan_'+i).val()
            };
            arrPilihan.push(arr);
        }

        var arrAlasan = [];
        for(var i=1;i<=parseInt(totalPilihanAlasan);i++){
            var arr = {
                Urutan : i,
                Keterangan : $('#formAlasan_'+i).val()
            };
            arrAlasan.push(arr);
        }

        var data = {
            action : 'addSoal',
            soal : {
                IDIndikator : IDIndikator,
                Soal : formSoal,
                Jawaban : formJawabanBenar,
                JawabanAlasan : formJawabanBenarAlasan,
                TypePembahasan : formTypePembahasan,
                Pembahasan : formPembahasan,
                TypeSoal : TypeSoal,
                CreatedBy : sessionID,
                CreatedAt : moment().format('YYYY-MM-DD H:m:s')
            },
            arrPilihan : arrPilihan,
            arrAlasan : arrAlasan
        };

        var url = base_url_js+'__crudSoal';
        $.post(url,{formData:data},function (result) {

            setTimeout(function () {
                alert('Soal tersimpan');
                // window.location.href='';
                var IDIndikator = '<?= $IDIndikator ?>';
                var TypeSoal = '<?= $TypeSoal ?>';
                window.location.replace(base_url_js+'guru/editsoal/'+IDIndikator+'/'+TypeSoal);
            },500);

        });


    });

</script>
