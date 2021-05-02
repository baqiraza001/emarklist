 <!-- header start -->
 <style>
  .badge:after{
    content:attr(value);
    font-size:12px;
    background-color: #dc3545;
    color: #fff;
    border-radius:50%;
    padding:5px 5px;
    position:relative;
    left:-8px;
    top:-10px;
    opacity:0.9;
  }
</style>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $(".scroll_link").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>
<header id="header" style="border-bottom: 1px solid #dedede; ">
  <div class="container-fluid">
    <div class="row align-items-center d-flex">
      <div class="col-2">
        <div id="logo">
          <a href="<?= ($this->session->userdata('is_employer_login'))? base_url() : base_url(); ?>"><img src="<?= base_url($this->general_settings['logo']); ?>" alt="" title="" /></a>
        </div>
      </div>
      <div class="col-10">
        <nav id="nav-menu-container">
          <ul class="nav-menu">
            <?php if ($this->session->userdata('is_user_login')): ?>
              <li class="menu-has-children bi bi-caret-down"><a href=""><?=trans('label_jobs')?></a>
                <ul>
                  <li><a href="<?= base_url('jobs-by-category'); ?>"><?=trans('label_jobs_by_cat')?></a></li>
                  <li><a href="<?= base_url('jobs-by-industry'); ?>"><?=trans('label_jobs_by_industry')?></a></li>
                  <li><a href="<?= base_url('jobs-by-location'); ?>"><?=trans('label_jobs_by_loc')?></a></li>
                  <li><a href="<?= base_url('jobs'); ?>"><?=trans('label_browse_jobs')?></a></li>
                </ul>
              </li>

              <li class=""><a href="<?= base_url('company'); ?>"><?=trans('label_companies')?></a></li>
              <li class=""><a href="<?= base_url('blog'); ?>"><?=trans('label_blog')?></a></li>

