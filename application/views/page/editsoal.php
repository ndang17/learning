<?php echo $header; ?>


<?php $Indikator = (count($dataIndikator)>0)
    ? $dataIndikator[0]['Indikator'] : '-';

    $d = $dataSoal[0];
?>

<div class="container" style="margin-top: 70px;margin-bottom: 100px;">



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
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <hr/>
                <div class="well" style="padding: 15px;">
                    <div class="form-group">
                        <label>Soal</label>
                        <textarea rows="5" class="form-control" id="formSoal"><?= $d['Soal']; ?></textarea>
                    </div>

                    <div style="text-align: right;">
                        <button class="btn btn-success" id="add">Tambah Pilihan Jawaban</button>
                        <button class="btn btn-danger" id="remv">Hapus Pilihan Jawaban</button>
                        <input id="totalPilihan" class="hide" readonly value="<?= count($d['PilihanJawaban']); ?>">
                    </div>

                    <?php $no = 1;
                            foreach ($d['PilihanJawaban'] AS $item){ ?>
                        <div class="form-group">
                            <label>Pilihan Jawaban <?=$no?></label>
                            <textarea class="form-jawaban" id="formPilihan_<?=$no?>"><?=$item['Keterangan']; ?></textarea>
                        </div>
                    <?php $no++; } ?>

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
                        <input id="totalPilihanAlasan" class="hide" readonly value="<?= count($d['PilihanAlasan']); ?>">
                    </div>

                    <?php $no_a = 1;
                            foreach ($d['PilihanAlasan'] AS $itemA){ ?>
                                <div class="form-group">
                                    <label>Pilihan Alasan <?= $no_a; ?></label>
                                    <textarea class="form-alasan" id="formAlasan_<?=$no_a;?>"><?=$itemA['Keterangan'];?></textarea>
                                </div>
                    <?php $no_a++; } ?>

                    <div id="addPilihanAlasan"></div>

                    <hr/>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label style="color: green;">Pilihan Jawaban Alasan Benar</label>
                                <select class="form-control" id="formJawabanBenarAlasan"></select>
                            </div>
                        </div>
                    </div

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
</div>

<script>
    $(document).ready(function () {

        loadJawaban();
        loadJawabanAlasan();
        typeBahasan();

        $('#formSoal').summernote({
            height : 200,
            // width : 700,
            airMode : false
        });

        $('.form-jawaban,.form-alasan').summernote({
            height : 100,
            // width : 700,
            airMode : false
        });

    });



    function typeBahasan(){
        var formTypePembahasan = $('#formTypePembahasan').val();

        var valuePembahasan = "<?= $d['Pembahasan']; ?>";

        var v = '<div class="form-group">' +
            '                            <label>Link URL Pembahasan</label>' +
            '                            <input class="form-control" value="'+valuePembahasan+'" id="formPembahasan">' +
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

        var Jawaban = "<?= $d['Jawaban']; ?>";

        $('#formJawabanBenar').empty();
        for(var i=1;i<=parseInt(totalPilihan);i++){

            var sc = (parseInt(Jawaban)==i) ? 'selected' : '';

            $('#formJawabanBenar').append('<option value="'+i+'" '+sc+' >Pilihan '+i+'</option>');
        }

    }

    function loadJawabanAlasan(){
        var totalPilihanAlasan = $('#totalPilihanAlasan').val();

        var Jawaban = "<?= $d['JawabanAlasan']; ?>";

        $('#formJawabanBenarAlasan').empty();
        for(var i=1;i<=parseInt(totalPilihanAlasan);i++){
            var sc = (parseInt(Jawaban)==i) ? 'selected' : '';
            $('#formJawabanBenarAlasan').append('<option value="'+i+'" '+sc+'>Alasan '+i+'</option>');
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
            action : 'updateSoal',
            IDSoal : '<?= $d['ID']; ?>',
            soal : {
                IDIndikator : IDIndikator,
                Soal : formSoal,
                Jawaban : formJawabanBenar,
                JawabanAlasan : formJawabanBenarAlasan,
                TypePembahasan : formTypePembahasan,
                Pembahasan : formPembahasan,
                TypeSoal : TypeSoal,
                LastUpdated : moment().format('YYYY-MM-DD H:m:s')
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

</script>
