<div class="single-slidebar">
	<figure class="mb-4">
		<a href="javascript:avoid(0)" class="employer-dashboard-thumb">
        <?php 
          $profile_picture = get_bussiness_profile($this->session->userdata('employer_id'));
          $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/user.png';
        ?>
	      <img class="profile-picture" src="<?= base_url($profile_picture); ?>" alt="">
	      <input type="file" name="profile_picture" class="hidden" accept="image/jpg,image/jpeg,image/png">
	    </a>
		<figcaption>
			<h2><?= $this->session->userdata('username'); ?></h2>
		</figcaption>
	</figure>
	<ul class="cat-list">
		<li>
			<a class="justify-content-between d-flex text_active" href="<?= base_url('bussiness/account/dashboard'); ?>"><p><i class="fa fa-dashboard pr-2"></i> <?=trans('label_dashboard')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex text_active" href="<?= base_url('bussiness/profile'); ?>"><p><i class="fa fa-user-o pr-2"></i> <?=trans('personal_info')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/company'); ?>"><p><i class="fa fa-user-o pr-2"></i>  <?=trans('company_profile')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/staff/add_staff'); ?>"><p><i class="fa fa-plus pr-2"></i> <?=trans('add_staff')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/staff/appointment_list'); ?>"><p><i class="fa fa-list pr-2"></i> Appointments</p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/job/post'); ?>"><p><i class="fa fa-plus pr-2"></i>  <?=trans('post_new_job')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/service/post'); ?>"><p><i class="fa fa-plus pr-2"></i>  <?=trans('post_new_service')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/service/post_product'); ?>"><p><i class="fa fa-plus pr-2"></i>Posting Product</p></a>
		</li>
		<li>
      <a class="" href="<?= base_url('bussiness/products/'); ?>"><p><i class="fa fa-shopping-cart pr-2"></i> <?=trans('label_my_products')?></p></a>
    </li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/service/post_deal'); ?>"><p><i class="fa fa-plus pr-2"></i>Posting Deals</p></a>
		</li>
		<li>
      <a class="" href="<?= base_url('bussiness/deals/'); ?>"><p><i class="fa fa-shopping-cart pr-2"></i> <?=trans('label_my_deals')?></p></a>
    </li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/job/listing'); ?>"><p><i class="fa fa-list pr-2"></i>  <!-- <?=trans('label_manage_jobs')?> -->Manage Jobs/Services</p></a>
		</li>
		<li>
      <a class="" href="<?= base_url('bussiness/orders/'); ?>"><p><i class="fa fa-shopping-cart pr-2"></i> <?=trans('label_my_orders')?></p></a>
    </li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/packages/bought'); ?>"><p><i class="fa fa-th-large pr-2"></i> <?=trans('my_packages')?> </p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/packages/bought_new_package'); ?>"><p><i class="fa fa-th-large pr-2"></i> <?=trans('new_package')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/cv/shortlisted') ?>"><p><i class="fa fa-briefcase pr-2"></i>  <?=trans('shortlisted_resumes')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/account/change_password'); ?>"><p><i class="fa fa-lock pr-2"></i> <?=trans('label_change_pass')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('bussiness/auth/logout'); ?>"><p><i class="fa fa-sign-out pr-2"></i> <?=trans('label_logout')?></p></a>
		</li>
	</ul>
</div>	