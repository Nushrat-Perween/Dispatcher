 <div class="mainbar">

  <div class="container">

    <button type="button" class="btn mainbar-toggle" data-toggle="collapse" data-target=".mainbar-collapse">
      <i class="fa fa-bars"></i>
    </button>

    <div class="mainbar-collapse collapse">
 <?php if($_SESSION['admin']['user_role']==1 || $_SESSION['admin']['user_role']==2) { ?>
      <ul class="nav navbar-nav mainbar-nav">
        <li class="active">
          <a href="<?php echo base_url();?>admin/dashboard">
            <i class="fa fa-dashboard"></i>
            Dashboard
          </a>
        </li>

        <li class="dropdown ">
          <a href="#about" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-user"></i>
           	Users
            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">   
            <li><a href="<?php echo base_url();?>admin/client_list"><i class="fa fa-user nav-icon"></i> Client</a></li>
            <li><a href="<?php echo base_url();?>admin/user_list"><i class="fa fa-user nav-icon"></i> User</a></li>
          </ul>
        </li>
		 <li class="">
          <a href="<?php echo base_url();?>admin/package_list">
           <i class="fa fa-columns"></i>
          Package
          </a>
        </li>
        
</ul>
<?php } else if($_SESSION['admin']['user_role']==6){?>
      <ul class="nav navbar-nav mainbar-nav">
        <li class="active">
          <a href="<?php echo base_url();?>admin/dashboard">
            <i class="fa fa-dashboard"></i>
            Dashboard
          </a>
        </li>
        <li class="active">
          <a href="<?php echo base_url();?>client/job_list">
            <i class="fa fa-files-o"></i>
            Job
          </a>
        </li>
        <li class="active">
          <a href="<?php echo base_url();?>client/getpatientlist">
            <i class="fa fa-user-md"></i>
           Patient
          </a>
        </li>
 	</ul>
 	
 	
 	
 	<?php } else if($_SESSION['admin']['user_role']==3 || $_SESSION['admin']['user_role']==4 || $_SESSION['admin']['user_role']==5) {?>
      <ul class="nav navbar-nav mainbar-nav">
        <li class="">
          <a href="<?php echo base_url();?>admin/dashboard">
            <i class="fa fa-dashboard"></i>
            Dashboard
          </a>
        </li>
        <?php if($_SESSION['admin']['user_role']!=5){?>
        <li class="">
          <a href="<?php echo base_url();?>admin/branch_list">
            <i class="fa fa-cogs"></i>
            Branch
          </a>
        </li>
        <li class="">
          <a href="<?php echo base_url();?>admin/hospital_list">
            <i class="fa fa-user-md"></i>
            Client
          </a>
        </li>
         <li class="">
          <a href="<?php echo base_url();?>admin/client_userlist">
            <i class="fa fa-user"></i>
           Users
          </a>
        </li>
        <?php }?>
        
        <li class="dropdown ">
          <a href="<?php echo base_url();?>admin/driver_list" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-ambulance"></i>
           Driver
            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
           
            
           <!--  <li><a href="<?php echo base_url();?>admin/schedule"><i class="fa fa-users nav-icon"></i> Schedule</a></li> -->
            <li><a href="<?php echo base_url();?>admin/driver_list"><i class="fa fa-clock-o nav-icon"></i> Schedule</a></li>
            <li><a href="<?php echo base_url();?>admin/fieldworker_attendance"><i class="fa fa-calendar nav-icon"></i> Attandance</a></li>
          
          </ul>
        </li>  
        
          <li class="dropdown ">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-files-o"></i>
           Job
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url();?>admin/job_list"><i class="fa fa-bars nav-icon"></i> List</a></li>
            <li><a href="<?php echo base_url();?>client/client_add_job"><i class="fa fa-money nav-icon"></i> Add</a></li>
          </ul>
        </li>
  <?php }?>
      </ul>

    </div> <!-- /.navbar-collapse -->   

  </div> <!-- /.container --> 

</div> <!-- /.mainbar -->


