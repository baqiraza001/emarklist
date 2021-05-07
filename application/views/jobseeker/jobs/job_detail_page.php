<!-- JSsocials -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugins/jssocials/jssocials.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugins/jssocials/jssocials-theme-flat.css" />

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('job_details')?>
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('job_details')?></a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<!-- Start post Area -->
<?php
if ($job_detail['posting_type']== '1') {
	?>
	<section class="post-area section-gap">
		<div class="container">
			<div class="row d-flex">
				<div class="col-lg-8 col-12">
					<?php if($this->session->flashdata('applied_success')): ?>
						<div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<?=$this->session->flashdata('applied_success')?>
						</div>
					<?php  endif; ?>
					<?php if($already_applied == true && $this->session->flashdata('applied_success') == null): ?>
						<div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<?=trans('already_applied')?>
						</div>
					<?php  endif; ?>
					<?php if($this->session->flashdata('validation_errors')): ?>
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<?= $this->session->flashdata('validation_errors') ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-lg-8 post-list">
					<div class="single-post d-flex flex-row">
						<div class="details col-12">
							<div class="title d-flex flex-row justify-content-between mb-2">
								<div class="titles">
									<a href="#"><h4><?= $job_detail['title']; ?></h4></a>
									<h6><?= get_company_name($job_detail['company_id']); ?></h6>					
								</div>
								<?php if($already_applied != true): ?>
									<ul class="btns">
										<li><a id="btn-apply" data-toggle="collapse" href="#collapseExample" role="button"><?=trans('apply')?></a></li>
									</ul>
								<?php endif; ?>
							</div>
							<hr/>
							<p class="address">
								<strong><?=trans('industry')?>:</strong> <?= get_industry_name($job_detail['industry']); ?>
							</p>
							<p class="address">
								<strong><?=trans('total_positions')?>:</strong> <?= $job_detail['total_positions']; ?>
							</p>
							<p class="address">
								<strong><?=trans('job_type')?>:</strong> <?= get_job_type_name($job_detail['job_type']); ?>
							</p>
							<p class="address">
								<strong><?=trans('gender')?>:</strong> <?= $job_detail['gender']; ?>
							</p>
							<p class="address">
							<strong><?=trans('salary')?>:</strong> <?= $job_detail['min_salary']; ?><?php //$this->general_settings['currency'];
							if ($job_detail['Currency_type']==1) {
								?>USD<?php
							}
							else{
								?>Naira<?php	
							}
							?> - 
							 <?= $job_detail['max_salary']; ?><?php //$this->general_settings['currency'];
							 if ($job_detail['Currency_type']==1) {
							 	?>USD<?php
							 }
							 else{
							 	?>Naira<?php	
							 }
							 ?>  (<?= $job_detail['salary_period']; ?>)
							</p>
							<p class="address">
								<strong><?=trans('education')?>:</strong> <?= get_education_level($job_detail['education']); ?>
							</p>
							<p class="address">
								<strong><?=trans('experience')?>:</strong> <?= $job_detail['experience']; ?> Years
							</p>
							<p class="address">
								<strong><?=trans('location')?>:</strong> <?= get_city_name($job_detail['city']); ?>, <?= get_country_name($job_detail['country']); ?>
							</p>
							<p class="address">
								<strong><?=trans('posted_date')?>:</strong> <?= date('d-m-Y', strtotime($job_detail['created_date'])); ?>
							</p>
							<p class="description">
								<?= $job_detail['description']; ?>
							</p>
							<?php  $skills = explode("," , $job_detail['skills']);?>
							<ul class="tags">
								<?php foreach($skills as $skill): ?>
									<li>
										<a href="#"><?= $skill; ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
							<span class="inline-block float-right" id="share"></span> 
						</div>
					</div>	
					<div id="apply-block">
						<div class="collapse" id="collapseExample">
							<div class="card card-body">
								<h4 class="card-title"><?=trans('apply_for_job')?></h4>
								<?php $attributes = array('id' => 'job-form', 'method' => 'post');
								echo form_open_multipart(base_url('jobs/apply_job'),$attributes);
								?>	
								<div class="form-group">
									<textarea name="cover_letter" class="form-control" rows="5" placeholder="<?=trans('msg_sect_employer')?>"></textarea>
							       	<!-- <input type="file" name="userfile" class="form-control">
							       	-->
							       	<div class="input-group">
							       		<div class="input-group-prepend">
							       			<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
							       		</div>
							       		<div class="custom-file">
							       			<input type="file" name="userfile" class="custom-file-input" id="inputGroupFile01" value="inputGroupFileAddon01" 
							       			aria-describedby="inputGroupFileAddon01">
							       			<label class="custom-file-label " for="inputGroupFile01">Choose file</label>
							       		</div>
							       	</div>

							       </div> 

							       <!-- Hidden Inputs -->
							       <input type="hidden" name="username" value="<?= $user_detail['firstname']; ?>">
							       <input type="hidden" name="email" value="<?= $user_detail['email']; ?>" >
							       <input type="hidden" name="job_id" value="<?= $job_detail['id']; ?>" >
							       <input type="hidden" name="emp_id" value="<?= $job_detail['employer_id']; ?>" >
							       <input type="hidden" name="job_title" value="<?= $job_detail['title']; ?>" >
							       <!-- current url for redirect to same job detail page  -->
							       <input type="hidden" name="job_actual_link" value="<?= $job_actual_link ?>" >

							       <?php
							       $last_request_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							       $this->session->set_userdata('last_request_page', $last_request_page); 
							       ?>

							       <?php if($this->session->userdata('is_user_login') == true): ?>
							       	<button type="submit" name="submit" value="submit" class="btn btn-primary btn-block"><?=trans('send_application')?></button>

							       	<?php elseif($this->session->userdata('is_employer_login') == true): ?>
							       		<a href="<?= base_url('auth/login'); ?>" class="btn btn-primary btn-block"><?=trans('login_jobseeker')?></a>
							       		<?php else: ?>
							       			<a href="<?= base_url('auth/login'); ?>" class="btn btn-primary btn-block"><?=trans('login_jobseeker')?></a>
							       		<?php endif; ?>    

							       		<?php echo form_close(); ?>
							       	</div>
							       </div>
							     </div>
							   </div>
							   <div class="col-lg-4 sidebar">
							   	<div class="single-slidebar">
							   		<h4><?=trans('label_jobs_by_loc')?></h4>
							   		<ul class="cat-list">
							   			<?php foreach($cities_job as $city):?>
							   				<li><a class="justify-content-between d-flex" href="<?= base_url('jobs/location/'.get_city_slug($city['city_id'])); ?>"><p><?= get_city_name($city['city_id']); ?></p><span><?= $city['total_jobs']; ?></span></a></li>
							   			<?php endforeach; ?>
							   		</ul>
							   	</div>													
							   </div>
							 </div>
							</div>	
						</section>
						<?php
					}
					else{
						?>

						<!--test image-->
						<!--Service view start-->
						<section class="post-area section-gap" style="margin-bottom: -20%;">
							<div class="container">

								<div class="row d-flex"> 
									<div class="col-lg-8 post-list">
										<div class="single-post d-flex flex-row">
											<div class="details col-12">
												<div class="title d-flex flex-row justify-content-between mb-2">
													<!--show image using photorama-->
													<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

													<!-- Fotorama from CDNJS, 19 KB -->
													<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
													<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
													<?php 
													$job_id=$job_detail['id'];
													$profile_picture = get_service_image($job_id);
													if(is_array($profile_picture) && !empty($profile_picture))
														{ ?>
															<div class="fotorama" data-width="" data-height="500"  data-ratio="800/560"  data-allowfullscreen="true"   data-nav="thumbs" style="background-color:#ffffff;border : solid #000 1px;" >

																<?php foreach($profile_picture as $key1=>$val1){
																	if($val1['name'] !='')
																	{
            	//echo $val1['name'];
																		?>
																		<img class="profile-picture" src="<?= base_url('uploads/service_images/'.$val1['name']); ?>" /> 

																	<?php } }?> 
																</div>
															<?php }
															else{
																$the_img = 'assets/img/job_icon1.jpg'; 
																?>
																<!-- <div class="fotorama" data-width="100%" data-height="500"  data-ratio="800/560"  data-allowfullscreen="true"   data-nav="thumbs" style="background-color:#ffffff;" > -->
																	<img class="profile-picture" src="<?= base_url($the_img); ?>" alt="" width="70%" />
																	<!-- </div> -->
																	<?php
																}?>
																<!--show image using photorama-->

															</div> 
														</div>
													</div>	 
												</div>
			<!-- <div class="col-lg-4 sidebar">
				<div class="single-slidebar">
		            <h4><?=trans('label_jobs_by_loc')?></h4>
		            <ul class="cat-list">
		              <?php foreach($cities_job as $city):?>
		               <li><a class="justify-content-between d-flex" href="<?= base_url('jobs/location/'.get_city_slug($city['city_id'])); ?>"><p><?= get_city_name($city['city_id']); ?></p><span><?= $city['total_jobs']; ?></span></a></li>
		             <?php endforeach; ?>
		           </ul>
		         </div>													
		       </div> -->
		     </div>
		   </div>	
		 </section>
		 <!--service view end-->
		 <!--test image end-->


		 <!--Service view start-->
		 <section class="post-area section-gap">
		 	<div class="container">

		 		<div class="row d-flex">
		 			<div class="col-lg-8 col-12">
		 				<?php if($this->session->flashdata('already_busy')): ?>
		 					<div class="alert alert-success">
		 						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		 						<?=$this->session->flashdata('already_busy')?>
		 					</div>
		 				<?php  endif; ?>
		 				<?php if($already_applied == true && $this->session->flashdata('applied_success') == null): ?>
		 					<div class="alert alert-success">
		 						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		 						<?=trans('already_applied')?>
		 					</div>
		 				<?php  endif; ?>
		 				<?php if($this->session->flashdata('validation_errors')): ?>
		 					<div class="alert alert-danger">
		 						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		 						<?= $this->session->flashdata('validation_errors') ?>
		 					</div>
		 				<?php endif; ?>
		 			</div>


		 			<div class="col-lg-8 post-list">
		 				<div class="single-post d-flex flex-row">
		 					<div class="details col-12">
		 						<div class="title d-flex flex-row justify-content-between mb-2">

		 							<div class="titles">
		 								<a href="#"><h4><?= $job_detail['title']; ?></h4></a>
		 								<h6><?= get_company_name($job_detail['company_id']); ?></h6>					
		 							</div>
		 							<ul class="btns">
		 								<!-- 								<li><a id="btn-apply" data-toggle="collapse" href="#collapseExample" role="button">Book Service</a> -->
		 									<a href="#" data-toggle="modal" data-target="#emailModal" data-whatever=""><i class="lnr lnr-envelope"></i> Book Service</a>
		 								</li>

		 							</ul>

		 							<!--for service booking start-->
		 							<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		 								<div class="modal-dialog modal-dialog-centered" role="document">
		 									<div class="modal-content">
		 										<div class="modal-header">
		 											<h5 class="" id="exampleModalLabel">New Appointment</h5>
		 											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		 												<span aria-hidden="true">&times;</span>
		 											</button>
		 										</div>
		 										<div class="modal-body">
		 											<?php $attributes = array('id' => 'appointment', 'method' => 'post');
		 											echo form_open('services/add_appointment',$attributes); ?>
		 											<input type="hidden" name="service_id" class="form-control" id="service_id" value="<?php echo $job_detail['id']; ?>">

		 											<div class="form-group">
		 												<label for="message-text" class="col-form-label">Select staff member :</label>

		 												<select name="staff" id="staff" class="form-control staff">
		 													<option value="">Select staff</option>
		 													<?php foreach($staff_data as $staff):?>
		 														<option value="<?= $staff->id ?>"><?php echo "$staff->name | $staff->service_name | $staff->category_name" ?></option>
		 													<?php endforeach; ?>
		 												</select>

		 											</div>

		 											<div class="form-group">
		 												<label for="appt-time">Choose Appointment Time</label>
		 												<select class="form-control" id="appointment_time" name="appointment_time">
		 													<option value="">Choose Appointment Time</option>
		 												</select>
		 												<span class="validity"></span>
		 											</div>

		 											<div class="form-group">
		 												<button type="button" class="btn btn-secondary" data-dismiss="modal"><?=trans('close')?></button>
		 												<input type="submit" class="btn btn-primary" name="submit" value="Confirm">
		 											</div>
		 											<?php form_close(); ?>
		 										</div>

		 									</div>
		 								</div>
		 							</div>
		 							<!--for service booking end-->
		 						</div>
		 						<hr/>
		 						<p class="description">
		 							<?= $job_detail['description']; ?>
		 						</p>
		 						<p class="address">
		 							<strong>Price:</strong> <?= $job_detail['cost']; ?><?= $this->general_settings['currency']; ?>
		 						</p>

		 						<?php
		 						$comp_info=$this->db->query("SELECT * FROM xx_companies WHERE id='".$job_detail['company_id']."' ")->result_array();
		 						foreach ($comp_info as $key) {
		 							$contact_number=$key['phone_no'];
		 						}
		 						if (!empty($contact_number)) {
		 							?>
		 							<p class="address">
		 								<strong>Contact:</strong> <?= $contact_number; ?>
		 							</p>
		 							<?php
		 						}
		 						?>

		 						<p class="address">
		 							<!-- <strong><?=trans('location')?>:</strong> <?= get_city_name($job_detail['city']); ?>, <?= get_country_name($job_detail['country']); ?> -->
		 							<strong><?=trans('location')?>:</strong> <?= $job_detail['location']; ?>
		 						</p>
		 						<p class="address">
		 							<strong><?=trans('posted_date')?>:</strong> <?= date('d-m-Y', strtotime($job_detail['created_date'])); ?>
		 						</p>

				<!-- 		<?php  $skills = explode("," , $job_detail['skills']);?>
						<ul class="tags">
							<?php foreach($skills as $skill): ?>
							<li>
								<a href="#"><?= $skill; ?></a>
							</li>
							<?php endforeach; ?>
						</ul> -->
						<span class="inline-block float-right" id="share"></span> 
					</div>
				</div>	
			<!-- 	<div id="apply-block">
					<div class="collapse" id="collapseExample">
						<div class="card card-body">
							<h4 class="card-title"><?=trans('apply_for_job')?></h4>
						    <?php $attributes = array('id' => 'job-form', 'method' => 'post');
		        			echo form_open(base_url('jobs/apply_job'),$attributes);
		        			?>	
						      	<div class="form-group">
							       <textarea name="cover_letter" class="form-control" rows="5" placeholder="<?=trans('msg_sect_employer')?>"></textarea>
							    </div> 

							    <input type="hidden" name="username" value="<?= $user_detail['firstname']; ?>">
							    <input type="hidden" name="email" value="<?= $user_detail['email']; ?>" >
							    <input type="hidden" name="job_id" value="<?= $job_detail['id']; ?>" >
							    <input type="hidden" name="emp_id" value="<?= $job_detail['employer_id']; ?>" >
							    <input type="hidden" name="job_title" value="<?= $job_detail['title']; ?>" >
							    current url for redirect to same job detail page 
							    <input type="hidden" name="job_actual_link" value="<?= $job_actual_link ?>" >
								
								<?php
								    $last_request_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
								    $this->session->set_userdata('last_request_page', $last_request_page); 
								 ?>

								<?php if($this->session->userdata('is_user_login') == true): ?>
								    <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block"><?=trans('send_application')?></button>

								<?php elseif($this->session->userdata('is_employer_login') == true): ?>
								    <a href="<?= base_url('auth/login'); ?>" class="btn btn-primary btn-block"><?=trans('login_jobseeker')?></a>
								<?php else: ?>
								    <a href="<?= base_url('auth/login'); ?>" class="btn btn-primary btn-block"><?=trans('login_jobseeker')?></a>
								<?php endif; ?>    

							<?php echo form_close(); ?>
						</div>
					</div>
				</div> -->
			</div>
			<div class="col-lg-4 sidebar">
				<div class="single-slidebar">
					<h4><?=trans('label_jobs_by_loc')?></h4>
					<ul class="cat-list">
						<?php foreach($cities_job as $city):?>
							<li><a class="justify-content-between d-flex" href="<?= base_url('jobs/location/'.get_city_slug($city['city_id'])); ?>"><p><?= get_city_name($city['city_id']); ?></p><span><?= $city['total_jobs']; ?></span></a></li>
						<?php endforeach; ?>
					</ul>
				</div>													
			</div>
		</div>
	</div>	
</section>
<!--service view end-->
<?php
}
?>
<!-- End post Area -->

