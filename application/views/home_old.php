<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
  <!-- start banner Area -->
  <section class="banner-area relative" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container" style="height: 500px;">
      <div class="row fullscreen d-flex align-items-center justify-content-center">
        <div class="banner-content col-lg-12">
          <h1 class="text-white">
            <?=trans('over')?> <span>10,000+</span> <?=trans('jobs_waiting')?>
          </h1>
          <br> 
            <div class="col-lg-6 form-cols">
<li>
<a href="<?= base_url('bussiness') ?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Find Daily Deals
</a>
            </li>
            </div>
            <div class="col-lg-6 form-cols">
            <li>
              <a href="<?= base_url('employers/cv/search') ?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Find Your Dream Jobs</a>
              </li>
            </div>
        </div>                      
      </div>
    </div>
  </section>
<!--   <br><br><br> -->
    <!-- Start feature-cat Area -->
  <section class="feature-cat-area section-full" id="category">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10"><?=trans('feature_job_cats')?></h1>
            <p><?=trans('feature_cat_subtitle')?></p>
          </div>
        </div>
      </div>            
      <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/accounting'); ?>">
              <img src="<?= base_url(''); ?>assets/img/o1.png" alt="">
              <p><?=trans('feature_accounting')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/construction'); ?>">
              <img src="<?= base_url(); ?>assets/img/o2.png" alt="">
              <p><?=trans('feature_construction')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/information-technology'); ?>">
              <img src="<?= base_url(); ?>assets/img/o3.png" alt="">
              <p><?=trans('feature_tech')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/sales'); ?>">
              <img src="<?= base_url(); ?>assets/img/o4.png" alt="">
              <p><?=trans('feature_sales')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/medical-healthcare'); ?>">
              <img src="<?= base_url(); ?>assets/img/o5.png" alt="">
              <p><?=trans('feature_medical')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/engineering'); ?>">
              <img src="<?= base_url(); ?>assets/img/o6.png" alt="">
              <p><?=trans('feature_engineering')?></p>
            </a>
          </div>      
        </div>                                                      
      </div>
    </div>  
  </section>
  <!-- End feature-cat Area -->
<!-- start Subscribe Area -->
<!--   <section class="subscribe-area section-half" id="subscribe-area">
    <div class="container">
      <div class="row section_padding"> 
        <div class="col-lg-12 col-md-12 col-12">
          <?php echo form_open(base_url('home/add_subscriber'), 'class="form-horizontal jsform"');  ?> 
            <div id="mc_embed_signup">
              <form action="#" method="get" class="form-inline" novalidate="true">
                <div class="form-group row no-gutters">
                  <div class="col-4" style="background-right: #000 !important; border-right: solid #bdbfbe 1px !important;">
                    <input type="text"  name="job_title" placeholder="<?=trans('search_place_holder')?>" required>
                  </div>
                  <div class="col-4"> 
                    <select name="country"  required style="line-height: 38px !important;border: none !important;background: #fff !important;font-weight: 300 !important;color: #777 !important;padding-left: 20px !important;width: 100% !important;height: 40px !important;">
                      <option value=""><?=trans('select_location')?></option>
                      <?php foreach($countries as $country):?>
                        <option value="<?= $country['id']?>"><?= $country['name']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div> 
                  <div class="col-2">
                    <button class="nw-btn primary-btn fa fa-search" ></button>
                  </div> 
                </div>    
              </form>
            </div>
          <?php echo form_close( ); ?>
        </div>
      </div>
    </div>
  </section> -->
  <!-- End Subscribe Area -->
<!--New Jobs-->
<div class="property_h_bg1 shownext hand list_bg list_dis_b">
<div class="container" style="padding: 0;width: 1230px;">
<h3 class="pull-left property_h1">New<span style="color: #0093ef;"> Jobs</span></h3>

