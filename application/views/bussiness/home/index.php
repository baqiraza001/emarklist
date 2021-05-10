 <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/slick.css">
 <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/slick-theme.css">
 <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
 <script src="<?= base_url() ?>assets/js/slick.js" type="text/javascript" charset="utf-8"></script>
 
 <!-- start banner Area -->
 <section class="banner-area relative" id="home">  
  <!-- <div class="overlay overlay-bg"></div> -->
  <div class="container">
    <div class="row fullscreen d-flex align-items-center justify-content-center" style="height: auto; padding-bottom: 50px;">
      <div class="banner-content col-lg-12 text-left">
        <?php $attributes = array('id' => 'search_job', 'method' => 'post');
        echo form_open('Services/search',$attributes);?>
        <div class="row form-wrap no-gutters">
          <div class="col-lg-3 form-cols">
            <input type="text" class="form-control" name="bussiness_name" placeholder="Bussiness Name">
          </div>

          <div class="col-lg-3 form-cols">
            <input type="text" class="form-control" name="Services" placeholder="Services">
          </div>

          <div class="col-lg-2 form-cols">
            <select name="country" class="form-control">
              <option value=""><?=trans('select_location')?></option>
              <?php foreach($countries as $country):?>
                <option value="<?= $country['id']?>"><?= $country['name']?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-lg-2 form-cols">
            <input type="submit" style="background: #256993" name="search" class="btn btn-info" value="<?=trans('btn_search_text')?>">
          </div>                
        </div>
        <?php echo form_close(); ?>
        <!--buttons-->
        <div class="container"> 


          <section class="center slider">
            <?php
            $cat=$this->db->query("SELECT * FROM xx_categories LIMIT 9")->result_array();
            foreach ($cat as $categories) {?>
              <div>
               <a href="<?= base_url();?>search/results/category/<?php echo $categories['id']; ?>" class="cat_btn_home"><?php echo $categories['name']; ?></a>
             </div>
           <?php } ?>
           <div>
             <a href="<?= base_url();?>search/results/" class="cat_btn_home">All</a>
           </div>
         </section>
       </div> 
       <!--buttons-->


     </div>                      
   </div>
 </div>
</section>
<!-- End banner Area --> 
<?php $the_img = 'assets/img/job_icon1.jpg'; ?> 

