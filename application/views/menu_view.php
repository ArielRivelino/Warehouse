<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Menu</h1>
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
                <?php if(isset($table)):?>
                <table class="table">
					<thead>
						<tr>
							<th><i class="fa fa-eye"></i></th>
							<th>Nama</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$res = $table->result();
						foreach ($res as $row):
					?>
						<tr style="background-color: rgba(0,0,0,.05);">
							<td>
							<?php
								$q = $this->Menu_model->get_childern($row->menu_id);
								if($q->num_rows() > 0):
							?>
								<button type="button" class="btn btn-success btn-xs btn-expand" data-id="tr-<?php echo $row->menu_id; ?>" data-toogle="0"><i class="fa fa-plus"></i></button>
								&nbsp;
							<?php endif; ?>
							</td>
							<td><?= $row->menu_name; ?></td>
							<td>
							<?php if($row->status==1):?>
								<a href="#" class="badge badge-success">Active</a>
							<?php else:?>
								<a href="#" class="badge badge-danger">Deactive</a>
							<?php endif; ?>
							</td>
							<td>
								<a href="<?= base_url("Menu/ubah/".$row->menu_id); ?>" title="" class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Ubah"><span class="fa fa-pencil-alt"></span></a>
								<a href="<?= base_url("Menu/hapus/".$row->menu_id); ?>" title="" class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Hapus"><span class="fa fa-trash"></span></a>
							</td>
						</tr>
						<?php
							$q = $this->Menu_model->get_childern($row->menu_id);
							if($q->num_rows() > 0):
						?>
						<tr id="tr-<?php echo $row->menu_id; ?>" style="display:none;">
							<td colspan="4" style="padding:0;">
                				<table class="table">
                					<tbody>
                						<?php
                							$cres = $q->result();
                							foreach ($cres as $crow):
                						?>
                						<tr>
                							<td></td>
											<td width="47.5%">
												<?= $crow->menu_name; ?>
												<br>
												<a href="<?= base_url($crow->url); ?>"><?= base_url($crow->url); ?></a>
											</td>
											<td>
											<?php if($crow->status==1):?>
												<a href="#" class="badge badge-success">Active</a>
											<?php else:?>
												<a href="#" class="badge badge-danger">Deactive</a>
											<?php endif; ?>
											</td>
											<td>
												<a href="<?= base_url("Menu/ubah/".$crow->menu_id); ?>" title="" class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Ubah"><span class="fa fa-pencil-alt"></span></a>
												<a href="<?= base_url("Menu/hapus/".$crow->menu_id); ?>" title="" class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Hapus"><span class="fa fa-trash"></span></a>
											</td>
                						</tr>
										<?php endforeach; ?>
                					</tbody>
                				</table>
							</td>
						</tr>
						<?php endif; ?>
					<?php endforeach; ?>
					</tbody>
                </table>
                <?php endif;?>
                <?php if(isset($form)):?>

				<?= form_open_multipart($form, array("class" => "") );?>

					<input type="hidden" name="menu_id" value="<?= isset($menu_id)?$menu_id:'';?>">
					
					<div class="form-group row">
						<label for="menu_name" class="col-sm-2 control-label">Nama Menu</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="menu_name" name="menu_name" value="<?= isset($menu_name)?$menu_name:"";?>" placeholder="Nama Menu" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="level" class="col-sm-2 control-label">Level</label>
						<div class="col-sm-10">
							<select class="form-control" id="level" name="level" required>
								<option value="0" <?php echo isset($type) && $type=="0"?"selected":""?> >Parent</option>
								<option value="1" <?php echo isset($type) && $type!="0"?"selected":""?> >Child</option>
							</select>
						</div>
					</div>
					<div class="if_parent">
						<div class="form-group row">
							<label for="icon_url" class="col-sm-2 control-label">Icon</label>
							<div class="pil_icn">
								<?php if(isset($type) && $type=="0"): ?>
									<div class="col-sm-1">
										<div class="icon_preview">
											<i class="fa <?php echo isset($url)?str_replace(".", "", $url):''; ?>"></i>
										</div>
									</div>
								<?php endif;?>
							</div>
							<div class="col-sm-8">
								<input type="hidden" id="icon_url" name="icon_url" value=".fa-cogs" required>
								<button type="button" class="btn btn-primary btn-cari-icon">Pilih Icon</button>
							</div>
						</div>
					</div>
					<div class="if_child" style="display: none;">
						<div class="form-group row">
							<label for="type" class="col-sm-2 control-label">Parent</label>
							<div class="col-sm-10">
								<select class="form-control" id="type" name="type" required>
								<?php
									$q = $this->Menu_model->get_parent();
									$res = $q->result();
									foreach ($res as $row){
										$sel = "";
										if(isset($type) && ($type == $row->menu_id)){
											$sel = "selected";
										}
										echo "<option value='$row->menu_id' $sel >$row->menu_name</option>";
									}
								?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="url" class="col-sm-2 control-label">Link</label>
							<div class="col-sm-10">
								<select class="form-control" id="url" name="url" required>
								<?php
									$dir = "application/controllers";
									$file = scandir($dir);
									unset($file[0], $file[1]);
									//isset($url)?$url:"";
									foreach ($file as $k => $v) {
										$ext = pathinfo($v, PATHINFO_EXTENSION);
										if($ext == "php"){
											$name = str_replace(".".$ext, "", $v);
											$sel = "";
											if(isset($url) && ($url == $name)){
												$sel = "selected";
											}
											echo "<option value='$name' $sel >$name</option>";
										}
									}
								?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button type="submit" class="btn btn-success">Simpan</button>
						</div>
					</div>
				</form>
				<pre>
				
				</pre>
				<?php endif; ?>
            </div>
        </div>
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

