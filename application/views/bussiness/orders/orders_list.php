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
				          <th>Update Status</th>
				          <th>Last Updated</th>
				        </tr>
				      </thead>
				      <tbody>
				      	<?php foreach($orders as $key => $order): ?>
				        <tr>
				        	<td><?= $order['order_id'] ?></td>
					        <td><a href="<?= site_url('bussiness/orders/order_details/'.$order['order_id']) ?>">View (<?= $order['total_products'] ?>)</a></td>
					        <td><?= $order['product_quantity'] ?></td>
					        <td><?= $order['total_price'] ?></td>
					        <td><?= $order['total_shiping'] ?></td>
					        <td><?= $order['gross_total'] ?></td>
					        <td><span class="badge badge-info badge-pill status-div"><?= $order['status'] ?></span></td>
					        <td><button data-status="<?= $order['status'] ?>" data-id="<?= $order['order_id'] ?>" class="update-status btn btn-sm btn-primary">Update</button></td>
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
<script type="text/javascript">
	$('.update-status').on('click', function() {
		 let this_btn = $(this);
			const order_id = $(this).attr('data-id');
			const old_status = $(this).attr('data-status');
			var data = {
				order_id: order_id,
				old_status: old_status
			}
			data[csfr_token_name] = csfr_token_value;
			$(this).html('Updating...');
			let status_div = this_btn.prev('.status-div');
			$.ajax({
				type: "POST",
				url: "<?= site_url('bussiness/orders/update_status') ?>",
				data: data,
				success: function(data) {
					this_btn.html('Update');
					this_btn.attr('data-status', data);
					console.log(this_btn.parent().prev('.status-div'))
					this_btn.parent().prev().find('.status-div').text(data);
				},
				error: function() {
					alert('error')
				}
			})

		})
</script>