  
<?php $footer =  get_footer_settings(); ?>

<footer class="footer-area footer-section">
  <div class="container">
    <div class="row">


      <div class="col-lg-2  col-md-2 col-sm-6">
        <div class="single-footer-widget newsletter">
          <h6>JOB SEEKERS</h6>
          <ul class="footer-nav">
            <li><a href="<?= base_url() ?>auth/registration">Create Account</a></li>
            <li><a href="<?= base_url() ?>myjobs/matching">Matching Jobs</a></li>
            <li><a href="<?= base_url() ?>jobs">Apply for Job</a></li>
            <li><a href="<?= base_url() ?>myjobs">Applied Jobs</a></li>
          </ul>        </div>
        </div>


        <div class="col-lg-3  col-md-3 col-sm-6">
          <div class="single-footer-widget newsletter">
            <h6>QUICK LINKS</h6>
            <ul class="footer-nav">
             <li><a href="<?= base_url() ?>jobs/search">Search Jobs</a></li>
             <li><a href="<?= base_url() ?>jobs-by-category">Jobs by Category</a></li>
             <li><a href="<?= base_url() ?>jobs-by-location">Jobs by Location</a></li>
             <li><a href="<?= base_url() ?>company">Listed Companies</a></li>
           </ul>        </div>
         </div>


         <div class="col-lg-3  col-md-3 col-sm-6">
          <div class="single-footer-widget newsletter">
            <h6>EMPLOYERS</h6>
            <ul class="footer-nav">
              <li><a href="<?= base_url() ?>employers/auth/registration">Create Account</a></li>
              <li><a href="<?= base_url() ?>employers/job/post">Post a Job</a></li>
              <li><a href="<?= base_url() ?>contact">Contact Us</a></li>
            </ul>        </div>
          </div>


          <div class="col-lg-4  col-md-4 col-sm-6">
            <div class="single-footer-widget newsletter">
              <h6>CONTACT US</h6>
              <form action="/home/add_subscriber" class="form-horizontal jsform" method="post" accept-charset="utf-8">
                <input type="hidden" name="csrf_test_name" value="de3e5c7f7f6b364437b51e0541faf7fe">                                     

                <div class="form-group row no-gutters">
                  <div class="col-10">
                    <input name="subscriber_email" placeholder="Enter Email" type="email">
                  </div> 
                  <div class="col-2">
                    <button class="nw-btn primary-btn fa fa-paper-plane-o"></button>
                  </div> 
                </div>    

              </form>
              <p class="mt-3">Contact@emarklist.com</p>
            </div>
          </div>


        </div>


      </div>
    </footer>
    <!-- End Footer Area -->

    <!-- start Copyright Area -->
    <div class="copyright1">
      <div class="container">
        <div class="row"> 
          <div class="col-md-6 col-8">
            <div class="bottom_footer_info">

              <p class="text-white"><?= $this->general_settings['copyright']?></p>
            </div>
          </div>
          <div class="col-md-6 col-4">
            <div class="bottom_footer_logo text-right">
              <ul class="list-inline">
                <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['facebook_link']; ?>"><i class="fa fa-facebook"></i></a></li>
                <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['twitter_link']; ?>"><i class="fa fa-twitter"></i></a></li>
                <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['google_link']; ?>"><i class="fa fa-google"></i></a></li>
                <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['linkedin_link']; ?>"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Copyright Area --> 