
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="well">
            <select class="form-control" id="filterSekolah">
                <option value="all">-- Semua Sekolah --</option>
                <option disabled>----------------------</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="loadTable"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        loadSelectOption_sekolah('#filterSekolah');
        loadAnak();
    });


    $('#filterSekolah').change(function () {
        loadAnak();
    });

    function loadAnak() {

        var filterSekolah = $('#filterSekolah').val();
        if(filterSekolah!='' && filterSekolah!=null){

            var url = base_url_js+'__crudMenuAdmin';

            var data = {
                action : 'showStudentBySekolah',
                SekolahID : filterSekolah
            };

            $.post(url,{formData : data},function (jsonResult) {

                if(jsonResult.length>0){
                    $('#loadTable').html('<table class="table table-striped">' +
                        '            <thead>' +
                        '            <tr>' +
                        '                <th style="width: 1%;">No</th>' +
                        '                <th style="width: 20%;">Siswa</th>' +
                        '                <th>Sekolah</th>' +
                        '                <th style="width: 1%;">Kelas</th>' +
                        '                <th style="width: 5%;"><i class="fa fa-cog"></i></th>' +
                        '            </tr>' +
                        '            </thead>' +
                        '            <tbody id="listSiswa"></tbody>' +
                        '        </table>');

                    $.each(jsonResult, function (i,v) {

                        var Alamat = (v.Sekolah_Alamat!=null && v.Sekolah_Alamat!='')
                            ? v.Sekolah_Alamat : '';
                        $('#listSiswa').append('<tr>' +
                            '<td>'+(i + 1)+'</td>' +
                            '<td>'+v.Nama+'</td>' +
                            '<td>'+v.Sekolah_Nama+'<br/><p class="help-block">'+Alamat+'</p></td>' +
                            '<td>'+v.Kelas+'</td>' +
                            '<td><a class="btn btn-sm btn-primary" href="'+base_url_js+'guru/analisis-1/'+v.ID+'">Lihat Hasil</a></td>' +
                            '</tr>');

                    });
                }

            });

        }
    }
</script>