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
								<button type="button" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
								&nbsp;
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
							</td>
						</tr>
						<?php
							$q = $this->Menu_model->get_childern($row->menu_id);
							if($q->num_rows() > 0):
						?>
						<tr>
							<td colspan="4" style="padding:0;">
                				<table class="table">
                					<tbody>
                						<?php
                							$cres = $q->result();
                							foreach ($cres as $crow):
                						?>
                						<tr>
                							<td></td>
											<td>
												<?= $crow->menu_name; ?>
												<br>
												<a href="<?= base_url($crow->menu_name); ?>"><?= base_url($crow->menu_name); ?></a>
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

					<input type="hidden" name="id_satuan" value="<?= isset($id_satuan)?$id_satuan:'';?>">
					
					<div class="form-group row">
						<label for="satuan" class="col-sm-2 control-label">Satuan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="satuan" name="satuan" value="<?= isset($satuan)?$satuan:"";?>" placeholder="Satuan" required>
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
