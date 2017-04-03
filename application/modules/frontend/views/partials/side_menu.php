   <!-- menu header -->
        <nav class="header-secondary navbar  bg-faded shadow">
          <div class="navbar-collapse">
            <a class="navbar-heading hidden-md-down" href="<?php echo base_url();?>dashboard">
              <i class="material-icons " aria-hidden="true">
                      dashboard
                    </i> <span>Dashboard</span>
            </a>
            <ul class="nav navbar-nav pull-xs-right">
              <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url();?>dashboard">
                 <i class="material-icons " aria-hidden="true">
                      home
                    </i>
                Home</a>
              </li>

              <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                 <i class="material-icons " aria-hidden="true" style="margin-bottom:10px">
                      J</i>Jobs
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="<?php echo base_url();?>job">
                   <i class="material-icons text-success"  style="margin-right:7px" aria-hidden="true">
                     add_circle
                    </i><span>Add Job</span>
                    </a>
                  <a class="dropdown-item"  href="<?php echo base_url();?>job_list">
                   <i class="material-icons text-info" aria-hidden="true">
                      playlist_add_check
                    </i>  <span>Job List</span>
					
                  </a>
                  <a class="dropdown-item" href="<?php echo base_url();?>all_job_on_map">
                   <i class="fa fa-map text-warning"  style="margin-right:12px" aria-hidden="true">
                   
                    </i>  <span>Map</span>
					 
                  </a>
                  <a class="dropdown-item" href="<?php echo base_url();?>job_detail">
                    <i class="material-icons text-primary" aria-hidden="true">
                      details
                    </i> <span> Pending</span>
					
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="material-icons text-success" aria-hidden="true">
                      check_circle
                    </i><span> Complited </span>
					 
                  </a>
                  <a class="dropdown-item" href="#">
                   <i class="material-icons text-danger" aria-hidden="true">
                      cancel
                    </i> <span> Cancel </span>
					
                  </a>
                </div>
              </div>

              <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons " aria-hidden="true">
                      group
                    </i>
                Users</a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="<?php echo base_url();?>add_user">
                       <i class="material-icons text-success" aria-hidden="true">
                      group_add
                    </i><span> Add </span>
                      </a>
                  <a class="dropdown-item"  href="<?php echo base_url();?>user_list">
                       <i class="material-icons text-info" aria-hidden="true">
                      playlist_add_check
                    </i> <span> List </span>
                  </a>
                 
                </div>
              </div>
              

              <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="material-icons " aria-hidden="true">
                      settings
                    </i>
                Tools</a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="ui-navs.html">
                     <i class="material-icons text-info" aria-hidden="true">
                      format_color_text
                    </i><span> Editor</span>
                  </a>
                  <a class="dropdown-item" href="ui-general.html">
                    <i class="material-icons text-danger" aria-hidden="true">
                      format_color_fill
                    </i> <span>Theme Color</span>
                  </a>
                  <a class="dropdown-item" href="ui-social-buttons.html">
                    <i class="material-icons text-primary" aria-hidden="true">
                      format_shapes
                    </i><span> Map Calculator</span>
                  </a>
                  <a class="dropdown-item" href="">
                    <i class="material-icons text-red" aria-hidden="true">
                      edit_location
                    </i> <span>Distance calculator</span>
                  </a>
                </div>
              </div>

              <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="material-icons " aria-hidden="true">
                      description
                    </i>
                Report</a>
                <div class="dropdown-menu dropdown-menu-right">
                  
                  <a class="dropdown-item" href="<?php echo base_url();?>report/jobs_by_company">
                   <i class="material-icons text-red" aria-hidden="true">
                      radio_button_checked
                    </i><span> Job Report</span>
                  </a>
                  <a class="dropdown-item" href="<?php echo base_url();?>report/jobs_by_branch">
                   <i class="material-icons text-red" aria-hidden="true">
                      radio_button_checked
                    </i><span> Branch Report</span>
                  </a>
                  <a class="dropdown-item" href="blank.html">
                   <i class="material-icons text-red" aria-hidden="true">
                      radio_button_checked
                    </i><span> Graph</span>
                  </a>
                  <a class="dropdown-item" href="<?php echo base_url();?>/dashboard ">
                <i class="material-icons text-dander" aria-hidden="true">
                      receipt
                    </i>
                <span>Invoice</span>
              </a>
                </div>
              </div>

         

            </ul>
          </div>
        </nav>
        <!-- /menu header -->
        