<div class="container pb-50 pt-4" id="bussiness">
  <div class="d-flex col col-md-12 pb-4">
    <div class="text-muted text-left"><h3>Business</h3></div>
    <a href="<?= site_url('company') ?>" class="btn btn-dark ml-auto">View All</a>
  </div>
  <div class="row">
    <?php foreach($companies as $job){?>
      <?php  
      
      $the_img = $job['company_logo'] ? $job['company_logo'] : $the_img;

      $company_name=get_company_name($job['company_id']);
      ?>
      <div class="card-deck col-lg-3 col-xs-12 mb-3" style="">
        <div class="card" style="margin-bottom: 5px;border-radius: 5px;">
          <div class="main-img-div" style="">
            <img class="card-img-top" src="<?= base_url($the_img); ?>" alt="image" style="width:100%">
            <div class="card-img-overlay text-center" style="position: relative;padding: 0.8rem !important;">
              <div class="ribbon-main-div " style="position: absolute;bottom: 0; left: 0; right: 0;">
                <img class="card-img-top rounded-circle" style="border: 4px solid #fff;width:70px;height: 70px;" src="<?= base_url($the_img); ?>" alt="image" >
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <h4 class="card-title text-center mt-3"><?= text_limit($job['title'], 20); ?></h4>
            <p class="card-text text-center"><?= text_limit($company_name, 40); ?></p>
            <hr>
            <div class="text-center">
              <a href="<?= site_url('company/'.($job['company_slug'])); ?>" class="btn ticker-btn-nav" style="padding: 9px 18px !important;">Apply Job</a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<div class="container pb-50 pt-4" id="services">
  <div class="d-flex col col-md-12 pb-4">
    <div class="text-muted text-left"><h3>Services</h3></div>
    <a href="<?= site_url('services')  ?>" class="btn btn-dark ml-auto">View All</a>
  </div>
  <div class="row">
    <?php foreach($services as $job){?>
      <?php  
      $profile_picture = get_service_image($job['id']);
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
      $company_name=get_company_name($job['company_id']);
      ?>
      <div class="card-deck col-lg-3 col-xs-12 mb-3" style="">
        <div class="card" style="margin-bottom: 5px;border-radius: 5px;">
          <div class="main-img-div" style="">
            <img class="card-img-top" src="<?= base_url($the_img); ?>" alt="image" style="width:100%">

            <div class="card-img-overlay text-center" style="position: relative;padding: 0.8rem !important;">
              <div class="ribbon-main-div " style="position: absolute;bottom: 0; left: 0; right: 0;">
                <img class="card-img-top rounded-circle" style="border: 4px solid #fff;width:70px;height: 70px;" src="<?= base_url($the_img); ?>" alt="image" >

              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <h4 class="card-title text-center mt-3"><?= text_limit($job['title'], 20); ?></h4>
            <p class="card-text text-center"><?= text_limit($company_name, 40); ?></p>
            <hr>
            <div class="text-center">
              <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btn ticker-btn-nav" style="padding: 9px 18px !important;">Apply Job</a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<div class="container pb-50 pt-4" id="products">
  <div class="d-flex col col-md-12 pb-4">
    <div class="text-muted text-left"><h3>Products</h3></div>
    <a href="<?= site_url('bussiness/products') ?>" class="btn btn-dark ml-auto">View All</a>
  </div>
  <div class="row">
    <?php foreach($products as $job){?>
      <?php  
      $profile_picture = get_products_image($job['id']);
      if(is_array($profile_picture) && !empty($profile_picture))
      {
        foreach($profile_picture as $key1=>$val1)
        {
          if($val1['name'] !='')
          {
            $the_img='uploads/product_images/'.$val1['name'];
            break;
          } 
        }
      }
      $company_name=get_company_name($job['company_id']);
      ?>
      <div class="card-deck col-lg-3 col-xs-12 mb-3" style="">
        <div class="card" style="margin-bottom: 5px;border-radius: 5px;">
          <div class="main-img-div" style="">
            <img class="card-img-top" src="<?= base_url($the_img); ?>" alt="image" style="width:100%">

            <div class="card-img-overlay text-center" style="position: relative;padding: 0.8rem !important;">
              <div class="ribbon-main-div " style="position: absolute;bottom: 0; left: 0; right: 0;">
                <img class="card-img-top rounded-circle" style="border: 4px solid #fff;width:70px;height: 70px;" src="<?= base_url($the_img); ?>" alt="image" >

              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <h4 class="card-title text-center mt-3"><?= text_limit($job['title'], 20); ?></h4>
            <p class="card-text text-center"><?= text_limit($company_name, 40); ?></p>
            <hr>
            <div class="text-center">
              <a href="<?= site_url('jobs/product_detail/'.$job['id'].'/'.($job['product_slug'])); ?>" class="btn ticker-btn-nav" style="padding: 9px 18px !important;">Buy Now</a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<div class="container pb-50 pt-4" id="daily_deals">
  <div class="d-flex col col-md-12 pb-4">
    <div class="text-muted text-left"><h3>Daily Deals</h3></div>
    <a href="<?= site_url('jobs/daily_deals') ?>" class="btn btn-dark ml-auto">View All</a>
  </div>
  <div class="row">
    <?php foreach($deals as $job){?>
      <?php  
      $profile_picture = get_deals_image($job['id']);
      if(is_array($profile_picture) && !empty($profile_picture))
      {
        foreach($profile_picture as $key1=>$val1)
        {
          if($val1['name'] !='')
          {
            $the_img='uploads/deal_images/'.$val1['name'];
            break;
          } 
        }
      }
      $company_name=get_company_name($job['company_id']);
      ?>
      <div class="card-deck col-lg-3 col-xs-12 mb-3" style="">
        <div class="card" style="margin-bottom: 5px;border-radius: 5px;">
          <div class="main-img-div" style="">
            <img class="card-img-top" src="<?= base_url($the_img); ?>" alt="image" style="width:100%">

            <div class="card-img-overlay text-center" style="position: relative;padding: 0.8rem !important;">
              <div class="ribbon-main-div " style="position: absolute;bottom: 0; left: 0; right: 0;">
                <img class="card-img-top rounded-circle" style="border: 4px solid #fff;width:70px;height: 70px;" src="<?= base_url($the_img); ?>" alt="image" >

              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <h4 class="card-title text-center mt-3"><?= text_limit($job['title'], 20); ?></h4>
            <p class="card-text text-center"><?= text_limit($company_name, 40); ?></p>
            <hr>
            <div class="text-center">
              <a href="<?= site_url('jobs/deals_detail/'.$job['id'].'/'.($job['deal_slug'])); ?>" class="btn ticker-btn-nav" style="padding: 9px 18px !important;">Apply Job</a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $(".slick-slide").css('width', 'auto');
    $(".slick-list draggable").css('padding', '15px 50px');
  })
  $(".center").slick({
    infinite: false,
    slidesToShow: 5,
    slidesToScroll: 3
  });
</script>