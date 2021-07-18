<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
  .bs-example{
    margin: 20px;
  }
</style>
<script type="text/javascript">
 function home() {
  document.getElementById('about_us').style.display = 'block';
  document.getElementById('staff').style.display = 'none';
  document.getElementById('services').style.display = 'none';
  document.getElementById('products').style.display = 'none';
  document.getElementById('jobs').style.display = 'none';
  document.getElementById('deals').style.display = 'none';

}
function staff() {
  document.getElementById('staff').style.display = 'block';
  document.getElementById('services').style.display = 'none';
  document.getElementById('about_us').style.display = 'none';
  document.getElementById('products').style.display = 'none';
  document.getElementById('jobs').style.display = 'none';
  document.getElementById('deals').style.display = 'none';
}
function services() {
  document.getElementById('services').style.display = 'block';
  document.getElementById('staff').style.display = 'none';
  document.getElementById('about_us').style.display = 'none';
  document.getElementById('products').style.display = 'none';
  document.getElementById('jobs').style.display = 'none';
  document.getElementById('deals').style.display = 'none';
}
function products() {
  document.getElementById('products').style.display = 'block'; 
  document.getElementById('staff').style.display = 'none';
  document.getElementById('about_us').style.display = 'none';
  document.getElementById('services').style.display = 'none';
  document.getElementById('jobs').style.display = 'none';
  document.getElementById('deals').style.display = 'none';

}
function jobs() {
  document.getElementById('jobs').style.display = 'block';
  document.getElementById('staff').style.display = 'none';
  document.getElementById('services').style.display = 'none';
  document.getElementById('about_us').style.display = 'none';
  document.getElementById('products').style.display = 'none';
  document.getElementById('deals').style.display = 'none';
}
function deals() {
  document.getElementById('deals').style.display = 'block';
  document.getElementById('staff').style.display = 'none';
  document.getElementById('services').style.display = 'none';
  document.getElementById('about_us').style.display = 'none';
  document.getElementById('products').style.display = 'none';
  document.getElementById('jobs').style.display = 'none';
}
</script>
<!-- start banner Area -->
<!-- <section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          <?=trans('employer_list_detail')?>
        </h1> 
        <p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""><?=trans('employer_list_detail')?></a></p>
      </div>                      
    </div>
  </div>
</section> -->
<!-- End banner Area -->  

<!-- Start post Area -->
<section class="post-area  pt-5 pb-5" style="margin-top: 60px;">
  <div class="container">

    <?php if($this->session->flashdata('add_service')): ?>
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <?=$this->session->flashdata('add_service')?>
      </div>
    <?php  endif; ?>

    <?php if($this->session->flashdata('add_deal')): ?>
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <?=$this->session->flashdata('add_deal')?>
      </div>
    <?php  endif; ?>


    <div class="row justify-content-center d-flex">
      <div class="col-lg-2" style="border:1px solid #d4d4d4; border-radius: 6px;padding-left: 0;padding-right: 0;">
        <div style="">
          <?php $the_img = 'assets/img/job_icon1.jpg'; ?> 
          <?php  $the_img = $company_info['company_logo'] ? $company_info['company_logo'] : $the_img;?> 

          <img src="<?= base_url($the_img) ?>" alt="" style="width:100%;" width="100%" height="auto">         
        </div>
      </div>
      <div class="col-lg-8">
        <div class="justify-content-between d-flex flex-row">
          <div class="emp_details">
            <div class="title d-flex flex-row justify-content-between mt-2">
              <div class="titles">
                <a href=""><h1 class="mb-2"><?php echo $company_info['company_name']; ?></h1></a>       
              </div>
            </div>
            <div class="job-listing-footer">
              <ul class="mb-3">
                <li><i class="lnr lnr-apartment"></i> <?= get_category_name($company_info['category']); ?></li>
                <li><i class="lnr lnr-map-marker"></i> <?= get_city_name($company_info['city']); ?>, <?= get_country_name($company_info['country']); ?></li>
                <li><i class="lnr lnr-map-marker"></i> <?= $company_info['address']; ?></li>
              </ul>                   
            </div>

          </div> 
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Start post Area -->
<!-- Start post Area -->
<section class="post-area" style="background-color: #dedede;">
  <div class="container">
    <div class="row justify-content-center d-flex">
      <div class="col col-lg-11">
        <nav class="navbar navbar-expand-md navbar-light" style="margin-bottom: 0px !important; font-size: 16px; font-weight: 600;"> 
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
              <a href="#" class="nav-item nav-link pr-4" id="home_button" onclick="home()">Home</a>
              <a href="#" class="nav-item nav-link pr-4" id="staff_button" onclick="staff()">Staff</a>
              <a href="#" class="nav-item nav-link pr-4" id="product_button" onclick="services()">Services</a>
              <a href="#" class="nav-item nav-link pr-4" id="job_button" onclick="jobs()">Jobs</a>
              <a href="#" class="nav-item nav-link pr-4" id="service_button" onclick="products()">Products</a>
              <a href="#" class="nav-item nav-link pr-4" id="deal_button" onclick="deals()">Deals</a>
              <!-- <a href="" class="nav-item nav-link">Messages</a>  -->
            </div> 
          </div>
        </nav>
      </div>
    </div>
  </div>
