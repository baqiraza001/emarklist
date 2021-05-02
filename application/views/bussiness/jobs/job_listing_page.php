<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          <!-- <?=trans('label_manage_jobs')?> -->
          Manage Jobs/Services
        </h1> 
        <p class="text-white link-nav"><a href="<?= base_url('bussiness'); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href="">Manage Jobs/Services<!--  <?=trans('label_manage_jobs')?> --></a></p>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->  

<!-- Start post Area -->
<section class="post-area section-gap">
  <div class="container">
    <div class="row justify-content-center d-flex">
      <div class="col-lg-4 sidebar">             
        <?php $this->load->view($emp_sidebar); ?>
      </div>
      <div class="col-lg-8 post-list">
        <div class="col-md-12">
          <?php if ($this->session->flashdata('update_success')) :?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
              <strong><?=$this->session->flashdata('update_success')?></strong> 
            </div>
          <?php endif;?>
          <?php if ($this->session->flashdata('deleted')) :?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
              <strong><?=$this->session->flashdata('deleted')?></strong> 
            </div>
          <?php endif;?>
        </div>
        <div class="profile_job_content col-lg-12">
<!--           <div class="headline">
            <div class="row">
              <div class="col-12">
                <h3 class="d-inline"><?=trans('label_manage_jobs')?></h3>
                <a class="btn btn-info float-right" href="<?= base_url('employers/job/post'); ?>"><?=trans('post_new_job')?></a>
              </div>
          </div>  
        </div> -->

        <div class="onjob-job-alerts">
          <div class="table-responsive">
            <table class="table table-responsive table-hover ">
              <thead>
                <tr>
                  <th>Type</th>
                  <th><!-- <?=trans('job_title')?> -->Title</th>
                  <th><?=trans('applications')?></th>
                  <th><?=trans('date')?></th>
                  <th><?=trans('status')?></th> 
                  <th><?=trans('action')?></th> 
                </tr>
              </thead>
              <tbody>
                <?php if(empty($job_info)): ?>
                  <p class="text-gray"><strong><?=trans('sorry')?>,</strong> <?=trans('no_posted_job_yet')?></p>
                <?php endif; ?>

                <?php foreach ($job_info as $job): ?>
                <tr>
                  
                  <td style="border-right: 1px solid #dbdbdb;">
                    <?php if ($job['posting_type']=='1'){?> 
                    <span style="font-weight: 700">Job</span>
                  <?php }
                  else{?>
                    <span style="font-weight: 700;padding-right: 10px;">Service</span>
                  <?php }?>
                  </td>
                  
                  <td style="padding: 10px;border-right: 1px solid #dbdbdb;">
                    <h4><a href=""><?= $job['title']; ?></a></h4>
                    <div class="job-listing-footer">
                      <ul>
                        <li><i class="fa fa-map-marker"></i> <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></li>
                        <li><i class="fa fa-database"></i> <?= get_industry_name($job['industry']); ?></li>
                      </ul>
                    </div>
                  </td>
                  <td class="text-center" style="padding: 10px;border-right: 1px solid #dbdbdb;">
                    <a href="<?= base_url('bussiness/applicants/view/'.$job['id']); ?>"><?=trans('applied')?> (<?= $job['cand_applied']?>)</a><br/>
                    <a href="<?= base_url('bussiness/applicants/shortlisted/'.$job['id']); ?>"><?=trans('shortlisted')?> (<?= $job['total_shortlisted']?>)</a><br/>
                  </td>
                  <td style="padding: 10px;border-right: 1px solid #dbdbdb;"><?= date("d F, Y h:i a", strtotime($job['created_date'])); ?></td>
                  <td style="padding: 10px;border-right: 1px solid #dbdbdb;">
                    <?php
                    $edit_text = 'service';
                    if ($job['posting_type']=='1'){
                      $edit_text = 'job';
                      $curdate = date('Y-m-d');
                      if ($curdate >= $job['expiry_date']) {
                        ?>
                        <span class="badge badge-info"><?= trans('expired') ?></span><br/>
                      <?php
                      }
                    }
                    ?>
                  </td>
                  <td style="padding-left: 10px;">
                    <a href="<?= base_url('bussiness/job/delete/'.$job['id']); ?>" class="onjob-savedjobs-links btn-delete"><i title="<?=trans('delete')?>" class="lnr lnr-trash"></i></a>
                    <a href="<?= base_url('bussiness/'.$edit_text.'/edit/'.$job['id']); ?>" class="onjob-savedjobs-links"><i title="<?=trans('edit')?>" class="lnr lnr-pencil"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>                            

    </div>

  </div>
</div>  
</section>
      <!-- End Job listing Area