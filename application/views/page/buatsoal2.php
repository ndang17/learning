<?php echo $header; ?>



<div class="container-fluid" style="margin-top: 70px;margin-bottom: 100px;">

    <div class="row">
        <div class="col-md-12">
            <a href="<?php echo base_url('guru/list-soal'); ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left margin-right"></i> Kembali ke halaman Guru</a>
            <hr/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div style="text-align: center;">
                <h3 style="margin-top: 0px;font-weight: bold;margin-bottom: 25px;">Soal 1</h3>
            </div>

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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color: green;">Pembahasan</label>
                            <select class="form-control" id="formTypePembahasan">
                                <option value="1">Link URL</option>
                                <option value="2">Unggah File</option>
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
                        <button id="btnSimpanSoal" class="btn btn-lg btn-primary">Simpan Soal 1</button>
                    </div>
                </div>
            </div>
            <hr/>
        </div>

        <div class="col-md-6">
            <div style="text-align: center;">
                <h3 style="margin-top: 0px;font-weight: bold;margin-bottom: 25px;">Soal 2</h3>
            </div>

            <div class="well" style="padding: 15px;">
                <div class="form-group">
                    <label>Soal</label>
                    <textarea rows="5" class="form-control" id="formSoal2"></textarea>
                </div>
                <div style="text-align: right;">
                    <button class="btn btn-success" id="add2">Tambah Pilihan Jawaban</button>
                    <button class="btn btn-danger" id="remv2">Hapus Pilihan Jawaban</button>
                    <input id="totalPilihan2" class="hide" readonly value="1">
                </div>

                <div class="form-group">
                    <label>Pilihan Jawaban 1</label>
                    <textarea id="formPilihan2_1"></textarea>
                </div>
                <div id="addPilihanJawaban2"></div>

                <hr/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color: green;">Pilihan Jawaban Benar</label>
                            <select class="form-control" id="formJawabanBenar2"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color: green;">Pembahasan</label>
                            <select class="form-control" id="formTypePembahasan2">
                                <option value="1">Link URL</option>
                                <option value="2">Unggah File</option>
                            </select>

                        </div>
                        <div id="viewTypePembahasan2"></div>

                    </div>
                </div>


                <div style="text-align: right;">
                    <button class="btn btn-success" id="addAlasan2">Tambah Pilihan Alasan</button>
                    <button class="btn btn-danger" id="remvAlasan2">Hapus Pilihan Alasan</button>
                    <input id="totalPilihanAlasan2" class="hide" readonly value="1">
                </div>

                <div class="form-group">
                    <label>Pilihan Alasan 1</label>
                    <textarea id="formAlasan2_1"></textarea>
                </div>
                <div id="addPilihanAlasan2"></div>

                <hr/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color: green;">Pilihan Jawaban Alasan Benar</label>
                            <select class="form-control" id="formJawabanBenarAlasan2"></select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div style="text-align: right;">
                        <button id="btnSimpanSoal2" class="btn btn-lg btn-primary">Simpan Soal 2</button>
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

        loadJawaban2();
        loadJawabanAlasan2();
        typeBahasan2();

        $('#formSoal,#formSoal2').summernote({
            height : 200,
            // width : 700,
            airMode : false
        });
        $('#formPilihan_1,#formAlasan_1,#formPilihan2_1,#formAlasan2_1').summernote({
            height : 100,
            // width : 700,
            airMode : false
        });
    });

    $('#formTypePembahasan').change(function () {
        typeBahasan();
    });

    $('#formTypePembahasan2').change(function () {
        typeBahasan2();
    });

    function typeBahasan(){
        var formTypePembahasan = $('#formTypePembahasan').val();

        var v = '<div class="form-group">' +
            '                            <label>Link URL</label>' +
            '                            <input class="form-control">' +
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
        var formJawabanBenar = $('#formJawabanBenar').val();
        var formJawabanBenarAlasan = $('#formJawabanBenarAlasan').val();
        var formTypePembahasan = $('#formTypePembahasan').val();

        var totalPilihan = $('#totalPilihan').val();
        var totalPilihanAlasan = $('#totalPilihanAlasan').val();

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
                Soal : formSoal,
                Jawaban : formJawabanBenar,
                JawabanAlasan : formJawabanBenarAlasan,
                TypePembahasan : formTypePembahasan,
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
                window.location.href='';
            },500);

        });


    });


    // SOAL 2
    $('#add2').click(function () {

        var totalPilihan = $('#totalPilihan2').val();
        var newTotal = parseInt(totalPilihan) + 1;

        var divPilihan = '<div class="form-group" id="divPilihan2'+newTotal+'">' +
            '                    <label>Pilihan Jawaban '+newTotal+'</label>' +
            '                    <textarea id="formPilihan2_'+newTotal+'"></textarea>' +
            '                </div>'
        $('#addPilihanJawaban2').append(divPilihan);

        $('#totalPilihan2').val(newTotal);

        $('#formPilihan2_'+newTotal).summernote({
            height : 100,
            // width : 700,
            airMode : false
        });

        loadJawaban2();

    });

    $('#remv2').click(function () {
        var totalPilihan = $('#totalPilihan2').val();

        if(parseInt(totalPilihan)>1){
            $('#divPilihan2'+totalPilihan).remove();

            var newTotal = parseInt(totalPilihan) - 1;

            $('#totalPilihan2').val(newTotal);
        } else {
            alert('Pilihan jawaban 1 tidak dapat dihapus');
        }

        loadJawaban2();

    });

    $('#addAlasan2').click(function () {

        var totalPilihanAlasan = $('#totalPilihanAlasan2').val();
        var newTotal = parseInt(totalPilihanAlasan) + 1;

        var divPilihan = '<div class="form-group" id="divAlasan2'+newTotal+'">' +
            '                    <label>Pilihan Alasan '+newTotal+'</label>' +
            '                    <textarea id="formAlasan2_'+newTotal+'"></textarea>' +
            '                </div>'
        $('#addPilihanAlasan2').append(divPilihan);

        $('#totalPilihanAlasan2').val(newTotal);

        $('#formAlasan2_'+newTotal).summernote({
            height : 100,
            // width : 700,
            airMode : false
        });

        loadJawabanAlasan2();

    });

    $('#remvAlasan2').click(function () {

        var totalPilihanAlasan = $('#totalPilihanAlasan2').val();

        if(parseInt(totalPilihanAlasan)>1){
            $('#divAlasan2'+totalPilihanAlasan).remove();

            var newTotal = parseInt(totalPilihanAlasan) - 1;

            $('#totalPilihanAlasan2').val(newTotal);
        } else {
            alert('Pilihan alasan 1 tidak dapat dihapus');
        }

        loadJawabanAlasan2();

    });

    function typeBahasan2(){
        var formTypePembahasan = $('#formTypePembahasan2').val();

        var v = '<div class="form-group">' +
            '                            <label>Link URL</label>' +
            '                            <input class="form-control">' +
            '                        </div>';

        if(formTypePembahasan==2 || formTypePembahasan=='2'){
            v = '<div class="form-group">' +
                '                            <label>Unggah File</label>' +
                '                            <input class="form-control" type="file">' +
                '                        </div>';
        }

        $('#viewTypePembahasan2').html(v);
    }

    function loadJawaban2() {
        var totalPilihan = $('#totalPilihan2').val();

        $('#formJawabanBenar2').empty();
        for(var i=1;i<=parseInt(totalPilihan);i++){
            $('#formJawabanBenar2').append('<option value="'+i+'">Pilihan '+i+'</option>');
        }

    }

    function loadJawabanAlasan2(){
        var totalPilihanAlasan = $('#totalPilihanAlasan2').val();

        $('#formJawabanBenarAlasan2').empty();
        for(var i=1;i<=parseInt(totalPilihanAlasan);i++){
            $('#formJawabanBenarAlasan2').append('<option value="'+i+'">Alasan '+i+'</option>');
        }
    }
</script>
