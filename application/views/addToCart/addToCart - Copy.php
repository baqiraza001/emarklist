<style>
.overlay_cart{
    position: absolute;
    width: 100%;
    height: 100%;
    top: 22px;
    left: 0px;
    /* background: rgba(0, 0, 0, 0.8); */
    opacity: 0.7;
}
.list-group-item_cart {
    position: relative;
    display: block;
    padding: .35rem 1.25rem;
    margin-bottom: -1px;
    /* background-color: #fff; */
    /* border: 1px solid rgba(0,0,0,.125); */
}
#loading{
  position:fixed;
  z-index:99999;
  top:0;
  left:0;
  bottom:0;
  right:0;
  background:rgba(0,0,0,0.4);
  /* transition: 0.1s 0.4s; */
}
</style>
<!--Section: Block Content-->
<!-- BEGIN PAGE CONTENT-->
    <div id="loading" style="display: none;" align="center">
        <img id="loading_image"  class="home-description" style="padding-top: 15%;" src="<?= base_url('uploads/joblist_loader/'); ?>joblist.gif" alt="Loading..." />
    </div>
<!-- END PAGE CONTENT-->
<section class="pt-5" >
    <div class="container"> 
        <!--Grid row-->
        <div class="row pt-5">
            <!--Grid column-->
            <div class="col-lg-8 "> 
        <?php   

        $arr = array(); 
        foreach ($pro_cart as $key => $item) {
           $arr[$item['brand_name']][$key] = $item;
        }
        //print_r($arr);
        //echo $arr[29][5]['brand_name'];
        //ksort($arr, SORT_NUMERIC);   
        ?>  
                <!-- Card --> 
            <?php  
$p_idz=1;
            ?>
            <?php foreach($arr as $key=>$res){ ?> 
                <div class="card wish-list mb-3 section_padding"> 
                    <div class="card-body">
                        <h5 class=" text-uppercase"> 
                            <input id="<?php echo 'p'.$p_idz; ?>" onchange="checkit(this);cartpush(); " type="checkbox"  value="1" class="user_name"> <?php  echo $key;?></h5> 
                        <hr>
                        <div>Rs. 49<input type="text" value="49" id="ship_fee" class="test"> </div>
                    <?php $c_idz=1; foreach($res as $key1 => $row){ ?> 
                        <div class="row mb-4">
                            <div class="col-md-1 col-lg-1 col-xl-1 ">
                              <div class="text-center" style="padding-top: 45px;">
                                <input type="checkbox" value="2" id="" onchange="cartpush(this); "  class="<?php echo 'c'.$p_idz;?>">
                              </div>
                            </div>
                            <div class="col-md-5 col-lg-2 col-xl-2">

                                <div class="view zoom overlay_cart z-depth-1 rounded mb-3 mb-md-0">
                                <?php if(empty($row['name'])){?>
                                    <p>No Image</p>
                                <?php } else{?>
                                    <img class="img-fluid"
                                    src="<?= base_url('uploads/product_images/'.$row['name']); ?>" alt="No Image Uploaded">
                                <?php } ?>
                                     
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-9 col-xl-9">
                                <div>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5>Product Name : <?php echo $row['title']; ?></h5>
                                            <h5 class="mb-2  text-danger">Rs. <?php echo $row['price']; ?> </h5>
                                            <input type="text" id="spp" value="<?php echo $row['price']; ?>" class="test">
                                            <!-- <p class="mb-2 text-muted text-uppercase small">Total Item : <?php echo $row['quantity']; ?> </p> -->
                                        </div>
                                        <div>
                                            <div class="def-number-input number-input safari_only mb-0 w-100">
                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown(); cartpush(this); showLooder();" class="minus btn-success">-</button>
                                                
                                                <input class="quantity" onchange="cartpush(this); " min="1" max="5" name="quantity" id="quantity" value="1" type="number" >

                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp(); cartpush(this); showLooder();" class="plus btn-success">+</button>
                                            </div>
                                            <small id="passwordHelpBlock" class="form-text text-muted text-center">
                                            (Note, 1 piece)
                                            </small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="<?= base_url('jobs/cartDelete/'.$row["user_id"].'/'.$row["product_id"]); ?>" type="button" class="card-link-secondary small text-uppercase mr-3"><i class="fa trash-alt mr-1"></i> Remove item </a>
                                            <!-- <a href="#!" type="button" class="card-link-secondary small text-uppercase"><i
                                            class="fas fa-heart mr-1"></i> Move to wish list </a> -->
                                        </div>
                                        <!-- <p class="mb-0"><span><strong>Total Price : <?php echo $row['total_price']; ?> </strong></span></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4"> 

                    <?php  $c_idz++;} ?>
                    <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i> Do not delay the purchase, adding
                        items to your cart does not mean booking them.</p>
                    </div>
                </div>
            <?php $p_idz++; } ?>
                <!-- Card -->
                 
                <!-- Card -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="mb-4">Expected shipping delivery</h5>
                        <p class="mb-0"> Thu., 12.03. - Mon., 16.03.</p>
                    </div>
                </div>
                <!-- Card -->
                <!-- Card -->
                <!-- <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="mb-4">We accept</h5>
                        <img class="mr-2" width="45px"
                        src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                        alt="Visa">
                        <img class="mr-2" width="45px"
                        src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                        alt="American Express">
                        <img class="mr-2" width="45px"
                        src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                        alt="Mastercard">
                        <img class="mr-2" width="45px"
                        src="https://z9t4u9f6.stackpathcdn.com/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png"
                        alt="PayPal acceptance mark">
                    </div>
                </div> -->
                <!-- Card -->
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-lg-4">
                <!-- Card -->
                <div class="card mb-3 section_padding">
                    <div class="card-body">
                        <h4 class="mb-3">Order Summary</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item_cart d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Subtotal (<div id="total_product">0</div>items)
                                <div >Rs. <span id="cartPayment">00</span></div>
                            </li>
                            <li class="list-group-item_cart d-flex justify-content-between align-items-center px-0">
                                Shipping Fee
                                <div >Rs. <span id="cartShip">00</span></div>
                            </li>
                            <li class="list-group-item_cart d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total</strong> 
                                    <!-- <strong> <p class="mb-0">(including VAT)</p> </strong> -->
                                </div>
                                <div >Rs. <span id="cartTotal">00</span></div>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-primary btn-block waves-effect waves-light">go to checkout</button>
                    </div>
                </div>
                <!-- Card -->
                <!-- Card -->
                <!-- <div class="card mb-3">
                    <div class="card-body">
                        <a class="dark-grey-text d-flex justify-content-between" data-toggle="collapse" href="#collapseExample1"
                            aria-expanded="false" aria-controls="collapseExample1">
                            Add a discount code (optional)
                            <span><i class="fas fa-chevron-down pt-1"></i></span>
                        </a>
                        <div class="collapse" id="collapseExample1">
                            <div class="mt-3">
                                <div class="md-form md-outline mb-0">
                                    <input type="text" id="discount-code1" class="form-control font-weight-light"
                                    placeholder="Enter discount code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- Card -->
                <div class="card mb-3">
                    <div class="card-body">
                        <button type="button" onclick="javascript:history.back()" class="btn btn-danger"> Go Back</button>
                    </div>
                </div>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
