<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          <?=trans('top_companies')?>
        </h1> 
        <p class="text-white link-nav"><a href=""><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""><?=trans('top_companies')?></a></p>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->

<section class="post-area section-gap">
  <div class="container">
    <div class="row">
      <?php foreach($companies as $company): ?>
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="company-item-list text-center">
          <a href="<?= base_url('company/detail1/'.$company['company_slug']); ?>"><img src="<?= base_url().$company['company_logo']; ?>" alt="company-img" /></a>
            <h4 class="card-title text-center mt-3"><?= text_limit($company['company_name'], 20); ?></h4>
            <p class="card-text text-center"><?= text_limit($company['description'], 40); ?></p>
          </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
     