<!--               <li><a href="<?= base_url('employers') ?>"><?=trans('label_for_employers')?></a>
              <li><a href="<?= base_url('bussiness') ?>"><?=trans('label_for_listings')?></a>
              </li> --> 
              <!-- <li><a href="<?= base_url('employers') ?>"><?=trans('label_for_local_bussiness')?></a>
              <li><a href="<?= base_url('bussiness') ?>"><?=trans('label_for_virtual_jobs')?></a>
              </li> -->
              <li>
                <a class="nav_btn mt-1" href="<?= base_url('bussiness') ?>"><?=trans('label_for_local_bussiness')?></a>
              </li>
              <li>
                <a class="nav_btn mt-1" href="<?= base_url('employers/cv/search') ?>"><?=trans('label_for_virtual_jobs')?>
              </a> 
            </li>  
            <?php 
            $profile_picture = get_user_profile($this->session->userdata('user_id'));
            $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/user.png';
            ?>
            <li class="menu-has-children margin-left-400"><img src="<?= base_url($profile_picture)?>" alt="user_img" height=35 /><a href="#"> <?= $this->session->userdata('username'); ?> </a>
              <ul>
                <li><a href="<?= base_url('profile'); ?>"><?=trans('label_my_profile')?></a></li>
                <li><a href="<?= base_url('myjobs'); ?>"><?=trans('label_my_apps')?></a></li>
                <li><a href="<?= base_url('myjobs/matching'); ?>"><?=trans('label_matching_jobs')?></a></li>
                <li><a href="<?= base_url('myjobs/saved'); ?>"><?=trans('label_saved_jobs')?></a></li>
                <li><a href="<?= base_url('account/change_password'); ?>"><?=trans('label_change_pass')?></a></li>
                <li><a href="<?= base_url('auth/logout')?>"><?=trans('label_logout')?></a></li>
              </ul>
            </li>
            <li class="menu-has-childres"><a href="">Lan</a>
              <ul>
                <?php $languages = get_site_languages(); ?>
                <?php foreach ($languages as $lang): ?>
                  <li><a href="<?= base_url('home/site_lang/'.$lang['directory_name']); ?>"><?= $lang['display_name']; ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
            <?php 
            $user_id = $this->session->userdata('user_id');  
            $addCart = $this->db->query("SELECT count(product_id) as total_cart FROM xx_product_cart WHERE user_id='".$user_id."' ")->result_array();

            ?>
            <li class="menu-has-children"><a href="<?= base_url('jobs/cartDetails/'.$user_id); ?>"> <i class="fa badge" value="<?php echo $addCart[0]['total_cart']; ?>">&#xf07a;</i></a>

            </li> 


          <?php elseif ($this->session->userdata('is_employer_login')):
            $emp_email=$this->db->query("SELECT * FROM xx_employers WHERE id='".$this->session->userdata('employer_id')."' ")->result_array();

            foreach ($emp_email as $row) {
              $emp_type=$row['employer_type'];
            }

            if ($emp_type=='1') {
             ?>
             <li><a href="<?= base_url('employers/dashboard') ?>"> <?=trans('label_dashboard')?></a></li>
           <!--  <li><a href="<?= base_url('employers/job/listing') ?>"> <?=trans('label_manage_jobs')?></a>
            <li><a href="<?= base_url('employers/cv/search_candidate') ?>"> <?=trans('label_find_cand')?></a>
            </li> -->
            <?php 
            $profile_picture = get_employer_profile($this->session->userdata('employer_id'));
            $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/user.png';
            ?>
            <li class="menu-has-children margin-left-400"><img src="<?= base_url($profile_picture)?>" alt="user_img"  height=35 /><a href="#"> <?= $this->session->userdata('username'); ?> </a>
              <ul>
                <li><a href="<?= base_url('employers/profile') ?>"><?=trans('label_dashboard')?></a></li>
                <li><a href="<?= base_url('employers/job/listing') ?>"><?=trans('label_manage_jobs')?></a></li>
                <li><a href="<?= base_url('employers/account/change_password'); ?>"><?=trans('label_change_pass')?></a></li>
                <li><a href="<?= base_url('employers/auth/logout')?>"><?=trans('label_logout')?></a></li>
              </ul>
            </li>
            <li class="menu-has-children"><a href="">Lan</a>
              <ul>
                <li><a href="<?= base_url('home/site_lang/english'); ?>">English</a></li>
                <li><a href="<?= base_url('home/site_lang/french'); ?>">French</a></li>
              </ul>
            </li>

            <?php
          }
                elseif ($emp_type=='2') { //for bussiness
                  ?>    
                  <!--for business navbar-->
                  <?php /* elseif ($this->uri->segment(1) == 'bussiness' && $this->session->userdata('is_employer_login')): */?> 
                  <li><a href="<?= base_url('bussiness/account/dashboard') ?>"> <?=trans('label_dashboard')?></a></li>
            <!-- <li><a href="<?= base_url('bussiness/job/listing') ?>"> <?=trans('label_manage_jobs')?></a>
            <li><a href="<?= base_url('bussiness/cv/search_candidate') ?>"> <?=trans('label_find_cand')?></a>
            </li> -->
            <?php 
            $profile_picture = get_employer_profile($this->session->userdata('employer_id'));
            $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/user.png';
            ?>
            <li class="menu-has-children margin-left-400"><img src="<?= base_url($profile_picture)?>" alt="user_img"  height=35 /><a href="#"> <?= $this->session->userdata('username'); ?> </a>
              <ul>
                <li><a href="<?= base_url('bussiness/profile') ?>"><?=trans('label_dashboard')?></a></li>
                <li><a href="<?= base_url('bussiness/job/listing') ?>"><?=trans('label_manage_jobs')?></a></li>
                <li><a href="<?= base_url('bussiness/account/change_password'); ?>"><?=trans('label_change_pass')?></a></li>
                <li><a href="<?= base_url('bussiness/auth/logout')?>"><?=trans('label_logout')?></a></li>
              </ul>
            </li>
            <li class="menu-has-children"><a href="">Lan</a>
              <ul>
                <li><a href="<?= base_url('home/site_lang/english'); ?>">English</a></li>
                <li><a href="<?= base_url('home/site_lang/french'); ?>">French</a></li>
              </ul>
            </li>
            <!--for business navbar end-->
          <?php     }
          ?> 

          <?php elseif ($this->uri->segment(1) == 'employers'): ?>   
            <li class=""><a href="<?= base_url('employers'); ?>"><?=trans('label_home')?></a></li>
            <li class=""><a href="<?= base_url('blog'); ?>"><?=trans('label_blog')?></a></li>
            <li class=""><a href="<?= base_url('employers/job/post'); ?>"><?=trans('label_post_job')?></a></li>
            <li><a class="ticker-btn-nav btn_login mt-1" href="<?= base_url('employers/auth/login') ?>"><i class="lnr lnr-user pr-1"></i> Login</a></li>
            <li><a class="nav_btn mt-1" href="<?= base_url() ?>"><?=trans('label_for_jobseeker')?></a> </li>
            <li class="menu-has-children"><a href="">Lan</a>
              <ul>
                <li><a href="<?= base_url('home/site_lang/english'); ?>">English</a></li>
                <li><a href="<?= base_url('home/site_lang/french'); ?>">French</a></li>
              </ul>
            </li>
          <?php else:
            if ($this->uri->segment(1)=='home') {
             ?>            
             <!-- <li><a href="<?= base_url(); ?>">Post A Job</a></li> -->

             <li class="menu-has-children"><a href=""><?=trans('label_jobs')?></a>
              <ul>
                <li><a href="<?= base_url('jobs'); ?>"><?=trans('label_search_job')?></a></li>
                <li><a href="<?= base_url('jobs-by-category'); ?>"><?=trans('label_jobs_by_cat')?></a></li>
                <li><a href="<?= base_url('jobs-by-industry'); ?>"><?=trans('label_jobs_by_industry')?></a></li>
                <li><a href="<?= base_url('jobs-by-location'); ?>"><?=trans('label_jobs_by_loc')?></a></li>
                <li><a href="<?= base_url('jobs'); ?>"><?=trans('label_browse_jobs')?></a></li>
              </ul> 
            </li>

            <li class=""><a href="<?= base_url('blog'); ?>"><?=trans('label_blog')?></a>
              <ul>
                <li><a href="<?= base_url('blog/business_pricing'); ?>">Business Pricing</a></li>
                <li><a href="<?= base_url('blog/job_pricing'); ?>">Job Pricing</a></li> 
              </ul>
            </li>
            <li>
              <a class="nav_btn mt-1" href="<?= base_url('bussiness_home') ?>"><?=trans('label_for_local_bussiness')?></a>
            </li>
            <li>
              <a class="nav_btn mt-1" href="<?= base_url('home') ?>"></i>Jobs Portal
              </a> 
            </li>

            <li><a class="ticker-btn-nav btn_login mt-1" href="<?= base_url('auth/login') ?>"><i class="lnr lnr-user pr-1"></i> <?=trans('label_login')?></a></li>
            <?php
          } 
          else{
            ?>
            <li class=""><a href="<?= base_url('home') ?>"><?=trans('label_home')?></a></li>
            <li class="scroll_link"><a href="#jobs"><?=trans('label_jobs')?></a></li>
            <li class="scroll_link"><a href="#services"><?=trans('label_services')?></a></li>
            <li class="scroll_link"><a href="#bussiness"><?=trans('label_bussiness')?></a></li>
            <li class="scroll_link"><a href="#products"><?=trans('label_products')?></a></li>
            <li class="scroll_link"><a href="#daily_deals"><?=trans('label_companies')?></a></li>
            <li class=""><a href="#"><?=trans('label_blog')?></a>
              <ul>
                <li><a href="<?= base_url('blog/business_pricing'); ?>">Business Pricing</a></li>
                <li><a href="<?= base_url('blog/job_pricing'); ?>">Job Pricing</a></li> 
              </ul>
            </li>
            <li><a class="nav_btn mt-1" href="<?= base_url('bussiness_home') ?>"><?=trans('label_for_local_bussiness')?></a></li>
            <li>
              <a class="nav_btn virtual_jobs mt-1" href="<?= base_url('home') ?>"><?=trans('label_for_virtual_jobs')?></a> 
            </li>
            <li><a class="ticker-btn-nav btn_login mt-1" href="<?= base_url('auth/login') ?>"><?=trans('label_login')?></a>
            </li>
          <?php }
          ?> 

