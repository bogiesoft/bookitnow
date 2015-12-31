<style>
.holiday-deals{
	font-size:26px;
	color: #06aad1;
	 margin-left: 18px;
}
.small-text-deals {
    color: #1d5567;
    font-size: 15px;
    font-weight: 500;
	margin-bottom:10px;
	 margin-left: 18px;
}

.bg_grey2, .crumb {
    background-image: linear-gradient(to bottom, #fafafa, #dbdfe6);
    border: 1px solid #dbdfe6;
    border-radius: 6px;
    padding: 10px;
}
.sm-font{
	color: #1d5567;
	margin-left:5px;
	font-size:13px;
}
.choice{
background-color:#06AAD1;
text-align:left;
margin: -11px 16px -28px 14px;
color:white;
}
.choice-go{
color:white;
}
.choice-go a{
color:white;
}
.choice-go a:hover{
color: #F90;
}
.box-bg{
background-color:red;

}
.img-bg{
background-color:#9fd9ed;
}
.image-box{
    bottom: 19px;
    float: right;
    position: absolute;
    right: -14px;
    width: 23.7288%;
}
.title-deal{
background-color: #EAEAEA;
padding-bottom:5px;
}
.image-deals{
 
    background-repeat: no-repeat;
    background-size: 100%;
    display: block;
    background-position: top;
    text-decoration: none;
    overflow: hidden;
    z-index: 2;
    height: 164px;
    margin-bottom: 10px;
	cursor:pointer;
}

.zoom-effect-container {
    float: left;
    position: relative;
   width: 349px;
    height: 164px;
    margin: 0 auto;
    overflow: hidden;
	cursor:pointer;
}

.image-card {
  position: absolute;
  top: 0;
  left: 0;
  cursor:pointer;
}

.image-card img {
  -webkit-transition: 0.8s ease;
  transition: 0.8s ease;
}

.zoom-effect-container:hover .image-card img {
  -webkit-transform: scale(1.34);
  transform: scale(1.34);
}	
</style>

<div class="clearfix"></div>

<!-- start slider meena adit -->
<div class="header-slider">
	<div class="image-bg"><img src="<?php echo base_url();?>images/banner.jpg" class="img-responsive" alt="banner-img"></div>

</div>   
<!--/slider closed meena adit --> 
    <div class="clearfix"></div>
   
    
    
<div id="body_content">
	<div class="container">
		
<div class="clearfix"></div>
<!--meena--adit-->
<div class="container">
	<div class="row"> 
		<div class="col-sm-9">
			<div class="row">
			<div class="col-sm-12 col-md-8">
				<h4 class="holiday-deals">Manager's Choice Holiday Deals</h4>
				<h2 class="small-text-deals">Unbeatable Hand Picked Deals, Exclusive to us!</h2>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="fluid columns_four bg_grey2">
					<div class="padded">
						<select style="font-size:15px;padding:0px;" name="dealType" onchange="blockHotelDeals(this);">
							<option value="holiday" selected="selected">Holiday Deals</option>
							<option value="city">City Breaks</option>
						</select>		
					</div>
				</div>
			</div>
		</div>

		<div class="right_side">		
			<?php echo $manager_deals_content;?>
			<div class="clearfix"></div>
		</div>
</div>
<!--sidebar-->
    <div class="col-sm-3">
        <div class="left-sidebar">
      
<?php include_once 'includes/atol_left.php';?>
<?php include_once 'includes/news_letter_left.php';?>
<div class="clearfix"></div>
<?php include_once 'includes/independent_reviews_left.php';?>
<div class="clearfix"></div>
<?php include_once 'includes/deals_email_left.php';?>


</div>
	</div>
<!--sidebar-->
	</div>
	<div class="row  choice">
		<div class="col-xs-12 col-md-8"><h3>Summer 2016 Choice<h3><h4>Our top picks for your essential summer 2016 getaway.</div>
			<div class="col-xs-6 col-md-10 choice-go"><a href="#">Our top picks for your essential summer getaway.Lanzarote, Benidorm, Majorca and More..</a></div>
		<div class="col-xs-12 col-md-2"><a class="button" href="#">GO <i class="icon-arrow-circle-right" aria-hidden="true"></i></a></div>
	</div>
	<br><br>
	
	

<div class="col-sm-4 col-mg-4">
	<div class="green_nature">
		<div class="title-deal">
			<h2>Green Nature Diamond</h2>					
			<p>FREE Marmaris City Tour and MORE!</p>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
				<img src="<?php echo base_url();?>images/deal-img-1.jpg" class="img-responsive" alt="Pool">			 
			</div> 				
			<div class="rate">						
				<div class="fluid image-box">
					<a href="#" class="button">TRY IT <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
				</div>				
			</div>
		</div>
	</div>		
</div>

<div class="col-sm-4 col-mg-4">
	<div class="green_nature">
		<div class="title-deal">
			<h2>Green Nature Diamond</h2>					
			<p>FREE Marmaris City Tour and MORE!</p>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
				<img src="<?php echo base_url();?>images/deal-img-2.jpg" class="img-responsive" alt="Pool">			 
			</div> 				
			<div class="rate">						
				<div class="fluid image-box">
					<a href="#" class="button">TRY IT <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
				</div>				
			</div>
		</div>
	</div>		
</div>

	<div class="col-sm-4 col-mg-4">
		<div class="green_nature">
			<div class="title-deal">
				<h2>Green Nature Diamond</h2>					
				<p>FREE Marmaris City Tour and MORE!</p>
			</div>
			<div class="zoom-effect-container">	
				<div class="image-card">
					<img src="<?php echo base_url();?>images/deal-img-3.jpg" class="img-responsive" alt="Pool">			 
				</div> 				
				<div class="rate">						
					<div class="fluid image-box">
						<a href="#" class="button">TRY IT <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
					</div>				
				</div>
			</div>
		</div>		
	</div>
</div>

<!--meena adit closed-->
</div>
</div><!--contanier-->
<div class="clearfix"></div>

<<script type="text/javascript">
function blockHotelDeals(e){	
	$.post( "/welcome/deals/switchDeals",{'deal_category' : e.value}, function( data ) {
		$('.right_side').html(data);
	});
}
</script>
