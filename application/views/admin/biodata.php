
<?php

    $viewBio = (count($DataBio)>0) ? $DataBio[0]['Biodata'] : '';

?>

<div class="form-group">
    <label>Biodata</label>
    <textarea id="Biodata"><?= $viewBio; ?></textarea>

    <div style="text-align: right;">
        <button class="btn btn-success" id="btnPostBio">Simpan</button>
    </div>

</div>

<script>

    $('#Biodata').summernote({
        height : 200,
        // width : 700,
        airMode : false
    });

    $('#btnPostBio').click(function () {

        var Biodata = $('#Biodata').val();

        if(Biodata!='' && Biodata!=null){

            loadingButton('#btnPostBio');

            var url = base_url_js+'__crudMenuAdmin';

            var formData = {
                action : 'biodata',
                Biodata : Biodata
            };

            $.post(url,{formData:formData},function (result) {

                toastr.success('Biodata tersimpan','Sukses');

                setTimeout(function () {
                    $('#btnPostBio').html('Simpan').prop('disabled',false);
                },500)

            });
        }


    });

</script>