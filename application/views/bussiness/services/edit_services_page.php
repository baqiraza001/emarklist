<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/src/bootstrap-wysihtml5.css"></link>
<script src="<?= base_url(); ?>assets/js/html-duration-picker.min.js"></script>
<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('edit_service')?>
				</h1>	
				<p class="text-white link-nav"><a href="index.html"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('edit_service')?></a></p>
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
							if ($this->session->flashdata('service_update_success')) {
				                echo '<div class="alert alert-success">' . $this->session->flashdata('post_job_success') . '</div>';
				            }
							if(validation_errors()){
				                echo '<div class="alert alert-danger">' . validation_errors() . '</div>';
				        	}
						?>
					</div>

					<?php $attributes = array('id' => 'post_job', 'method' => 'post');
        			echo form_open_multipart('bussiness/service/edit/'.$service_record['id'],$attributes);?>

					<div class="add_job_content col-lg-12">
						<div class="headline">
							<h3><i class="fa fa-folder-o"></i> <?=trans('edit_service')?></h3>
						</div>
						<div class="add_job_detail">
							<div class="row">
								<div class="col-12">
									<div class="submit-field">
										<h5><?=trans('service_title')?> *</h5>
										<input type="text" name="job_title" class="form-control" value="<?= $service_record['title'] ?>">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Service Type *</h5>
										<?php 
											$types = get_service_type_list();
											$options =  array($service_record['job_type'] => $service_record['service_name']) + array_column($types, 'name','id');
											echo form_dropdown('service_type',$options,'','class="form-control service_type" required');
										?>
									</div>
								</div>
							
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Service Sub-Type *</h5>
										<select class="form-control category" name="category">
										   <option><?=trans('select_category')?></option>
										   <option value="<?= $service_record['category'] ?>" selected><?= $service_record['category_name']?></option>
										</select>
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Duration</h5>
										<input type="text" style="text-align: left;" name="duration" class="form-control html-duration-picker" data-hide-seconds  value="<?= $service_record['duration'] ?>">
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<div class="submit-field">
										<h5><?=trans('cost')?> <!-- (<?= $this->general_settings['currency']; ?>) --> *</h5>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<input type="number" name="cost" class="form-control" placeholder="<?=trans('cost')?>"  value="<?= $service_record['cost'] ?>">
												</div>
											</div>

											<div class="col-md-6">
												<div class="submit-field">
													<select name="currency_type" class="country form-control">
														<option value="">Select Currency</option>
														<option value="1" <?php if($service_record['cost'] == '1') echo "selected"; ?>>USD</option>
														<option value="2" <?php if($service_record['cost'] == '2') echo "selected"; ?>>Naira</option>
													</select>
												</div>
											</div>

										</div>
									</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Add Category (If not found on uper list)</h5>										
										<input type="text" name="add_category" class="form-control">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field"> 
										<h5>Service For *</h5>
										<select name="gender" class="form-control">	
									   		<option value="Male"<?php if($service_record['gender'] == 'Male') echo "selected"; ?>><?=trans('male')?></option>
									   		<option value="Female"<?php if($service_record['gender'] == 'Female') echo "selected"; ?>><?=trans('female')?></option>
									   		<option value="No Preference"<?php if($service_record['gender'] == 'No Preference') echo "selected"; ?>><?=trans('no_preference')?></option>
										</select>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('service_description')?> *</h5>
										<textarea name="description" class="textarea form-control" id="exampleFormControlTextarea1" rows="5"><?= $service_record['description'] ?></textarea>
									</div>
								</div>
								
								<div class="col-12">
									<div class="submit-field">
										<h5>Address *</h5>
										<input type="text" name="location" class="form-control" placeholder="<?=trans('type_address')?>" value="<?= $service_record['location'] ?>">
									</div>
								</div>
								<div class="col-12">
                  <div class="submit-field">
                    <h5><?=trans('profile_picture')?> (optional)</h5>
                    <input type="file" name="userfile[]" class="form-control" multiple="multiple">
                  </div>
                </div>
							</div>
						</div>
					</div>
					<div class="add_job_btn col-lg-12 mt-3">
						<div class="submit-field">
							<input type="submit" class="job_detail_btn" name="post_job" value="<?=trans('submit')?>">
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