
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
                        <button class="btn btn-success btn-rate"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate"><i class="fa fa-star-o fa-2x"></i></button>
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
                        <button class="btn btn-info btn-rate"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate"><i class="fa fa-star-o fa-2x"></i></button>
                        <button class="btn btn-default btn-rate"><i class="fa fa-star-o fa-2x"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <hr/>
            <div style="text-align: right;">
                <button class="btn btn-warning" style="float: left;"><i class="fa fa-arrow-circle-left" style="margin-right : 5px;"></i> Sebelumnya</button>
                <button class="btn btn-primary">Selanjutnya <i class="fa fa-arrow-circle-right" style="margin-left: 5px;"></i> </button>
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

        $.post(url,{formData:data},function (jsonRssult) {

            console.log(jsonRssult);

            // Load Soal
            $('#viewNoSoal').html(jsonRssult.No);

            var Soal = jsonRssult.Soal;
            $('#showSoal').html(Soal.Soal);


            // Load Pilihan Ganda
            var PilihanGanda = Soal.PilihanGanda;
            if(PilihanGanda.length>0){
                $.each(PilihanGanda,function (i,v) {
                    $('#loadJawaban').append('<div class="radio">' +
                        '                        <label>' +
                        '                            <input type="radio" name="optionJawaban" id="optJawaban'+v.ID+'" value="'+v.ID+'">'+v.Keterangan+'</label>' +
                        '                    </div>');
                });
            }

            // Load Alasan
            var AlasanJawaban = Soal.AlasanJawaban;
            if(AlasanJawaban.length>0){
                $.each(AlasanJawaban,function (i,v) {
                    $('#loadAlasanJawaban').append('<div class="radio">' +
                        '                        <label>' +
                        '                            <input type="radio" name="optionAlasanJawaban" id="optAlasanJawaban'+v.ID+'" value="'+v.ID+'">'+v.Keterangan+'</label>' +
                        '                    </div>');
                });
            }


            // Load Button
            var TotalBtn = jsonRssult.Total;
            $('#loadBtn').html('');
            for(var i=1;i<=TotalBtn;i++){
                var b = (i!=TotalBtn) ? ' - ' : '';

                var btn_ac = '<button id="btn_'+i+'" class="btn btn-sm btn-default" disabled>'+i+'</button>'
                if(jsonRssult.Terjawab.length>=i){

                    btn_ac = '<button id="btn_'+i+'" data-id="'+jsonRssult.Terjawab[i-1]+'" class="btn btn-sm btn-success btn-jump">'+i+'</button>'
                }

                $('#loadBtn').append(btn_ac+''+b);
            }

            $('#btn_'+jsonRssult.No).removeClass('btn-default btn-success')
                .addClass('btn-danger').prop('disabled',false);



        });

    }
    
</script>