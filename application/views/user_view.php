<?= form_open_multipart($form, array("class" => "form-horizontal") );?>
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="name" name="name" value="<?= isset($name)?$name:"";?>" placeholder="Name" required>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Password</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="password" name="password" value="<?= isset($password)?$password:"";?>" placeholder="Password" required>
		</div>
	</div>
	<div class="form-group">
		<label for="staff" class="col-sm-2 control-label">Staff</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="staff" name="staff" value="<?= isset($staff)?$staff:"";?>" placeholder="Staff" required>
		</div>
	</div>
	<div class="form-group">
		<label for="role_id" class="col-sm-2 control-label">Role id</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="role_id" name="role_id" value="<?= isset($role_id)?$role_id:"";?>" placeholder="Role id" required>
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="email" name="email" value="<?= isset($email)?$email:"";?>" placeholder="Email" required>
		</div>
	</div>
	<div class="form-group">
		<label for="nama_kategori" class="col-sm-2 control-label">Nama Kategori</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= isset($nama_kategori)?$nama_kategori:"";?>" placeholder="Nama Kategori" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-success">Simpan</button>
		</div>
	</div>
</form>

<?= isset($link_add)?$link_add:'';?>
<?= isset($table)?$table:'';?>

<?php 
	$msg = $this->session->flashdata("msg");
	$msg_status = $this->session->flashdata("msg_status");
	$msg_title = $this->session->flashdata("msg_title");
	if(isset($msg)): 
?>
	<div class="alert <?= $msg_status; ?> alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<h4 id="omg-error-txt"><?= $msg_title; ?><a class="anchorjs-link" href="#omg-error-txt"><span class="anchorjs-icon"></span></a></h4>
		<p><?php echo $msg; ?></p>
	</div>
<?php endif; ?>

