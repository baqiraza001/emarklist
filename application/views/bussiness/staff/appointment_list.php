<style type="text/css">
  table td, table th {
    border: 1px solid #dee2e6 !important;
    text-align: center !important;
  }
  table td {
    padding: 10px;
  }
</style>
<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          <!-- <?=trans('label_manage_jobs')?> -->
          Appointment List
        </h1> 
        <p class="text-white link-nav"><a href="<?= base_url('bussiness'); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href="">Appointment List<!--  <?=trans('label_manage_jobs')?> --></a></p>
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

          <div class="onjob-job-alerts">
            <div class="table-responsive">
              <table class="table table-responsive table-hover text-center ">
                <thead>
                  <tr>
                    <th>Staff</th>
                    <th>Service ID</th>
                    <th>Service</th>
                    <th>Slot Booked</th>
                    <th>Booked By</th>
                    <th>User Email</th>
                    <th>User Phone</th>
                    <th>Created On</th>
                    <th><?=trans('action')?></th> 
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($appointments)): ?>
                    <p class="text-gray"><strong><?=trans('sorry')?>,</strong> No appointments yet.</p>
                  <?php endif; ?>

                  <?php foreach ($appointments as $appointment): ?>
                    <tr>
                      <td><?= $appointment->name ?></td>
                      <td><?= $appointment->service_id ?></td>
                      <td><?= $appointment->title ?></td>
                      <td><?= date("h:i a", strtotime($appointment->slot)); ?></td>
                      <td><?= $appointment->firstname .' ' .$appointment->lastname ?></td>
                      <td><?= $appointment->email ?></td>
                      <td><?= $appointment->mobile_no ?></td>
                      <td><?= date("d F, Y h:i a", strtotime($appointment->date_created)); ?></td>
                      <td>
                        <a href="<?= base_url('bussiness/staff/delete_appointment/'.$appointment->appointment_id); ?>" class="onjob-savedjobs-links btn-delete"><i title="<?=trans('delete')?>" class="lnr lnr-trash"></i></a>
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