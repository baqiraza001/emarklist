<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('your_packages')?>
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url('bussiness'); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('your_packages')?> </a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<section class="section-gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 sidebar">
				<?php $this->load->view($emp_sidebar); ?>					
			</div>

			<div class="col-lg-8 profile_job_content">
				<div class="headline">
					<h3><?=trans('your_packages')?></h3>
				</div>
				<?php if(empty($package_detail)): ?>
                  <p class="text-gray"><strong><?=trans('sorry')?>,</strong> <?=trans('no_package_msg')?></p>
                <?php endif; ?>

				<?php foreach($package_detail as $package): 
					if ($package['is_active']==1) {
					 ?>
				<div class="card m-5">
					<div class="card-body">
					    <h4 class="card-title"><?= $package['title'] ?></h4>
					    <!-- <p class="card-text"><?= $package['detail'] ?></p> -->
					    <p class="pt-3"><?=trans('num_of_posts')?> : <?= $package['no_of_posts'] ?></p>
					    <p class="pt-3"><?=trans('num_of_days')?> : <?= $package['no_of_days'] ?></p>
					    <p class="pt-3"><?=trans('bought_date')?> : <?= date_time($package['buy_date']) ?></p>
					    <p class="pt-3"><?=trans('expiry_date')?> : <?= date_time($package['expire_date']) ?></p>
					    <h5 class="pt-3"><?=trans('price')?> : <?= $package['price'] ?> </h5>
					    <?php
					    	$current_date = date("Y-m-d");
					    	if($current_date == $package['expire_date'])
					    		echo '<a class="btn btn-danger mt-3">'.trans('expired').'</a>';

					    	if($package['is_active'] == 1)
					    		echo '<a href="" class="btn btn-success mt-3">'.trans('active').'</a>';

					    	if($package['is_active'] == 0)
					    		echo '<a class="btn btn-danger mt-3">'.trans('deactivated').'</a>';
					    ?>


					  </div>
				</div>
				<?php
				} 
			endforeach; ?>
			</div>
		</div>
	</div>
</section>
