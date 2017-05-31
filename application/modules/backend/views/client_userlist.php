
<div class="container">

  <div class="content">

    <div class="content-container">
      <div class="content-header">
        <h2 class="content-header-title">User List <a href="<?php echo base_url();?>admin/add_client_user"><button class="btn bg-primary btn-sm pull-right no-radius">
<i class="fa fa-plus" aria-hidden="true"> </i> Users
</button></a></h2>
       
      </div> <!-- /.content-header -->
      <div class="row">

        <div class="col-md-12">

          <div class="portlet">
            <div class="portlet-content">           

              <div class="table-responsive">

              <table 
                class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                data-provide="datatable" 
                data-display-rows="10"
                data-info="true"
                data-search="true"
                data-length-change="true"
                data-paginate="true"
              >
                  <thead>
                  
                    <tr>
                    <th >Sr.No</th>
                    <th data-filterable="true" data-sortable="true"> Branch </th>
					<th  >First Name </th>
					<th >Last Name </th>
					<th >Email</th>
					<th >Mobile</th>
					<th  data-filterable="true" data-sortable="true">Role</th>
					<th  data-filterable="true" data-sortable="true">Created Date</th>
					<th>Action </th>
                    </tr>
                  </thead>
                  <tbody>
               <?php

$sr=0;
foreach($client_userlist as $row) {
	$sr++;


	?>
<tr>
<td><?php echo $sr ; ?> </td>
<td> <?php echo $row['branch_name'];?> </td>
<td> <?php echo $row['first_name'];?> </td>
<td> <?php echo $row['last_name'];?> </td>
<td> <?php echo $row['email'];?> </td>
<td> <?php echo $row['mobile'];?> </td>
<td> <?php if($row['user_role']==4) { echo "Subadmin"; } else if ($row['user_role']==5) { echo "Dispatcher"; } else { echo "Driver"; } ?> </td>
<td> <?php echo (isset($row['created_date']) && !empty($row['created_date']))?date("d-m-Y", strtotime($row['created_date'])):'';?> </td>
<td style="padding-left:5px !important">
<a href="<?php echo base_url();?>admin/edit_clientuser/<?php echo $row['id'];?>" class="bg-green" style="margin:2px">&nbsp;&nbsp;<i class="fa fa-pencil text-white"></i>&nbsp;Edit&nbsp;&nbsp;</a>
</td>
</tr>
<?php }?>
                  </tbody>
                </table>
              </div> <!-- /.table-responsive -->
              

            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->

        

        </div> <!-- /.col -->

      </div> <!-- /.row -->
    </div>
  </div>
 </div>
      
 <script src="<?php echo asset_url();?>js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/datatables/DT_bootstrap.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/tableCheckable/jquery.tableCheckable.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/icheck/jquery.icheck.min.js"></script>
