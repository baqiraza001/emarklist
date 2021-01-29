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

			<div class="col-lg-12">
				<h3>Your Order Summary</h3>
				<hr />
			</div>

			<div class="col-lg-6">

				<div class="card">

					<div class="card-body">

						<h5 class="card-title"><?= $package_detail['title'] ?> &nbsp; (<span><?= $this->general_settings['currency']; ?></span> <?=$package_detail['price']?><?=($package_detail['price'] != 0)? '&nbsp;/&nbsp;'.($package_detail['title']):'';?>)</h5>

						<p class="card-text">This package includes following features: </p>
						<p class="card-text">
							<?=trans('no_of_posts')?>: <?= $package_detail['no_of_posts'] ?>
						</p>
						<p class="card-text">
							<?=trans('no_of_days')?>: <?= $package_detail['no_of_days'] ?>
						</p>

						<p class="card-text">Details:
							 <?= $package_detail['detail'] ?>
						</p>

						<p><h4>Total Due: &nbsp;<?= $this->general_settings['currency']; ?> <?=$package_detail['price']?></h4></p>
						<!--<p><h4>Next Expiry Date: &nbsp; $expiry_date?></h4></p> -->

					</div>

				</div>

			</div>

			<div class="card col-lg-5">
				<div class="card-body">
					<!-- Credit card form tabs -->
					<ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
						<li class="nav-item">
							<a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
								<i class="fa fa-credit-card"></i>
								Credit Card
							</a>
						</li>

						<li class="nav-item">
							<a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
								<i class="fa fa-paypal"></i>
								Paypal
							</a>
						</li>

					</ul>
					<!-- End -->


					<!-- Credit card form content -->
					<div class="tab-content">

						<!-- credit card info-->
						<div id="nav-tab-card" class="tab-pane fade show active">
							<p class="payment-status" id="payment-errors">&nbsp;</p>
							<?php $attributes = array('id' => 'paymentFrm', 'method' => 'post' , 'class' => 'form_horizontal'); ?>
							<?php echo form_open_multipart(base_url('employers/packages/pay_with_stripe'),$attributes);?>
							<div class="form-group">
								<label for="username">Full name (on the card)</label>
								<input type="text" name="name" id="name" placeholder="Jason Doe" required class="form-control">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" id="email"  placeholder="test@example.com" required class="form-control">
							</div>

							<div class="form-group">
								<input type="hidden" name="item_number" class="form-control" value="<?= $package_detail['id'] ?>" required>
							</div>

							<div class="form-group">
								<input type="hidden" name="item_price" class="form-control" value="<?= $package_detail['price'] ?>" required />
							</div>

							<div class="form-group">
								<label for="cardNumber">Card number</label>
								<div class="input-group">
									<input type="text" name="card-number" id="card-number" autocomplete="off" placeholder="Your card number" class="form-control" required>
									<div class="input-group-append">
                    <span class="input-group-text text-muted">
                                                <i class="fa fa-cc-visa mx-1"></i>
                                                <i class="fa fa-cc-amex mx-1"></i>
                                                <i class="fa fa-cc-mastercard mx-1"></i>
                                            </span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-8">
									<div class="form-group">
										<label><span class="hidden-xs">Expiration</span></label>
										<div class="input-group">
											<input type="number" placeholder="MM" maxlength="2" name="card-expiry-month" id="card-expiry-month" class="form-control" required>
											<input type="number" placeholder="YY" maxlength="4" name="card-expiry-year" id="card-expiry-year" class="form-control" required>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group mb-4">
										<label data-toggle="tooltip" title="Three-digits code on the back of your card">CVV
											<i class="fa fa-question-circle"></i>
										</label>
										<input type="text" name="card-cvc" id="card-cvc" required class="form-control">
									</div>
								</div>



							</div>
							<button type="submit" id="payBtn" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Confirm  </button>
							<?php echo form_close(); ?>
						</div>
						<!-- End -->

						<!-- Paypal info -->
						<div id="nav-tab-paypal" class="tab-pane fade">
							<?php echo form_open(base_url('employers/packages/buy'), 'class="my-form" '); ?>
							<input type="hidden" name="package_id" value="<?=$package_detail['id']?>">
							<p>Pay with your Paypal account.</p>
							<p>
								<input type="submit" name="submit" class="btn btn-primary rounded-pill" value="Pay with Paypal">
							</p>
							<p class="text-muted">System will take you to Paypal website for payment.
							</p>
							<?php echo form_close(); ?>
						</div>
						<!-- End -->




					</div>
					<!-- End -->

				</div>
			</div>


		</div>

	</div>

</section>

<script>
	var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
	var csfr_token_value = '<?php echo $this->security->get_csrf_hash(); ?>';
	var total_amount = '<?php $package_detail['price'];  ?>';
	var currency = '<?php echo 'USD'; ?>';
	var stripe_key = '<?php echo 'sk_test_TMbUaFbCy6vreanBfGa64frP00mxfxxHiv' ?>';
</script>

<!-- Stripe JavaScript library -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

