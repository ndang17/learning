
<style>
    .container-image {
        display: inherit;
        position: relative;
        text-align: center;
        color: white;
        border: 2px solid #FFFFFF;
    }

    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<div class="row">
    <div class="col-xs-4 col-xs-offset-4">
        <div class="well">
            <select class="form-control" id="filterSekolah"></select>
        </div>
        <hr/>

    </div>
    <div class="col-xs-4" style="text-align: right;">
        <button class="btn btn-primary btn-lg" onclick="printDiv();">Cetak</button>
    </div>
</div>

<div id="DivIdToPrint">



    <div class="row">

        <div class="col-md-12">
            <h3 id="viewSekolah"></h3>
            <div id="loadTable"></div>
        </div>
    </div>

</div>


<script>

    $(document).ready(function () {

       loadSelectOption_sekolah('#filterSekolah');

       var firstload = setInterval(function () {

           var filterSekolah = $('#filterSekolah').val();

           if(filterSekolah!=null && filterSekolah!=''){
               loadAnalisa2();
               clearInterval(firstload);
           }

       },1000);

    });

    $(document).on('change','#filterSekolah',function () {
        loadAnalisa2();
    });

    function loadAnalisa2() {

        var filterSekolah = $('#filterSekolah').val();

        if(filterSekolah!=null && filterSekolah!=''){

            $('#viewSekolah').html($('#filterSekolah option:selected').text());

            var url =base_url_js+'__getAnalisis2/'+filterSekolah;

            $.getJSON(url,function (jsonResult) {
               console.log(jsonResult);
               if(jsonResult.length>0){
                   $('#loadTable').html('<table class="table table-bordered">' +
                       '            <thead>' +
                       '            <tr>' +
                       '                <th style="width: 1%;">No</th>' +
                       '                <th style="width: 15%;">Nama</th>' +
                       '                <th style="width: 10%;">Tes</th>' +
                       '                <th>Soal</th>' +
                       '            </tr>' +
                       '            </thead>' +
                       '            <tbody id="rwStd"></tbody>' +
                       '        </table>');
                   $.each(jsonResult,function (i,v) {

                       var col = v.Test.length;

                       var tr2 = (v.Test.length>0) ? ''
                           : '<td colspan="2">Belum pernah melakukan tes</td>';

                       $('#rwStd').append('<tr>' +
                           '<td rowspan="'+(col+1)+'">'+(i+1)+'</td>' +
                           '<td rowspan="'+(col+1)+'">'+v.Nama+'</td>' +
                           ''+tr2+
                           '</tr>');

                       if(col>0){

                           $.each(v.Test,function (i2,v2) {

                               var soal = '';
                               $.each(v2.Detail,function (i3, v3) {
                                   if(v3.IDKategori==1 || v3.IDKategori=='1'){
                                       soal = soal+' <div class="container-image"><img src="'+base_url_js+'assets/icon/paham.png"><div class="centered">'+(i3+1)+'</div></div>';
                                   } else if(v3.IDKategori==2 || v3.IDKategori=='2'){
                                       soal = soal+' <div class="container-image"><img src="'+base_url_js+'assets/icon/tidakpaham.png"><div class="centered">'+(i3+1)+'</div></div>';
                                   } else {
                                       soal = soal+' <div class="container-image"><img src="'+base_url_js+'assets/icon/miskonsepsi.png"><div class="centered">'+(i3+1)+'</div></div>';
                                   }
                               });

                               $('#rwStd').append('<tr>' +
                                   '<td>Tes ke-'+(i2+1)+'</td>' +
                                   '<td>'+soal+'</td>' +
                                   '</tr>');

                           });
                       }



                   });
               }
            });

        }

    }



</script>