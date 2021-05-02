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
        			echo form_open('bussiness/staff/add_staff',$attributes);?>

					<div class="add_job_content col-lg-12">
						<div class="headline">
							<h3><i class="fa fa-folder-o"></i>Add New Staff</h3>
						</div>
						<div class="add_job_detail">
							<div class="row">
								<div class="col-12">
									<div class="submit-field">
										<h5>Designation *</h5>
										<input type="text" required name="designation" class="form-control" value="<?= set_value('designation') ?>">
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Name *</h5>
										<input type="text" required name="name" class="form-control" value="<?= set_value('name') ?>">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field"> 
										<h5>Gender</h5>
										<select name="gender" class="form-control" required>	
									   		<option value="Male"><?=trans('male')?></option>
									   		<option value="Female"><?=trans('female')?></option>
									   		<option value="No Preference" selected=""><?=trans('no_preference')?></option>
										</select>
									</div>
								</div>

								
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Shift Start *</h5>
										<select class="form-control" name="shift_start" required>
											<?php
											for ($i=1; $i <=24 ; $i++) { 
											
											?>
										   <option value="<?= $i ?>"><?php echo $i.":00"; ?></option>
										   	<?php 
											}
											?>

										</select>
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Shift End *</h5>
										<select class="form-control" name="shift_end" required>
											<?php
											for ($i=1; $i <=24 ; $i++) { 
											?>
										   <option value="<?= $i ?>"><?php echo $i.":00"; ?></option>				
										   <?php 
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Service Type *</h5>
										<?php 
											$types = get_job_post_by_posting_type(2, $bussiness_id);
											$options = array('' => trans('select_service_type')) + array_column($types, 'title','id');
											echo form_dropdown('service_id',$options,'','class="form-control service_type" required');
										?>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Working Days *</h5>
										<select name="working_days[]" class="form-control" multiple="true">	
								   		<?php foreach (weekDays() as $key => $value) { ?>
								   		<option value="<?= $key ?>"><?= $value ?></option>
											<?php } ?>	
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