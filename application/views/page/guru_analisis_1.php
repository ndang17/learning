
<div class="row">
    <div class="col-md-12">
        <a href="<?= base_url('guru/list-siswa'); ?>" class="btn btn-warning"><i class="fa fa-arrow-left margin-right"></i> List Siswa</a>
        <hr/>
    </div>
</div>

<?php

if(count($soal)>0){
    $user = $soal[0];

    ?>
    <div id="DivIdToPrint">

        <div class="row">
            <div class="col-xs-6">
                <table class="table table-striped">
                    <tr>
                        <td style="width: 25%;">Nama</td>
                        <td style="width: 1%;">:</td>
                        <td><?= $user['Nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?= $user['Kelas'] ?></td>
                    </tr>
                    <tr>
                        <td>Sekolah</td>
                        <td>:</td>
                        <td><?= $user['Sekolah_Nama']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-6">
                <div style="text-align: right;">
                    <button class="btn btn-primary btn-lg" onclick="printDiv();">Cetak</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!--        <pre>-->
                <!--            --><?php //print_r($soal); ?>
                <!--        </pre>-->

                <?php
                $no = 1;
                foreach ($soal AS $itm){ ?>
                    <h3>Tes <?= $no; ?></h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Soal</th>
                        </tr>
                        </thead>
                        <?php

                        $noSoal = 1;
                        foreach ($itm['Soal'] AS $itmSoal){ ?>
                            <tr>
                                <td><?= $noSoal; ?></td>
                                <td>
                                    <?= $itmSoal['Soal_Isi']; ?>
                                    <hr/>
                                    <div class="well">
                                        <b>Jawaban</b>
                                        <p class="help-block"><?= $itmSoal['Usr_Jawaban']; ?></p>
                                        <b>Tingkat Keyakinan Jawaban : <?= $itmSoal['Jawaban_K']; ?></b>
                                        <hr/>
                                        <b>Alasan</b>
                                        <p class="help-block"><?= $itmSoal['Usr_Alasan']; ?></p>
                                        <b>Tingkat Keyakinan Alasan : <?= $itmSoal['Alasan_K']; ?></b>
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        <b>Kunci Jawaban</b>
                                        <p><?= $itmSoal['Soal_Kunci_1']; ?></p>
                                        <hr/>
                                        <b>Kunci Jawaban Alasan</b>
                                        <p><?= $itmSoal['Soal_Alasan_1']; ?></p>
                                    </div>
                                    <hr/>
                                    <b>Identifikasi</b>
                                    <h3><?= $itmSoal['Identifikasi']; ?></h3>
                                </td>
                            </tr>
                            <?php $noSoal++; } ?>
                    </table>

                    <?php $no++; } ?>

            </div>
        </div>

    </div>

    <script>


        function printDiv()
        {

            var divToPrint=document.getElementById('DivIdToPrint');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html>' +
                '<link href="'+base_url_js+'assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">' +
                '<body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);

        }
    </script>

    <?php
} else { ?>
    <div class="row">
        <div class="col-xs-12">
            <h3>Belum melakukan UJIAN</h3>
        </div>
    </div>
<?php }


?>