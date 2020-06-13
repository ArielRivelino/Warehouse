<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Permintaan</h1>
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
					<input type="hidden" name="request_id" value="<?= isset($request_id)?$request_id:'';?>">
					<input type="hidden" name="nik" id="nik" value="1234">
					<?php if($request_type==0): ?>
					<div class="form-group row row">
						<label for="barang" class="col-sm-2 control-label">Barang</label>
						<div class="col-sm-10">
							<div class="input-group">
							  	<input type="text" id="barang" class="form-control" placeholder="Barang" value="<?= isset($nama_barang)?$nama_barang:"";?>" required>
							  	<input type="hidden" name="id_barang" id="id_barang">
							  	<div class="input-group-append">
							    	<button type="button" class="btn btn-success input-group-text" data-toggle="modal" data-target="#modal_barang">
										<i class="fa fa-search"></i>
							    	</button>
							  	</div>
							</div>
						</div>
					</div>
					<?php else: ?>

					
					<?= isset($cbjenis)?$cbjenis:'';?>
					<div class="form-group row row">
						<label for="item_name" class="col-sm-2 control-label">Item name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="item_name" name="item_name" value="<?= isset($item_name)?$item_name:"";?>" placeholder="Item name" required>
						</div>
					</div>
					<?= isset($cbsatuan)?$cbsatuan:'';?>
					<div class="form-group row">
						<label for="blok" class="col-sm-2 control-label">Blok</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="blok" name="blok" value="<?= isset($blok)?$blok:"";?>" placeholder="Blok" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="code" class="col-sm-2 control-label">Code</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="code" name="code" value="<?= isset($code)?$code:"";?>" placeholder="Code" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="line" class="col-sm-2 control-label">Line</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="line" name="line" value="<?= isset($line)?$line:"";?>" placeholder="Line" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="column" class="col-sm-2 control-label">Column</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="column" name="column" value="<?= isset($column)?$column:"";?>" placeholder="Column" required>
						</div>
					</div>


					<?php endif; ?>
					<hr>
					<div class="form-group row row">
						<label for="amount" class="col-sm-2 control-label">Jumlah</label>
						<div class="col-sm-10">
							<input type="number" min="0" class="form-control" id="amount" name="amount" value="<?= isset($amount)?$amount:"";?>" placeholder="Jumlah" required>
						</div>
					</div>
					<div class="form-group row row">
						<label for="information" class="col-sm-2 control-label">Informasi</label>
						<div class="col-sm-10">
							<textarea type="text" class="form-control" id="information" name="information" rows="10" placeholder="Informasi" required><?= isset($information)?$information:"";?></textarea>
						</div>
					</div>
					<div class="form-group row row">
						<label for="proof" class="col-sm-2 control-label">Proof</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="proof" name="proof" value="<?= isset($proof)?$proof:"";?>" placeholder="Proof" required>
						</div>
					</div>
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


<div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Cari User</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	     	<div class="modal-body">
	        	...
	      	</div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
  	</div>
</div>

<div class="modal fade" id="modal_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Cari Barang</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	     	<div class="modal-body ">
	        	<div class="container modal-body-barang"></div>
	      	</div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
  	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#modal_barang').on('shown.bs.modal', function () {
		  	$(".modal-body-barang").load('<?= base_url("ajax/barang"); ?>');
		});
	});

	function pilih_barang(id, nama_barang) {
		$('#modal_barang').modal("hide");
		$("#id_barang").val(id);
		$("#barang").val(nama_barang);
	}
</script>	

