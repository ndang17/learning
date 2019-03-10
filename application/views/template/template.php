<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Learning</title>

    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js'); ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/moment/moment.js'); ?>"></script>
    <script src="<?php echo base_url('assets/moment/moment-with-locales.min.js'); ?>"></script>

    <!-- include summernote css/js -->
    <link href="<?php echo base_url('assets/summernote/') ?>summernote.css" rel="stylesheet">
    <script src="<?php echo base_url('assets/summernote/') ?>summernote.js"></script>

    <script>

        window.base_url_js = "<?php echo base_url(); ?>";

        window.sessionID = "<?php echo $this->session->userdata('ID'); ?>";

        function ucWord(str) {
            str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            return str;
        }

        function loadingPage(elm){
            $(elm).html('<div class="row">' +
                '    <div class="col-md-12" style="text-align: center;">' +
                '        <h4><i class="fa fa-refresh fa-spin fa-fw"></i> Loading...</h4>' +
                '    </div>' +
                '</div>');
        }

        function loadingButton(elm) {
            $(elm).html('<i class="fa fa-refresh fa-spin fa-fw"></i> Loading...').prop('disabled',true);
        }
        function loadingButtonSM(elm) {
            $(elm).html('<i class="fa fa-refresh fa-spin fa-fw"></i>').prop('disabled',true);
        }
    </script>

    <style>
        .margin-right {
            margin-right: 5px;
        }
    </style>

</head>
<body>

<?php echo $content; ?>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>