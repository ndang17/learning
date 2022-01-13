<style>
    .thumbnail h3 {
        border-left: 13px solid orange;
        padding-left: 10px;
        font-weight: bold;
        margin-bottom: 15px;
    }
</style>


<div class="row" style="margin-top: 20px;">

    <div class="col-md-6">
        <!--        <div class="form-group">-->
        <!--            <label>Jumlah soal untuk tes</label>-->
        <!--            <input class="form-control" id="formSoal" value="--><? //= $DataSeting[0]['Nilai']; 
                                                                            ?>
        <!--">-->
        <!--        </div>-->
        <h3>Mengatur Waktu Pengerjaan</h3>
        <div class="form-group">
            <label>Waktu pengerjaan (menit)</label>
            <input class="form-control" id="formDurasi" value="<?= $DataSeting[1]['Nilai']; ?>">
        </div>
        <div class="form-group">
            <label>Button Remidial</label>
            <select class="form-control" id="formBtnRemidial">
                <option value="1" <?= ($DataSeting[2]['Nilai'] == '1' || $DataSeting[2]['Nilai'] == 1) ? 'selected' : ''; ?>>Tampilkan</option>
                <option value="0" <?= ($DataSeting[2]['Nilai'] == '0' || $DataSeting[2]['Nilai'] == 0) ? 'selected' : ''; ?>>Sembunyikan</option>
            </select>
        </div>

        <div style="text-align: right;">
            <button class="btn btn-success" id="btnSave">Simpan</button>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <hr />
        <h3>Mengatur Jumlah Soal dan Gelombang Pengerjaan</h3>
    </div>
    <div class="">
        <div class="col-md-4">

            <div class="form-group">
                <label>Keterangan</label>
                <input class="hide" id="formID">
                <input class="form-control" id="formNama">
            </div>
            <div class="form-group">
                <label>Jumlah Soal</label>
                <input class="form-control" id="formNilai">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" id="formStatus">
                    <option value="1">Aktif</option>
                    <option value="0">Non aktif</option>
                </select>
            </div>
            <div class="form-group" style="text-align: right;">
                <button class="btn btn-success" id="simpanGel">Simpan</button>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="showSetGel"></tbody>
            </table>
        </div>
        <textarea class="hide" id="dataGel"></textarea>
    </div>
</div>

<div class="row" style="margin-bottom: 70px;">
    <div class="col-md-12">
        <hr />
        <h3>Aturan Pengerjaan</h3>
        <textarea id="formAturan"></textarea>

        <div style="text-align: right;">
            <button class="btn btn-success" id="btnSaveAturan">Simpan</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        loadDataGel();

        getAturan();

        $('#formAturan').summernote({
            height: 200,
            // width : 700,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    });

    $('#btnSave').click(function() {

        var formSoal = $('#formSoal').val();
        var formDurasi = $('#formDurasi').val();
        var formBtnRemidial = $('#formBtnRemidial').val();

        if (formDurasi != '' && formDurasi != null &&
            formBtnRemidial != '' && formBtnRemidial != null) {

            loadingButton('#btnSave');

            var url = base_url_js + '__crudMenuAdmin';

            var formData = {
                action: 'setting',
                Waktu: formDurasi,
                Soal: formSoal,
                Btn: formBtnRemidial
            };

            $.post(url, {
                formData: formData
            }, function(result) {

                toastr.success('Pengaturan tersimpan', 'Sukses');

                setTimeout(function() {
                    $('#btnSave').html('Simpan').prop('disabled', false);
                }, 500)

            });


        }


    });


    function loadDataGel() {

        var formData = {
            action: 'gelombangRead',
        };
        var url = base_url_js + '__crudMenuAdmin';

        $.post(url, {
            formData: formData
        }, function(jsonResult) {

            $('#showSetGel').empty();

            $('#dataGel').val(JSON.stringify(jsonResult));

            if (jsonResult.length > 0) {

                $.each(jsonResult, function(i, v) {

                    var s = (v.Status == '0') ? 'Non aktif' : 'Aktif';
                    $('#showSetGel').append('<tr>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td>' + v.Nama + '<br/>Jumlah Soal : ' + v.Nilai + '</td>' +
                        '<td>' + s + '</td>' +
                        '<td><button class="btnEdit" data-id="' + v.ID + '">Edit</button></td>' +
                        '</tr>');
                });
            } else {
                $('#showSetGel').append('<tr><td colspan="4">Tidak ada data</td></tr>');
            }

        });
    }

    $(document).on('click', '.btnEdit', function() {

        var dataGel = $('#dataGel').val();

        var dataGel = JSON.parse(dataGel);
        var ID = $(this).attr('data-id');

        var result = $.grep(dataGel, function(e) {
            return e.ID == ID;
        });

        var d = result[0];

        $('#formID').val(d.ID);
        $('#formNama').val(d.Nama);
        $('#formNilai').val(d.Nilai);
        $('#formStatus').val(d.Status);



    });

    $('#simpanGel').click(function() {


        var ID = $('#formID').val();
        var Nama = $('#formNama').val();
        var Nilai = $('#formNilai').val();
        var Status = $('#formStatus').val();


        if (Nama != '' && Nama != null &&
            Nilai != '' && Nilai != null) {
            var formData = {
                action: (ID != '' && ID != null) ? 'gelombangUpdate' : 'gelombangInsert',
                ID: ID,
                formD: {
                    Nama: Nama,
                    Nilai: Nilai,
                    Status: Status
                }
            };

            var url = base_url_js + '__crudMenuAdmin';

            $.post(url, {
                formData: formData
            }, function(jsonResult) {

                $('#formID').val('');
                $('#formNama').val('');
                $('#formNilai').val('');
                $('#formStatus').val('0');

                setTimeout(function() {
                    alert('Data tersimpan');
                    loadDataGel();
                }, 500);
            });
        }

    });

    $('#btnSaveAturan').click(function() {

        var formAturan = $('#formAturan').val();
        if (formAturan != '' && formAturan != null) {

            var formData = {
                action: 'insertAturan',
                Deskripsi: formAturan
            };

            var url = base_url_js + '__crudMenuAdmin';

            $.post(url, {
                formData: formData
            }, function(Result) {
                toastr.success('Data tersimpan', 'Sukses');
            });

        }

    });

    function getAturan() {
        var formData = {
            action: 'getAturan'
        };

        var url = base_url_js + '__crudMenuAdmin';
        $.post(url, {
            formData: formData
        }, function(jsonResult) {

            if (jsonResult.length > 0) {
                $('#formAturan').summernote('code', jsonResult[0].Deskripsi);
            } else {
                $('#formAturan').summernote('code', '');
            }
        });
    }
</script>