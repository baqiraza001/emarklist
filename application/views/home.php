  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!-- start Subscribe Area --> <!-- section-half -->
  <section class="subscribe-area " id="subscribe-area" style="padding: 75px 0 25px 0;">
    <div class="container">
      <div class="row " style="padding: 20px 20px 10px 20px; background: #f0f0f0;box-shadow: 0px 0px 40px 0px rgba(132, 144, 255, 0.2);"> 
        <div class="col-lg-12 col-md-12 col-12">
                    <?php $attributes = array('id' => 'search_job', 'method' => 'post','class'=>'form-horizontal jsform');
          echo form_open(base_url('Jobs/search_home'),$attributes);?>
<!--           <?php echo form_open(base_url('home/add_subscriber'),$attributes);  ?>  -->
            <div id="mc_embed_signup">
<!--               <form action="#" method="get" class="form-inline" novalidate="true"> -->
                <div class="form-group row no-gutters">
                  <div class="col-3 home_form" >
                    <input type="text"  name="bussiness_name" placeholder="Company Name">
                  </div>
                  <div class="col-3 home_form" >
                    <input type="text"  name="job_title" placeholder="<?=trans('search_place_holder')?>">
                  </div>
                  <div class="col-3"> 
                    <select name="posting_type" id="posting_type" class="location_selection">
                        <option value="1">Jobs</option>
                        <option value="2">Service</option>
                     </select>
                  </div> 
                  <div class="col-2">
                    <input type="submit" name="search" class="nw-btn primary-btn" value="<?=trans('btn_search_text')?>">
                    <!-- <button class="nw-btn primary-btn" >Search</button> -->
                  </div> 
                </div>    
              <!-- </form> -->
            </div>
          <?php echo form_close( ); ?>
        </div>
      </div>
    </div>
  </section>
  <!-- End Subscribe Area -->  
   <!-- start Subscribe Area -->
  <section class="subscribe-area" id="subscribe-area">
      <div class="container"> 
        <div class="row">
        <?php
        $cat=$this->db->query("SELECT * FROM xx_categories LIMIT 9")->result_array();
        foreach ($cat as $categories) {?>
         <a href="<?= base_url();?>Jobs/category/<?php echo $categories['id']; ?> " class="categories_class"><?php echo $categories['name']; ?></a>
          <?php

        }
        ?>
        </div>
      </div> 
  </section>
  <!-- End Subscribe Area -->

  <!-- end service  -->  
<div class="container pb-50 pt-4">
    <div class="row">   
      <div class="col col-md-8 pb-5">
        <h3>New Jobs</h3>
      </div>
            <!-- Wrapper for slides -->
            <div class="carousel-inner"> 
                <div class="item active">
                    <div class="row ">
                        <?php foreach($jobs as $job){?>
                        
                        <div class="col-sm-3 pb-5">
                            <div class="col-item ">
                                <div class="photo">
                                    
        <?php 
          // $company_id=$job['company_id'];
          // $profile_picture = get_bussiness_profile_image($company_id);
          // $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/job_icon.png';
      
          $the_img = 'assets/img/job_icon1.jpg'; 
?>
<img class="profile-picture" src="<?= base_url($the_img); ?>" alt="" width="70%" />
<!--         <img class="profile-picture" src="<?= base_url($profile_picture); ?>" alt=""> -->
<!--         <img class="profile-picture" src="<?= base_url($profile_picture); ?>" alt="" width="70%" /> -->


                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12 pt-4">
                                            <a style="font-weight: bold;" href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><?= text_limit($job['title'], 20); ?></a>
                                            <!-- <h5 class="price-text-color"> -->
                                              <?php
                                              $company_name=get_company_name($job['company_id']);
                                              ?>
                                               <h5 class="price-text-color"><?= text_limit($company_name, 20); ?>
                                                 
                                               </h5>
                                             <!--  </h5> -->
                                        </div> 
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
<!--                                             <i class="fa fa-shopping-cart"></i> -->
                                            <span class="lnr lnr-clock"></span> <?= time_ago($job['created_date']); ?>
                                          </p>
                                        <p class="btn-details space">
<!--                                             <i class="fa fa-list"></i> -->
                                            <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns text-uppercase apply_button"><?=trans('apply_job')?></a>
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
    </div> 
</div>
<!-- end service  -->
 

<!--company start-->
<!-- <div class="container pb-50 pt-4">
    <div class="row">   
      <div class="col col-md-8 pb-5">
        <h3>Business Listings</h3>
      </div>
            <div class="carousel-inner"> 
                <div class="item active">
                    <div class="row ">
                        <?php foreach($company as $job){?>
                        
                        <div class="col-sm-3 pb-5">
                            <div class="col-item ">
                                <div class="photo">
                                    
        <?php 
      
          $the_img = 'assets/img/job_icon1.jpg'; 
?>
<img class="profile-picture" src="<?= base_url($the_img); ?>" alt="" width="70%" />

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12 pt-4">
                                            <a style="font-weight: bold;" href=""><?= text_limit($job['company_name'], 20); ?></a>
                                              <?php
                                              $company_name=get_company_name($job['company_id']);
                                              ?>
                                               <h5 class="price-text-color"><?= text_limit($job['address'], 20); ?>
                                                 
                                               </h5>

                                        </div> 
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <span class="lnr lnr-clock"></span> <?= time_ago($job['updated_date']); ?>
                                          </p>
                                        <p class="btn-details space">
                                            <a href="<?= base_url('company/detail1/'.$job['company_slug']); ?>" class="btns text-uppercase apply_button">
                                              View Details</a>
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
    </div> 
</div> -->
<!--company end-->

  <!-- end service  -->  
<!-- <div class="container pb-50 pt-4">
    <div class="row">   
      <div class="col col-md-8 pb-5">
        <h3> New Services</h3>
      </div>
            <div class="carousel-inner"> 
                <div class="item active">
                    <div class="row ">
                        <?php foreach($services as $job){?>
                        
                        <div class="col-sm-3 pb-5">
                            <div class="col-item ">
                                <div class="photo">
                                    <?php 
      $job_id=$job['id'];
            $profile_picture = get_service_image($job_id);
        ?>
        <?php if(is_array($profile_picture) && !empty($profile_picture))
                { ?>
<?php foreach($profile_picture as $key1=>$val1){
          if($val1['name'] !='')
            {
              ?>
           <img class="profile-picture" src="<?= base_url('uploads/service_images/'.$val1['name']); ?>" /> 

            
          <?php 
          break;
        } }?> 
<?php }
else{
          $the_img = 'assets/img/job_icon1.jpg'; 
?>
<img class="profile-picture" src="<?= base_url($the_img); ?>" alt="" width="70%" />
 <?php
}?>

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12 pt-4">
                                            <a style="font-weight: bold;" href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><?= text_limit($job['title'], 20); ?></a>
                                              <?php
                                              $company_name=get_company_name($job['company_id']);
                                              ?>
                                               <h5 class="price-text-color"><?= text_limit($company_name, 20); ?>
                                                 
                                               </h5>
                                        </div> 
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <span class="lnr lnr-clock"></span> <?= time_ago($job['created_date']); ?>
                                          </p>
                                        <p class="btn-details space">
                                            <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns tet-uppercase apply_button">View Details</a>
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
    </div> 
</div> -->
<!-- end service  -->
 