<!--                 <li><a href="<?= base_url(); ?>"><?=trans('label_home')?></a></li>
  <li class="menu-has-children"><a href=""><?=trans('label_jobs')?></a> -->
              <!-- <ul>
                <li><a href="<?= base_url('jobs'); ?>"><?=trans('label_search_job')?></a></li>
                <li><a href="<?= base_url('jobs-by-category'); ?>"><?=trans('label_jobs_by_cat')?></a></li>
                <li><a href="<?= base_url('jobs-by-industry'); ?>"><?=trans('label_jobs_by_industry')?></a></li>
                <li><a href="<?= base_url('jobs-by-location'); ?>"><?=trans('label_jobs_by_loc')?></a></li>
                <li><a href="<?= base_url('jobs'); ?>"><?=trans('label_browse_jobs')?></a></li>
              </ul> 
            </li>-->
<!--             <li class=""><a href="<?= base_url('company'); ?>"><?=trans('label_companies')?></a></li>
  <li class=""><a href="<?= base_url('blog'); ?>"><?=trans('label_blog')?></a></li> -->
            <!-- <li>
              <a class="nav_btn mt-1" href="<?= base_url('employers') ?>"><i class="lnr lnr-briefcase pr-1"></i><?=trans('label_for_employers')?></a>
             </li>
            <li>
              <a class="nav_btn mt-1" href="<?= base_url('bussiness') ?>"><i class="lnr lnr-briefcase pr-1"></i><?=trans('label_for_listings')?>
              </a> 
            </li> -->
         <!--    <li>
              <a class="nav_btn mt-1" href="<?= base_url('bussiness_home') ?>"><i class="lnr lnr-briefcase pr-1"></i><?=trans('label_for_local_bussiness')?></a>
             </li>
            <li>
              <a class="nav_btn mt-1" href="<?= base_url('home') ?>"><i class="lnr lnr-briefcase pr-1"></i>Jobs Portal
              </a> 
            </li>

            <li><a class="ticker-btn-nav btn_login mt-1" href="<?= base_url('auth/login') ?>"><i class="lnr lnr-user pr-1"></i> <?=trans('label_login')?></a></li> -->
            <!--<li class="menu-has-children"><a href="">Lan</a>-->
              <!--  <ul>-->
                <!--    <li><a href="<?= base_url('home/site_lang/english'); ?>">English</a></li>-->
                <!--    <li><a href="<?= base_url('home/site_lang/french'); ?>">French</a></li>-->
                <!--  </ul>-->
                <!--</li>-->
              <?php endif; ?>                                 
            </ul>
          </nav><!-- #nav-menu-container -->      
        </div>      
      </div>
    </div>
</header><!-- #header End