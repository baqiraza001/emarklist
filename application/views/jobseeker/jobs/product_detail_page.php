	<style type="text/css" media="screen">
.blog_item {
    padding-top: 10px;
}
	.blog_item h21 {
    /* font-family: "Playfair Display", serif; */
    color: #111111 ;
    /* font-style: italic; */
    margin-bottom: 20px;
    font-size: 34px;
    font-weight: 500;
}	
.title.daily-deals {
    margin-top: 20px;
}

.title h6 {
    display: inline-block; 
    margin-bottom: 6px;
    font-size: 20px;
    line-height: 20px;
    font-weight: 600;
    color: #000;
}
.title p {
    display: inline-block; 
    margin-bottom: 6px;
    font-size: 16px;
    line-height: 20px; 
    color: grey;
}
	</style>
<section class="blog spad pb-5" style="padding-top: 110px">
	<div class="container"> 
		<div class="row">
			<div class="col-lg-8" style="border-right: 1px solid rgba(0,0,0,.2);">
				<div class="blog__item">
					<div class="row">
						<div class="col col-md-12"> 
                                            <?php if($this->session->flashdata('success')): ?>
                  <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <?=$this->session->flashdata('success')?>
                  </div>
                  <?php endif ?>
<!-- 								<img src="<?php echo base_url('assets/img/job_icon1.jpg');?>" width="730px" height="450px"> -->
								<!-- <div class="blog_pic_inner">
									<div class="label">UpTo 10% OFF </div>
									 
								</div> --> 
<!--show image using photorama start-->
<?php
$job_id=$job_detail['id'];
// foreach ($job_detail as $key) {
// 	echo "string";
// 	print_r($job_detail);
// $job_id=$key['id'];
// }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<?php 
  $profile_picture = get_products_image($job_id);
 if(is_array($profile_picture) && !empty($profile_picture))
                { ?>
<div class="fotorama" data-width="100%" data-height="500"  data-ratio="800/560"  data-allowfullscreen="true"   data-nav="thumbs" style="background-color:#ffffff;border : solid #000 1px;" >
 
<?php foreach($profile_picture as $key1=>$val1){
          if($val1['name'] !='')
            {
            	?>
           <img class="profile-picture" src="<?= base_url('uploads/product_images/'.$val1['name']); ?>" /> 
          <?php } }?> 
</div>
<?php }
else{
  $the_img = 'assets/img/job_icon1.jpg'; 
?>
 <img class="profile-picture" src="<?= base_url($the_img); ?>" alt="" width="70%" />
 <?php
}?>
<!--show image using photorama end-->
						</div>
					</div>

					<div class="blog_item h2">
						<h21><?php echo ucwords($job_detail['title']); ?></h21>
						<div class="title">
							<h6>Description</h6>
						</div>
					<div class="title">
						<p><?php echo $job_detail['description']; ?></p>
					</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
                <?php $attributes = array('method' => 'post'); ?>
                    <?php echo form_open('jobs/addtocart',$attributes);
                ?>
				<div class="blog_item pb-4">
					<h3> Delivering <?php echo $job_detail['title']; ?> </h3>
					<hr>
<!--             <?php
              if (empty($this->session->userdata('user_id')) || empty($this->session->userdata('guest_email'))) {
                ?>       
                <div id="guest_login" >
                    <div class="title">
                        <h6 style="font-weight: 600">Enter information</h6>
                    </div>

                    <div class="submit-field">
                      <h5>Email</h5>
                      <input class="form-control" type="text" name="guest_email" value="" placeholder="John Wick">
                    </div> -->
                
<!--                     <div class="submit-field">
                      <h5>Contact</h5>
                      <input class="form-control" type="text" name="guest_contact" value="" placeholder="John Wick">
                    </div>
                  
                    <div class="submit-field">
                      <h5>Address</h5>
                      <input class="form-control" type="text" name="guest_address" value="" placeholder="John Wick">
                    </div> -->
                  
<!--                     </div>
                     <?php
            }
                ?> -->
					<div class="title">
						<h6 style="font-weight: 600">Delivering</h6>
					</div> 
					<div class="input-group plus-minus-input pb-2 pt-2">
						QTY
                      <div class="pl-2"> 
                        <button  type="button" class="btn-info" data-quantity="minus" data-field="quantity">
                          <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>
                      </div>
                        <input  type="number" class="bg-light" id="quantity" name="quantity" onchange="getcube()" value="1"  style="width: 60px !important; text-align: center;">
                      <div class="">
                        <button type="button" class="btn-info" data-quantity="plus" data-field="quantity">
                          <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                      </div>
					</div> 
					<div class="title">
					<p id="price_update">	Price : <?php echo $job_detail['price'];?> Naira</p>
                    <input type="text" style="display: none;" name="price_check1" id="price_check1" value="<?php echo $job_detail['price'];?>">
					</div>  
				</div>
               

                                <!--test start-->
                                                <!-- Hidden Inputs --> 
<input type="hidden" name="username" value="<?= $user_detail['firstname']; ?>">
<input type="hidden" name="email" value="<?= $user_detail['email']; ?>" >
<input type="hidden" name="job_id" value="<?= $job_detail['id']; ?>" >
<input type="hidden" name="emp_id" value="<?= $job_detail['employer_id']; ?>" >
<input type="hidden" name="job_title" value="<?= $job_detail['title']; ?>" > 
<input type="hidden" name="job_actual_link" value="<?= $job_actual_link ?>" >
                                
                                <?php
                                    $last_request_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                    $this->session->set_userdata('last_request_page', $last_request_page); 
                                 ?>
                <div class="blog__sidebar">
                    <div class="blog_sidebar_search"> 
                        <div class="form-group">
                            <input type="submit"  class="form-control btn btn-danger"  value="Add To Cart">
                        </div>  
                    </div>
                    <hr/> 
                    <div class="blog_sidebar_search"> 
                        <div class="form-group">
                            <input type="button" onclick="javascript:history.back()" class="form-control btn btn-success"  value="Go Back">
                        </div>  
                    </div>
                </div> 

                <?php echo form_close(); ?>
			</div>	
		</div>
	</div>
</section>
<!-- <script>
$(document).ready(function(){
    // Get value on button click and show alert
    $("#plus").click(function(){
        var str = $("#quantity").val();
        consule.log(str);
    });
});
</script> -->

<!--service view end-->
<script>
jQuery(document).ready(function(){
    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
        getcube();
    });
   // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
        getcube();
    });
});
</script>
<script>
function getcube(){  

var number=document.getElementById("quantity").value;
var singlevalue=document.getElementById("price_check1").value; 
var update_price=number*singlevalue;
document.getElementById("price_update").innerHTML="Price : "+update_price+" Naira";

}  
</script>