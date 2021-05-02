 <!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
			<?=trans('label_matching_products')?>
			<?php
			$curdate = date('Y-m-d');
			?>
        </h1> 
        <p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('products')?></a></p>
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
        <?php if(empty($products)){ ?>
          <p class="text-gray">No products found</p>
        <?php } else { ?>
        	<div class="table-responsive">
				    <table class="table table-bproducted table-striped table-hover">
				      <thead>
				        <tr class="text-center">
				          <th>ID</th>
				          <th>Title</th>
				          <th>Brand Name</th>
				          <th>Type</th>
				          <th>Category</th>
				          <th>Price</th>
				          <th>Featured</th>
				          <th>Expiry Date</th>
				          <th>Status</th>
				          <th>Date Created</th>
				          <th>Date Updated</th>
				          <th>Actions</th>
				        </tr>
				      </thead>
				      <tbody>
				      	<?php foreach($products as $key => $product): ?>
				        <tr>
				        	<td><?= $product['id'] ?></td>
				        	<td><?= $product['title'] ?></td>
					        <td><?= $product['brand_name'] ?></td>
					        <td><?= $product['service_name'] ?></td>
					        <td><?= $product['category_name'] ?></td>
					        <td><?= $product['price'] ?></td>
					        <td><?= $product['is_featured'] ?></td>
					        <td><?= date('d F, Y', strtotime($product['expiry_date'])) ?></td>
					        <td><span class="badge badge-info badge-pill status-div"><?= $product['is_status'] ?></span></td>
					        <td><?= date('d F, Y', strtotime($product['created_date'])) ?></td>
					        <td><?= date('d F, Y', strtotime($product['updated_date'])) ?></td>
					        <td>
					        		<a href="<?= site_url('bussiness/products/edit/'.$product['id']) ?>" class="mr-5"><span class="fa fa-1x fa-edit"></span></a>
					        		<a href="<?= site_url('bussiness/products/delete/'.$product['id']) ?>" title="product will be deleted immediately" class="text-danger"><span class="fa fa-1x fa-trash"></span></a>
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