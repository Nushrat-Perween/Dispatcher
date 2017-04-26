 <!-- Site admin  -->
   <?php if($_SESSION['admin']['user_role']==1 || $_SESSION['admin']['user_role']==2) {?>
        <nav class="header-secondary navbar  bg-faded shadow">
          <div class="navbar-collapse">
            <a class="navbar-heading hidden-md-down" href="<?php echo base_url();?>admin/dashboard">
            	<i class="material-icons " aria-hidden="true">  dashboard  </i> <span>Dashboard</span>
            </a>
            <ul class="nav navbar-nav pull-xs-right">
              <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url();?>admin/dashboard">
                	<i class="material-icons " aria-hidden="true"> home </i>Home
                </a>
              </li>
             <li class="nav-item active">
              <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                	<i class="material-icons " aria-hidden="true">  group </i> Users
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="<?php echo base_url();?>admin/client_list">
                  	<i class="material-icons text-success" aria-hidden="true"> group_add  </i><span> Client</span>
                  </a>
                  <a class="dropdown-item" href="<?php echo base_url();?>admin/user_list">
                    <i class="material-icons text-success" aria-hidden="true"> group_add </i><span> User</span> 
                 </a>
                </div>
              </div>
              </li>
                <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url();?>admin/package_list">
                	<i class="material-icons " aria-hidden="true">  home  </i> Package 
                </a>
              </li>
            </ul>
          </div>
        </nav>
         <!-- Client  -->
    <?php } else if($_SESSION['admin']['user_role']==6){?>
        <nav class="header-secondary navbar  bg-faded shadow">
          <div class="navbar-collapse">
            <a class="navbar-heading hidden-md-down" href="<?php echo base_url();?>admin/dashboard">
             <i class="material-icons " aria-hidden="true">
                      dashboard
                    </i> <span>Dashboard</span>
            </a>
            <ul class="nav navbar-nav pull-xs-right">
              <li class="nav-item ">
                <a class="nav-link" href="<?php echo base_url();?>admin/dashboard">
                <i class="material-icons " aria-hidden="true">
                      home
                    </i>
                Home</a>
              </li>
			<li class="nav-item ">
                <a class="nav-link" href="<?php echo base_url();?>client/job_list">
               <i class="material-icons" aria-hidden="true">
                      add_circle_outline
                    </i>
               Jobs
                </a>
              </li>
                <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url();?>client/getcustomerlist">
                <i class="material-icons" aria-hidden="true">
                      account_circle
                    </i>
				Contact</a>
              </li>
			 <li class="nav-item active">
			  <a class="nav-link" href="<?php echo base_url();?>client/getpatientlist">
                 <i class="material-icons " aria-hidden="true">
                     people
                    </i>
				Patient List</a>
			
              </li>
            <li class="nav-item active">
			  <a class="nav-link" href="<?php echo base_url();?>client/client_report">
                 <i class="material-icons " aria-hidden="true">
                     description
                    </i>
				Report</a>
              </li>
            </ul>
          </div>
        </nav>
     <?php } else if($_SESSION['admin']['user_role']==3 || $_SESSION['admin']['user_role']==4 || $_SESSION['admin']['user_role']==5) {?>
        <!-- menu header -->
        <nav class="header-secondary navbar  bg-faded shadow">
          <div class="navbar-collapse">
            <a class="navbar-heading hidden-md-down" href="<?php echo base_url();?>admin/dashboard">
             <i class="material-icons " aria-hidden="true">
                      dashboard
                    </i> <span>Dashboard</span>
            </a>
            <ul class="nav navbar-nav pull-xs-right">
              <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url();?>admin/dashboard">
                 <i class="material-icons " aria-hidden="true">
                      home
                    </i>
                Home</a>
              </li>
			<?php if($_SESSION['admin']['user_role']!=5){?>
              <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="material-icons " aria-hidden="true">
                      group
                    </i>
                Users</a>
				
                <div class="dropdown-menu dropdown-menu-right">
                
                  <a class="dropdown-item"  href="<?php echo base_url();?>admin/client_userlist">
                       <i class="material-icons text-info" aria-hidden="true">
                      playlist_add_check
                    </i> <span> User</span>
                  </a>
                  <a class="dropdown-item"  href="<?php echo base_url();?>admin/hospital_list">
                       <i class="material-icons text-info" aria-hidden="true">
                      playlist_add_check
                    </i> <span>Hospital</span>
                  </a>
                 
                </div>
              </div>
              <?php } ?>
              

<div class="nav-item nav-link dropdown">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
<i class="material-icons " aria-hidden="true">
directions_bike
</i>
Field Worker</a>
<div class="dropdown-menu dropdown-menu-right">


<a class="dropdown-item"  href="<?php echo base_url();?>admin/field_worker_list">
<i class="material-icons text-info" aria-hidden="true">
playlist_add_check
</i> <span> Fieldworker </span>
</a>
<a class="dropdown-item" href="<?php echo base_url();?>admin/error_screen">
<i class="fa fa-bicycle " style="margin-right:7px" aria-hidden="true">
</i><span> Trip</span>
</a>
<a class="dropdown-item" href="<?php echo base_url();?>admin/schedule">
<i class="material-icons text-red" aria-hidden="true">
Schedular
</i><span> Schedular</span>
</a>
<a class="dropdown-item" href="<?php echo base_url();?>admin/fieldworker_attendance">
<i class="material-icons" aria-hidden="true">
perm_contact_calendar
</i> <span>Attendance</span>
</a>
</div>
</div>
<!-- 			<div class="nav-item nav-link ">
<a href="<?php echo base_url();?>admin/attendance" ><i class="material-icons " aria-hidden="true">
<!--                       today -->
<!--                     </i><span>Attendance</span></a> -->

<!--               </div> -->
<div class="nav-item nav-link dropdown">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons " aria-hidden="true">
location_on
</i>Location</a>
<div class="dropdown-menu dropdown-menu-right">

<a class="dropdown-item"  href="<?php echo base_url();?>admin/city_list">
<i class="material-icons text-info" aria-hidden="true">
room
</i> <span> City</span>
</a>
<a class="dropdown-item"  href="<?php echo base_url();?>admin/locality_list">
<i class="material-icons text-info" aria-hidden="true">
room
</i> <span>Locality</span>
</a>
<a class="dropdown-item"  href="<?php echo base_url();?>admin/zone_list">
<i class="material-icons text-info" aria-hidden="true">
room
</i> <span> Zone</span>
</a>
<a class="dropdown-item"  href="<?php echo base_url();?>admin/assign_zone_area">
<i class="material-icons text-info" aria-hidden="true">
room
</i> <span>Assign Zone Area</span>
</a>

</div>
</div>
<div class="nav-item nav-link dropdown">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
<i class="material-icons " aria-hidden="true" style="margin-bottom:10px">
J</i><span>Jobs</span></a>
<div class="dropdown-menu dropdown-menu-right">
<!--  <a class="dropdown-item" href="<?php echo base_url();?>job">
<i class="material-icons text-success"  style="margin-right:7px" aria-hidden="true">
add_circle -->
<!--                     </i><span>Add Job</span> -->
<!--                     </a> -->
<a class="dropdown-item"  href="<?php echo base_url();?>admin/job_list">
<i class="material-icons text-info" aria-hidden="true">
playlist_add_check
</i>  <span>Jobs</span>

</a>
<a class="dropdown-item"  href="<?php echo base_url();?>client/client_add_job">
<i class="material-icons text-info" aria-hidden="true">
playlist_add_check
</i>  <span>Add</span>

</a>
</div>



</div>
<?php if($_SESSION['admin']['user_role']!=5){?>

<div class="nav-item nav-link dropdown">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
<i class="material-icons " aria-hidden="true">
description
</i>
Report</a>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="<?php echo base_url();?>admin/error_screen">
<i class="material-icons text-red" aria-hidden="true">
radio_button_checked
</i> <span> Worker</span>
</a>
<a class="dropdown-item" href="<?php echo base_url();?>admin/error_screen">
<i class="material-icons text-red" aria-hidden="true">
radio_button_checked
</i><span> Job Report</span>
</a>

</div>
</div>
<?php } ?>


</ul>
</div>
</nav>
<!-- /menu header -->


     <?php }?>
