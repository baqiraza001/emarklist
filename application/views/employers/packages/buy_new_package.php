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
				<div class="row pt-4 text-center d-flex " style="justify-content: space-evenly;">
			<?php foreach($package_detail as $package): ?>
				<div class="col-md-5 ">
					<div class="card mb-4 box-shadow card-columns">
						<div class="card-header" style="background-color: #f9f9ff">
							<h2 class="my-0 font-weight-bold" style="font-size: 23px;"><?= $package['title'] ?></h2>
							<h4 class="my-0 font-weight-normal mt-3">(<?= $package['no_of_posts'] ?> Posts)</h4>
							<h4 class="my-0 font-weight-normal mt-3 mb-3" style="font-size: 17px;">Package Duration (<?= $package['no_of_days'] ?> Days)</h4>
						</div>
						<div class="card-body">
						</div>
						<div class="card border-0">
							<div class="card-body text-center">
								<div class="card-text border p-3 mx-auto w-75" style="background-color: #f9f9ff;">
									<div class="mt-3">
										<p style="font-size: 30px;" class="text-left">USD</p>
										<p style="font-size: 45px;letter-spacing: 1px;" class="text-right"><?= $package['price'] ?></p>
										<p style="margin-top: 30px;" class="">
											<?php if($package['is_active'] == 1) { ?>
											<a href="<?= base_url();?>employers/packages/order_confirmation/<?php echo $package['id']; ?>" class="btn btn-success" style="padding: 7px 6px !important;"><?= trans('active') ?></a>
											<?php } ?>
											<?php if($package['is_active'] == 0) { ?>
											<a href="#" class="btn btn-danger" style="padding: 7px 6px !important;"><?= trans('deactivated') ?></a>
											<?php } ?>
										</p>
										<input type="hidden" name="package_id" value="<?php echo $package['id'];?>" >
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</div>

			</div>
		</div>
	</div>
</section>
