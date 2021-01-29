<!DOCTYPE html>
<html lang="zxx">
	<!-- Mirrored from preview.colorlib.com/theme/cake/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Dec 2020 10:27:24 GMT -->
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Cake Template">
		<meta name="keywords" content="Cake, unica, creative, html">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<!-- <title>Cake | Template</title> -->
		<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="css/flaticon.css" type="text/css">
		<link rel="stylesheet" href="css/barfiller.css" type="text/css">
		<link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
		<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
		<link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
		<link rel="stylesheet" href="css/nice-select.css" type="text/css">
		<link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
		<link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
		<link rel="stylesheet" href="css/style.css" type="text/css">
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
.text_bold{
	font-size: 18px;
	font-weight: 600;
}
	</style>
	</head>
	<body>
		 
 
<section class="blog spad pb-5" style="padding-top: 110px">
	<div class="container"> 
		<div class="row">
			<div class="col-lg-8" style="border-right: 1px solid rgba(0,0,0,.2);">
				<div class="blog__item">
					<div class="row">
						<div class="col col-md-12"> 
<!-- 								<img src="<?php echo base_url('assets/img/job_icon1.jpg');?>" width="730px" height="450px"> -->
								<!-- <div class="blog_pic_inner">
									<div class="label">UpTo 10% OFF </div>
									 
								</div> --> 
<!--show image using photorama start-->
<?php
foreach ($job_detail as $key) {
$job_id=$key['id'];
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<?php 
  $profile_picture = get_deals_image($job_id);
 if(is_array($profile_picture) && !empty($profile_picture))
                { ?>
<div class="fotorama" data-width="100%" data-height="500"  data-ratio="800/560"  data-allowfullscreen="true"   data-nav="thumbs" style="background-color:#ffffff;border : solid #000 1px;" >
 
<?php foreach($profile_picture as $key1=>$val1){
          if($val1['name'] !='')
            {
            	?>
           <img class="profile-picture" src="<?= base_url('uploads/deal_images/'.$val1['name']); ?>" /> 
            
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
						<?php
						foreach ($job_detail as $key) {
							$price = $key['price'].' Naira';
							$expiry_date = $key['expiry_date'];
						?>
					<div class="blog_item h2 ">
						<h21><?php echo ucwords($key['title']); ?></h21>
						<hr>
						<!-- <p>Price  :<?php echo $key['price'].' Naira'; ?></p>
						<br>
						<p>Expire :<?php echo $key['expiry_date']; ?></p> -->

						<div class="title">
							<h6>Description</h6>
						</div>
					<div class="title">
						<p><?php echo $key['description']; ?></p>
						<!-- <p>Herbs are fun and easy to grow. When harvested they make even the simplest meal seem like a gourmet delight. By using herbs in your cooking you can easily change the flavors of your recipes in many different ways, according to which herbs you add...</p> -->
					<!-- 	<table>
							<tr>
								<td>
									
								</td>
								<td>
									
								</td>
							</tr>
						</table> -->
					</div>
					<!-- <div class="title">
						<h6>Delivering</h6>
					</div>
					<div class="title">	
						<p>Herbs are fun and easy to grow. When harvested they make even the simplest meal seem like a gourmet delight. By using herbs in your cooking you can easily change the flavors of your recipes in many different ways, according to which herbs you add...</p>
					</div>
					<div class="title">
						<h6>Delivering</h6>
					</div>
					<div class="title">	
						<p>Herbs are fun and easy to grow. When harvested they make even the simplest meal seem like a gourmet delight. By using herbs in your cooking you can easily change the flavors of your recipes in many different ways, according to which herbs you add...</p>
					</div> -->
					</div>
					<?php
					}
					?>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="blog__sidebar">
					<div class="blog_sidebar_search">
						<form action="#"> 
							<div class="form-group">
								<input type="button"  class="form-control btn btn-danger"  value="Book Now">
							</div> 
						</form>
					</div>
					<hr/> 
				</div>
				<div class="blog__sidebar"> 
					<div class="title pb-4"> 
						<div class="blog_pic_inner">
							<div class="label">
								<p class="text-dark text_bold"> Price : <?php echo $price; ?></p>
						 		<br>
							    <p class="text-dark text_bold"> Expire : <?php echo $expiry_date; ?></p>
						    </div>
							
						</div>
					</div> 
				</div>
			</div>	
		</div>
	</div>
</section>
  
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.barfiller.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/main.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'UA-23581568-13');
</script>
</body>
<!-- Mirrored from preview.colorlib.com/theme/cake/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Dec 2020 10:27:29 GMT -->
</html>