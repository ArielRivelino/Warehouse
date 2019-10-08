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
             <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i>Tambah Data </button>
			  <!-- Modal -->
			  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">

                        <form action="<?php echo site_url('Warehouse/addbarang');?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                        </div>
                        <div class="modal-body">
                        	<div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input class="form-control" name="nama_barang" placeholder="Nama Barang" required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <select class="form-control" name="jenis" >
											<option value="Alat Berat">Alat Berat</option>
											<option value="Umum">Umum</option>
											<option value="IT">IT</option>
										</select>
                                    </div>
                                    <div class="form-group">
                                    	<label>Stok</label>
                                        <input type="number" class="form-control" name="stok" placeholder="Jumlah Stok" required="required" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                    	<label>Satuan</label>
                                        <input class="form-control" name="satuan" placeholder="" required="required" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Blok</label>
                                        <input class="form-control" name="blok" placeholder="A-Z" required="required" pattern="[A-Z]{1}" title="1 Huruf Alphabet" autocomplete="off">
                                	</div>
                                    <div class="form-group">
                                    	<label>Kode</label>
                                        <input class="form-control" name="kode" placeholder="A-Z" required="required" pattern="[A-Z]{1}" title="1 Huruf Alphabet" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                    	<label>Baris</label>
                                        <input type="text" class="form-control" name="baris" placeholder="01-99" required="" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                    	<label>Kolom</label>
                                        <input type="text" class="form-control" name="kolom" placeholder="01-99" required="required" autocomplete="off">
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
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis</th>
                                        <th>Stok</th>
                                        <th>Satuan</th>
                                        <th>Blok</th>
                                        <th>Kode</th>
                                        <th>Baris</th>
                                        <th>Kolom</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									foreach ($barang as $row) {
									?>
									<tr>
										<td><?php echo $row['id_barang']; ?></td>
										<td><?php echo $row['nama_barang'] ;?></td>
										<td><?php echo $row['jenis'] ;?></td>
										<td><?php echo $row['stok'] ;?></td>
										<td><?php echo $row['satuan'] ;?></td>
										<td><?php echo $row['blok'] ;?></td>
                                        <td><?php echo $row['kode'] ;?></td>
                                        <td><?php echo $row['baris'] ;?></td>
                                        <td><?php echo $row['kolom'] ;?></td>
										<td>
											<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myEdit<?php echo $row['id_barang']; ?>"><i class="fa fa-edit fa-fw"></i></button>
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#myHapus<?php echo $row['id_barang'];?>"><i class="fas fa-trash"></i></button>
										</td>
									
									<!-- modal edit -->
									<div class="modal fade" id="myEdit<?php echo $row['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?php echo site_url('Warehouse/editbarang/'.$row['id_barang']);?>" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Edit Data Master Barang</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Nama Barang</label>
                                                                    <input class="form-control" name="nama_barang" autocomplete="off" required="required" value="<?php echo $row['nama_barang']?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Jenis</label>
                                                                    <select class="form-control" name="jenis">
																		<option <?php echo ($row['jenis']=='Alat Berat')?'selected':''; ?> value="Alat Berat">Alat Berat</option>
																		<option <?php echo ($row['jenis']=='Umum')?'selected':''; ?> value="Umum">Umum</option>
																		<option <?php echo ($row['jenis']=='IT')?'selected':''; ?> value="IT">IT</option>
																	</select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Stok</label>
                                                                    <input type="number" class="form-control" name="stok" autocomplete="off" required="required" value="<?php echo $row['stok']?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Satuan</label>
                                                                    <input class="form-control" name="satuan" autocomplete="off" required="required" value="<?php echo $row['satuan']?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
																	<!-- <?php
																		$koderak = $row['KODE_RAK']; // AA0101
																		$blok = substr($koderak,0,1); //A
																		$baris = substr($koderak,1,1); //A
																		$kolom = substr($koderak,2,2); //01
																		$no_rak = substr($koderak,4,2); //01
																		// memecah kode rak
																	?> -->
                                                                <div class="form-group">
                                                                    <label>Blok</label>
                                                                    <input type="text" class="form-control" name="blok" placeholder="A-Z" required="required" pattern="[A-Z]{1}" title="1 Huruf Alphabet" autocomplete="off" value="<?php echo $row['blok']?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Kode</label>
                                                                    <input type="text" class="form-control" name="kode" placeholder="A-Z" required="required" pattern="[A-Z]{1}" title="1 Huruf Alphabet" autocomplete="off" value="<?php echo $row['kode']?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Baris</label>
                                                                    <input type="number" class="form-control" name="baris" placeholder="A-Z" required="required" autocomplete="off" value="<?php echo $row['baris']?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Kolom</label>
                                                                    <input type="number" class="form-control" name="kolom" placeholder="A-Z" required="required" autocomplete="off" value="<?php echo $row['kolom']?>">
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
                                    <div class='modal fade' id='myHapus<?php echo $row['id_barang'];?>'' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <form action="<?php echo site_url('Warehouse/deleteBarang/'.$row['id_barang'])?>" method="post">
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                        <h4 class='modal-title' id='myModalLabel'>Hapus Data Master Barang</h4>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <input type="text" name="id_barang"  hidden value="<?php echo $row['id_barang'];?>">
                                                        <center><h4>Apakah Anda Ingin Menghapus Data  : <b><?php echo $row['nama_barang'];?> ? </b>
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
<!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myEdit<?php echo site_url('Warehouse/editbarang/'.$row['KODE_BARANG']);?>"><i class="fa fa-edit fa-fw"></i></button> -->

<!-- <!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h1>Master Barang</h1>
<form method="POST" action="<?php echo site_url('Warehouse/addbarang');?>">
	Jenis: <select name="JENIS" >
				<option value="Alat Berat">Alat Berat</option>
				<option value="Umum">Umum</option>
				<option value="IT">IT</option>
			</select><br>
	Nama Barang: <input type="text" name="NAMA_BARANG" placeholder="Masukkan Nama Barang" required="required"><br>
	Stok: <input type="text" name="STOK" placeholder="Jumlah Stok" required="required"><br>
	Satuan: <input type="text" name="SATUAN" placeholder="" required="required"><br>
	Kode Rak:<br>
	Blok: 	
	Baris: <input type="text" name="baris" placeholder="A-Z" required="required" pattern="[A-Z]{1}" title="1 Huruf Alphabet"> 
	Kolom: <input type="text" name="kolom" placeholder="" required="required"> 
	No. Rak: <input type="text" name="no_rak" placeholder="" required="required"><br>
	<button type="submit" name="btnsimpan">Simpan</button> <button type="submit" name="btnhapus">Hapus</button>
</form>
<hr>
<table width="100%">
	<thead>
		<tr>
			<th>Jenis</th>
			<th>Nama Barang</th>
			<th>Stok</th>
			<th>Satuan</th>
			<th>Kode Rak</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($barang as $row) {
		?>
		<tr>
			<td><?php echo $row['JENIS'] ;?></td>
			<td><?php echo $row['NAMA_BARANG'] ;?></td>
			<td><?php echo $row['STOK'] ;?></td>
			<td><?php echo $row['SATUAN'] ;?></td>
			<td><?php echo $row['KODE_RAK'] ;?></td>
			<td><a href="<?php echo site_url('Warehouse/editbarang/'.$row['KODE_BARANG']);?>">EDIT</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>

</body>
</html> -->