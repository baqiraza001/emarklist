<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('cv_search')?>
				</h1>	
				<p class="text-white link-nav"><a href=""><?=trans('label_home')?>Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""><?=trans('cv_search')?> </a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container" >
		<div class="row d-flex"  >
		<!--for cv search start-->
		  <div class="col-lg-6"  >
			<div class="col-lg-12">
				<div class="search-bar">
					<?php $attributes = array('id' => 'search_job', 'method' => 'post');
             		 echo form_open('employers/cv/search',$attributes);?>
	                <div class="row justify-content-center form-wrap no-gutters">
	                  <div class="col-lg-6 form-cols">
	                    <input type="text" class="form-control" name="job_title" value="<?php if(isset($search_value['title'])) echo str_replace('-', ' ', $search_value['title']); ?>" placeholder="<?=trans('search_for_resumes')?>">
	                  </div>
	                    
						<div class="col-3">
							<input type="submit" name="search" class="btn btn-info btn-lg" value="<?=trans('btn_search_text')?>">
						</div>
					</div>
	              <?php echo form_close(); ?>
	            </div> 
			</div>
			<!-- End search sidebar -->
			<div class="col-12 post-list">
				<?php if(empty($profiles)): ?>
		          <p class="alert alert-danger"><strong><?=trans('sorry')?>,</strong> <?=trans('profile_not_found')?></p>
		        <?php endif; ?>
				<?php foreach($profiles as $row): ?>
				<div class="single-post d-flex row">
					<div class="thumb col-lg-5" >
						<img src="<?= base_url()?>assets/img/user.png" height=100 alt="">
						<?php  $skills = explode("," , $row['skills']);?>
						<ul class="tags">
							<?php foreach($skills as $skill): ?>
							<li>
								<a href="#"><?= $skill; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="details col-lg-7">
						<div class="title d-flex flex-row justify-content-between">
							<div class="titles">
								<a href="#"><h4><?= $row['firstname'].' '.$row['lastname']; ?></h4></a>
								<h6><?= $row['job_title']; ?></h6>					
							</div>
						</div>
						<p class=""><?=trans('location')?>: <?= get_city_name($row['city']).','. get_country_name($row['country']); ?></p>
						<p class=""><?=trans('education')?>: <?= get_education_level($row['education_level']); ?></p>
						<p class=""><?=trans('experience')?>: <?= $row['experience']; ?> Years</p>
						<p class=""><?=trans('nationality')?>: <?= get_country_name($row['nationality']); ?></p>
						<p class=""><?=trans('cur_salary')?>: <?= $this->general_settings['currency']; ?> <?= $row['current_salary']; ?></p>
						<p class=""><?=trans('expected_salary')?>: <?= $this->general_settings['currency']; ?> <?= $row['expected_salary']; ?></p>
						<p class=""><?=trans('category')?>: <?= get_category_name($row['category']); ?></p>
						<p class="address">
							<?= $row['description']; ?>
						</p>
					</div>
					<div class="options col-lg-12">
						<a href="<?= base_url('employers/cv/make_shortlist/'.$row['id']); ?>" class="btn btn-info"><?=trans('shortlist')?></a>
							<?php if(!empty($row['resume'])) :?>
						<!-- <a href="<?= base_url().$row['resume']; ?>" class="btn btn-danger"><?=trans('download_resume')?></a> -->
							<?php endif; ?>
					</div>
				</div>			
				<?php endforeach; ?>									
			</div>
			<div class="col-12">
          		<div class="pull-right"><?php echo $this->pagination->create_links(); ?></div>
			</div>
		  </div>
		  <!--for cv search end-->

		  <!--for job seeker start-->
		  <div class="col-lg-6"  >
			<div class="col-lg-12">
				<div class="search-bar">
					<?php $attributes = array('id' => 'search_job', 'method' => 'post');
             		 echo form_open('jobs/search',$attributes);?>
	                <div class="row justify-content-center form-wrap no-gutters">
	                  <div class="col-lg-6 form-cols">
	                    <input type="text" class="form-control" name="job_title" value="<?php if(isset($search_value['title'])) echo str_replace('-', ' ', $search_value['title']); ?>" placeholder="<?=trans('search_for_jobs_new')?>">
	                  </div>
	                   
						<div class="col-3">
							<input type="submit" name="search" class="btn btn-info btn-lg" value="<?=trans('btn_search_text')?>">
						</div>
					</div>
	              <?php echo form_close(); ?>
	            </div> 
			</div>
			<!-- End search sidebar -->
			<div class="col-12 post-list">
				<?php if(empty($jobs)): ?>
		          <p class="alert alert-danger"><strong><?=trans('sorry')?>,</strong> <?=trans('profile_not_found')?></p>
		        <?php endif; ?>
	        <?php foreach($jobs as $job): ?>
	            <div class="single-post d-flex row">
		            <div class="thumb col-3">
		                <img src="<?= base_url(); ?>assets/img/job_icon.png" alt="">
		            </div>
		            <div class="details col-9">
		                <div class="title d-flex flex-row justify-content-between">
		                  <div class="titles">
		                    <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['title'], 35); ?></h4></a>
		                    <h6><?= get_company_name($job['company_id']); ?></h6>         
		                  </div>
		                </div>
		                <div class="job-listing-footer">
		                  <ul>
		                    <li><i class="lnr lnr-map-marker"></i> <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></li>
		                    <li><i class="lnr lnr-apartment"></i> <?= get_industry_name($job['industry']); ?></li>
		                    <li><i class="lnr lnr-clock"></i> <?= time_ago($job['created_date']); ?></li>
		                  </ul>                 
		                </div>
		            </div>
		            <div class=" col-12 pt-1">
		                <a class="saved_job btn btn-info" style="color: #fff;" data-job_id="<?= $job['id']; ?>">Save</a>
		                <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btn btn-danger"><?=trans('apply')?></a>
		            </div>
	            </div>
	        <?php endforeach; ?>
	           <!--  <a class="text-uppercase loadmore-btn mx-auto d-block" href="<?= base_url('jobs'); ?>"><?=trans('load_more_jobs')?></a> -->
			</div>
			<div class="col-12">
          		<div class="pull-right"><?php echo $this->pagination->create_links(); ?></div>
			</div>
		  </div>
		  <!--for job seeker end-->


		  	
		</div>
	</div>	
</section>
<!-- End post Area -->

