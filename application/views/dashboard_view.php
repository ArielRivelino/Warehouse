<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><?= $judul; ?></h1>
</div>

<!-- Content Row -->
<div class="row">
	<div class="col">
		<pre>
		
		</pre>
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

