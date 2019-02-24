<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #f4f4f4;
    }

    .thumbnail{

        text-align: center;

        padding: 20px;

        border-radius: 0px;

        -webkit-box-shadow: -1px -1px 9px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px -1px 9px 0px rgba(0,0,0,0.75);
        box-shadow: -1px -1px 9px 0px rgba(0,0,0,0.75);
    }
    .thumbnail h3 {
        font-weight: bold;
        /*text-shadow: 1px 1px 1px #5E5E5E;*/
    }

    .thumbnail:hover {
        border: 1px solid #333333;
        background: #fdffea;
        cursor: pointer;
    }
</style>

<div style="min-height: 100px;background: #8ba8af;text-align: center;padding: 20px;border-bottom: 9px solid #ffc107;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo base_url('images/unnes.png') ?>" style="max-width: 100%;max-width: 100px;">
                <h1 style="color: #FFFFFF;font-weight: bold;text-shadow: 2px 2px 2px #5E5E5E;">E-Diagnostic Test</h1>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <div class="thumbnail">
                <img src="<?php echo base_url('images/icon/siswa.png'); ?>" style="width: 100%;max-width: 100px;">
                <h3>Saya Siswa</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="thumbnail">
                <img src="<?php echo base_url('images/icon/guru.png'); ?>" style="width: 100%;max-width: 100px;">
                <h3>Saya Guru</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="text-align: center;">
            <hr/>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
            </p>
        </div>
    </div>
</div>