<?php $this->load->view('header') ?>

		<!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Master</a>
            </li>
            <li class="breadcrumb-item active">Master Barang</li>
          </ol>

          <div class="row">

          	<div class="col-lg-12">
          		<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i>Tambah Data</button>
			  <!-- Modal -->
			  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">

                        <form action="<?php echo site_url('Warehouse/addUser');?>" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                        	<div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input class="form-control" name="nik" placeholder="NIK" required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input class="form-control" type="text" name="nama_lengkap" placeholder="Nama Lengkap" required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="email" placeholder="Email" required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Username" required="required" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="Password" class="form-control" name="password" placeholder="Password" required="required" required minlength="5" ="" autocomplete="off">
                                	</div>
                                    <div class="form-group">
                                    	<label>Staff</label>
                                        <input type="text" class="form-control" name="staff" placeholder="Staff" required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                    	<label>Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" required="required" autocomplete="off">
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Batal</button>
                            <button type="submit" name="btnsimpan" class="btn btn-success"><i class="fa fa-check fa-fw"></i> Simpan</button>
                        </div>
                        </form>

                   </div>
                   <!-- modal-content -->
				</div>
				<!-- modal-dialog -->
			  </div>
			  <!-- modal -->
          	</div>
          	<!-- col-lg-12 -->
          	<br>
          	<br>
          	<hr>
			  <div class="col-lg-12 col-md-6">
				 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID User</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Staff</th>
                                        <th>Jabatan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									foreach ($user as $row) {
									?>
									<tr>
										<td><?php echo $row['id_user']; ?></td>
										<td><?php echo $row['nik'] ;?></td>
										<td><?php echo $row['nama_lengkap'] ;?></td>
                                        <td><?php echo $row['email'] ;?></td>
										<td><?php echo $row['username'] ;?></td>
										<td><?php echo $row['password'] ;?></td>
										<td><?php echo $row['staff'] ;?></td>
                                        <td><?php echo $row['jabatan'] ;?></td>
										<td>
											<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myEdit<?php echo $row['id_user']; ?>"><i class="fa fa-edit fa-fw"></i></button>
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#myHapus<?php echo $row['id_user'];?>"><i class="fas fa-trash"></i></button>
										</td>

								<!-- modal edit -->
									<div class="modal fade" id="myEdit<?php echo $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?php echo site_url('Warehouse/editUser/'.$row['id_user']);?>" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label>NIK</label>
                                                                    <input class="form-control" name="nik" placeholder="NIK" autocomplete="off" required="required"> value="<?php echo $row['nik'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama Lengkap</label>
                                                                    <input class="form-control" type="text" name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off" required="required"> value="<?php echo $row['nama_lengkap']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input class="form-control" type="email" name="email" placeholder="Email" required="required"> autocomplete="off" value="<?php echo $row['email']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" class="form-control" name="username" placeholder="Username" required="required" autocomplete="off" value="<?php echo $row['username'];?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="Password" class="form-control" name="password" placeholder="Password" autocomplete="off" required="required" required minlength="5" value="<?php echo $row['password'];?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Staff</label>
                                                                    <input type="text" class="form-control" name="staff" placeholder="Staff" required="required" autocomplete="off" value="<?php echo $row['staff'];?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Jabatan</label>
                                                                    <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" required="required" autocomplete="off" value="<?php echo $row['jabatan'];?>">
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Batal</button>
                                                    <button type="submit" name="update" class="btn btn-success"><i class="fa fa-check fa-fw"></i> Update </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal edit -->

                                    <!-- modal delete -->
                                    <div class='modal fade' id='myHapus<?php echo $row['id_user'];?>'' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <form action="<?php echo site_url('Warehouse/deleteUser/'.$row['id_user'])?>" method="post">
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                        <h4 class='modal-title' id='myModalLabel'>Hapus Data</h4>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <input type="text" name="id_user"  hidden value="<?php echo $row['id_user'];?>">
                                                        <center><h4>Apakah Anda Ingin Menghapus Data  : <b><?php echo $row['nama_lengkap'];?> ? </b>
                                                        </h4></center>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-danger' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Batal</button>
                                                        <button type='submit' name='hapus' class='btn btn-success'><i class='fa fa-trash fa-fw'></i> Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal delete -->
                                    <?php 
                                    echo "</tr>"; 
                                    }
                                    ?>
                                </tbody>
                 </table>
			  </div>
          </div>
		  <!-- row -->
<?php $this->load->view('footer') ?>