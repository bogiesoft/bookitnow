
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
    		$attributes = array('name'=>'forgot_form');
			echo form_open(base_url().'welcome/forgot_pwd', $attributes);
		?>
          <div class="form-group">
    <label for="exampleInputEmail1">Enter Mail Id</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Mail Id" name="email">
  </div>
  
  
          
          <div class="reg-bwn"><button type="submit">SUBMIT</button></div>
          <?php echo form_close();?>
          
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  </div>
</div>

