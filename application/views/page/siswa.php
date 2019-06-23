
<style>
    .tb-list {
        text-align: center;
        padding: 10px;
        margin-bottom: 7px;
    }
    .timeTes {
        margin-top: 3px;
        font-size: 15px;
    }
    .tb-blm-selesai {
        background: #f5f5f5;
    }
    .tb-selesai {

    }
</style>


<?php echo $header; ?>



<div class="container" style="margin-top: 70px;">

<!--    <pre>-->
<!--    --><?php //print_r($this->session->all_userdata()); ?>
<!--</pre>-->

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Profil</h4>
                        </div>
                        <div class="panel-body">
                            <div style="text-align: center;">
                                <img src="<?php echo base_url('images/icon/boy.png'); ?>" style="width: 100%;max-width: 100px;">
                                <h3><?= $this->session->userdata('Nama'); ?>
                                    <br/>
                                    <small>
                                        <a><?= $this->session->userdata('Email'); ?></a>
                                        <br/><?= $this->session->userdata('NIS'); ?>
                                        <hr/>username : <?= $this->session->userdata('Username'); ?></small></h3>
                                <a href="<?php echo base_url('logOut'); ?>" class="btn btn-danger">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="alert alert-warning" role="alert">
                        <b>Aturan E-Diagnostic Test</b>
                        <ol>
                            <li>Waktu pengerjaan 30 menit</li>
                            <li>Boleh menggunakan sisa waktu ujian untuk mengoreksi jawaban sebelum jawaban dikirim</li>
                        </ol>
                    </div>
                    <div class="well" id="viewMulaiBtn" style="padding: 15px;text-align: center;">
                        <button class="btn btn-success" id="btnMulai"><b>Mulai</b> E-Diagnostic Test</button>
                    </div>
                    <hr/>
                    <div id="listTesting"></div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
       loadTest();
    });

    function loadTest(){
        var url = base_url_js+'__crudSoal';
        var data = {
            action : 'loadListTest'
        };

        $.post(url,{formData:data},function (jsonResult) {
            loadingPage('#listTesting');
            console.log(jsonResult);
            if(jsonResult.length>0){
                $('#listTesting').html('');
                $.each(jsonResult,function (i,v) {

                    var Details = v.Details;

                    var btnAct = '';

                    if(Details.length>0){
                        $.each(Details,function (i2,v2) {

                            var timer = (v2.Time != null) ? v2.Time : '00:00:00';

                            var btnAct2 = (v2.Status==1 || v2.Status=='1')
                                ? '<div class="col-md-4"><a href="'+base_url_js+'hasil/'+v2.ID+'" class="btn btn-primary btn-block btn-sm btn-act-test">Lihat hasil tes '+(i2 + 1)+' (Skor : '+v2.Score+')</a></div>'
                                : '<div class="col-md-4"><a href="'+base_url_js+'soal/'+v2.ID+'" class="btn btn-warning btn-block btn-sm btn-act-test">Lanjutkan ( '+timer+' )</a></div>';

                            btnAct = btnAct+''+btnAct2;

                        });
                    }



                    var cl = (v.Status==1 || v.Status=='1') ? 'tb-selesai' : 'tb-blm-selesai';

                    $('#listTesting').append('<div class="thumbnail tb-list '+cl+'">' +
                        '                       <div class="row">' +
                        '                           <div class="col-md-4"><div class="timeTes" >'+moment(v.DateTime).format('dddd, DD MMMM YYYY')+'</div></div>' +
                        '                           '+btnAct+
                        '                       </div>' +
                        '                    </div>');
                });
                $('#viewMulaiBtn').remove();
            }
            else {
                $('#listTesting').html('<div style="text-align:center;"><h4 style="color: #CCCCCC;">Tidak ada riwayat ujian</h4></div>');
            }
        });

    }

    $('#btnMulai').click(function () {
        if(confirm('Apakah anda yakin?')){

            var url = base_url_js+'__crudSoal';
            var data = {
              action : 'mulaiTest',
                Token : moment().unix()
            };

            $.post(url,{formData:data},function (jsonResult) {

                window.location.href = base_url_js+'soal/'+jsonResult.IDTest;
            });

        }
    });
</script>