</section> 

<!-- End Start post Area -->
<!-- Start post Area -->
<div id="about_us">
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-10"> 
          <div class="">
            <div class="headline">
              <h5 class="company_overview"><?=trans('company_overview')?></h5>
            </div>
            <div class="profile_job_detail">
              <div class="row">
                <div class="col-md-12 col-sm-12 mt-3">
                  <div class="submit-field company_des">
                    <p><?= $company_info['description']; ?></p>
                    <hr>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </section>
  <!-- End Start post Area -->
  <!-- Start post Area -->
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-10"> 
          <div class="row pb-1">
            <div class="col-lg-6">
              <div class="headline">
                <h6 class="company_details"> Website</h6>
              </div>
              <div class="profile_job_detail">  
                <p class="font_details"><?= $company_info['website']; ?></p> 
              </div> 
            </div>
            <div class="col-lg-6 ">
              <div class="headline">
                <h6 class="company_details"> Phone </h6>
              </div>
              <div class="profile_job_detail">  
                <p class="font_details"><?= $company_info['phone_no']; ?></p> 
              </div> 
            </div> 
          </div>
          <div class="row pb-1">
            <div class="col-lg-6">
              <div class="headline">
                <h6 class="company_details"> Category </h6>
              </div>
              <div class="profile_job_detail">  
                <p class="font_details"><?= get_category_name($company_info['category']); ?></p> 
              </div> 
            </div>
            <div class="col-lg-6 ">
              <div class="headline">
                <h6 class="company_details"> Email</h6>
              </div>
              <div class="profile_job_detail">  
                <p class="font_details"><?= $company_info['email']; ?></p> 
              </div> 
            </div> 
          </div>
        </div> 
      </div>
    </div>
  </section>
</div>
<!-- End Start post Area -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous"> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $('.collapse.in').each(function(){
      $(this).parent().find(".glyphicon").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
    });
    
    $('.collapse').on('shown.bs.collapse', function(){
      $(this).parent().find(".glyphicon-chevron-down").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
    }).on('hidden.bs.collapse', function(){
      $(this).parent().find(".glyphicon-chevron-up").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
    });       
  });
</script>

