<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">User</h1>
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

					<div class="form-group row row">
						<label for="nik" class="col-sm-2 control-label">NIK</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nik" name="nik" <?= isset($nik)?'value="'.$nik.'" readonly':"";?> placeholder="NIK" required>
						</div>
					</div>

					<div class="form-group row row">
						<label for="password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="password" name="password" value="<?= isset($password)?$password:"";?>" placeholder="Password" required>
						</div>
					</div>
					<div class="form-group row row">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" value="<?= isset($name)?$name:"";?>" placeholder="Name" required>
						</div>
					</div>
					<div class="form-group row row">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" value="<?= isset($email)?$email:"";?>" placeholder="Email" required>
						</div>
					</div>
					<div class="form-group row row">
						<label for="staff" class="col-sm-2 control-label">Staff</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="staff" name="staff" value="<?= isset($staff)?$staff:"";?>" placeholder="Staff" required>
						</div>
					</div>
					<?= isset($cb_role)?$cb_role:""; ?>
					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button type="submit" class="btn btn-success">Simpan</button>
						</div>
					</div>
				</form>
            	<?php endif;?>
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




