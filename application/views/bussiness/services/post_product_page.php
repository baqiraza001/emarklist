<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/src/bootstrap-wysihtml5.css"></link>

<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Post New Product
				</h1>	
				<p class="text-white link-nav"><a href="index.html"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Post New Product</a></p>
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

					<?php $attributes = array('id' => 'post_job', 'method' => 'post');
        			echo form_open_multipart('bussiness/service/post_product',$attributes);?>

					<div class="add_job_content col-lg-12">
						<div class="headline">
							<h3><i class="fa fa-folder-o"></i> Post New Product</h3>
						</div>
						<div class="add_job_detail">
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Product Title *</h5>
										<input type="text" name="product_title" class="form-control">
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Product's Brand *</h5>
										<input type="text" name="brand_name" class="form-control" placeholder="Samsung ,Nokia ,Honda etc">
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Product Type *</h5>
										<?php 
											$types = get_service_type_list();
											$options = array('' => trans('select_service_type')) + array_column($types, 'name','id');
											echo form_dropdown('product_type',$options,'','class="form-control service_type" required');
										?>
									</div>
								</div>
							
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Product Sub-Type *</h5>
										<select class="form-control category" name="product_category">
										   <option><?=trans('select_category')?></option>
										   <!-- <?php foreach($categories as $category): ?>
										   		<option value="<?= $category['id']?>"><?= $category['name']?></option>
										   <?php endforeach; ?> -->
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Add Sub-Type (If not found on uper list)</h5>		
										<input type="text" name="add_category" class="form-control">
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Price (NAIRA) *</h5>
													<input type="number" name="price" class="form-control" placeholder="250k NAIRA">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
										<div class="submit-field">
										<h5>Quantity</h5>
										<input type="number" name="quantity" class="form-control" placeholder="1,2,3...etc">
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('service_description')?> *</h5>
										<textarea name="product_description" class="textarea form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
									</div>
								</div>
								<div class="col-12">
				                  <div class="submit-field">
				                    <h5>Upload Photo</h5>
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