<!-- Start post Area -->
<div id="staff" style="display: none;">
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-10"> 
          <div class="">
            <div class="headline">
              <h2 style="font-weight: 700;">Staff</h2>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </section>
  <!-- End Start post Area -->
  <!-- Start post Area -->
  <?php if(count($staff) > 0) { ?>
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-11">     
          <div class="panel-group" id="accordion1">
            <!--make colapse dynamic-->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <button class="btn btn-link coustomize_btn" data-target="#all-staff" data-toggle="collapse" data-parent="#accordion1">
                    </button>
                  </h4>
                </div>
                 <div class="panel-collapse ">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col col-md-12">
                      <?php foreach ($staff as $staff) { ?>

                          <div class=" col col-md-6" >
                            <div class="co col-md-12" style="padding: 20px; border: 1px solid #e2d1d1;margin-bottom: 10px; border-radius: 6px;">
                              <div class="col col-md-6">
                                <h6><b><?= $staff->name?></b></h6>
                              </div>
                              <div class="col col-md-6 text-right" >
                                <h6><b><?= $staff->designation ?></b></h6>
                              </div>

                              <div class="col col-md-6">
                                <h6>Service:</h6>
                              </div>
                              <div class="col col-md-6 text-right" >
                                <h6><?= $staff->title ?></h6>
                              </div>

                              <div class="col col-md-6">
                                <h6>Gender:</h6>
                              </div>
                              <div class="col col-md-6 text-right" >
                                <h6><?= $staff->gender ?></h6>
                              </div>

                              <div class="col col-md-6">
                                <h6>Shift Start:</h6>
                              </div>
                              <div class="col col-md-6 text-right" >
                                <h6><?= date("H:00 a", mktime($staff->shift_start)) ?></h6>
                              </div>

                              <div class="col col-md-6">
                                <h6>Shift End:</h6>
                              </div>
                              <div class="col col-md-6 text-right" >
                                <h6><?= date("H:00 a", mktime($staff->shift_end)) ?></h6>
                              </div>
                              <div class="col col-md-4">
                                <h6>Working Days:</h6>
                              </div>
                              <div class="col col-md-8 text-right " >
                                <?php $working_days_arr = explode(",", $staff->working_days); $days_len = count($working_days_arr); ?>
                                <?php for ($i=0; $i < $days_len; $i++) { ?>
                                  
                                <h6 style="display: inline-block;"><?php echo weekDays()[$working_days_arr[$i]] ?><?php if($days_len > 1 && $i !== ($days_len - 1) ) echo ","?></h6>
                                <?php } ?>
                              </div>

                            </div> 
                          </div> 
                    <?php } ?>

                      </div>
                    </div> 
                  </div>
                </div>
            </div>
          <!--end-->
        </div>
      </div> 
    </div>
  </div>
</section>
<?php } ?>
</div>


<!-- Start post Area -->
<div id="services" style="display: none;">
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-10"> 
          <div class="">
            <div class="headline">
              <h2 style="font-weight: 700;">Services</h2>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </section>
  <!-- End Start post Area -->
  <!-- Start post Area -->
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-11">     
          <div class="panel-group" id="accordion1">
            <?php
            $services=$this->db->query("SELECT DISTINCT job_type FROM xx_job_post WHERE company_id=".$company_info['id']." AND posting_type='2' ")->result_array();
            $count=COUNT($services);
            ?>
            <!--make colapse dynamic-->
            <?php foreach ($services as $key) { ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <button class="btn btn-link coustomize_btn" data-target="#<?php echo $key['job_type'].'s';?>" data-toggle="collapse" data-parent="#accordion1">
                      <span class="glyphicon glyphicon-chevron-down"></span>
                      <?php 
                      $services_cat_name=$this->db->query("SELECT DISTINCT name FROM xx_service_type WHERE id=".$key['job_type']."")->result_array();
                      foreach ($services_cat_name as $key1) {
                        echo $key1['name'];
                      }
                      ?>
                    </button>
                  </h4>
                </div>
                <?php   for ($i=0; $i <$count; $i++) { 
                 $services_job=$this->db->query("SELECT * FROM xx_job_post WHERE company_id=".$company_info['id']." AND posting_type='2' AND job_type=".$key['job_type']." ")->result_array(); ?>
                 <div class="panel-collapse collapse" id="<?php echo $key['job_type'].'s';?>">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col col-md-12">

                        <?php foreach ($services_job as $key ) {?>
                          <div class=" col col-md-6" >
                            <div class="co col-md-12" style="padding: 20px; border: 1px solid #000;margin-bottom: 10px; border-radius: 6px;">
                              <div class="col col-md-6">
                                <h6><b><?php  echo $key['title'];?></b></h6>
                              </div>
                              <div class="col col-md-6 text-right" >
                                <h6><b><?php echo 'Price :'.$key['min_salary'].'Naira'."-".$key['max_salary']."Naira";?></b></h6>
                              </div>
                              <div class="col col-md-12 pb-3">
                                <?php echo text_limit($key['description'], 180);?>
                              </div> 
                              <div class="col col-md-12 text-right">
                                <!--                             <button class="btn btn-danger" style="text-align: right;">Request</button> -->
                                <a href="<?= site_url('jobs/'.$key['id'].'/'.($key['job_slug'])); ?>" class="btns text-uppercase apply_button">View Details</a>
                              </div> 

                            </div> 
                          </div> 
                        <?php } ?>

                      </div>
                    </div> 
                  </div>
                </div>
              <?php } ?>
            </div>
            <?php
          }
          ?>
          <!--end-->
        </div>
      </div> 
    </div>
  </div>
