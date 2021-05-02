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
					Post New Deal
				</h1>	
				<p class="text-white link-nav"><a href="index.html"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Post New Deal</a></p>
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
							if ($this->session->flashdata('post_deal_success')) {
				                echo '<div class="alert alert-success">' . $this->session->flashdata('post_job_success') . '</div>';
				            }
							if(validation_errors()){
				                echo '<div class="alert alert-danger">' . validation_errors() . '</div>';
				        	}
						?>
					</div>

					<?php $attributes = array('id' => 'post_job', 'method' => 'post');
        			echo form_open_multipart('bussiness/deals/edit/'.$deal_record['id'],$attributes);?>

					<div class="add_job_content col-lg-12">
						<div class="headline">
							<h3><i class="fa fa-folder-o"></i>Edit Deal</h3>
						</div>
						<div class="add_job_detail">
							<div class="row">
								<div class="col-12">
									<div class="submit-field">
										<h5>Title *</h5>
										<input type="text" name="deal_title" class="form-control" value="<?= $deal_record['title'] ?>">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Deal Type *</h5>
										<?php 
											$types = get_service_type_list();
											$options =  array($deal_record['deal_type'] => $deal_record['service_name']) + array_column($types, 'name','id');
											echo form_dropdown('deal_type',$options,'','class="form-control service_type" required');
										?>
									</div>
								</div>
							
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Deal Category *</h5>
										<select class="form-control category" name="deal_category">
										   <option><?=trans('select_category')?></option>
										   <option value="<?= $deal_record['category'] ?>" selected><?= $deal_record['category_name']?></option>
										</select>
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<!-- <div class="submit-field"> -->

										<div class="submit-field">
										<h5>Add Category (If not found on uper list)</h5>		
										<input type="text" name="add_category" class="form-control">
									<!-- </div> -->
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Duration *</h5>
										<input type="text" style="text-align: left;" name="duration" class="form-control html-duration-picker" data-hide-seconds value="<?= $deal_record['duration'] ?>">
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Shift Start *</h5>
										<select class="form-control" name="shift_start" required>
											<?php
											for ($i=1; $i <=24 ; $i++) { 
											?>
										   <option value="<?= $i ?>" <?php if($deal_record['shift_start'] == $i) echo 'selected' ?>><?php echo $i.":00"; ?></option>
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
										   <option value="<?= $i ?>" <?php if($deal_record['shift_end'] == $i) echo 'selected' ?>><?php echo $i.":00"; ?></option>				
										   <?php 
											}
											?>
										</select>
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Price *</h5>
											<input type="number" name="price" class="form-control" value="<?= $deal_record['price'] ?>" placeholder="<?=trans('minimum')?>">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5> <?=trans('expiry_date')?> *</h5>
										<input type="date" name="expiry_date" class="form-control" placeholder="" value="<?= $deal_record['expiry_date'] ?>">
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Deal Description *</h5>
										<textarea name="deal_description" class="textarea form-control" id="exampleFormControlTextarea1" rows="5"><?= $deal_record['description'] ?></textarea>
									</div>
								</div>
								
								<div class="col-12">
				                  <div class="submit-field">
				                    <h5>Upload Photo (optional)</h5>
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