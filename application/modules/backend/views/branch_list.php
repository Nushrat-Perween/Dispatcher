

<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div class="content-header">
        <h2 class="content-header-title"> Branch List  <a href="<?php echo base_url();?>admin/add_branch"><button class="btn bg-primary btn-sm pull-right no-radius">
<i class="fa fa-plus" aria-hidden="true"> </i> Branch
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
                     <th> ID </th>
                      <th data-filterable="true" data-sortable="true" data-direction="desc">Branch Name</th>
                      <th data-direction="asc" data-filterable="true" data-sortable="true">Address</th>
                      <th data-filterable="true" data-sortable="true"> City</th>
                      <th  data-filterable="true" data-sortable="true"> State</th>
                      <th data-filterable="true" class="hidden-xs hidden-sm"> Zipcode</th>
                      <th> Action</th>
                    </tr>
                  </thead>
                  <tbody>
                 <?php

$sr=0;
foreach($branch_list as $row) {
	$sr++;


	?>
<tr>
<td> <?php echo $row['id'];?> </td>

<td> <?php if($row['branch_name'] != "") echo ucwords($row['branch_name']); else echo "NA";?> </td>
<td> <?php if($row['address'] != "") echo $row['address']; else echo "NA";?> </td>

<td> <?php if($row['city'] != "") echo $row['city']; else echo "NA";?> </td>
<td> <?php if($row['state'] != "") echo $row['state']; else echo "NA";?> </td>
<td> <?php if($row['zipcode'] != "") echo $row['zipcode']; else echo "NA";?> </td>
<td style="padding-left:5px !important">
<a href="<?php echo base_url();?>admin/edit_branch/<?php echo $row['id'];?>" class="bg-green" style="margin:2px">&nbsp;&nbsp;<i class="fa fa-pencil text-white"></i>&nbsp;Edit&nbsp;&nbsp;</a>
</td>

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