
<style>
    body {
        background: #f5f5f5;
    }
    #tableHasil th, #tableHasil td {
        text-align: center;
    }

    #tableHasil th {
        background: #607d8b;
        color: #ffffff;
    }
</style>

<!--<pre>-->
<!--    --><?php //print_r($dataTest[0]); ?>
<!--</pre>-->

<div class="container" style="margin-top: 40px;margin-bottom: 100px;">

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <a href="<?= base_url('siswa'); ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left margin-right"></i> Kembali ke halaman utama</a>
            <hr/>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8 col-md-offset-1">

            <div class="thumbnail" style="min-height: 100px;padding: 15px;">

                <table class="table table-striped table-bordered" id="tableHasil">
                    <thead>
                    <tr>
                        <th>Soal</th>
                        <th style="width: 15%;">Hasil</th>
                        <th style="width: 15%;">Pembahasan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php


                    $no=1; foreach ($dataHasil AS $item){

                        $hasil = '<span class="label label-danger" style="font-size: 13px;"><i class="fa fa-times-circle margin-right"></i> '.$item['Keterangan'].'</span>';

                        if($item['IDKategori']=='2' || $item['IDKategori']==2){
                            $hasil = '<span class="label label-warning" style="font-size: 13px;"><i class="fa fa-info-circle margin-right"></i> '.$item['Keterangan'].'</span>';
                        } else if($item['IDKategori']=='1' || $item['IDKategori']==1){
                            $hasil = '<span class="label label-success" style="font-size: 13px;"><i class="fa fa-check-circle margin-right"></i> '.$item['Keterangan'].'</span>';
                        }

                        $pembahasan = ($item['IDKategori']=='1' || $item['IDKategori']==1) ? '-' : '<button class="btn btn-sm btn-default btnPembahasan" data-id="'.$item['IDIndikator'].'" data-indikator="'.$item['Indikator'].'" >Pembahasan</button>';
                        ?>
                        <tr>
                            <td style="text-align: left;">Soal <?= $no.' - '.$item['Indikator']; ?></td>
                            <td><?=$hasil;?></td>
                            <td><?= $pembahasan; ?></td>
                        </tr>
                    <?php $no++; } ?>
                    </tbody>
                </table>

                <?php if(count($dataTest)>0 && count($dataTest)<2 && $buttonRemidial=='1'){ ?>
                        <div style="text-align: right;">
                            <button class="btn btn-primary" data-id="<?=$dataTest[0]['ID']; ?>" data-token="<?=$dataTest[0]['Token']; ?>" id="btnTestUlang">Remidial</button>
                        </div>
                    <?php } ?>

            </div>
        </div>

        <div class="col-md-2">
            <div class="thumbnail" style="text-align: center;padding: 10px;">
                <h3 style="margin: 0px;">Skor</h3>
                <hr style="margin: 10px;"/>
                <h3 style="margin: 0px;"><b><?= round($dataScore[0]['Score'],2); ?></b></h3>
            </div>
        </div>

    </div>
</div>


<script>



    $('#btnTestUlang').click(function () {

        if(confirm('Apakah anda yakin?')){
            var ID = $(this).attr('data-id');
            var Token = $(this).attr('data-token');

            var url = base_url_js+'__crudSoal';
            var data = {
                action : 'mulaiTest2',
                ID : ID,
                Token : Token
            };

            $.post(url,{formData:data},function (jsonResult) {

                if(jsonResult.IDTest==0 || jsonResult.IDTest=='0'){
                    alert('Tidak bisa melakukan test ulang karna, semua jawaban anda tepat!');
                } else {
                    window.location.href = base_url_js+'soal/'+jsonResult.IDTest;
                }


            });
        }
    });

    $(document).on('click','.btnPembahasan',function () {

        var IDIndikator = $(this).attr('data-id');
        var Indikator = $(this).attr('data-indikator');

        var url = base_url_js+'__crudPembahasan';

        var formData = {
            action : 'seePembahasan',
            IDIndikator : IDIndikator
        };

        $.post(url,{formData : formData},function (jsonResult) {

            console.log(jsonResult);

            var head = '';
            if(jsonResult.length>0){
                $.each(jsonResult,function (i,v) {
                    if(v.Pembahasan.length>0){
                        var list='';
                        $.each(v.Pembahasan,function (i2,v2) {
                            var pem = v2.Penjelasan;
                            if(v.ID==2){
                                pem = '<div style="margin-bottom: 10px;">'+v2.FileDesc+' | <a target="_blank" href="'+base_url_js+'uploads/pembahasan/'+v2.File+'" class="btn btn-xs btn-default">Download File</a></div>'
                            } else if(v.ID==3){
                                pem = '<a target="_blank" href="'+v2.Link+'">'+v2.Link+'</a>';
                            }
                            list = list+'<li>'+pem+'</li>';
                        });
                        head = head+'<h3>'+v.Keterangan+'</h3><ul>'+list+'</ul>';

                    }


                });
            }

            var body = (head=='') ? '<h3>Belum ada pembahasan</h3>' : head;
            $('#myModal .modal-title').html(Indikator);
            $('#myModal .modal-body').html(body);
            $('#myModal').modal('show');

        });



    });

</script>
