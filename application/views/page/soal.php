
<style>
    .panelNoSOal {
        text-align: left;
        border-bottom: 1px solid #CCCCCC;
        font-size: 1.5em;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    .panelSoal {
        position: relative;
        margin-bottom: 15px;
        padding: 10px;
        margin-top: 15px;
        border: 1px solid #607d8b;
    }

    .list-ok {
        margin-top: 10px;
        border-left: 10px solid orangered;
        padding-left: 10px;
    }
    .panel-jawabantitle {
        border-bottom: 1px solid #CCCCCC;
        margin-bottom: 25px;
        padding-bottom: 10px;
    }

    .panelJawaban .panel-heading{
        border: 1px solid green;
        border-bottom: none;

    }
    .panelJawaban .panel-title {
        font-weight: bold;
    }
    .panelJawaban .panel-body{
        border: 1px solid green;
    }

    .panelAlasan .panel-heading{
        border: 1px solid #7282dc;
        border-bottom: none;

    }
    .panelAlasan .panel-title {
        font-weight: bold;
    }
    .panelAlasan .panel-body{
        border: 1px solid #7282dc;
    }
    .btn-rate {
        border-radius: 45px;
        border: 1px solid #333333;
        padding: 6px 8px;
    }

    .btn-rate:hover {
        border: 1px solid #333333;
    }
</style>

<div class="container" style="border-top: 15px solid #8ba8af;border-bottom: 15px solid #8ba8af;">

    <div class="row">
        <div class="col-md-12">
            <div class="panelSoal">
                <div class="panelNoSOal">
                    Soal <span id="viewNoSoal"></span>
                </div>
                <div id="showSoal"></div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-success panelJawaban">
                <div class="panel-heading">
                    <h4 class="panel-title">Jawaban</h4>
                </div>
                <div class="panel-body">
                    <div class="panel-jawabantitle">
                        <h4 class="list-ok">Jawaban</h4>
                    </div>

                    <div id="loadJawaban"></div>

                    <hr/>
                    <h4 class="list-ok">Tingkat Keyakinan Jawaban</h4>
                    <div style="text-align: center;margin-top: 30px;margin-bottom: 25px;">
                        <button class="btn btn-default btn-rate rate-jawaban" id="1"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate rate-jawaban" id="2"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate rate-jawaban" id="3"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate rate-jawaban" id="4"><i class="fa fa-star-o fa-2x"></i></button>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="panel panel-info panelAlasan">
                <div class="panel-heading">
                    <h4 class="panel-title">Alasan</h4>
                </div>
                <div class="panel-body">
                    <div class="panel-jawabantitle">
                        <h4 class="list-ok">Alasan Jawaban</h4>
                    </div>

                    <div id="loadAlasanJawaban"></div>


                    <hr/>
                    <h4 class="list-ok">Tingkat Keyakinan Alasan Jawaban</h4>
                    <div style="text-align: center;margin-top: 30px;margin-bottom: 25px;">
                        <button class="btn btn-default btn-rate rate-alasan" id="alasan_1"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate rate-alasan" id="alasan_2"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate rate-alasan" id="alasan_3"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate rate-alasan" id="alasan_4"><i class="fa fa-star-o fa-2x"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <hr/>
            <div style="text-align: right;">
                <input id="jawaban" class="hide">
                <input id="jawabanAlasan" class="hide">

                <input id="formIDNext" class="hide">

                <input id="formJawaban" class="hide">
                <input id="td_Jawaban" class="hide">

                <input id="formRaingJawaban" class="hide">
                <input id="td_RaingJawaban" class="hide">

                <input id="formAlasan" class="hide">
                <input id="td_Alasan" class="hide">

                <input id="formRatingAlasan" class="hide">
                <input id="td_RatingAlasan" class="hide">

<!--                <button class="btn btn-warning" style="float: left;"><i class="fa fa-arrow-circle-left" style="margin-right : 5px;"></i> Sebelumnya</button>-->
                <button id="nextSoal" class="btn btn-primary">Selanjutnya <span class="badge" id="nextSoalViewNomor"></span><i class="fa fa-arrow-circle-right" style="margin-left: 5px;"></i> </button>
                <button id="lihatHasil" class="btn btn-success hide">Selesai</button>
            </div>
            <hr/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="well">
                <div id="loadBtn"></div>
<!--                <button class="btn btn-sm btn-success">1</button>-->
<!--                <button class="btn btn-sm btn-danger">2</button>-->
<!--                <button class="btn btn-sm btn-default" disabled>3</button>-->
            </div>
        </div>
        <div class="col-md-2" style="text-align: center;">
            <div class="well">
                <h3 style="margin-top: 0px;margin-bottom: 0px;">00:80:00</h3>
            </div>

        </div>
    </div>
</div>


<script>
    
    $(document).ready(function () {
        loadSoal();
    });
    
    function loadSoal() {
        var url = base_url_js+'__crudSoal';

        var data = {
            action : 'testOnline',
            IDTest : '<?=$IDTest;?>'
        };

        $.post(url,{formData:data},function (result) {


            if(result==0 || result=='0'){

            } else {
                loadDetailSoal(result);
            }
        });

    }

    $(document).on('click','.btn-jump',function () {
        var IDTD = $(this).attr('data-id');
        loadDetailSoal(IDTD);
    });

    function loadDetailSoal(IDTD) {

        $('#nextSoal').prop('disabled',true);

        var url = base_url_js+'__crudSoal';

        var data = {
            action : 'getJumpSoalOnline',
            IDTest : '<?=$IDTest;?>',
            IDTD : IDTD
        };

        $.post(url,{formData:data},function (jsonResult) {
            console.log(jsonResult);

            $('.rate-jawaban').removeClass('btn-success');
            $('.rate-jawaban').addClass('btn-default');


            $('.rate-alasan').removeClass('btn-info');
            $('.rate-alasan').addClass('btn-default');

            // Load Soal
            $('#viewNoSoal').html(jsonResult.No);

            var Soal = jsonResult.Soal;

            // Load Rate Jawaban
            if(Soal.Jawaban_K!=null && Soal.Jawaban_K!=''){
                loadRate_Jawaban(Soal.Jawaban_K);
            }
            if(Soal.Alasan_K!=null && Soal.Alasan_K!=''){
                loadRate_Alasan(Soal.Alasan_K)
            }

            $('#showSoal').html(Soal.Soal);

            $('#jawaban').val(Soal.Kunci_Jawaban);
            $('#jawabanAlasan').val(Soal.Kunci_JawabanAlasan);


            // Load Pilihan Ganda
            var PilihanGanda = Soal.PilihanGanda;
            if(PilihanGanda.length>0){
                $('#loadJawaban').empty();
                $.each(PilihanGanda,function (i,v) {

                    var sc = (parseInt(Soal.Jawaban) == parseInt(v.Urutan)) ? 'checked' : '';

                    $('#loadJawaban').append('<div class="radio">' +
                        '                        <label>' +
                        '                            <input type="radio" '+sc+' name="optionJawaban" class="formPilihanGanda" id="optJawaban'+v.Urutan+'" value="'+v.Urutan+'">'+v.Keterangan+'</label>' +
                        '                    </div>');
                });

                if(Soal.Jawaban!='' && Soal.Jawaban!=null){
                    loadJawaban(Soal.Jawaban);
                }
            }

            // Load Alasan
            var AlasanJawaban = Soal.AlasanJawaban;
            if(AlasanJawaban.length>0){
                $('#loadAlasanJawaban').empty();
                $.each(AlasanJawaban,function (i,v) {

                    var sc = (parseInt(Soal.Alasan) == parseInt(v.Urutan)) ? 'checked' : '';

                    $('#loadAlasanJawaban').append('<div class="radio">' +
                        '                        <label>' +
                        '                            <input type="radio" '+sc+' name="optionAlasanJawaban" class="formPilihanGandaAlasan" id="optAlasanJawaban'+v.Urutan+'" value="'+v.Urutan+'">'+v.Keterangan+'</label>' +
                        '                    </div>');
                });

                if(Soal.Alasan!='' && Soal.Alasan!=null){
                    loadJawabanAlasan(Soal.Alasan);
                }
            }


            // Load Button
            var TotalBtn = jsonResult.Total;
            $('#loadBtn').html('');
            for(var i=1;i<=TotalBtn;i++){
                var b = (i!=TotalBtn) ? ' - ' : '';

                var btn_ac = '<button id="btn_'+i+'" class="btn btn-sm btn-default" disabled>'+i+'</button>'
                if(jsonResult.Terjawab.length>=i){

                    btn_ac = '<button id="btn_'+i+'" data-id="'+jsonResult.Terjawab[i-1]+'" class="btn btn-sm btn-success btn-jump">'+i+'</button>'
                }

                $('#loadBtn').append(btn_ac+''+b);
            }

            $('#btn_'+jsonResult.No).removeClass('btn-default btn-success')
                .addClass('btn-danger').prop('disabled',false);

            $('#nextSoal').prop('disabled',false);
            $('#nextSoal').attr('data-id',jsonResult.IDNext);

            $('#formIDNext').val(jsonResult.IDNext);

            var nonext = (jsonResult.No == (parseInt(jsonResult.Terjawab.length)+1))
                ? (parseInt(jsonResult.Terjawab.length)+2)
                : (parseInt(jsonResult.Terjawab.length)+1);

            $('#nextSoalViewNomor').html('No : '+nonext);

            if(parseInt(nonext)>= parseInt(jsonResult.Total)){
                $('#nextSoal').addClass('hide');
                $('#lihatHasil').removeClass('hide');
            } else {
                $('#nextSoal').removeClass('hide');
                $('#lihatHasil').addClass('hide');
            }


        });

    }


    // PEMBAHASAN
    $(document).on('change','.formPilihanGanda',function () {
        var p = $('.formPilihanGanda:checked').val();
        loadJawaban(p);
    });

    function loadJawaban(p){
        var jawaban = $('#jawaban').val();

        var v =(parseInt(jawaban)==parseInt(p)) ? 'Benar' : 'Salah';
        $('#formJawaban').val(v);
        $('#td_Jawaban').val(p);

        loadNilaiKategori();
    }

    $('.rate-jawaban').click(function () {
        $('.rate-jawaban').removeClass('btn-success');
        $('.rate-jawaban').addClass('btn-default');

        var id = $(this).attr('id');
        loadRate_Jawaban(id);

    });

    function loadRate_Jawaban(id) {
        for(var i=1;i<=parseInt(id);i++){
            $('#'+i).removeClass('btn-default');
            $('#'+i).addClass('btn-success');
        }

        var v = (parseInt(id)>=3) ? 'Tinggi' : 'Rendah';

        $('#formRaingJawaban').val(v);
        $('#td_RaingJawaban').val(id);

        loadNilaiKategori();
    }


    $(document).on('change','.formPilihanGandaAlasan',function () {
        var p = $('.formPilihanGandaAlasan:checked').val();
        loadJawabanAlasan(p);
    });
    function loadJawabanAlasan(p){
        var jawabanAlasan = $('#jawabanAlasan').val();

        var v =(parseInt(jawabanAlasan)==parseInt(p)) ? 'Benar' : 'Salah';
        $('#formAlasan').val(v);
        $('#td_Alasan').val(p);

        loadNilaiKategori();
    }

    $('.rate-alasan').click(function () {
        $('.rate-alasan').removeClass('btn-info');
        $('.rate-alasan').addClass('btn-default');

        var id = $(this).attr('id').split('_')[1];

        loadRate_Alasan(id);

    });

    function loadRate_Alasan(id) {
        for(var i=1;i<=parseInt(id);i++){
            $('#alasan_'+i).removeClass('btn-default');
            $('#alasan_'+i).addClass('btn-info');
        }

        var v = (parseInt(id)>=3) ? 'Tinggi' : 'Rendah';

        $('#formRatingAlasan').val(v);
        $('#td_RatingAlasan').val(id);

        loadNilaiKategori();
    }


    function loadNilaiKategori() {
        var formJawaban = $('#formJawaban').val();
        var formRaingJawaban = $('#formRaingJawaban').val();
        var formAlasan = $('#formAlasan').val();
        var formRatingAlasan = $('#formRatingAlasan').val();

        if(formJawaban!='' && formJawaban!=null &&
            formRaingJawaban!='' && formRaingJawaban!=null &&
        formAlasan!='' && formAlasan!=null &&
        formRatingAlasan!='' && formRatingAlasan!=null){

            var IDTD = $('#formIDNext').val();

            var td_Jawaban = $('#td_Jawaban').val();
            var td_RaingJawaban = $('#td_RaingJawaban').val();
            var td_Alasan = $('#td_Alasan').val();
            var td_RatingAlasan = $('#td_RatingAlasan').val();

            var url = base_url_js+'__crudSoal';
            var data = {
                action: 'getHasilKombinasi',
                IDTest : '<?=$IDTest;?>',
                IDTD : IDTD,
                Jawaban : formJawaban,
                RatingJawaban : formRaingJawaban,
                Alasan : formAlasan,
                RatingAlasan : formRatingAlasan,
                dataUpdate : {
                    Jawaban : td_Jawaban,
                    Jawaban_K : td_RaingJawaban,
                    Alasan : td_Alasan,
                    Alasan_K : td_RatingAlasan,
                    Status : '1'
                }
            };

            $.post(url,{formData:data},function (result) {
                $('#nextSoal').attr('data-id',result);
            });

        }

    }

    $('#nextSoal').click(function () {


        var formJawaban = $('#formJawaban').val();
        var formRaingJawaban = $('#formRaingJawaban').val();
        var formAlasan = $('#formAlasan').val();
        var formRatingAlasan = $('#formRatingAlasan').val();

        if(formJawaban!='' && formJawaban!=null &&
            formRaingJawaban!='' && formRaingJawaban!=null &&
            formAlasan!='' && formAlasan!=null &&
            formRatingAlasan!='' && formRatingAlasan!=null){

            $('#nextSoal').prop('disabled',true);

            var IDTD = $(this).attr('data-id');
            loadDetailSoal(IDTD);

            setTimeout(function () {
                $("html, body").animate({scrollTop: 0}, 1000);
            },1000);


        } else {
            alert('Lengkapi jawaban terlebih dahulu');
        }

    });

    $('#lihatHasil').click(function () {

        var formJawaban = $('#formJawaban').val();
        var formRaingJawaban = $('#formRaingJawaban').val();
        var formAlasan = $('#formAlasan').val();
        var formRatingAlasan = $('#formRatingAlasan').val();

        if(formJawaban!='' && formJawaban!=null &&
            formRaingJawaban!='' && formRaingJawaban!=null &&
            formAlasan!='' && formAlasan!=null &&
            formRatingAlasan!='' && formRatingAlasan!=null){

            alert('Ok cuy lihat hasilmu');


        } else {
            alert('Lengkapi jawaban terlebih dahulu');
        }
    });

    
</script>