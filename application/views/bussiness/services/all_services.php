<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('search_results')?>
				</h1>	
				<p class="text-white link-nav"><a href=""><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""><?=trans('search_results')?></a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->

<div class="container pb-50 pt-4">
  <div class="row">   
    <div class="col col-md-8 pb-5">
      <h3>Services</h3>
    </div>
    <!-- Wrapper for slides -->
    <div class="carousel-inner"> 
      <div class="item active">
        <div class="row ">
          <?php foreach($services as $job){?>
            <?php  
            $profile_picture = get_service_image($job['id']);
            $the_img = 'assets/img/job_icon1.jpg';
            if(is_array($profile_picture) && !empty($profile_picture))
            {
              foreach($profile_picture as $key1=>$val1)
              {
                if($val1['name'] !='')
                {
                  $the_img='uploads/service_images/'.$val1['name'];
                  break;
                } 
              }
            }
            ?>
            <div class="col-sm-3 pb-5">
              <div class="col-item ">
                <div class="photo">
                  <img class="profile-picture" src="<?= base_url($the_img); ?>" alt="" width="70%" />
                </div>
                <div class="info">
                  <div class="row">
                    <div class="price col-md-12 pt-4">
                      <a style="font-weight: bold;" href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><?= text_limit($job['title'], 20); ?></a>
                        <?php $company_name = get_company_name($job['company_id']); ?>
                        <h5 class="price-text-color"><?= text_limit($company_name, 20); ?>
                      </h5>
                    </div> 
                  </div>
                  <div class="separator clear-left">
                    <p class="btn-add">
                      <span class="lnr lnr-clock"></span> <?= time_ago($job['created_date']); ?>
                    </p>
                  </div>
                  <div class="clearfix">
                  </div>
                </div>
              </div>
            </div> 
          <?php  } ?>
        </div>
      </div> 
    </div> 
  <div class="pull-right">
      <?php echo $this->pagination->create_links(); ?>
  </div>
  </div> 
</div>
<!-- End post Area -->

