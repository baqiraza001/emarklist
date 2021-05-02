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
    <?php $attributes = array('method' => 'post'); ?>
    <?php echo form_open('jobs/goToCheckOut',$attributes); ?>

    <div class="container"> 
        <!--Grid row--> 
        <div class="row pt-5"> 
            <!--Grid column-->
            <div class="col-lg-8 "> 
        <?php   

        $arr = array(); 
        $arr2 = array(); 
        foreach ($pro_cart as $key => $item) {
           $arr[$item['brand_name']][$key] = $item; 
        }
        //print_r($arr);
        //echo $arr[29][5]['brand_name'];
        //ksort($arr, SORT_NUMERIC);
        foreach ($pro_cart as $key2 => $item) { 
           $arr2[$item['price']][$key2] = $item;
        }   
        ?>  
                <!-- Card --> 
            <?php  $product_total=0; $countProduct=0;
            foreach($arr2 as $key2=>$res2){
                $product_total = $product_total+ $key2;  

                 $countProduct = count($arr2);       
            } 
            ?>
            <?php $sip =0; $p_idz=1; foreach($arr as $key=>$res){ ?> 
                <div class="card wish-list mb-3 section_padding"> 
                    <div class="card-body">
                        <h5 class=" text-uppercase"> 
                            <?php  echo $key;?></h5> 
                        <hr>  
                    <?php 
                    $c_idz=1;   
                    // echo"<pre>";
                    // echo"<pre>";
                        foreach($res as $key1 => $row){ ?> 
                        <div>Rs. <?php $sip +=$row['total_price']; echo  $shiping = $row['total_price']; ?> 

<input type="hidden" value="<?php echo $row['company_id']; ?>" name="company_id[]" id="company_id" > 
<input type="hidden" value="<?php echo $shiping; ?>" name="shiping_fee[]" id="<?php echo 'shp'.$p_idz.$c_idz; ?>" class="test"> 
<input type="hidden" value="<?php echo $row['user_id']; ?>" name="user_id[]" id="user_id" class="test"> 
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-1 col-lg-1 col-xl-1 ">
                              <div class="text-center" style="padding-top: 45px;">
                                
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
<input type="hidden" value="<?php echo $row['product_id']; ?>" name="product_id[]" id="product_id"  >     
                                            <h5 class="mb-2 text-danger">Rs. <?php echo $row['price']; ?></h5>
<input type="hidden" name="pro_price[]" id="<?php echo 'spp'.$p_idz.$c_idz; ?>" value="<?php echo $row['price']; ?>" class="test">

                                            <!-- <p class="mb-2 text-muted text-uppercase small">Total Item : <?php echo $row['quantity']; ?> </p> -->
                                        </div>
                                        <div>
                                            <div class="def-number-input number-input safari_only mb-0 w-100">
                                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); cartpushdel(this);  " class="minus btn-primary" id="<?php echo 'btnd'.$p_idz.$c_idz; ?>">-</button>
                                                
                                                <input class="quantity" onchange="cartpush(this); " min="1" max="5" name="quantity[]" id="<?php echo 'qty'.$p_idz.$c_idz; ?>" value="1" type="number" >

                                                <button type="button" id="<?php echo 'btn'.$p_idz.$c_idz; ?>" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); cartpush(this);" class="plus btn-primary">+</button>
                                            </div>
                                            <small id="passwordHelpBlock" class="form-text text-muted text-center">
                                            (Note, 1 piece)
                                            </small>
                                        </div>
                                    </div>  
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="<?= base_url('/jobs/cartDelete/'.$row["user_id"].'/'.$row["product_id"]); ?>" type="button" class="card-link-secondary small text-uppercase mr-3 mt-3"><i class="fa trash-alt mr-1"></i> Remove item </a>
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
                <!-- <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="mb-4">Expected shipping delivery</h5>
                        <p class="mb-0"> Thu., 12.03. - Mon., 16.03.</p>
                    </div>
                </div> -->
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
<input type="hidden" id="t_product_value" name="tp_value" value="<?php echo $countProduct;?>">
<input type="hidden" id="t_price_value" name="t_price_value" value="<?php echo $product_total;?>">
<input type="hidden" id="ship_value" name="ship_value" value="<?php echo $sip; ?> ">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item_cart d-flex justify-content-between align-items-center border-0 px-0 pb-0">Subtotal (<div id="total_product"> <?php echo $countProduct;?> </div>items)
                                <div >Rs. <span id="cartPayment"> <?php   echo $product_total;  ?></span></div>
                            </li>
                            <li class="list-group-item_cart d-flex justify-content-between align-items-center px-0">
                                Shipping Fee
                                <div >Rs. <span id="cartShip"><?php echo $sip; ?></span></div>
                            </li>
                            <li class="list-group-item_cart d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total</strong> 
                                    <!-- <strong> <p class="mb-0">(including VAT)</p> </strong> -->
                                </div>
                                <div >Rs. <span id="cartTotal"><?php  echo $cartT = $product_total + $sip; ?></span> 
                                </div>
