
<style>
    body {
        background-color: #F6F6F6;
    }
    .list-group .fa {
        margin-right: 5px;
    }
</style>

<?php
    $menuAct = $this->uri->segment(2);
?>

<div class="container" style="margin-top: 30px;">

    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <h3>Admin E-Diagnostic Test</h3>
            <hr/>
        </div>
    </div>

	<div class="row">
		<div class="col-md-3">
			<div class="list-group">
			  <a href="<?= base_url('admin/biodata'); ?>" class="list-group-item <?php if($menuAct=='biodata'){ echo "active";} ?>"><i class="fa fa-edit"></i> Biodata</a>
			  <a href="<?= base_url('admin/pengaturan'); ?>" class="list-group-item <?php if($menuAct=='pengaturan'){ echo "active";} ?>"><i class="fa fa-cog"></i> Pengaturan</a>
			  <a href="<?= base_url('admin/master-sekolah'); ?>" class="list-group-item <?php if($menuAct=='master-sekolah'){ echo "active";} ?>"><i class="fa fa-database"></i> Master Sekolah</a>
			  <a href="<?= base_url('admin/guru'); ?>" class="list-group-item <?php if($menuAct=='guru'){ echo "active";} ?>"><i class="fa fa-user-circle"></i> Guru</a>
			  <a href="<?= base_url('admin/murid'); ?>" class="list-group-item <?php if($menuAct=='murid'){ echo "active";} ?>"><i class="fa fa-users"></i> Murid</a>
			</div>

            <button class="btn btn-block btn-danger">Log Out</button>

		</div>
		<div class="col-md-9">

            <div class="thumbnail" style="min-height: 100px;padding: 15px;">
                <?= $page; ?>

            </div>

		</div>
	</div>
</div>