<div class="pull-right"><img src="<?= base_url(); ?>assets/img/job_icon.png" class=" visible-xs" alt=""></div>
<div class="clearfix"></div>
</div>
</div>
<div class="list_bg list_dis_n">
<div class="container">
<div class="pt35 pb35 ">
<div class="property_list_h">
<div class="property_list scroll_2">
<ul>
<?php 
foreach($jobs as $job) { 
?>
<li style="margin-right: 10px;border:1px solid;">
<div class="property_area">
<div class="property_img img_scale rel">
<div class="cnt_pos">
<div>
<p class="osons weight800 fs18 white">                                
  <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"  style="color: #FFFFFF;"><h4><?= text_limit($job['title'], 35); ?></h4></a>
      <h6 style="color: #FFFFFF;"><?= get_company_name($job['company_id']); ?></h6>
</p>
<!-- <p class="osons fs14 white loc_h"><?php echo $val['address']; ?></p> -->
</div>
</div>
<figure><img src="<?= base_url(); ?>assets/img/job_icon.png">
</figure></div>
<div class="property_cnt_sec">
<!-- <p class="content_txt"> -->

<p class="address"><span class="lnr lnr-map-marker"></span>  <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></p>
<p class="address"><span class="lnr lnr-clock"></span> <?= time_ago($job['created_date']); ?></p>

<!-- </p>
 --><div class="price_area">
<div class="property_price"><a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns text-uppercase"><?=trans('apply_job')?></a>
</div>
<div class="property_btn">                    
  <!-- <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns text-uppercase"><?=trans('apply_job')?></a> --></div>
<div class="clearfix mb8"></div>
</div>
</div>
</div>
</li>
<?php } ?>


</ul>
</div>
</div>
</div>
</div>
</div>
<!--end-->




<!--New Services-->
<div class="property_h_bg1 shownext hand list_bg list_dis_b">
<div class="container" style="padding: 0;width: 1230px;">
<h3 class="pull-left property_h1">Daily<span style="color: #0093ef;"> Deals</span></h3>

<div class="pull-right"><img src="<?= base_url(); ?>assets/img/job_icon.png" class=" visible-xs" alt=""></div>
<div class="clearfix"></div>
</div>
</div>
<div class="list_bg list_dis_n">
<div class="container">
<div class="pt35 pb35 ">
<div class="property_list_h">
<div class="property_list scroll_2">
<ul>
<?php 
foreach($services as $job) { 
?>
<li style="margin-right: 10px;border:1px solid;">
<div class="property_area">
<div class="property_img img_scale rel">
<div class="cnt_pos">
<div>
<p class="osons weight800 fs18 white">                                
  <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"  style="color: #FFFFFF;"><h4><?= text_limit($job['title'], 35); ?></h4></a>
      <h6 style="color: #FFFFFF;"><?= get_company_name($job['company_id']); ?></h6>
</p>
<!-- <p class="osons fs14 white loc_h"><?php echo $val['address']; ?></p> -->
</div>
</div>
<figure><img src="<?= base_url(); ?>assets/img/job_icon.png">
</figure></div>
<div class="property_cnt_sec">
<!-- <p class="content_txt"> -->

<p class="address"><span class="lnr lnr-map-marker"></span>  <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></p>
<p class="address"><span class="lnr lnr-clock"></span> <?= time_ago($job['created_date']); ?></p>

<!-- </p>
 --><div class="price_area">
<div class="property_price"><a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns text-uppercase">View Details</a>
</div>
<div class="property_btn">                    
  <!-- <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns text-uppercase"><?=trans('apply_job')?></a> --></div>
<div class="clearfix mb8"></div>
</div>
</div>
</div>
</li>
<?php } ?>


