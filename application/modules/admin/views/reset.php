
<div id="wrapper">
<!--top header start-------->
<div class="top_bg">
  <div class="container">
    <div class="row">
      <div class="top_left">
        <ul>
          <li class="top_link"><a href="<?php echo base_url();?>">Home </a></li>
       <li class="top_link"><a href="<?php echo base_url();?>">Contact Us</a></li>
        </ul>
      </div>
      
    </div>
  </div>
</div>
<!--top header end--------> 

<!--header top start-------->


<div class="header_top">
  <div class="container">
    <div class="row">
     
    </div>
  </div>
</div>

<div class="clearfix"> </div>
<!--header top end-------->

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="login">
        <h1>LOGIN</h1>
        <div class="login-bottom">
          
          <div class="social-icons">
           <div class="col-sm-12">
        <div class="logo" ><a href="#"><img src="<?php echo base_url();?>images/logo.png" ></a></div>
      </div>
      <div class="clearfix"></div>
    </div>
    
    	<?php echo validation_errors(); 
    		echo $this->session->flashdata('message');
    		$attributes = array('name'=>'admin_login');
			echo form_open(base_url().'welcome/resetPassword/'.$flag, $attributes);
		?>
	    <div class="form-group">	    	
	    	<label for="exampleInputEmail1">Password</label>
	    	<input type="password" class="form-control" id="exampleInputEmail1" name="password" placeholder="password" >
	 	</div>
	 	<div class="form-group">
		    <label for="exampleInputPassword">Confirm Password</label>
		    <input type="password" class="form-control"  placeholder="Password" name="confirm_password" >
		</div>
        
        <div class="reg-bwn"><button type="submit" >LOG IN</button></div>          
       </div>
       <?php echo form_close();?>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  </div>
</div>