</section>
</div>

<!-- Start post Area -->
<div id="jobs" style="display: none;">
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-10"> 
          <div class="">
            <div class="headline">
              <h2 style="font-weight: 700;">Jobs</h2>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </section>
  <!-- End Start post Area -->
  <!-- Start post Area for services -->
  <!-- Start post Area -->
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-11">     
          <div class="panel-group" id="accordion2">
            <?php
            $services=$this->db->query("SELECT DISTINCT job_type FROM xx_job_post WHERE company_id=".$company_info['id']." AND posting_type='1' ")->result_array();
            $count=COUNT($services);
            ?>
            <!--make colapse dynamic-->
            <?php foreach ($services as $key) { ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <button class="btn btn-link coustomize_btn" data-target="#<?php echo $key['job_type'].'j';?>" data-toggle="collapse" data-parent="#accordion2">
                      <span class="glyphicon glyphicon-chevron-down"></span>
                      <?php 
                      $services_cat_name=$this->db->query("SELECT type FROM xx_job_type WHERE id=".$key['job_type']."")->result_array();
                      foreach ($services_cat_name as $key1) {
                        echo $key1['type'];
                      }
                      ?>
                    </button>
                  </h4>
                </div>
                <?php   for ($i=0; $i <$count; $i++) { 
                 $services_job=$this->db->query("SELECT * FROM xx_job_post WHERE company_id=".$company_info['id']." AND posting_type='1' AND job_type=".$key['job_type']." ")->result_array(); ?>
                 <div class="panel-collapse collapse" id="<?php echo $key['job_type'].'j';?>">
                  <div class="panel-body">
                    <div class="row">

                        <?php foreach ($services_job as $key ) {?>
                          <div class=" col-md-6" >
                              <div class="">
                                <h6><b><?php  echo $key['title'];?></b></h6>
                              </div>
                              <div class="text-right" >
                                <h6><b><?php echo 'Price :'.$key['min_salary'].'Naira'."-".$key['max_salary']."Naira";?></b></h6>
                              </div>
                              <div class=" pb-3"
                                <?php echo text_limit($key['description'], 180);?>
                              </div> 
                              <div class="text-right">
                        <a href="<?= site_url('jobs/'.$key['id'].'/'.($key['job_slug'])); ?>" class="btns text-uppercase apply_button"><?=trans('apply_job')?></a>
                        
                      </div> 

                  </div> 
                <?php } ?>

            </div> 
          </div>
        </div>
      <?php } ?>
    </div>
    <?php
  }
  ?>
  <!--end-->
</div>
</div> 
</div>
</div>
</section>
</div>