</ul>
</div>
</div>
<!-- <div class="text-center white visible-xs u"><a href="<?php echo base_url() ?>new-property">View All</a></div> -->
</div>
</div>
</div>
<script type="text/javascript">
    $().ready(function() {
    $(".scroll_2").jCarouselLite({
       btnPrev:".prev2",
      btnNext:".next2",
      vertical: false,
      hoverPause:true,
      visible:3,
      auto:2000,
      speed:400
});
  });
     
     $("#back-top").hide(); 

     $('.shownext').click(function(){$('.subdd').hide('fast'); $(this).next().slideToggle('fast');});
     $(function(){$(".scroll_3").jCarouselLite({btnPrev:".prev5",btnNext:".next5",vertical: false,hoverPause:true,visible:4,auto:2000,speed:400});});
     (function($){$.fn.jCarouselLite=function(o){o=$.extend({btnPrev:null,btnNext:null,btnGo:null,mouseWheel:false,auto:null,hoverPause:false,speed:200,easing:null,vertical:false,circular:true,visible:3,start:0,scroll:1,beforeStart:null,afterEnd:null},o||{});return this.each(function(){var running=false,animCss=o.vertical?"top":"left",sizeCss=o.vertical?"height":"width";var div=$(this),ul=$("ul",div),tLi=$("li",ul),tl=tLi.size(),v=o.visible;if(o.circular){ul.prepend(tLi.slice(tl-v+1).clone()).append(tLi.slice(0,o.scroll).clone());o.start+=v-1}var li=$("li",ul),itemLength=li.size(),curr=o.start;div.css("visibility","visible");li.css({overflow:"hidden",float:o.vertical?"none":"left"});ul.css({margin:"0",padding:"0",position:"relative","list-style-type":"none","z-index":"1"});div.css({overflow:"hidden",position:"relative","z-index":"2",left:"0px"});var liSize=o.vertical?height(li):width(li);var ulSize=liSize*itemLength;var divSize=liSize*v;li.css({width:li.width(),height:li.height()});ul.css(sizeCss,ulSize+"px").css(animCss,-(curr*liSize));div.css(sizeCss,divSize+"px");if(o.btnPrev){$(o.btnPrev).click(function(){return go(curr-o.scroll)});if(o.hoverPause){$(o.btnPrev).hover(function(){stopAuto()},function(){startAuto()})}}if(o.btnNext){$(o.btnNext).click(function(){return go(curr+o.scroll)});if(o.hoverPause){$(o.btnNext).hover(function(){stopAuto()},function(){startAuto()})}}if(o.btnGo)$.each(o.btnGo,function(i,val){$(val).click(function(){return go(o.circular?o.visible+i:i)})});if(o.mouseWheel&&div.mousewheel)div.mousewheel(function(e,d){return d>0?go(curr-o.scroll):go(curr+o.scroll)});var autoInterval;function startAuto(){stopAuto();autoInterval=setInterval(function(){go(curr+o.scroll)},o.auto+o.speed)};function stopAuto(){clearInterval(autoInterval)};if(o.auto){if(o.hoverPause){div.hover(function(){stopAuto()},function(){startAuto()})}startAuto()};function vis(){return li.slice(curr).slice(0,v)};function go(to){if(!running){if(o.beforeStart)o.beforeStart.call(this,vis());if(o.circular){if(to<0){ul.css(animCss,-((curr+tl)*liSize)+"px");curr=to+tl}else if(to>itemLength-v){ul.css(animCss,-((curr-tl)*liSize)+"px");curr=to-tl}else curr=to}else{if(to<0||to>itemLength-v)return;else curr=to}running=true;ul.animate(animCss=="left"?{left:-(curr*liSize)}:{top:-(curr*liSize)},o.speed,o.easing,function(){if(o.afterEnd)o.afterEnd.call(this,vis());running=false});if(!o.circular){$(o.btnPrev+","+o.btnNext).removeClass("disabled");$((curr-o.scroll<0&&o.btnPrev)||(curr+o.scroll>itemLength-v&&o.btnNext)||[]).addClass("disabled")}}return false}})};function css(el,prop){return parseInt($.css(el[0],prop))||0};function width(el){return el[0].offsetWidth+css(el,'marginLeft')+css(el,'marginRight')};function height(el){return el[0].offsetHeight+css(el,'marginTop')+css(el,'marginBottom')}})(jQuery);
</script>
<!--New Property--> 


  <!-- end service  -->  
<!-- <div class="container pb-50">
    <div class="row"> 
        <div class="col-md-2">
 
          <div class="controls pull-left hidden-xs">
            <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example1" data-slide="prev"></a>
             
          </div>
        </div> 
        <div class="col col-md-8">
                <h3>Latest Jobs</h3>
        </div>
        <div class="col-md-2">
          <div class="controls pull-right hidden-xs"> 
            <a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example1" data-slide="next"></a>
          </div>
        </div>

        <div id="carousel-example1" class="carousel slide hidden-xs" data-ride="carousel">
            <div class="carousel-inner">
              <?php for($x=1; $x<=4; $x++) {?>
                <div class="item <?php if($x==1){echo'active';}?>">
                    <div class="row">
                        <?php //for($y=1; $y<=4; $y++)
                        foreach($jobs as $job)
                        {?>
                        
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                  <img src="<?= base_url(); ?>assets/img/job_icon.png" alt="" style="width: 350;height: 260">
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['title'], 35); ?></h4></a>
                               <h6><?= get_company_name($job['company_id']); ?></h6>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                    <p class="address"><span class="lnr lnr-map-marker"></span>  <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></p>
                    <p class="address"><span class="lnr lnr-clock"></span> <?= time_ago($job['created_date']); ?></p>
                    <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns text-uppercase"><?=trans('apply_job')?></a>

                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php  } ?>
                    </div>
                </div>
              <?php }?> 
            </div>
        </div>
    </div> 
