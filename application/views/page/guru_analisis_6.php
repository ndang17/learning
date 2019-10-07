
<style>
    .tableData tr th, .tableData tr td {
        text-align: center;
    }
</style>

<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <div class="well">
            <div class="row">
                <div class="col-xs-8">
                    <select class="form-control" id="filterSekolah"></select>
                </div>
                <div class="col-xs-4">
                    <select class="form-control" id="filterGelombang"></select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-3" style="text-align: right;">
        <button class="btn btn-primary btn-lg" onclick="printDiv();">Cetak</button>
    </div>
</div>

<div id="DivIdToPrint">


    <div class="row">

        <div class="col-md-12">

            <h3 id="viewSekolah"></h3>
            <table class="table table-bordered tableData table2excel" data-tableName="Soal tes 1">
                <thead>
                <tr id="viewHeader"></tr>
                <tr id="viewNomorSoal"></tr>
                <tr id="viewJumlahSoal"></tr>
                </thead>
                <tbody id="viewData"></tbody>
            </table>
            <button class="btn btn-default exportToExcel">Export to XLS</button>
            <hr/>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered table2excel" data-tableName="Alasan Tes 1">
                <thead>
                <tr id="viewHeader_alasan"></tr>
                <tr id="viewNomorSoal_alasan"></tr>
                <tr id="viewJumlahSoal_alasan"></tr>
                </thead>
                <tbody id="viewData_alasan"></tbody>
            </table>
            <button class="btn btn-default exportToExcel">Export to XLS</button>
            <hr/>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered tableData table2excel" data-tableName="Soal Tes 2">
                <thead>
                <tr id="viewHeader_2"></tr>
                <tr id="viewNomorSoal_2"></tr>
                <tr id="viewJumlahSoal_2"></tr>
                </thead>
                <tbody id="viewData_2"></tbody>
            </table>
            <button class="btn btn-default exportToExcel">Export to XLS</button>
            <hr/>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered tableData table2excel" data-tableName="Alasan Tes 2">
                <thead>
                <tr id="viewHeader_alasan_2"></tr>
                <tr id="viewNomorSoal_alasan_2"></tr>
                <tr id="viewJumlahSoal_alasan_2"></tr>
                </thead>
                <tbody id="viewData_alasan_2"></tbody>
            </table>
            <button class="btn btn-default exportToExcel">Export to XLS</button>
            <hr/>
        </div>

    </div>


</div>

