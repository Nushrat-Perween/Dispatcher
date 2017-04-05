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
  <a href="<?php echo base_url()?>client/client_add_job" class="btn bg-orange m-r-xs m-b-xs"> Add <i class="fa fa-plus"></i> </a>
	<div class="card">
        <div class="card-block">
        <div class="row" style="padding-bottom:20px;">
        	<div class="col-md-1"></div>
        	<div class="col-md-3">From: <input type="text" name="start_date" id= "start_date" class="form-control"></div>
         	<div class="col-md-3">To: <input type="text" name="end_date" id= "end_date" class="form-control"></div>
         	<div class="col-md-3"> C. Number<input type="text" name="mobno" id = "mobno" class="form-control"></div>
         	<div class="col-md-1" style = "padding-top:20px;"> <button type="button" class="btn btn-primary m-r-xs m-b-xs" onclick = "searchByDateMob()"> Search </button> </div>
         </div>
            <table class="table table-bordered datatable" id="job">
                 <thead>
                    <tr>
	                    <th> Action</th>
	                    <th> Job  Name </th>
	                    <th> Contact name </th>
	                    <th> Cotact number </th>
	                    <th> Patient Name </th>
	                    <th> Caller </th>
	                    <th> Careated Date</th>
	                    <th> Delivery Date</th>
	                    <th> Delivery Time</th>
	                    <th> Status </th>
                    </tr>
                  </thead>
				  <tbody>
				  <?php //print_r($joblist);
					foreach($joblist as $row) { ?>
					   <tr>
					   	  <td style="padding-left:5px !important">
								<a href="<?php echo base_url();?>client/edit_client_job/<?php echo $row['job_id']; ?>" class="bg-green" style="margin:2px">&nbsp;&nbsp;<i class="fa fa-pencil text-white"></i>&nbsp;&nbsp;&nbsp;</a>
						</td>
	                      <td><a href=""> <?php echo $row['job_name'];?> </a></td>
	                      <td>  <?php echo $row['contact_name'];?></td>
	                      <td>  <?php echo $row['mobile'];?> </td>
	                      <td> <?php echo $row['patient_name'];?> </td>
	                      <td>  <?php echo $row['caller'];?> </td>
	                      <td> <?php echo (isset($row['created_date']) && !empty($row['created_date']))?date("d-m-Y", strtotime($row['created_date'])):'';?></td>
	                      <td> <?php echo (isset($row['delivery_date']) && !empty($row['delivery_date']))?date("d-m-Y", strtotime($row['delivery_date'])):'';?></td>
	                      <td> <?php echo (isset($row['delivery_time']) && !empty($row['delivery_time']))?date("H:i:s", strtotime($row['delivery_time'])):'';?></td>
	                      <td><?php if($row['status']==0) { echo "Pendind";} else if($row['status']==1) { echo "Success";} else { echo "Cancel" ; }?></td>
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


    function searchByDateMob()
	{
		var from_date=$("#start_date").val();
		var to_date=$("#end_date").val();
		var mobile_number = $("#mobno").val();
		//alert(from_date);
		//lert(to_date);
		//alert(mobile_number);
		if(from_date=="" && to_date=="")
		{
			alert('Please Select FromDate And ToDate');
		}
		else
		{
			$.post(base_url+"client/clientjob_byMob",{from_date:from_date,to_date:to_date,mobile_number:mobile_number}, function(data){
				var oTable = $("#job").dataTable();
				oTable.fnClearTable();
				$(data).each(function(index){
					var	edit = '<a href="'+base_url+'client/edit_client_job/'+data[index].job_id+'" class="bg-green" style="margin:2px;padding:2px"> <i class="fa fa-pencil text-white"></i></a>';
					var row = [];
					var status = "";
					if(data[index].status==0)
					{
						status = "Pending";
					}
					else
					{
						status = "Completed"
					}
						row.push(edit);
						row.push(data[index].job_name);
						row.push(data[index].contact_name);
						row.push(data[index].mobile);
						row.push(data[index].patient_name);
						row.push(data[index].caller);
						row.push(data[index].created_date);
						row.push(data[index].delivery_date);
						row.push(data[index].delivery_time);
						row.push(status);
						oTable.fnAddData(row);
				});
				//alert(data.value);
			},'json');
		}
	}
    </script>
  