<script>

	$(document).ready(function (){
		$("#btn-apply").click(function (){
			$('html, body').animate({
				scrollTop: $("#apply-block").offset().top-90
			}, 1000);
		});


		$('#staff').on('change', function() {
			const staff_id = $(this).val();
			var data = {
				staff_id: staff_id
			}
			data[csfr_token_name] = csfr_token_value;
			$('.validity').html('Loading data');
			
			$.ajax({
				type: "POST",
				url: "<?= site_url('bussiness/staff/slot_booked_list') ?>",
				data: data,
				dataType: "json",
				success: function(data) {
					let slots_arr = [];
					<?php foreach ($staff_data as $staff) { ?>
						if(staff_id == <?= $staff->id ?>)
						{
							if(data.slots.indexOf('<?= $staff->shift_start.":00" ?>') == -1)
								slots_arr.push('<?= $staff->shift_start.":00" ?>');
							<?php 
							$start_time = ($staff->shift_start);
							$end_time = $staff->shift_end;
							$duration = $staff->duration;
							$duration_miutes = HHMMToMinutes($duration);
							for ($i=$start_time; $i < $end_time ; $i++) { 
								$slot = date('H:i', strtotime("+".$duration_miutes." minutes", strtotime("$i:00")));
								?>	
								if(data.slots.indexOf("<?= $slot ?>") == -1)
								{
									slots_arr.push("<?= $slot ?>");
								}
							<?php	} ?>
						}
					<?php } ?>
					$('.validity').html('');
					$('#appointment_time').html('<option>Choose Appointment Time</option>')
					$.each(slots_arr, function(key, value) {   
						$('#appointment_time')
						.append($("<option></option>")
							.attr("value", value)
							.text(value)); 
					});

				},
				error: function() {
				}
			})

		})
	});
</script>

<script src="<?= base_url() ?>assets/plugins/jssocials/jssocials.min.js"></script>
<script>
	$("#share").jsSocials({
		showLabel: false,
		showCount: false,
		shares: ["email","twitter", "facebook", "googleplus", "linkedin", "pinterest"]
	});
</script>