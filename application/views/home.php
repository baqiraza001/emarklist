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
        echo form_open('Jobs/search_home',$attributes);?>
        <div class="row form-wrap no-gutters">
          <div class="col-lg-3 form-cols">
            <input type="text" class="form-control" name="bussiness_name" placeholder="Bussiness Name">
          </div>

          <div class="col-lg-3 form-cols">
            <input type="text" class="form-control" name="job_title" placeholder="<?=trans('search_place_holder')?>">
          </div>

          <div class="col-lg-2 form-cols">
            <select name="posting_type" id="posting_type" class="form-control location_selection">
              <option value="1">Jobs</option>
              <option value="2">Service</option>
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
               <a href="<?= base_url();?>Jobs/category/<?php echo $categories['id']; ?> " class="cat_btn_home"><?php echo $categories['name']; ?></a>
             </div>
           <?php } ?>
           <div>
             <a href="<?= base_url();?>Jobs/All_category/" class="cat_btn_home">All</a>
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
<div class="container pb-50 pt-4" id="jobs">
  <div class="d-flex col col-md-12 pb-4">
    <div class="text-muted text-left"><h3>New Jobs</h3></div>
    <a href="<?= site_url('jobs')  ?>" class="btn btn-dark ml-auto">View All</a>
  </div>
  <div class="row">
    <?php foreach($jobs as $job){?>
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

<!-- why-us-section-Starts -->
<section class="emp-why-us">
  <div class="container text-center">
    <div class="row">
      <div class="col-md-12">
        <h1 class="section-title"><?=trans('why')?> <?= $this->general_settings['application_name']; ?>?</h1>
        <div class="line-title"></div>
        <h5 class="pt-3"><?=trans('why_msg')?></h5>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mt-5">
        <i class="fa fa-universal-access fa-3x"></i> 
        <h4 class="pt-3"><?=trans('massive_reach')?></h4>
        <p><?=trans('reach_msg')?></p>
      </div>
      <div class="col-md-4 mt-5">
        <i class="fa fa-handshake-o fa-3x"></i> 
        <h4 class="pt-3"><?=trans('easy_n_fast')?></h4>
        <p><?=trans('easy_msg')?></p>
      </div>
      <div class="col-md-4 mt-5">
        <i class="fa fa-snowflake-o fa-3x"></i> 
        <h4 class="pt-3"><?=trans('cost_effect_hiring')?></h4>
        <p><?=trans('hiring_msg')?></p>
      </div>
    </div>
  </div>
</section>

<!-- why-us-section-Ends -->

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