</div>
<div class="container pb-50">
    <div class="row"> 
        <div class="col-md-2">
          <div class="controls pull-left hidden-xs">
            <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example" data-slide="prev"></a>
             
          </div>
        </div> 
        <div class="col col-md-8">
                <h3> Daily Services</h3>
        </div>
        <div class="col-md-2">
          <div class="controls pull-right hidden-xs"> 
            <a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example" data-slide="next"></a>
          </div>
        </div> 
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <div class="carousel-inner">
              <?php for($x=1; $x<=4; $x++) {?>
                <div class="item <?php if($x==1){echo'active';}?>">
                    <div class="row">
                        <?php //for($y=1; $y<=4; $y++)
                        $count=0;
                        foreach($services as $job)
                        {
                          if ($count<=3)
                        {
                          $count++;
                          ?>
                        
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                  <img src="<?= base_url(); ?>assets/img/job_icon.png" alt="" style="width: 350;height: 260">
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['title'], 35); ?></h4></a>
                               <h6><?= get_company_name($job['company_id']); ?></h6>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                    <p class="address"><span class="lnr lnr-map-marker"></span>  <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></p>
                    <p class="address"><span class="lnr lnr-clock"></span> <?= time_ago($job['created_date']); ?></p>
                    <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns text-uppercase">View Service</a>

                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php  } } ?>
                    </div>
                </div>
              <?php }?> 
            </div>


        </div>
    </div> 
