 <!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
			<?=trans('label_matching_deals')?>
			<?php
			$curdate = date('Y-m-d');
			?>
        </h1> 
        <p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('deals')?></a></p>
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
				<?php $this->load->view($user_sidebar); ?>
			</div>
			<div class="col-lg-8 post-list">
				<div class="col-lg-12">
					<?php if ($this->session->flashdata('deleted')) :?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
              <strong><?=$this->session->flashdata('deleted')?></strong> 
            </div>
          <?php endif;?>
        <?php if(empty($deals)){ ?>
          <p class="text-gray">No deals found</p>
        <?php } else { ?>
        	<div class="table-responsive">
				    <table class="table table-bdealed table-striped table-hover">
				      <thead>
				        <tr class="text-center">
				          <th>ID</th>
				          <th>Title</th>
				          <th>Type</th>
				          <th>Category</th>
				          <th>Expiry Date</th>
				          <th>Status</th>
				          <th>Date Created</th>
				          <th>Date Updated</th>
				          <th>Actions</th>
				        </tr>
				      </thead>
				      <tbody>
				      	<?php foreach($deals as $key => $deal): ?>
				        <tr>
				        	<td><?= $deal['id'] ?></td>
				        	<td><?= $deal['title'] ?></td>
					        <td><?= $deal['service_name'] ?></td>
					        <td><?= $deal['category_name'] ?></td>
					        <td><?= date('d F, Y', strtotime($deal['expiry_date'])) ?></td>
					        <td><span class="badge badge-info badge-pill status-div"><?= $deal['is_status'] ?></span></td>
					        <td><?= date('d F, Y', strtotime($deal['created_date'])) ?></td>
					        <td><?= date('d F, Y', strtotime($deal['updated_date'])) ?></td>
					        <td>
					        		<a href="<?= site_url('bussiness/deals/edit/'.$deal['id']) ?>" class="mr-5"><span class="fa fa-1x fa-edit"></span></a>
					        		<a href="<?= site_url('bussiness/deals/delete/'.$deal['id']) ?>" title="deal will be deleted immediately" class="text-danger"><span class="fa fa-1x fa-trash"></span></a>
					        </td>
					      </tr>
								<?php endforeach; ?>
				      </tbody>
				    </table>
				  </div>
				    <div class="pull-right">
			        <?php echo $this->pagination->create_links(); ?>
			    </div>
        </div>
			</div>
		</div>
        <?php }  ?>
	</div>	
</section>