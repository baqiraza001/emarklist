 <!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
			<?=trans('label_matching_orders')?>
			<?php
			$curdate = date('Y-m-d');
			?>
        </h1> 
        <p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('orders')?></a></p>
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
        <?php if(empty($orders)){ ?>
          <p class="text-gray">No orders found</p>
        <?php } else { ?>
        	<div class="table-responsive">
				    <table class="table table-bordered table-striped table-hover">
				      <thead>
				        <tr class="text-center">
				          <th width="20">Order ID</th>
				          <th width="100">Total Products</th>
				          <th>Quantity</th>
				          <th>Price</th>
				          <th width="50">Shipping Fee</th>
				          <th width="50">Gross Total</th>
				          <th>Status</th>
				          <th>Last Updated</th>
				        </tr>
				      </thead>
				      <tbody>
				      	<?php foreach($orders as $key => $order): ?>
				        <tr>
				        	<td><?= $order['id'] ?></td>
					        <td><?= $order['total_products'] ?></td>
					        <td><?= $order['product_quantity'] ?></td>
					        <td><?= $order['total_price'] ?></td>
					        <td><?= $order['total_shiping'] ?></td>
					        <td><?= $order['gross_total'] ?></td>
					        <td><span class="badge badge-info badge-pill"><?= $order['status'] ?></span></td>
					        <td><?= date('d F, Y', strtotime($order['last_update'])) ?></td>
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
<!-- End post Area -->		