<div class="row" style="margin-top: 20px;margin-bottom: 30px;">



    <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
            <label>Jumlah soal untuk tes</label>
            <input class="form-control" id="formSoal" value="<?= $DataSeting[0]['Nilai']; ?>">
        </div>
        <div class="form-group">
            <label>Waktu pengerjaan (menit)</label>
            <input class="form-control" id="formDurasi" value="<?= $DataSeting[1]['Nilai']; ?>">
        </div>
        <div class="form-group">
            <label>Button Remidial</label>
            <select class="form-control" id="formBtnRemidial">
                <option value="1" <?= ($DataSeting[2]['Nilai']=='1' || $DataSeting[2]['Nilai']==1) ? 'selected' : ''; ?>>Tampilkan</option>
                <option value="0" <?= ($DataSeting[2]['Nilai']=='0' || $DataSeting[2]['Nilai']==0) ? 'selected' : ''; ?>>Sembunyikan</option>
            </select>
        </div>

        <div style="text-align: right;">
            <button class="btn btn-success" id="btnSave">Simpan</button>
        </div>
    </div>

</div>

<script>

    $('#btnSave').click(function () {
        var formSoal = $('#formSoal').val();
        var formDurasi = $('#formDurasi').val();
        var formBtnRemidial = $('#formBtnRemidial').val();

        if(formSoal!='' && formSoal!=null &&
            formDurasi!='' && formDurasi!=null &&
            formBtnRemidial !='' && formBtnRemidial!=null){

            loadingButton('#btnSave');

            var url = base_url_js+'__crudMenuAdmin';

            var formData = {
                action : 'setting',
                Waktu : formDurasi,
                Soal : formSoal,
                Btn : formBtnRemidial
            };

            $.post(url,{formData:formData},function (result) {

                toastr.success('Pengaturan tersimpan','Sukses');

                setTimeout(function () {
                    $('#btnSave').html('Simpan').prop('disabled',false);
                },500)

            });


        }


    });

</script>