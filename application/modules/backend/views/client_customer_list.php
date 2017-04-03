 <link rel="stylesheet" href="<?php echo asset_url();?>vendor/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
 <style>
	td{font-size:0.9em;padding:5px 5px 5px 5px !important;text-align:center}
	th{text-align:center}
	hr{margin-bottom:0rem}
	.icon-arrow-left {
	color:black;
	}
	.modal-body {
    position: relative;
    padding-left: 20%;
    padding-right: 20%;
	}
	</style>
  <div class="content-view">
  	<h5> Customer Report </h5>
	<div class="card">
        <div class="card-block">
        	
        <div class="row" style="padding-bottom:20px;">
        	<div class="col-md-1"></div>
        	<div class="col-md-3">From: <input type="text" name="number" id= "start_date" class="form-control"></div>
         	<div class="col-md-3">To: <input type="text" name="number" id= "end_date" class="form-control"></div>
         	<div class="col-md-3"> C. Number<input type="text" name="number" class="form-control"></div>
         	<div class="col-md-1" style="padding-top:20px;"> <button type="button" class="btn btn-primary m-r-xs m-b-xs"> Search </button> </div>
         </div>
            <table class="table table-bordered datatable">
                 <thead>
                    <tr>
	                    <th> Contact name </th>
	                    <th> Cotact number </th>
	                    <th> Address </th>
	                    <th> Street</th>
	                    <th> Building Number </th>
	                    <th> Created_date</th>
                    </tr>
                  </thead>
				  <tbody>
				  <?php //print_r($joblist);
					foreach($customerlist as $row) { ?>
					   <tr>
	                      <td> <?php echo $row['contact_name'];?></td>
	                      <td>  <?php echo $row['mobile'];?></td>
	                      <td>  <?php echo $row['city_name'];?> </td>
	                      <td> <?php echo $row['street'];?> </td>
	                      <td>  <?php echo $row['building'];?> </td>
	                      <td> <?php echo (isset($row['created_date']) && !empty($row['created_date']))?date("d-m-Y", strtotime($row['created_date'])):'';?></td>
	                    </tr>
	                 <?php }?>  
				  </tbody>
                </table>
              </div>
            </div>
            </div>
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
    <script>
    $('.datatable').DataTable();
    $(function() {
        $("#start_date").datepicker({
            dateFormat: "dd-mm-yyyy"
        }).datepicker("setDate", "0");
        $("#end_date").datepicker({
            dateFormat: "dd--mm-yyyy"
        }).datepicker("setDate", "0");    // Here the current date is set
    });
    </script>
  