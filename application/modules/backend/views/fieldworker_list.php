
<div class="container">

  <div class="content">

    <div class="content-container">
      <div class="content-header">
        <h2 class="content-header-title"> Driver List 	</h2>
       
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
                    <th  data-filterable="true" data-sortable="true">Sr.No</th>
					<th data-filterable="true" data-sortable="true"> Name </th>
					<!-- <th width="5%"> Email </th> -->
					<th data-filterable="true" data-sortable="true"> Mobile No. </th>
					<th data-filterable="true" data-sortable="true"> Email </th>
					<th> User Role </th>
					<th >Status</th>
					<th > Last Job Assigned </th>
					<th data-filterable="true" data-sortable="true">City </th>
					<th > Zone </th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
					    $sr=0;
					    foreach($fieldworker_list as $row) {
					        $sr++;
					        ?>
					<tr>
					<td><?php echo $sr ; ?> </td>
						<td> <?php if($row['first_name']!="" || $row['last_name']!="") echo $row['first_name']." ".$row['last_name']; else echo "NA";?> </td>
						<!-- <td> <?php //if($row['email'] != "") echo $row['email']; else echo "NA";?> </td> -->
						<td> <?php if($row['mobile'] != "") echo $row['mobile']; else echo "NA";?> </td>
						<td> <?php if($row['email'] != "") echo $row['email']; else echo "NA";?> </td>
						
						<td> <?php if($row['role_name'] != "") echo $row['role_name']; else echo "NA";?></td>
						<td> <?php if($row['verified'] == 1)echo "Verified";else echo "Not Verified";?></td>
						<td> 23456</td>
						<td> City name</td>
						<td> Zone name</td>
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
  
 