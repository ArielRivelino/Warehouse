<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">User Access</h1>
</div>

<!-- Content Row -->
<div class="row">

	<div class="col">

		<div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      	<?= isset($link_add)?$link_add:'';?>
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?= isset($table)?$table:'';?>
                <?php if(isset($form)):?>

				<?= form_open_multipart($form, array("class" => "") );?>

					
					<input type="hidden" name="id_access" value="<?= isset($id_access)?$id_access:'';?>">
					<?= isset($combo_role)?$combo_role:''; ?>
					<?= isset($combo_menu)?$combo_menu:''; ?>
					<div class="form-group row row">
						<label for="aksi" class="col-sm-2 control-label">Aksi</label>
						<div class="col-sm-10">
							<div class="form-check form-check-inline">
							  	<input class="form-check-input" type="checkbox" id="cb_view" value="1" name="aksi[]" <?= isset($cb_view)?"checked":'';?> >
							  	<label class="form-check-label" for="cb_view">Melihat Data</label>
							</div>
							<div class="form-check form-check-inline">
							  	<input class="form-check-input" type="checkbox" id="cb_add" value="2" name="aksi[]" <?= isset($cb_add)?"checked":'';?> >
							  	<label class="form-check-label" for="cb_add">Tambah Data</label>
							</div>
							<div class="form-check form-check-inline">
							  	<input class="form-check-input" type="checkbox" id="cb_update" value="3" name="aksi[]" <?= isset($cb_update)?"checked":'';?> >
							  	<label class="form-check-label" for="cb_update">Ubah Data</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button type="submit" class="btn btn-success">Simpan</button>
						</div>
					</div>
				</form>
				<?php endif; ?>
            </div>
        </div>
		

		<?php 
			$msg = $this->session->flashdata("msg");
			$msg_status = $this->session->flashdata("msg_status");
			$msg_title = $this->session->flashdata("msg_title");
			if(isset($msg)): 
		?>
			<div class="alert <?= $msg_status; ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 id="omg-error-txt"><?= $msg_title; ?><a class="anchorjs-link" href="#omg-error-txt"><span class="anchorjs-icon"></span></a></h4>
				<p><?php echo $msg; ?></p>
			</div>
		<?php endif; ?>

		
		<br><br>
		
	</div>
</div>

