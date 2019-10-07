
<style>
    #tableAnlisis5 tr th, #tableAnlisis5 tr tD {
        text-align: center;
    }
</style>

<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
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

    <div class="col-xs-2" style="text-align: right;">
        <button class="btn btn-primary btn-lg" onclick="printDiv();">Cetak</button>
    </div>
</div>

<div id="DivIdToPrint">


    <div class="row">
        <div class="col-md-12">
            <h3 id="viewSekolah"></h3>
            <table class="table table-bordered" id="tableAnlisis5">
                <thead>
                <tr>
                    <th style="width: 1%;">No</th>
                    <th>Nama</th>
                    <th style="width: 10%;">Nilai Tes I</th>
                    <th style="width: 10%;">Nilai Tes II</th>
                </tr>
                </thead>
                <tbody id="listHasil"></tbody>
            </table>
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

            $('#listHasil').empty();
            var url = base_url_js+'__getAnalisis5/'+filterSekolah+'/'+filterGelombang;
            $.getJSON(url,function (jsonResult) {

                if(jsonResult.length>0){

                    var jumlahBenar_1 = 0;
                    var jumlahSiswa_1 = jsonResult.length;
                    var jumlahBenar_2 = 0;
                    var jumlahSiswa_2 = jsonResult.length;

                    $.each(jsonResult,function (i,v) {

                        var BanyakSoal = v.BanyakSoal;

                        var dataTest_1 = v.dataTest_1;
                        var JumlahBenarSOal1 = 0;
                        if(dataTest_1.length>0){
                            $.each(dataTest_1,function (i2,v2) {
                                if(parseInt(v2.IDKategori)==1){
                                    JumlahBenarSOal1 = JumlahBenarSOal1+1
                                }
                            });
                        }

                        var percentaseBenar1 = (JumlahBenarSOal1>0)
                            ? (JumlahBenarSOal1/BanyakSoal) * 100
                            : 0;
                        jumlahBenar_1 = jumlahBenar_1+percentaseBenar1;

                        var dataTest_2 = v.dataTest_2;
                        var JumlahBenarSOal2 = 0;
                        if(dataTest_2.length>0){
                            $.each(dataTest_2,function (i2,v2) {
                                if(parseInt(v2.IDKategori)==1){
                                    JumlahBenarSOal2 = JumlahBenarSOal2+1
                                }
                            });
                        }

                        var percentaseBenar2 = (JumlahBenarSOal2>0)
                            ? (JumlahBenarSOal2/BanyakSoal) * 100 : 100;
                        jumlahBenar_2 = jumlahBenar_2+percentaseBenar2;

                        if(dataTest_1.length>0){
                            $('#listHasil').append('<tr>' +
                                '<td>'+(i+1)+'</td>' +
                                '<td style="text-align: left;">'+v.Nama+'</td>' +
                                '<td>'+percentaseBenar1.toFixed(2)+'</td>' +
                                '<td>'+percentaseBenar2.toFixed(2)+'</td>' +
                                '</tr>');
                        }


                    });

                    var rata_1 = (jumlahBenar_1>0) ? jumlahBenar_1/jumlahSiswa_1 : 0;
                    var rata_2 = (jumlahBenar_2>0) ? jumlahBenar_2/jumlahSiswa_2 : 0;

                    var v_g = (rata_2-rata_1) / (100 - rata_1);
                    var v_g_ket = 'Tinggi';

                    if(v_g<0.3){
                        v_g_ket = 'Rendah';
                    } else if(v_g<0.7 && v_g>=0.3){
                        v_g_ket = 'Sedang';
                    }

                    $('#listHasil').append('<tr>' +
                        '<td colspan="2">Rata - rata</td>' +
                        '<td>'+rata_1.toFixed(2)+'</td>' +
                        '<td>'+rata_2.toFixed(2)+'</td>' +
                        '</tr>' +
                        '' +
                        '<tr>' +
                        '<td colspan="2">&lt; g &gt;</td>' +
                        '<td>'+v_g.toFixed(2)+'</td>' +
                        '<td>'+v_g_ket+'</td>' +
                        '</tr>');
                }
                else {
                    $('#listHasil').append('<tr>' +
                        '<td colspan="4">Tidak ada data</td>' +
                        '</tr>');
                }

            });
        }




    }


</script>