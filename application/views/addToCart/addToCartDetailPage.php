 <style>
.alert {
  padding: 20px;
  background-color: #4CAF50;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<!-- Start post Area --> 
<section class="post-area section-gap">
	<div class="container">
		<div class="alert">
			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
			<?php echo $alert; ?>
		</div>
		<div class="row justify-content-center d-flex"> 
			<div class="col-lg-8 order-md-2  post-list" > 
			<?php foreach ($place_xx_order_products as $value) {
				# code...
			?>
				<div class="single-post d-flex flex-row" style="border: 2px solid gray;  border-radius: 6px;">
					<?php $pro_image_name = get_product_image_name($value['product_id']); ?>
					<div class="thumb">
						<img class="img-fluid" src="<?= base_url('uploads/product_images/'.$pro_image_name); ?>" alt="No Image Uploaded"> 
					</div>
					<div class="details">
						<div class="title d-flex flex-row justify-content-between">
							<div class="titles">
								<h4>Company : <?php echo get_company_name($value['business_id']); ?></h4> 
								<h6>Brand : <?php echo get_brand_name($value['product_id']); ?></h6>
								<h6>Product : <?php echo get_product_title($value['product_id']); ?></h6>	
							</div> 
						</div>
						<div class="job-listing-footer">
							<ul>
								<li><i class="lnr lnr-dollar">Rs.</i><?php echo $value['product_price']; ?> </li>
								<li><i class="lnr lnr-"></i> Total Product : <?php echo $value['product_quantity']; ?> </li>
								<li><i class="lnr lnr-"></i>Total : Rs.<?php echo $value['total_price']; ?> </li>
								<li><i class="lnr lnr-car"></i> Shiping Fee : Rs.<?php echo $value['shiping_fee']; ?>  </li>
							</ul>									
						</div>
					</div>
					<!-- <div class="job-listing-btns">
						<ul class="btns">
							 <li><a class="saved_job" data-job_id=" "><span class="lnr lnr-heart"></span></a></li>
							<li><a href="#"><?=trans('apply');?></a></li>
						</ul>
					</div> -->
				</div> 
			<?php } ?>
			</div> 
			<div class="col-lg-4 order-2 sidebar search">
				<?php foreach ($place_xx_order as $xx_order) {
					$t_products = $xx_order['total_products'];
					$p_quantity = $xx_order['product_quantity'];
					$t_price = $xx_order['total_price'];
					$t_shiping = $xx_order['total_shiping']; 
					$gross_total = $xx_order['gross_total'];
					# code...
				}?>

				<div class="single-slidebar" style="border: 2px solid gray;  border-radius: 6px;">
					<div id="category_toggle">
					  <h4>Total Products : <?php echo $t_products; ?> Piece</h4>
					  <h4>Total Quantity : <?php echo $p_quantity; ?> Piece</h4>
					  <h4>Products Total Price : Rs.<?php echo $t_price; ?></h4>
					  <h4>Total Shiping : Rs.<?php echo $t_shiping; ?></h4>
					  <h4>Gross Total : Rs.<?php echo $gross_total; ?></h4>
					</div> 
				</div>
				  

				<?php foreach ($place_xx_user_order_address as $row) {
					$email = $row['user_email'];
					$user_cell_number = $row['user_cell_number'];
					$state_id = $row['state_id'];
					$city_id = $row['city_id'];
					$user_order_address = $row['user_order_address']; 
					# code...
				}?>	 
<hr>
				<div class="single-slidebar" style="border: 2px solid gray; border-radius: 6px;">
					<div id="category_toggle">
					  <h4><i class="fa fa-envolp"></i>User Email : <span class="text-primary"><?php echo $email; ?></span></h4>
					  <h4><i class="fa fa-envolp"></i>User Phone # : <span class="text-primary"><?php echo $user_cell_number; ?></span></h4>
					  <h4><i class="fa fa-envolp"></i>Satate # : <span class="text-primary"><?php echo get_state_name($state_id); ?></span></h4>
					  <h4><i class="fa fa-envolp"></i>City # : <span class="text-primary"><?php echo get_city_name($city_id); ?></span></h4>
					  <h4><i class="fa fa-envolp"></i>Home Address # : <span class="text-primary"><?php echo $user_order_address; ?></span></h4>
					</div> 
				</div> 
				<!-- <div class="single-slidebar btn-search">	
					<input type="button" name="search" class="btn btn-info btn-block" value="testing">
				</div> -->				 
			</div> 
			<!-- End search sidebar --> 
			
		</div>
	</div>	
</section>
<!-- End post Area -->