<input type="hidden" id="cart_total_value" name="cart_total_value" value="<?php  echo $cartT = $product_total + $sip; ?> ">
                            </li>
                        </ul>
                        <?php if(!empty($pro_cart)){?>
                        <button type="button" class="btn btn-primary btn-block text-capitalize" data-toggle="modal" data-target="#myModal">go to checkout</button>
                    <?php }else{ ?>
                        <button type="button" class="btn btn-primary btn-block text-capitalize" disabled="">go to checkout</button>
                    <?php }?>
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
            <div class="container"> 
              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog ">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary">Final Order Submission</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
            <?php
                $User_id = $this->session->userdata('user_id');
                $email = get_user_email($User_id);
                $cellNumber = get_user_cell_no($User_id);
                $address = get_user_address($User_id);

                $state = get_user_state($User_id);
                $city = get_user_city($User_id);

                $stateName = get_state_name($state);
                $cityName = get_city_name($city);
                $country_id = 160;
                $countryState = get_country_states($country_id);
            ?>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr" class="text-primary">Email</label> :
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label for="usr" class="text-primary">Cell Number</label> :
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $cellNumber; ?>" required="required">
                        </div> 
                        <div class="form-group">

                            <label for="usr" class="text-primary">State</label> :
                            <select class="form-select" aria-label="Default select example" name="state" id="state" onchange="ajaxCityName();" required="required">
                                <option value="<?php echo $state; ?>"><?php echo $stateName; ?></option>
                                <option value="">Select State...</option>
                            <?php 
                                foreach ($countryState as $value) { 
                                    echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                                } 
                            ?> 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usr" class="text-primary">City</label> :
                            <select class="form-select" aria-label="Default select example" id="city" name="city" required="required">
                                <option value="<?php echo $city; ?>"><?php echo $cityName; ?></option>
                                <option value="">Select City...</option>
                              
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="usr" class="text-primary">Postal Address</label> :
                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $address; ?>" required="required">
                        </div>
                    </div> 
                    <div class="modal-body">
                         Please confirm <b>Address</b> and <b>Phone Number</b>, then click on <b>'Place Order'</b> button to place order.
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" >Place Order</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--Grid column--> 
        </div>
        <!--Grid row-->
    </div>
         <?php echo form_close(); ?>
    
</section>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
 var flag=false;

function cartpush(obj){
showLooder()
    var cartPayment = parseInt(document.getElementById('cartPayment').innerHTML);
    var cartShip = parseInt(document.getElementById('cartShip').innerHTML);
    var cartTotal = parseInt(document.getElementById('cartTotal').innerHTML);
    var product = parseInt(document.getElementById('total_product').innerHTML);

var id=obj.id.substring(3); 
var dec_id="btnd"+id

var product_ship="shp"+id;
var product_price="spp"+id;
var product_qty="qty"+id;

//var ship= parseInt(document.getElementById(product_ship).value);
var ship = parseInt(document.getElementById('cartShip').innerHTML);
var price = parseInt(document.getElementById(product_price).value);
var qty = parseInt(document.getElementById(product_qty).value);
var pro1 = product-(qty-1)+qty;


// count total product
    var total_product = parseInt(qty) + parseInt(product) ;
// product and price total
    var sub_tal = parseInt(cartPayment)+ parseInt(price) ;
// previous value

//alert(sub_tal);
    var subtotal = (parseInt(sub_tal) + parseInt(ship));

// total of product and shipping fee
  // var tot = (parseInt(sub_tal) + parseInt(ship_fee));

   // var total = ( parseInt(tot) + parseInt(cartTotal));
let sum = 0;
    $(".quantity").each(function(){
        sum += +$(this).val();
    });
   // $(".total").val(sum);
// insert value in input field and cart
    $('#total_product').html(sum).innerHtml;
    $('#t_product_value').val(sum); 
// insert value in input field and cart
    $('#cartPayment').html(sub_tal).innerHtml;
    $('#t_price_value').val(sub_tal); 

    $('#cartShip').html(ship).innerHTML;
    $('#cartTotal').html(subtotal).innerHTML;
    $('#cart_total_value').val(subtotal);
    flag=false;
}  
// product value kam krny k liya 
function cartpushdel(obj){

var id=obj.id.substring(4);  

var product_ship="shp"+id;
var product_price="spp"+id;
var product_qty="qty"+id;
var ship= parseInt(document.getElementById(product_ship).value);
var price= parseInt(document.getElementById(product_price).value);
var qty =parseInt(document.getElementById(product_qty).value);
// remove product quntity 
showLooder()
    var cartPayment = parseInt(document.getElementById('cartPayment').innerHTML);
    var cartShip = parseInt(document.getElementById('cartShip').innerHTML);
    var cartTotal = parseInt(document.getElementById('cartTotal').innerHTML);
    var product = parseInt(document.getElementById('total_product').innerHTML);

//var pro1=product+(qty-1)-qty; 
// product and price total
    var sub_tal = parseInt(cartPayment)- parseInt(price) ;
// previous value
//alert(sub_tal);
    var subtotal = (parseInt(sub_tal) + parseInt(cartShip));
// total of product and shipping fee
  // var tot = (parseInt(sub_tal) + parseInt(ship_fee));
   // var total = ( parseInt(tot) + parseInt(cartTotal));


    let sum = 0;
    $(".quantity").each(function(){
        sum += +$(this).val();
    });
    //$(".total").val(sum);

//console.log(arr);

    if(flag){
    } else{ //alert('else'); 
            $('#cartTotal').html(subtotal).innerHTML;$('#cartPayment').html(sub_tal).innerHtml;
            $('#cartShip').html(cartShip).innerHTML;
    }
    if(qty==1){
        flag=true;
    }
    $('#total_product').html(sum).innerHtml;
}   
</script>
<script> 
function ajaxCityName() { 
    var stateid = document.getElementById('state').value; 
        //alert (stateid); 
    $.ajax({
        url: '<?php echo base_url();?>jobs/cityname',
        type: 'GET',
        data: {stateid:stateid},
        success: function (result) {  
           //var data = JSON.parse(result);
           var data =result;
           //alert(data); 
            $('#city').html(data).innerHTML;
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        }
    });  
}
</script>

