<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><?= $judul; ?></h1>
</div>

<!-- Content Row -->
<div class="row">

	<div class="col">
		<?php if(isset($form)):?>

		<?= form_open_multipart($form, array("class" => "form-horizontal") );?>

			
			<input type="hidden" name="id_barang" value="<?= isset($id_barang)?$id_barang:'';?>">
			<?= isset($cbjenis)?$cbjenis:'';?>
			<div class="form-group">
				<label for="item_name" class="col-sm-2 control-label">Item name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="item_name" name="item_name" value="<?= isset($item_name)?$item_name:"";?>" placeholder="Item name" required>
				</div>
			</div>
			<div class="form-group">
				<label for="stock" class="col-sm-2 control-label">Stock</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" id="stock" name="stock" min="1" value="<?= isset($stock)?$stock:"";?>" placeholder="Stock" required>
				</div>
			</div>
			<?= isset($cbsatuan)?$cbsatuan:'';?>
			<div class="form-group">
				<label for="blok" class="col-sm-2 control-label">Blok</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="blok" name="blok" value="<?= isset($blok)?$blok:"";?>" placeholder="Blok" required>
				</div>
			</div>
			<div class="form-group">
				<label for="code" class="col-sm-2 control-label">Code</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="code" name="code" value="<?= isset($code)?$code:"";?>" placeholder="Code" required>
				</div>
			</div>
			<div class="form-group">
				<label for="line" class="col-sm-2 control-label">Line</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="line" name="line" value="<?= isset($line)?$line:"";?>" placeholder="Line" required>
				</div>
			</div>
			<div class="form-group">
				<label for="column" class="col-sm-2 control-label">Column</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="column" name="column" value="<?= isset($column)?$column:"";?>" placeholder="Column" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</div>
		</form>
		<?php endif; ?>

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

		<?= isset($link_add)?$link_add:'';?>
		<br><br>
		<?= isset($table)?$table:'';?>
	</div>
</div>