<div class="modal" id="modal-icon" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title">Icons</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
	        	<div class="container">
	        		<form action="">
	        			<div class="input-group mb-3">
						  	<input type="text" class="form-control txt-cari-icon" placeholder="Cari.." aria-describedby="basic-addon2">
						  	<div class="input-group-append">
						    	<span class="input-group-text icon-cari-icon" id="basic-addon2"><i class="fa fa-search"></i></span>
						  	</div>
						</div>
	        		</form>
	        	</div>
        		<div class="icon_load_box">
        			<div class="container">
		        		<div class="row load_icon">
		        		</div>
        			</div>
        		</div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
  	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){



		$(".btn-expand").click(function(){
			var id = $(this).attr("data-id");
			var to = $(this).attr("data-toogle");
			if(to == 0){
				$(this).attr("data-toogle", 1);
				$(this).html('<i class="fa fa-minus"></i>');
				$("#"+id).show();
			}else{
				$(this).attr("data-toogle", 0);
				$(this).html('<i class="fa fa-plus"></i>');
				$("#"+id).hide();
			}
		});

		$("#level").change(function(){
			var val = $(this).val();
			if(val==0){
				$(".if_parent").show();
				$(".if_child").hide();
			}else{
				$(".if_child").show();
				$(".if_parent").hide();

			}
		});


		$(".txt-cari-icon").keyup(function(){
			var val  = $(this).val();
			$(".load_icon").load("<?= base_url("fa_list") ?>/cari/"+val);
		});

		$(".btn-cari-icon").click(function(){
			$("#modal-icon").modal("show");
			$(".load_icon").load("<?= base_url("fa_list") ?>");
		});

		$(".btn-icon-pilih").click(function(){
			var icon = $(this).attr("data-icon");
			var val = $("#icons").val();

			$("#icons").val(val+', "'+icon+'"');			

		});


		<?php if(isset($type) && $type=="0"): ?>
			$(".if_parent").show();
			$(".if_child").hide();
		<?php elseif(isset($type) && $type!="0"): ?>
			$(".if_child").show();
			$(".if_parent").hide();
		<?php endif; ?>
	});

	function pilih_icon(icn) {
		console.log(icn);
		var ic = icn.replace(".", "")
		var ret = '<div class="col-sm-1"><div class="icon_preview">';
		ret += '<i class="fa '+ic+'"></i>';
		ret += '</div></div>';
		$("#icon_url").val(icn);
		$(".pil_icn").html(ret);
		$("#modal-icon").modal("hide");
	}
</script>