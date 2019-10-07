
<style>
    .soal {
        max-height: 100px;
        overflow: auto;
    }
</style>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <select class="form-control" id="filterTPSoal">
                        <option value="1" <?= ($this->uri->segment(3)==1) ? 'selected' : ''; ?>>Tes 1</option>
                        <option value="2" <?= ($this->uri->segment(3)==2) ? 'selected' : ''; ?>>Remidial</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-default btn-block" id="btnShowPage"><i class="fa fa-send"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" style="margin-bottom: 150px;">
        <table class="table table-striped" id="tableSoal">
            <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th>Soal</th>
                <th style="width: 10%;"><i class="fa fa-cog"></i></th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach ($dataSoal AS $item){ ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td>
                        <div class="soal"><?= $item['Soal']; ?></div>
                    </td>
                    <td><button class="btn btn-sm btn-default btnShowAnalisa3" data-no="<?= $no; ?>" data-id="<?= $item['ID']; ?>">Analisa</button></td>
                </tr>
                <?php $no++; } ?>

            </tbody>
        </table>
    </div>
</div>


<script>

    $(document).ready(function () {
        $('#tableSoal').dataTable({
            ordering : false
        });
    });

    $('#btnShowPage').click(function () {
        var filterTPSoal = $('#filterTPSoal').val();
        window.location.href = base_url_js+'guru/analisis-3/'+filterTPSoal;
    });

    
    $(document).on('click','.btnShowAnalisa3',function () {
        
        var ID = $(this).attr('data-id');
        var No = $(this).attr('data-no');

        // console.log(jsonResult);
        $('#myModal .modal-title').html('No Soal - '+No);
        $('#myModal .modal-body').html('' +
            '<input id="modalID" class="hide" value="'+ID+'" />' +
            '<input id="modalNo" class="hide" value="'+No+'" />' +
            '<select class="form-control" id="filterSekolah">' +
            '<option value="0">Semua Sekolah</option>' +
            '</select> <hr/>' +
            '<div id="showChart"></div>');

        loadSelectOption_sekolah('#filterSekolah');

        getPie();

        $('#myModal').modal('show');


        
    });

    $(document).on('change','#filterSekolah',function () {
        getPie();
    });

    function getPie() {

        var ID = $('#modalID').val();
        var No = $('#modalNo').val();

        var filterSekolah = $('#filterSekolah').val();

        var filterTPSoal = $('#filterTPSoal').val();

        var url = base_url_js+'__getAnalisis3/'+ID+'/'+filterTPSoal+'/'+filterSekolah;

        $('#showChart').html('<div id="chartContainer" style="height: 370px;width: 100%;max-width: 920px; margin: 0px auto;"></div>');

        $.getJSON(url,function (jsonResult) {

            var chart = new CanvasJS.Chart("chartContainer", {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "No Soal - "+No
                },
                legend:{
                    cursor: "pointer",
                    itemclick: explodePie
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    toolTipContent: "{name}: <strong>{y}%</strong>",
                    indexLabel: "{name} - {y}%",
                    dataPoints: [
                        { y: jsonResult.M, name: "Miskonsepsi", color : '#d9534f' },
                        { y: jsonResult.TP, name: "Tidak Paham", color: '#f0ad4e' },
                        { y: jsonResult.P, name: "Paham", color : '#5cb85c', exploded: true }
                    ]
                }]
            });

            chart.render();

        });
    }

    function explodePie (e) {
        if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.chart.render();

    }


</script>