<!-- Start post Area -->
<div id="products" style="display: none;">
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-10"> 
          <div class="">
            <div class="headline">
              <h2 style="font-weight: 700;">Products</h2>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </section>
  <!-- End Start post Area -->
  <!-- Start post Area for services -->
  <!-- Start post Area -->
  <!-- Start post Area -->
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-11">     
          <div class="panel-group" id="products123">
            <?php
            $services=$this->db->query("SELECT DISTINCT product_type FROM xx_product_post WHERE company_id=".$company_info['id']." ")->result_array();
            $count=COUNT($services);
            ?>
            <!--make colapse dynamic-->
            <?php foreach ($services as $key) { ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <button class="btn btn-link coustomize_btn" data-target="#<?php echo $key['product_type'].'p';?>" data-toggle="collapse" data-parent="#products123">
                      <span class="glyphicon glyphicon-chevron-down"></span>
                      <?php 
                      $services_cat_name=$this->db->query("SELECT DISTINCT name FROM xx_service_type WHERE id=".$key['product_type']."")->result_array();
                      foreach ($services_cat_name as $key1) {
                        echo $key1['name'];
                      }
                      ?>
                    </button>
                  </h4>
                </div>
                <?php   for ($i=0; $i <$count; $i++) { 
                 $services_job=$this->db->query("SELECT * FROM xx_product_post WHERE company_id=".$company_info['id']." AND product_type=".$key['product_type']." ")->result_array(); ?>
                 <div class="panel-collapse collapse" id="<?php echo $key['product_type'].'p';?>">
                  <div class="panel-body ">
                    <div class="row">
                        <div class="col col-md-12">
                        <?php foreach ($services_job as $key ) {?>
                          <div class=" col col-md-6" >
                              <div class="col col-md-12" style="padding: 20px; border: 1px solid #e2d1d1;margin-bottom: 5px; border-radius: 6px;">
                              <div class="d-flex justify-content-between">
                                <div><h6 ><b><?php  echo $key['title'];?></b></h6></div>
                                    <div><h6 ><b><?php echo 'Price :'.$key['price'].'Naira';?></b></h6></div>
                                </div>
                             
                              
                              <div class=" pb-3">
                                <?php echo text_limit($key['description'], 180);?>
                              </div> 
                              <div class=" text-right ">
                               <a href="<?= site_url('jobs/product_detail/'.$key['id'].'/'.($key['product_slug'])); ?>" class="btns text-uppercase apply_button">Request</a>
                             </div> 
                            </div>
                         </div> 
                       <?php } ?>
                    </div>
                   </div> 
                 </div>
               </div>
             <?php } ?>
           </div>
           <?php
         }
         ?>
         <!--end-->
       </div>
     </div> 
   </div>
 </div>
</section>
</div>



<!-- Start post Area -->
<div id="deals" style="display: none;">
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-10"> 
          <div class="">
            <div class="headline">
              <h2 style="font-weight: 700;">Deals</h2>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </section>
  <!-- End Start post Area -->
  <!-- Start post Area for services -->
  <!-- Start post Area -->
  <section class="post-area  pt-5 pb-5">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-11">     
          <div class="panel-group" id="accordion4">
            <?php
            $services=$this->db->query("SELECT DISTINCT deal_type FROM xx_deal_post WHERE company_id=".$company_info['id']."")->result_array();
            $count=COUNT($services);
            ?>
            <!--make colapse dynamic-->
            <?php foreach ($services as $key) { ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <button class="btn btn-link coustomize_btn" data-target="#<?php echo $key['deal_type'].'d';?>" data-toggle="collapse" data-parent="#accordion4">
                      <span class="glyphicon glyphicon-chevron-down"></span>
                      <?php 
                      $services_cat_name=$this->db->query("SELECT DISTINCT name FROM xx_service_type WHERE id=".$key['deal_type']."")->result_array();
                      foreach ($services_cat_name as $key1) {
                        echo $key1['name'];
                      }
                      ?>
                    </button>
                  </h4>
                </div>
                <?php   for ($i=0; $i <$count; $i++) { 
                 $services_job=$this->db->query("SELECT * FROM xx_deal_post WHERE company_id=".$company_info['id']." AND deal_type=".$key['deal_type']." ")->result_array(); ?>
                 <div class="panel-collapse collapse" id="<?php echo $key['deal_type'].'d';?>">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col col-md-12">

                        <?php foreach ($services_job as $key ) {?>
                          <div class=" col col-md-6" >
                            <div class="co col-md-12" style="padding: 20px; border: 1px solid #000;margin-bottom: 10px; border-radius: 6px;">
                              <div class="col col-md-6">
                                <h6><b><?php  echo $key['title'];?></b></h6>
                              </div>
                              <div class="col col-md-6 text-right" >
                                <h6><b><?php echo 'Price :'.$key['price'].'Naira';?></b></h6>
                              </div>
                              <div class="col col-md-12 pb-3">
                                <?php echo text_limit($key['description'], 180);?>
                              </div> 
                              <div class="col col-md-12 text-right">
                               <a href="<?= site_url('jobs/deals_detail/'.$key['id'].'/'.($key['deal_slug'])); ?>" class="btns text-uppercase apply_button">Book Now</a>
                             </div> 

                           </div> 
                         </div> 
                       <?php } ?>

                     </div>
                   </div> 
                 </div>
               </div>
             <?php } ?>
           </div>
           <?php
         }
         ?>
         <!--end-->
       </div>
     </div> 
   </div>
 </div>