</section>
<!--Section: Block Content--> 
<script>
    jQuery(document).ready(function() {
        //here is auto reload after 1 second for time and date in the top
        //$("#loading").hide();
       // $("#loading").css("display", "none");
    });
</script>
<script>
    function showLooder(){ 
        $("#loading").css("display", "block"); 
        setTimeout(function() { $("#loading").css("display", "none"); }, 500);
    }
</script>
<script>
function checkit(obj){
    var cl=obj.id.replace('p','c')
    if(obj.checked){
        $("."+cl).attr("checked", "true");
    } else {
     //alert('in ');
        $("."+cl).removeAttr("checked");
    }
}
function cartpush(obj){

    // var cartPayment = document.getElementById('cartPayment').innerHTML;
    // var cartShip = document.getElementById('cartShip').innerHTML;
    // var cartTotal = document.getElementById('cartTotal').innerHTML;

 

    var spp_val = document.getElementById('spp').value;
    var quantity = document.getElementById('quantity').value;

    var ship_fee = document.getElementById('ship_fee').value;

// product and price total
    var sub_tal =(parseInt(spp_val) * parseInt(quantity));
// previous value
   // var subtotal = (parseInt(sub_tal) + parseInt(cartPayment));

// total of product and shipping fee
    var tot = (parseInt(sub_tal) + parseInt(ship_fee));

   // var total = ( parseInt(tot) + parseInt(cartTotal));

    $('#total_product').html(quantity).innerHtml;
    $('#cartPayment').html(sub_tal).innerHtml;
    $('#cartShip').html(ship_fee).innerHTML;
    $('#cartTotal').html(tot).innerHTML;
     

} 

</script>
<script>
  $(document).ready(function(){
        $(".test").click(function(evt){
            alert($(this).attr("value"));
            var spp_val = document.getElementById('spp').value;
            var quantity = document.getElementById('quantity').value;

            var ship_fee = document.getElementById('ship_fee').value;

        // product and price total
            var sub_tal =(parseInt(spp_val) * parseInt(quantity));
        // previous value
           // var subtotal = (parseInt(sub_tal) + parseInt(cartPayment));

        // total of product and shipping fee
            var tot = (parseInt(sub_tal) + parseInt(ship_fee));

           // var total = ( parseInt(tot) + parseInt(cartTotal));

            $('#total_product').html(quantity).innerHtml;
            $('#cartPayment').html(sub_tal).innerHtml;
            $('#cartShip').html(ship_fee).innerHTML;
            $('#cartTotal').html(tot).innerHTML;

            
        });
     });
</script>