</div> -->
<!-- end daily deals-->

 


  <!-- Start post Area -->
  <!-- <section class="post-area section-full bg-gray">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10"><?=trans('jobs_avail')?></h1>
            <p><?=trans('jobs_avail_subtitle')?></p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center d-flex">
        <div class="col-lg-8 post-list">
          <?php foreach($jobs as $job): ?>
            <div class="single-post d-flex flex-row">
              <div class="thumb">
                <img src="<?= base_url(); ?>assets/img/job_icon.png" alt="">
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
                    <li><i class="lnr lnr-apartment"></i> <?= get_industry_name($job['industry']); ?></li>
                    <li><i class="lnr lnr-clock"></i> <?= time_ago($job['created_date']); ?></li>
                  </ul>                 
                </div>
              </div>
              <div class="job-listing-btns">
                <ul class="btns">
                  <li><a class="saved_job" data-job_id="<?= $job['id']; ?>"><span class="lnr lnr-heart"></span></a></li>
                  <li><a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><?=trans('apply')?></a></li>
                </ul>
              </div>
            </div>
          <?php endforeach; ?>

          <a class="text-uppercase loadmore-btn mx-auto d-block" href="<?= base_url('jobs'); ?>"><?=trans('load_more_jobs')?></a>
        </div>

        <div class="col-lg-4 sidebar">
          <div class="single-slidebar">
            <h4><?=trans('jobs_by_cities')?></h4>
            <ul class="cat-list">
              <?php foreach($cities_job as $city):?>
               <li><a class="justify-content-between d-flex" href="<?= base_url('jobs/location/'.get_city_slug($city['name'])); ?>"><p><?= get_city_name($city['name']); ?></p><span><?= $city['total_jobs']; ?></span></a></li>
             <?php endforeach; ?>
           </ul>
          </div>

          <div class="single-slidebar">
            <h4><?=trans('top_rated_job_posts')?></h4>
            <div class="active-relatedjob-carusel">
              <?php foreach($jobs as $job): ?>
                <div class="single-rated">
                  <img class="img-fluid" src="<?= base_url(); ?>assets/img/r1.jpg" alt="">
                  <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['title'], 35); ?></h4></a>
                  <h6><?= get_company_name($job['company_id']); ?></h6>
                  <p>
                    <?= text_limit($job['description'], 100); ?>
                  </p>
                    <p class="address"><span class="lnr lnr-apartment"></span> <?= get_industry_name($job['industry']); ?></h5>
                    <p class="address"><span class="lnr lnr-map-marker"></span>  <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></p>
                    <p class="address"><span class="lnr lnr-clock"></span> <?= time_ago($job['created_date']); ?></p>
                    <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns text-uppercase"><?=trans('apply_job')?></a>
                  </div>
                <?php endforeach; ?>                                 
              </div>
            </div>  
          </div>

        </div>
    </div>  
  </section> -->
  <!-- End post Area -->

  <!-- Start Cities Area -->
  <!-- <section class="featured-cities-area section-full" id="Cities">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10"><?=trans('top_employers')?></h1>
            <p><?=trans('top_employers_subtitle')?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <?php foreach($companies as $company): ?>
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="company-item-list text-center">
              <a href="<?= base_url('company/'.$company['company_slug']); ?>"><img src="<?= base_url().$company['company_logo']; ?>" alt="company-img" /></a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="col-12 post-list">
        <a class="text-uppercase loadmore-btn mx-auto d-block" href="<?= base_url('company'); ?>"><?=trans('show_all')?></a>
      </div>
    </div>
  </section> -->
  <!-- End cities Area -->


  <!-- Start call-to-action Area -->
  <!-- <section class="callto-action-area section-half" id="join">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content col-lg-9">
          <div class="title text-center">
            <h1 class="mb-10 text-white"><?=trans('join_us')?></h1>
            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
            <a class="primary-btn" href="#"><?=trans('i_am_cand')?></a>
            <a class="primary-btn" href="<?= base_url('auth/login'); ?>"><?=trans('req_free_demo')?></a>
          </div>
        </div>
      </div>  
    </div>  
  </section> -->
  <!-- End call-to-action Area -->

  <!-- Start download Area -->
 <!--  <section class="download-area section-gap" id="app">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 download-left">
          <img class="img-fluid" src="<?= base_url(); ?>assets/img/d1.png" alt="">
        </div>
        <div class="col-lg-6 download-right">
          <h1><?=trans('download_app_listing')?>!</h1>
          <p class="subs">
            <?=trans('app_listing_text')?>
          </p>
          <div class="d-flex flex-row">
            <div class="buttons">
              <i class="fa fa-apple" aria-hidden="true"></i>
              <div class="desc">
                <a href="#">
                  <p>
                    <span><?=trans('available')?></span> <br>
                    <?=trans('on_app_store')?>
                  </p>
                </a>
              </div>
            </div>
            <div class="buttons">
              <i class="fa fa-android" aria-hidden="true"></i>
              <div class="desc">
                <a href="#">
                  <p>
                    <span><?=trans('available')?></span> <br>
                    <?=trans('on_play_store')?>
                  </p>
                </a>
              </div>
            </div>                  
          </div>            
        </div>
      </div>
    </div>  
  </section> -->
  <!-- End download Area -->

  <!-- Start testimonial Area -->
  <!-- <section class="testimonial-area section-full">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10"><?=trans('testimonials')?></h1>
            <p><?=trans('testimonials_subtitle')?>.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 shdw pt-4 pb-4">
          <div id="testimonial-slider" class="owl-carousel">
              
            <?php 
                foreach($testimonials as $row):
                    $photo = ($row['photo']) ? $row['photo'] : 'assets/img/user.png';
            ?>
              <div class="testimonial">
                <div class="pic">
                    <img src="<?= base_url($photo) ?>" alt="">
                </div>
                <h3 class="testimonial-title">
                     <?= $row['testimonial_by'] ?><small>,  <?= $row['comp_and_desig'] ?></small>
                </h3>
                <p class="description">
                    <?= $row['testimonial'] ?>
                </p>
              </div>
            <?php  endforeach; ?>
            
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- End testimonial Area -->


  <!-- Start Blog Area -->
  <section class="blog-area section-full">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10"><?=trans('blogs')?></h1>
            <p><?=trans('blogs_subtitle')?>.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <?php  foreach($posts as $post): ?>
          <div class="col-lg-4">
            <div class="card">
              <img class="card-img-top" src="<?= base_url($post['image_default']) ?>" alt="">
              <div class="card-body">
                <h5 class="card-title"><a href="<?= base_url().'blog/post/'.$post['slug'] ?>"><?= $post['title'] ?></a></h5>
                <p class="card-text"><?= text_limit($post['content'], 150) ?></p>
                <a href="<?= base_url().'blog/post/'.$post['slug'] ?>" class="btn btn-info"><?=trans('read_more')?>..</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>  
      </div>
    </div>
  </section>