

<style>
    #tableAns4 tr th, #tableAns4 tr td {
        text-align: center;
    }
</style>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="filterSekolah">
                        <option value="">Semua Sekolah</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" id="filterGelombang"></select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" id="filterType">
                        <option value="1">Tes 1</option>
                        <option value="2">Remidial</option>
                    </select>
                </div>
            </div>
        </div>
        <hr/>
    </div>
    <div class="col-md-2" style="text-align: right;">
        <button class="btn btn-primary btn-lg" onclick="printDiv();">Cetak</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="DivIdToPrint">
        <h3 id="viewSekolah"></h3>
        <table class="table table-striped table-bordered" id="tableAns4">
            <thead>
            <tr>
                <th rowspan="2" style="width: 2%;">No</th>
                <th rowspan="2">Soal <span id="viewJumlahSoal"></span></th>
                <th colspan="3">Jumlah Siswa <span id="viewJumlahSiswa"></span></th>
            </tr>
            <tr>
                <th style="width: 15%;">Paham</th>
                <th style="width: 15%;">Tidak Paham</th>
                <th style="width: 15%;">Miskonsepsi</th>
            </tr>
            </thead>
            <tbody id="listAnls4"></tbody>

        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        loadSelectOption_sekolah('#filterSekolah');
        loadSelectOption_gelombang('#filterGelombang');

        var frisLod = setInterval(function () {

            var filterGelombang = $('#filterGelombang').val();
            if(filterGelombang!='' && filterGelombang!=null){
                loadAnalisa4();
                clearInterval(frisLod);
            }

        },1000);

    });

    $('#filterSekolah,#filterGelombang,#filterType').change(function () {
        loadAnalisa4();
    });

    function loadAnalisa4() {

        var filterSekolah = $('#filterSekolah').val();
        var filterGelombang = $('#filterGelombang').val();
        var filterType = $('#filterType').val();

        if(filterGelombang!='' && filterGelombang!=null){

            $('#viewSekolah').html($('#filterSekolah option:selected').text()+' - '+
                $('#filterGelombang option:selected').text()+' - '+
                $('#filterType option:selected').text());

            var sch = (filterSekolah!='') ? filterSekolah : '-';
            var url =base_url_js+'__getAnalisis4?sch='+sch+'&g='+filterGelombang+'&t='+filterType;

            $.getJSON(url,function (jsonResult) {

                $('#listAnls4').empty();
                if(jsonResult.Details.length>0){
                    $('#viewJumlahSiswa').html('('+jsonResult._JumlahSiswa+' anak)');
                    $('#viewJumlahSoal').html('('+jsonResult._JumlahSoal+' soal)');

                    var total_P = 0;
                    var total_TP = 0;
                    var total_M = 0;

                    $.each(jsonResult.Details,function (i,v) {
                        var no = i+1;
                        $('#listAnls4').append('<tr>' +
                            '<td>'+no+'</td>' +
                            '<td style="text-align: left;">Soal - '+no+'</td>' +
                            '<td>'+v.P+'</td>' +
                            '<td>'+v.TP+'</td>' +
                            '<td>'+v.M+'</td>' +
                            '</tr>');

                        total_P = total_P + v.P;
                        total_TP = total_TP + v.TP;
                        total_M = total_M + v.M;
                    });

                    $('#listAnls4').append('<tr>' +
                        '<td colspan="2" style="text-align: right;">Jumlah</td>' +
                        '<td>'+total_P+'</td>' +
                        '<td>'+total_TP+'</td>' +
                        '<td>'+total_M+'</td>' +
                        '</tr>');

                    var pres_p = (total_P/jsonResult.JumlahKeseluruhan * 100).toFixed(0);
                    var pres_tp = (total_TP/jsonResult.JumlahKeseluruhan * 100).toFixed(0);
                    var pres_m = (total_M/jsonResult.JumlahKeseluruhan * 100).toFixed(0);

                    $('#listAnls4').append('<tr>' +
                        '<td colspan="2" style="text-align: right;">Persentase(%)</td>' +
                        '<td>'+pres_p+' %</td>' +
                        '<td>'+pres_tp+' %</td>' +
                        '<td>'+pres_m+' %</td>' +
                        '</tr>');

                    var k_p = 'Rendah';
                    if(pres_p>=30 && pres_p<70){
                        k_p = 'Sedang';
                    }
                    else if(pres_p>=70){
                        k_p = 'Tinggi';
                    }
                    var k_tp = 'Rendah';
                    if(pres_tp>=30 && pres_tp<70){
                        k_tp = 'Sedang';
                    }
                    else if(pres_tp>=70){
                        k_tp = 'Tinggi';
                    }
                    var k_m = 'Rendah';
                    if(pres_m>=30 && pres_m<70){
                        k_m = 'Sedang';
                    }
                    else if(pres_m>=70){
                        k_m = 'Tinggi';
                    }

                    $('#listAnls4').append('<tr>' +
                        '<td colspan="2" style="text-align: right;">Kriteria</td>' +
                        '<td>'+k_p+'</td>' +
                        '<td>'+k_tp+'</td>' +
                        '<td>'+k_m+'</td>' +
                        '</tr>');

                }  else {
                    $('#listAnls4').append('<tr>' +
                        '<td colspan="5">Tidak ada yang melakukan testing</td>' +
                        '</tr>');
                }

            });
        }



    }
</script>