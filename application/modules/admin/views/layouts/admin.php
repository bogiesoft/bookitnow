<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $title_for_layout; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php echo @$this->layouts->print_includes()['css']; ?>		
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
				
	</head>
	<body class="hold-transition skin-blue sidebar-mini"> 
		<div class="wrapper">  
			  <!-- Main Header -->
			  <header class="main-header">		    
			    <!-- Logo --> 
			    <a href="<?php echo base_url();?>admin/index" class="logo"> 
			    <!-- mini logo for sidebar mini 50x50 pixels --> 
			    <span class="logo-mini"><b>B</b>KN</span> 
			    <!-- logo for regular state and mobile devices --> 
			    <span class="logo-lg"><b>BOOK IT NOW</b></span> </a> 			    
			    <!-- Header Navbar -->
			    <nav class="navbar navbar-static-top" role="navigation"> 
			      <!-- Sidebar toggle button--> 
			      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a> 
			      <!-- Navbar Right Menu -->
			      <div class="navbar-custom-menu">
			        <ul class="nav navbar-nav">
			         
			        <!--   <li class="dropdown messages-menu"> 
			             
			            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i> <span class="label label-success">4</span> </a>
			            <ul class="dropdown-menu">
			              <li class="header">You have 4 messages</li>
			              <li> 
			                
			                <ul class="menu">
			                  <li> 
			                    <a href="#">
			                    <div class="pull-left"> 
			           
			                      <img src="<?php echo base_url();?>images/user.png" class="img-circle" alt="User Image"> </div>
			          
			                    <h4> Support Team <small><i class="fa fa-clock-o"></i> 5 mins</small> </h4>
			          
			                    <p>Why not buy a new awesome theme?</p>
			                    </a> </li>
			          
			                </ul>
			           
			              </li>
			              <li class="footer"><a href="#">See All Messages</a></li>
			            </ul>
			          </li>
			           
			          
			          
			          <li class="dropdown notifications-menu"> 
			             
			            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <span class="label label-warning">10</span> </a>
			            <ul class="dropdown-menu">
			              <li class="header">You have 10 notifications</li>
			              <li> 
			               
			                <ul class="menu">
			                  <li> 
			                    <a href="#"> <i class="fa fa-users text-aqua"></i> 5 new members joined today </a> </li>
			                  
			                </ul>
			              </li>
			              <li class="footer"><a href="#">View all</a></li>
			            </ul>
			          </li>
			        
			          <li class="dropdown tasks-menu"> 
			         
			            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-flag-o"></i> <span class="label label-danger">9</span> </a>
			            <ul class="dropdown-menu">
			              <li class="header">You have 9 tasks</li>
			              <li> 
			                
			                <ul class="menu">
			                  <li>
			                    <a href="#"> 
			                   
			                    <h3> Design some buttons <small class="pull-right">20%</small> </h3>
			                   
			                    <div class="progress xs"> 
			                     
			                      <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">20% Complete</span> </div>
			                    </div>
			                    </a> </li>
			                  
			                </ul>
			              </li>
			              <li class="footer"> <a href="#">View all tasks</a> </li>
			            </ul>
			          </li>-->
			          <!-- User Account Menu -->
			          <li class="dropdown user user-menu"> 
			            <!-- Menu Toggle Button --> 
			            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
			            <!-- The user image in the navbar--> 
			            <img src="<?php echo base_url();?>images/user.png" class="user-image" alt="User Image"> 
			            <!-- hidden-xs hides the username on small devices so only the image appears. --> 
			            <span class="hidden-xs"><?php echo ucfirst($this->session->userdata('name'));?></span> </a>
			            <ul class="dropdown-menu">
			              <!-- The user image in the menu -->
			              <li class="user-header"> <img src="<?php echo base_url();?>images/user.png" class="img-circle" alt="User Image">
			                <p> <?php echo ucfirst($this->session->userdata('name'));?> <!-- <small>Member since Nov. 2012</small> --> </p>
			              </li>
			              <!-- Menu Body 
			              <li class="user-body">
			                <div class="col-xs-4 text-center"> <a href="#">Followers</a> </div>
			                <div class="col-xs-4 text-center"> <a href="#">Sales</a> </div>
			                <div class="col-xs-4 text-center"> <a href="#">Friends</a> </div>
			              </li>
			              <!-- Menu Footer-->
			              <li class="user-footer">
			                <div class="pull-left"> <a href="<?php echo base_url();?>admin/profile" class="btn btn-default btn-flat">Profile</a> </div>
			                <div class="pull-right"> <a href="<?php echo base_url();?>admin/logout" class="btn btn-default btn-flat">Sign out</a> </div>
			              </li>
			            </ul>
			          </li>
			          <!-- Control Sidebar Toggle Button -->
			          
			        </ul>
			      </div>
			    </nav>
			  </header>
			  <!-- Left side column. contains the logo and sidebar -->
			  <aside class="main-sidebar"> 
			    
			    <!-- sidebar: style can be found in sidebar.less -->
			    <section class="sidebar"> 
			      
			      <!-- Sidebar user panel (optional) -->
			      <div class="user-panel">
			        <div class="pull-left image"> <img src="<?php echo base_url();?>images/user.png" class="img-circle" alt="User Image"> </div>
			        <div class="pull-left info">
			          <p><?php echo ucfirst($this->session->userdata('name'));?></p>
			          <!-- Status --> 
			          <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
			      </div>
			      
			      <!-- search form (Optional) -->
			      <form action="#" method="get" class="sidebar-form">
			        <div class="input-group">
			          <input type="text" name="q" class="form-control" placeholder="Search...">
			          <span class="input-group-btn">
			          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
			          </span> </div>
			      </form>
			      <!-- /.search form --> 
			      
			      <!-- Sidebar Menu -->
			      <ul class="sidebar-menu">
			        <!-- Optionally, you can add icons to the links -->
			        <?php $active_tab = ($active_tab_var == 'dashboard') ? 'active' : '' ;?>
			        <li class="<?php echo $active_tab;?>"><a href="<?php echo base_url();?>admin/index"><i class="fa fa-table"></i> <span>Dashboard</span></a></li>
			        <?php $active_tab = ($active_tab_var == 'listings') ? 'active' : '' ;?>
			        <li class="<?php echo $active_tab;?>"><a href="<?php echo base_url();?>admin/listings"><i class="fa fa-table"></i> <span>Active Arrivals</span></a></li>
			        <?php $active_tab = ($active_tab_var == 'deals') ? 'active' : '' ;?>
			        <li class="<?php echo $active_tab;?>"><a href="<?php echo base_url();?>admin/deals"> <i class="fa fa-list"></i> <span>Manager Choices</span></a></li>
			        <?php $active_tab = ($active_tab_var == 'extras') ? 'active' : '' ;?>
			        <li class="<?php echo $active_tab;?>"> <a href="<?php echo base_url();?>admin/mang_ext_categories"><i class="fa fa-list"></i> <span>Extras View</span></a> </li>
			      	<?php $active_tab = ($active_tab_var == 'subscribers') ? 'active' : '' ;?>
			        <li class="<?php echo $active_tab;?>"> <a href="<?php echo base_url();?>admin/subscribers_list"><i class="fa fa-table"></i> <span>Subscribers</span></a> </li>
			        <?php $active_tab = ($active_tab_var == 'contacts') ? 'active' : '' ;?>
			        <li class="<?php echo $active_tab;?>"> <a href="<?php echo base_url();?>admin/contacts_list"><i class="fa fa-table"></i> <span>Contacts List</span></a> </li>
			        <?php $active_tab = ($active_tab_var == 'booking') ? 'active' : '' ;?>
			        <li class="<?php echo $active_tab;?>"> <a href="<?php echo base_url();?>admin/booking_info"><i class="fa fa-table"></i> <span>Bookings</span></a> </li>
			        <?php $active_tab = ($active_tab_var == 'luggage') ? 'active' : '' ;?>
			        <li class="<?php echo $active_tab;?>"> <a href="<?php echo base_url();?>admin/luggage_view"><i class="fa fa-table"></i> <span>Luggage View</span></a> </li>
			        <?php $active_tab = ($active_tab_var == 'margins') ? 'active' : '' ;?>
			        <li class="<?php echo $active_tab;?>"> <a href="<?php echo base_url();?>admin/margins"><i class="fa fa-table"></i> <span>Margins</span></a> </li>
			        <?php $active_tab = ($active_tab_var == 'bulkbooking') ? 'active' : '' ;?>
                    <li class="<?php echo $active_tab;?>"> <a href="<?php echo base_url();?>admin/bulkbooking"><i class="fa fa-table"></i><span>BulkBooking</span></a> </li>
			        
                  </ul>
			      <!-- /.sidebar-menu --> 
			    </section>
			    <!-- /.sidebar --> 
			  </aside>
			  
			  <!-- Content Wrapper. Contains page content -->
			  <div class="content-wrapper">    
					<?php echo $content_for_layout; ?>
			      <!-- /.content --> 
			  </div>
			  <!-- /.content-wrapper --> 
			  
			  <!-- Main Footer -->
			  <footer class="main-footer"> 
			    <!-- To the right --> 
			    
			    <!-- Default to the left --> 
			    <strong>Copyright &copy; 2015 <a href="#">bookitnow</a>.</strong> All rights reserved. </footer>
			 
			</div>			  
		<?php echo @$this->layouts->print_includes()['js']; ?> 
		<script type="text/javascript">
			$(function(){
	    		$(".table").DataTable({
	    			"scrollX": true
			    });
	        }); 
		</script>
	</body>
</html>



