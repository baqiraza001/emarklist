<!-- start banner Area -->
<section class="banner-area relative" id="home">  
<div class="overlay overlay-bg"></div>
<div class="container">
  <div class="row d-flex align-items-center justify-content-center">
    <div class="about-content col-lg-12">
      <h1 class="text-white">
        <?= $title ?>
      </h1> 
      <p class="text-white"><a href="<?= base_url(); ?>"><?=trans('label_home')?>Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?= $title ?></a></p>
    </div>                      
  </div>
</div>
</section>
<!-- End banner Area --> 

<section class="section-gap">
  <div class="container">
    <div class="row">  
    
      <div class="col-lg-12 profile_job_content">
        <div class="headline">
          <h3><?php echo $label; ?></h3>
        </div> 
<!--           <p class="text-gray"><strong>testing</strong> testing</p>  -->
      <div class="row">
      <?php foreach ($posts as $key) {
      ?>
        <div class="col-lg-4">
          <div class="card m-5">
            <div class="card-body">
                <h4 class="card-title"><?php echo $key['title'];?></h4> 
                <p class="pt-3">Total No. of Posts :<?php echo $key['no_of_posts'];?></p>no of posts
                <p class="pt-3">Total No. of Days :<?php echo $key['no_of_days'];?></p>
                <h5 class="pt-3">Price :<?php echo $key['price'];?></h5>
                 
            </div>
          </div> 
        </div>
      <?php } ?>
      </div>
      </div>  
    </div>
  </div>
</section>