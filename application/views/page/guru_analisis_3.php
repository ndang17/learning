
<style>
    .soal {
        max-height: 100px;
        overflow: auto;
    }
</style>

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


<script>

    $(document).ready(function () {
        $('#tableSoal').dataTable({
            ordering : false
        });
    });

    
    $(document).on('click','.btnShowAnalisa3',function () {
        
        var ID = $(this).attr('data-id');
        var No = $(this).attr('data-no');

        var url = base_url_js+'__getAnalisis3/'+ID;
        
        $.getJSON(url,function (jsonResult) {

            console.log(jsonResult);
            $('#myModal .modal-title').html('No Soal - '+No);
            $('#myModal .modal-body').html('<div id="chartContainer" style="height: 370px;width: 100%;max-width: 920px; margin: 0px auto;"></div>\n');

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
                        { y: jsonResult.M, name: "Miskonsepsi" },
                        { y: jsonResult.TP, name: "Tidak Paham" },
                        { y: jsonResult.P, name: "Paham", exploded: true }
                    ]
                }]
            });

            $('#myModal').on('shown.bs.modal', function () {
                chart.render();
            });
            $('#myModal').modal('show');




        });
        
    });

    function explodePie (e) {
        if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.chart.render();

    }


</script>
