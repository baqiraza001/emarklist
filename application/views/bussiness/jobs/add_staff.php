<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/src/bootstrap-wysihtml5.css"></link>

<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Add Staff
				</h1>	
				<p class="text-white link-nav"><a href="index.html">Add Staff </a>  <span class="lnr lnr-arrow-right"></span>  <a href="">Add Staff</a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row justify-content-center d-flex">
			<div class="col-lg-4 sidebar">					
				<?php $this->load->view($emp_sidebar); ?>
			</div>
			
			<div class="col-lg-8 post-list">
				<div class="row">
					<div class="col-12">
						<?php 
							if ($this->session->flashdata('post_job_success')) {
				                echo '<div class="alert alert-success">' . $this->session->flashdata('post_job_success') . '</div>';
				            }
							if($this->session->flashdata('post_job_error')){
				                echo '<div class="alert alert-danger">' . $this->session->flashdata('post_job_error') . '</div>';
				        	}
						?>
					</div>

					<?php $attributes = array('id' => 'add_staff', 'method' => 'post');
        			echo form_open('bussiness/job/add_staff',$attributes);?>

					<div class="add_job_content col-lg-12">
						<div class="headline">
							<h3><i class="fa fa-folder-o"></i>Add New Staff</h3>
						</div>
						<div class="add_job_detail">
							<div class="row">
								<div class="col-12">
									<div class="submit-field">
										<h5>Designation *</h5>
										<input type="text" name="Designation" class="form-control">
									</div>
								</div>

								<div class="col-12">
									<div class="submit-field">
										<h5>Name *</h5>
										<input type="text" name="name" class="form-control">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Service Type *</h5>
										<?php 
											$types = get_service_type_list();
											$options = array('' => trans('select_service_type')) + array_column($types, 'name','id');
											echo form_dropdown('service_type',$options,'','class="form-control service_type" required');
										?>
									</div>
								</div>
							
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Service Sub-Type *</h5>
										<select class="form-control category" name="category">
										   <option><?=trans('select_category')?></option>
										   <!-- <?php foreach($categories as $category): ?>
										   		<option value="<?= $category['id']?>"><?= $category['name']?></option>
										   <?php endforeach; ?> -->
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="add_job_btn col-lg-12 mt-3">
						<div class="submit-field">
							<input type="submit" class="job_detail_btn" name="add_staff" value="<?=trans('submit')?>">
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>													
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->	



<script src="<?= base_url(); ?>assets/plugins/texteditor/lib/js/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>assets/plugins/texteditor/lib/js/prettify.js"></script>
<script src="<?= base_url(); ?>assets/plugins/texteditor/src/bootstrap-wysihtml5.js"></script>

<script>
	$('.textarea').wysihtml5();
</script>