<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          <?=trans('search_results')?>
        </h1> 
        <p class="text-white link-nav"><a href="<?= base_url() ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""><?=trans('search_results')?></a></p>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- Start post Area -->
<section class="post-area section-gap">
  <div class="container">
    <div class="row justify-content-center d-flex">
      <div class="col-lg-12">
        <div class="search-bar">
          <?php $attributes = array('id' => 'search_multi', 'method' => 'post');
          echo form_open('search/results',$attributes);?>
          <div class="row justify-content-center form-wrap no-gutters">
            <div class="col-lg-6 form-cols">
              <input type="text" class="form-control" name="search_q" value="<?php if(isset($search_value['title'])) echo str_replace('-', ' ', $search_value['title']); ?>" placeholder="<?=trans('what_looking')?>">
            </div>
            <div class="col-lg-4 form-cols">
              <select name="search_option" class="form-control">
                <?php foreach(search_options() as $key => $value):?>
                  <?php if($key == $search_value['search_option']): ?>
                    <option value="<?= $key; ?>" selected> <?= $value; ?> </option>
                    <?php else: ?>
                      <option value="<?= $key; ?>"> <?= $value; ?> </option>
                    <?php endif; endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-2 form-cols">
                  <input type="submit" name="search" class="btn btn-info" value="<?=trans('btn_search_text')?>">
                </div>                
              </div>
              <?php echo form_close(); ?>
            </div> 
          </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script>
            $(document).ready(function(){

              $("#category_toggle").click(function(){
                $("#cat-list").slideToggle("slow");
              });
              $("#experience_toggle").click(function(){
                $("#exp-list").slideToggle("slow");
              });

              $("#job_toggle").click(function(){
                $("#job-list").slideToggle("slow");
              });

              $("#emp_toggle").click(function(){
                $("#emp-list").slideToggle("slow");
                console.log("1");
              });


            });
          </script>
          <div class="col-lg-4 order-2 sidebar search">
            <div class="single-slidebar">
              <div id="category_toggle">
                <h4><?=trans('category')?> <i class="fa fa-caret-down"></i></h4>
              </div>
              <?php  
              $category_uri = array();
              if(!empty($search_value['title']))
                $category_uri['title'] = $search_value['title'];
              if(!empty($search_value['category']))
                $category_uri['category'] = $search_value['category'];
              if(!empty($search_value['search_option']))
                $category_uri['search_option'] = $search_value['search_option'];
              $query = $this->uri->assoc_to_uri($category_uri);

              ?>
              <?php $attributes = array('id' => 'post_job', 'method' => 'post');
              echo form_open('search/results/'.$query,$attributes);?>
              

              <div id="cat-list" style="display: none;">
                <ul class="cat-list">
                  <?php $category_id = (isset($search_value['category']))? $search_value['category']: '';  ?>
                  <?php foreach($categories as $category): ?>
                    <?php if($category_id == $category['id']): ?>
                      <li>
                        <p><input type="checkbox" name="category" class="category" value="<?= $category['id']?>" checked="" > <?= $category['name']?></p>
                      </li>
                      <?php else: ?>
                        <li>
                          <p><input type="checkbox" name="category" class="category" value="<?= $category['id']?>" > <?= $category['name']?></p>
                        </li>
                      <?php endif; endforeach; ?>
                    </ul>
                  </div>
                </div>
                <div class="single-slidebar btn-search">  
                  <input type="submit" class="btn btn-info btn-block" value="<?=trans('btn_search_text');?>">
                </div>        
                <?php echo form_close(); ?>
              </div>

              <?php if(!empty($services)){ ?>
                <div class="col-lg-8 order-md-2  post-list">
                  <?php foreach($services as $job): ?>
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
                            <li><i class="lnr lnr-briefcase"></i> <?= get_job_type_name($job['job_type']); ?></li>
                            <li><i class="lnr lnr-apartment"></i> <?= get_industry_name($job['industry']); ?></li>
                            <li><i class="lnr lnr-clock"></i> <?= time_ago($job['created_date']); ?></li>
                          </ul>                 
                        </div>
                      </div>
                      <div class="job-listing-btns">
                        <ul class="btns">
                         <li><a class="saved_job" data-job_id="<?= $job['id']; ?>"><span class="lnr lnr-heart"></span></a></li>
                         <li><a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><?=trans('apply');?></a></li>
                       </ul>
                     </div>
                   </div>
                 <?php endforeach; ?>
                 <div class="pull-right">
                  <?php echo $this->pagination->create_links(); ?>
                </div>
              </div>
            <?php } ?>


            <?php if(!empty($products)){ ?>
              <div class="col-lg-8 order-md-2  post-list">
                <?php foreach($products as $job): ?>
                  <div class="single-post d-flex flex-row">
                    <div class="thumb">
                      <img src="<?= base_url()?>assets/img/job_icon.png" alt="">
                    </div>
                    <div class="details">
                      <div class="title d-flex flex-row justify-content-between">
                        <div class="titles">
                          <a href="<?= site_url('jobs/product_detail/'.$job['id'].'/'.($job['product_slug'])); ?>"><h4><?= text_limit($job['title'], 100); ?></h4></a>
                          <h6><?= get_company_name($job['company_id']); ?></h6>         
                        </div>

                      </div>
                    </div>
                    <div class="job-listing-btns">
                      <ul class="btns">
                        <li><a class="btn ticker-btn-nav" style="background: #256993" href="<?= site_url('jobs/product_detail/'.$job['id'].'/'.($job['product_slug'])); ?>">Buy Now</a></li>
                      </ul>
                    </div>
                  </div>
                <?php endforeach; ?>
                <div class="pull-right">
                  <?php echo $this->pagination->create_links(); ?>
                </div>
              </div>
            <?php } ?>

            <?php if(!empty($deals)){ ?>
              <div class="col-lg-8 order-md-2  post-list">
                <?php foreach($deals as $job): ?>
                  <div class="single-post d-flex flex-row">
                    <div class="thumb">
                      <img src="<?= base_url()?>assets/img/job_icon.png" alt="">
                    </div>
                    <div class="details">
                      <div class="title d-flex flex-row justify-content-between">
                        <div class="titles">
                          <a href="<?= site_url('jobs/deals_detail/'.$job['id'].'/'.($job['deal_slug'])); ?>"><h4><?= text_limit($job['title'], 100); ?></h4></a>
                          <h6><?= get_company_name($job['company_id']); ?></h6>         
                        </div>

                      </div>
                    </div>
                    <div class="job-listing-btns">
                      <ul class="btns">
                        <li><a href="<?= site_url('jobs/deals_detail/'.$job['id'].'/'.($job['deal_slug'])); ?>">Apply Now</a></li>
                      </ul>
                    </div>
                  </div>
                <?php endforeach; ?>
                <div class="pull-right">
                  <?php echo $this->pagination->create_links(); ?>
                </div>
              </div>
            <?php } ?>

            <?php if(!empty($companies)){ ?>
              <div class="col-lg-8 order-md-2  post-list">
                <?php foreach($companies as $job): ?>
                  <div class="single-post d-flex flex-row">
                    <div class="thumb">
                      <img src="<?= base_url()?>assets/img/job_icon.png" alt="">
                    </div>
                    <div class="details">
                      <div class="title d-flex flex-row justify-content-between">
                        <div class="titles">
                          <a href="<?= site_url('company/'.($job['company_slug'])); ?>"><h4><?= text_limit($job['company_name'], 100); ?></h4></a>
                        </div>

                      </div>
                      <div class="job-listing-footer">
                        <ul>
                          <li><i class="lnr lnr-map-marker"></i> <?= $job['address']; ?></li>
                        </ul>                 
                      </div>
                    </div>

                    <div class="job-listing-btns">
                      <ul class="btns">
                        <li><a href="<?= site_url('company/'.($job['company_slug'])); ?>">View</a></li>
                      </ul>
                    </div>
                  </div>
                <?php endforeach; ?>
                <div class="pull-right">
                  <?php echo $this->pagination->create_links(); ?>
                </div>
              </div>
            <?php } ?>

          </div>
        </div>  
      </section>
      <!-- End post Area -->

<script type="text/javascript">
  $(".category").change(function() {
    if($(this).prop('checked')) {
     $('#post_job').attr('action', "<?= site_url('search/results/'.$query) ?>/category/"+$(this).val());
    }
  })
</script>