</section>
</div>









<!-- Start post Area -->
<!-- <section class="post-area section-gap">
  <div class="container">
    <div class="row justify-content-center d-flex">
      <div class="col-lg-10 list_banner">
        <div class="justify-content-between d-flex flex-row">
          <div class="emp_details">
            <div class="title d-flex flex-row justify-content-between mt-2">
              <div class="titles">
                <a href=""><h2 class="mb-2"><?= $company_info['company_name']; ?></h2></a>       
              </div>
            </div>
            <div class="job-listing-footer">
              <ul class="mb-3">
                <li><i class="lnr lnr-apartment"></i> <?= get_category_name($company_info['category']); ?></li>
                <li><i class="lnr lnr-map-marker"></i> <?= get_city_name($company_info['city']); ?>, <?= get_country_name($company_info['country']); ?></li>
                <li><i class="lnr lnr-map-marker"></i> <?= $company_info['address']; ?></li>
              </ul> -->
              <!--<ul>
                <li><a class="ticker-btn mb-3" href="#">Follow</a></li>
                <li><a class="ticker-btn mb-3" href="#">Add a review</a></li>
              </ul>-->                   
            <!-- </div>
          </div>
          <div class="emp_logo">
            <img src="<?= base_url().$company_info['company_logo']?>" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center d-flex">
      <div class="col-lg-10 post-list">
        <div class="profile_job_content">
          <div class="headline">
            <h3> <?=trans('company_overview')?></h3>
          </div>
          <div class="profile_job_detail">
            <div class="row">
              <div class="col-md-12 col-sm-12 mt-3">
                <div class="submit-field">
                  <p><?= $company_info['description']; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="profile_job_content col-lg-12 mt-5">
          <div class="headline">
            <h3> <?=trans('jobs_opening')?></h3>
          </div>
          <div class="profile_job_detail">
            <div class="row">
              <div class="col-lg-12">
                <?php if(empty($jobs)): ?>
                  <p class="text-gray"><strong><?=trans('sorry')?>,</strong> <?=trans('no_opening')?></p>
                <?php endif; ?>
              </div>
              <div class="col-lg-12 post-list">
                <?php foreach($jobs as $job): ?>
                <div class="single-post d-flex flex-row">
                  <div class="thumb">
                    <img src="<?= base_url()?>assets/img/job_icon.png" alt="">
                  </div>
                  <div class="details">
                    <div class="title d-flex flex-row justify-content-between">
                      <div class="titles">
                        <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['title'], 35); ?></h4></a>
                        <h6><?= get_company_name($job['company_id']); ?></h6>         
                      </div>
                      
                    </div>
                    <div class="job-listing-footer">
                      <ul>
                        <li><i class="lnr lnr-map-marker"></i> <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></li>
                        <li><i class="lnr lnr-briefcase"></i> <?= $job['job_type']; ?></li>
                        <li><i class="lnr lnr-apartment"></i> <?= get_industry_name($job['industry']); ?></li>
                        <li><i class="lnr lnr-clock"></i> <?= time_ago($job['created_date']); ?></li>
                      </ul>                 
                    </div>
                  </div>
                  <div class="job-listing-btns">
                    <ul class="btns">
                      <li><a href="#"><span class="lnr lnr-heart"></span></a></li>
                      <li><a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><?=trans('apply')?></a></li>
                    </ul>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>  
  </div>
</section> -->
      <!-- End post Area -->