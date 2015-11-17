<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Modern an Admin Panel Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<?php echo @$this->layouts->print_includes()['css']; ?> 
</head>
<body>
<div id="wrapper">
     <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url();?>">
                 <img src="<?php echo base_url();?>images/logo_admin.png">
                </a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
	        		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-comments-o"></i><span class="badge">4</span></a>
	        		<ul class="dropdown-menu">
						<li class="dropdown-menu-header">
							<strong>Messages</strong>
							<div class="progress thin">
							  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
							    <span class="sr-only">40% Complete (success)</span>
							  </div>
							</div>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="<?php echo base_url();?>images/1.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
								<span class="label label-info">NEW</span>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="<?php echo base_url();?>images/2.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
								<span class="label label-info">NEW</span>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="<?php echo base_url();?>images/3.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="<?php echo base_url();?>images/4.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="<?php echo base_url();?>images/5.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="<?php echo base_url();?>images/pic1.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
							</a>
						</li>
						<li class="dropdown-menu-footer text-center">
							<a href="#">View all messages</a>
						</li>	
	        		</ul>
	      		</li>
			    <li class="dropdown">
	        		<a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><img src="<?php echo base_url();?>images/1.png"><span class="badge">9</span></a>
	        		<ul class="dropdown-menu">
						<li class="dropdown-menu-header text-center">
							<strong>Account</strong>
						</li>
						<li class="m_2"><a href="#"><i class="fa fa-bell-o"></i> Updates <span class="label label-info">42</span></a></li>
						<li class="m_2"><a href="#"><i class="fa fa-envelope-o"></i> Messages <span class="label label-success">42</span></a></li>
						<li class="m_2"><a href="#"><i class="fa fa-tasks"></i> Tasks <span class="label label-danger">42</span></a></li>
						<li><a href="#"><i class="fa fa-comments"></i> Comments <span class="label label-warning">42</span></a></li>
						<li class="dropdown-menu-header text-center">
							<strong>Settings</strong>
						</li>
						<li class="m_2"><a href="#"><i class="fa fa-user"></i> Profile</a></li>
						<li class="m_2"><a href="#"><i class="fa fa-wrench"></i> Settings</a></li>
						<li class="m_2"><a href="#"><i class="fa fa-usd"></i> Payments <span class="label label-default">42</span></a></li>
						<li class="m_2"><a href="#"><i class="fa fa-file"></i> Projects <span class="label label-primary">42</span></a></li>
						<li class="divider"></li>
						<li class="m_2"><a href="#"><i class="fa fa-shield"></i> Lock Profile</a></li>
						<li class="m_2"><a href="<?php echo base_url();?>admin/logout"><i class="fa fa-lock"></i> Logout</a></li>	
	        		</ul>
	      		</li>
			</ul>
			<form class="navbar-form navbar-right">
              <input type="text" class="form-control" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
            </form>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard fa-fw nav_icon"></i>Dashboard</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/listings"><i class="fa fa-indent nav_icon"></i>Listings</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/luggage_view"><i class="fa fa-indent nav_icon"></i>Luggage Prices</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/mang_ext_categories"><i class="fa fa-indent nav_icon"></i>Manage Extras</a>
                        </li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
        <div class="graphs">
		
		
     	<div class="col_3">
        	<div class="col-md-3 widget widget1">
        		
        	</div>
        	<div class="col-md-3 widget widget1">
        		
        	</div>
        	<div class="col-md-3 widget widget1">
        		
        	</div>
        	<div class="col-md-3 widget">
        		
        	 </div>
        	<div class="clearfix"> </div>
      </div>
	  
	  
	  
     
<?php echo $content_for_layout; ?>

 	   
		   
		   
		   
		   
		      <tbody>
		       
		      
		      
		        
		       
		      
		      
		        
		
		   </div>
	   </div>
	  <div class="col-md-4 span_4">
		 <div class="col_2">
		  <div class="box_1">
		   <div class="col-md-6 col_1_of_2 span_1_of_2">
             
		   </div>
		  
		   <div class="clearfix"> </div>
		 </div>
		 <div class="box_1">
<!--sidebar-->
<!--sidebar-->
    <div class="col-sm-12">
        <div class="left-sidebar">
       <div class="superescapes">
<h2>Why Super Escapes Travel?</h2>
<ul>
<li><img src="<?php echo base_url();?>images/1.png" alt="ATOL holders"><a href="#">ATOL holders</a></li>
<li><img src="<?php echo base_url();?>images/2.png" alt="ATOL Protected"><a href="#">ATOL Protected</a></li>
<li><img src="<?php echo base_url();?>images/3.png" alt="Hand picked deals"><a href="#">Hand picked deals</a></li>
</ul>
</div>
<div class="get">
<h2>GET OUR NEWS LETTER  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><img src="<?php echo base_url();?>images/mail.png" class="" alt="Mail Icon"></span></h2>
<form >
  <div class="form-group">
      <label for="" class="get_name">First Name</label>
      <input type="text" class="form-control"  placeholder="First Name" style="height:30px;" >
    </div>
    <div class="form-group">
      <label for=""  class="get_name">Last Name</label>
      <input type="text" class="form-control"  placeholder="Last Name" style="height:30px;" >
    </div>
    
    <div class="form-group">
      <label for=""  class="get_name">Zip code</label>
      <input type="text" class="form-control"  placeholder="zip code" style="height:30px;" >
    </div>
    
    <div class="form-group">
      <label for=""  class="get_name">Email</label>
      <input type="text" class="form-control"  placeholder="email" style="height:30px;" >
    </div>
  </form>
  <div class="subcribe"><a href="#">Subscribe</a></div>
</div>
<div class="clearfix"></div>



</div>
</div>
<!--sidebar-->	 
		  
		  

<!--sidebar-->

		  
		   <div class="clearfix"> </div>
		   </div>
		  </div>
		  <div class="cloud">
			<div class="grid-date">
				<div class="date">
					<p class="date-in">New York</p>
					<span class="date-on">�F �C </span>
					<div class="clearfix"> </div>							
				</div>
				<h4>30�<i class="fa fa-cloud-upload"> </i></h4>
			</div>
			<p class="monday">Monday 10 July</p>
		  </div>
		</div>
		<div class="clearfix"> </div>
	    </div>		<div class="copy">
            <p>Powered by: emerchantdigital </p>
	    </div>
		</div>
       </div>
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
  <?php echo @$this->layouts->print_includes()['js']; ?> 
</body>
</html>



