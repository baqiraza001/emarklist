<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('order_confirmation')?>
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('back')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""><?=trans('order_confirmation')?> </a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<section class="section-gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<h3><?=trans('order_summary')?></h3>
				<hr />
				<div class="card">
					<div class="card-body">
					    <h5 class="card-title"><?= $package_detail['title'] ?></h5>
					    <p class="card-text"><?= $package_detail['detail'] ?></p>
					    <ul>
					    	<h6><?=trans('no_of_posts')?>: <?= $package_detail['no_of_posts'] ?>  </h6>
					    	<h6><?=trans('no_of_days')?>: <?= $package_detail['no_of_days'] ?></h6>
					    </ul>
					   
					    <h3 class="mt-5"><?= $package_detail['price']. $this->config->item('paypal_lib_currency_code') ?></h3>

					    <!-- Paypal Integration-->

					    <?php

						$paypal_url = $this->config->item('paypal_url'); // Test Paypal API URL

						$paypal_id = $this->config->item('business'); // Business email ID

						?>
				        
				        <?php echo form_open( base_url('employers/packages/buy'), array('id'=>'','method'=>'post')); ?>
				            <input type="hidden" name="package_id" value="<?= $package_detail['id'] ?>">
				
							<input type="image" class="float-right" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="<?=trans('paypal_msg')?>!">

						<?php echo form_close(); ?>

					  </div>
				</div>
			</div>
		</div>
	</div>
</section>
