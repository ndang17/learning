
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

        <div class="col-md-6 col-md-offset-3">
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

                        $pembahasan = ($item['IDKategori']=='1' || $item['IDKategori']==1) ? '-' : '<button class="btn btn-sm btn-default">Pembahasan</button>';
                        ?>
                        <tr>
                            <td style="text-align: left;">Soal <?= $no.' - '.$item['Indikator']; ?></td>
                            <td><?=$hasil;?></td>
                            <td><?= $pembahasan; ?></td>
                        </tr>
                    <?php $no++; } ?>
                    </tbody>
                </table>

                <div style="text-align: right;">
                    <button class="btn btn-primary">Test Ulang</button>
                </div>
            </div>
        </div>

    </div>
</div>
