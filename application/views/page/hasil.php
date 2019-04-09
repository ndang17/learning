
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

<div class="container" style="margin-top: 40px;margin-bottom: 100px;">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <a href="<?= base_url('siswa'); ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left margin-right"></i> Kembali ke halaman utama</a>
            <hr/>
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
                    <?php $no=1; foreach ($dataHasil AS $item){

                        $hasil = '<span class="label label-danger" style="font-size: 13px;"><i class="fa fa-times-circle margin-right"></i> '.$item['Keterangan'].'</span>';

                        if($item['IDKategori']=='2' || $item['IDKategori']==2){
                            $hasil = '<span class="label label-warning" style="font-size: 13px;"><i class="fa fa-info-circle margin-right"></i> '.$item['Keterangan'].'</span>';
                        } else if($item['IDKategori']=='1' || $item['IDKategori']==1){
                            $hasil = '<span class="label label-success" style="font-size: 13px;"><i class="fa fa-check-circle margin-right"></i> '.$item['Keterangan'].'</span>';
                        }

                        $pembahasan = ($item['IDKategori']=='1' || $item['IDKategori']==1) ? '-' : '<button class="btn btn-sm btn-default" data-url="'.$item['Pembahasan'].'">Pembahasan</button>';
                        ?>
                        <tr>
                            <td style="text-align: left;">Soal <?= $no.' - '.$item['Indikator']; ?></td>
                            <td><?=$hasil;?></td>
                            <td><?= $pembahasan; ?></td>
                        </tr>
                    <?php $no++; } ?>
                    </tbody>
                </table>

                <?php if(count($dataTest)>0 && count($dataTest)<2){ ?>
                        <div style="text-align: right;">
                            <button class="btn btn-primary" data-id="<?=$dataTest[0]['ID']; ?>" data-token="<?=$dataTest[0]['Token']; ?>" id="btnTestUlang">Test Ulang</button>
                        </div>
                    <?php } ?>

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

</script>
