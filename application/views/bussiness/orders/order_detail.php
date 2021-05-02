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
        <?php if(empty($order_detail)){ ?>
          <p class="text-gray">No orders found</p>
        <?php } else { ?>
        	<div class="table-responsive">
				    <table class="table table-bordered table-striped table-hover">
				      <thead>
				        <tr class="text-center">
				          <th>Product ID</th>
				          <th width="100">Title</th>
				          <th>Quantity</th>
				          <th>Total Price</th>
				          <th width="50">Shipping Fee</th>
				          <th width="50">User Cell</th>
				          <th>User Email</th>
				          <th style="width: 10%">Address</th>
				          <th width="50">State</th>
				          <th width="50">City</th>
				        </tr>
				      </thead>
				      <tbody>
				      	<?php foreach($order_detail as $key => $order): ?>
				        <tr>
					        <td><?= $order['product_id'] ?></td>
					        <td><?= $order['title'] ?></td>
					        <td><?= $order['product_quantity'] ?></td>
					        <td><?= $order['total_price'] ?></td>
					        <td><?= $order['shiping_fee'] ?></td>
					        <td><?= $order['user_cell_number'] ?></td>
					        <td><?= $order['user_email'] ?></td>
					        <td><?= $order['user_order_address'] ?></td>
					        <td><?= get_state_name($order['state_id']) ?></td>
					        <td><?= get_city_name($order['city_id']) ?></td>
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
<script type="text/javascript">
	$(document).ready(function(){
	  $('[data-toggle="popover"]').popover({trigger: "focus"});
	});
</script>
<!-- End post Area -->		