<script>

    $(document).ready(function () {
        loadSelectOption_sekolah('#filterSekolah');
        loadSelectOption_gelombang('#filterGelombang');


        var firstLoad = setInterval(function () {
            var filterSekolah = $('#filterSekolah').val();
            var filterGelombang = $('#filterGelombang').val();
            if(filterSekolah!='' && filterSekolah!=null
                && filterGelombang!='' && filterGelombang!=null){
                getAnalisis();
                clearInterval(firstLoad);
            }
        },1000);

        setTimeout(function () {
            clearInterval(firstLoad);
        },5000);

    });

    $('#filterSekolah,#filterGelombang').change(function () {

        var filterSekolah = $('#filterSekolah').val();
        var filterGelombang = $('#filterGelombang').val();
        if(filterSekolah!='' && filterSekolah!=null
            && filterGelombang!='' && filterGelombang!=null){
            getAnalisis();
        }

    });
    
    function getAnalisis() {

        var filterSekolah = $('#filterSekolah').val();
        var filterGelombang = $('#filterGelombang').val();
        if(filterSekolah!='' && filterSekolah!=null
            && filterGelombang!='' && filterGelombang!=null){

            $('#viewSekolah').html($('#filterSekolah option:selected').text()+' - '+$('#filterGelombang option:selected').text());

            $('#viewHeader,#viewNomorSoal,#viewJumlahSoal,#viewData').empty();
            $('#viewHeader_alasan,#viewNomorSoal_alasan,#viewJumlahSoal_alasan,#viewData_alasan').empty();

            $('#viewHeader_2,#viewNomorSoal_2,#viewJumlahSoal_2,#viewData_2').empty();
            $('#viewHeader_alasan_2,#viewNomorSoal_alasan_2,#viewJumlahSoal_alasan_2,#viewData_alasan_2').empty();

            var jmlSoal = $('#filterGelombang option:selected').attr('data-n');

            $('#viewHeader').append('<th colspan="'+(2+jmlSoal)+'"><h4>Tabel Analisis Soal Jawaban Siswa pada Tes 1</h4></th>');
            $('#viewNomorSoal').append('<th style="width: 1%;" rowspan="2">No</th><th style="" rowspan="2">Siswa</th>' +
                '<th colspan="'+jmlSoal+'">Nomor Soal</th>');
            for(var i=1;i<=jmlSoal;i++){
                $('#viewJumlahSoal').append('<th style="width: 1%;">'+i+'</th>');
            }

            $('#viewHeader_alasan').append('<th colspan="'+(2+jmlSoal)+'" style="text-align: center;"><h4>Tabel Analisis Alasan Jawaban Siswa pada Tes 1</h4></th>');
            $('#viewNomorSoal_alasan').append('<th style="width: 1%;" rowspan="2">No</th><th style="" rowspan="2">Siswa</th>' +
                '<th colspan="'+jmlSoal+'">Nomor Soal</th>');
            for(var i=1;i<=jmlSoal;i++){
                $('#viewJumlahSoal_alasan').append('<th style="width: 1%;">'+i+'</th>');
            }

            $('#viewHeader_2').append('<th colspan="'+(2+jmlSoal)+'"><h4>Tabel Analisis Soal Jawaban Siswa pada Tes 2</h4></th>');
            $('#viewNomorSoal_2').append('<th style="width: 1%;" rowspan="2">No</th><th style="" rowspan="2">Siswa</th>' +
                '<th colspan="'+jmlSoal+'">Nomor Soal</th>');
            for(var i=1;i<=jmlSoal;i++){
                $('#viewJumlahSoal_2').append('<th style="width: 1%;">'+i+'</th>');
            }

            $('#viewHeader_alasan_2').append('<th colspan="'+(2+jmlSoal)+'"><h4>Tabel Analisis Alasan Jawaban Siswa pada Tes 2</h4></th>');
            $('#viewNomorSoal_alasan_2').append('<th style="width: 1%;" rowspan="2">No</th><th style="" rowspan="2">Siswa</th>' +
                '<th colspan="'+jmlSoal+'">Nomor Soal</th>');
            for(var i=1;i<=jmlSoal;i++){
                $('#viewJumlahSoal_alasan_2').append('<th style="width: 1%;">'+i+'</th>');
            }

            var url = base_url_js+'__getAnalisis6/'+filterSekolah+'/'+filterGelombang;

            $.getJSON(url,function (jsonResult) {

                if(jsonResult.length>0){

                    var arrTest1_JawabanBenar = ['1','2','3','4','5','8','10','11'];
                    var arrTest1_JawabanBenar_alasan = ['1','2','3','4','6','9','12','13'];

                    $.each(jsonResult,function (i,v) {

                        $('#viewData').append('<tr id="tr_'+i+'">' +
                            '<td>'+(i+1)+'</td>' +
                            '<td style="text-align: left;">'+v.Nama+'</td>' +
                            '</tr>');

                        $('#viewData_alasan').append('<tr id="tr_alasan_'+i+'">' +
                            '<td>'+(i+1)+'</td>' +
                            '<td style="text-align: left;">'+v.Nama+'</td>' +
                            '</tr>');

                        $('#viewData_2').append('<tr id="tr_2_'+i+'">' +
                            '<td>'+(i+1)+'</td>' +
                            '<td style="text-align: left;">'+v.Nama+'</td>' +
                            '</tr>');

                        $('#viewData_alasan_2').append('<tr id="tr_alasan_2_'+i+'">' +
                            '<td>'+(i+1)+'</td>' +
                            '<td style="text-align: left;">'+v.Nama+'</td>' +
                            '</tr>');

                        // test 1
                        var dataTest_1 = v.dataTest_1;
                        var dataTest_2 = v.dataTest_2;
                        if(dataTest_1.length>0){
                            $.each(dataTest_1,function (i2,v2) {

                                if($.inArray(''+v2.IDKombinasi,arrTest1_JawabanBenar)!=-1){
                                    $('#tr_'+i).append('<td>1</td>');
                                } else {
                                    $('#tr_'+i).append('<td>0</td>');
                                }

                                // Alasan
                                if($.inArray(''+v2.IDKombinasi,arrTest1_JawabanBenar_alasan)!=-1){
                                    $('#tr_alasan_'+i).append('<td>1</td>');
                                } else {
                                    $('#tr_alasan_'+i).append('<td>0</td>');
                                }

                                // Test 2
                                if(parseInt(v2.IDKombinasi)==1){
                                    $('#tr_2_'+i).append('<td>1</td>');
                                    $('#tr_alasan_2_'+i).append('<td>1</td>');
                                } else {

                                    console.log(i2,dataTest_2.length);
                                    if(i2 < dataTest_2.length){
                                        if($.inArray(''+dataTest_2[i2].IDKombinasi,arrTest1_JawabanBenar)!=-1){
                                            $('#tr_2_'+i).append('<td>1</td>');
                                        } else{
                                            $('#tr_2_'+i).append('<td>0</td>');
                                        }

                                        if($.inArray(''+dataTest_2[i2].IDKombinasi,arrTest1_JawabanBenar_alasan)!=-1){
                                            $('#tr_alasan_2_'+i).append('<td>1</td>');
                                        } else {
                                            $('#tr_alasan_2_'+i).append('<td>0</td>');
                                        }
                                    } else {
                                        $('#tr_2_'+i).append('<td>1</td>');
                                        $('#tr_alasan_2_'+i).append('<td>1</td>');
                                    }


                                }


                            });
                        }



                    });

                }

            });
        }
        
    }


    $(function() {
        $(".exportToExcel").click(function(e){
            var table = $(this).prev('.table2excel');
            var tableName = $(this).prev('.table2excel').attr('data-tableName');
            if(table && table.length){
                var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                $(table).table2excel({
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: tableName+"_" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                    fileext: ".xls",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true,
                    preserveColors: preserveColors
                });
            }
        });

    });

</script>