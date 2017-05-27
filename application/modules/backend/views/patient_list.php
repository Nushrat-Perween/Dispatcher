

<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div class="content-header">
        <h2 class="content-header-title"> Contact List </h2>
           	
        <div class="row" style="padding-bottom:20px;">
        	<div class="col-md-1"></div>
        	<div class="col-md-3">From: <input type="text" name="number" id= "start_date" class="form-control"></div>
         	<div class="col-md-3">To: <input type="text" name="number" id= "end_date" class="form-control"></div>
         	<div class="col-md-1" style ="padding-top:20px;"> <button type="button" class="btn btn-primary m-r-xs m-b-xs" onclick = "searchByDateMob()" > Search </button> </div>
         </div>
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
                       <th data-filterable="true" data-sortable="true" data-direction="desc"> Name </th>
	                    <th data-filterable="true" data-sortable="true" data-direction="desc"> Room Number </th>
	                    <th> Test </th>
	                    <th data-filterable="true" data-sortable="true" data-direction="desc"> Caller</th>
	                    <th> Special Instruction </th>
	                    <th data-filterable="true" data-sortable="true" data-direction="desc"> Created_date</th>
                    </tr>
                  </thead>
                  <tbody>
    			<?php //print_r($joblist);
					foreach($patientlist as $row) { ?>
					   <tr>
	                      <td> <?php echo $row['name'];?></td>
	                      <td>  <?php echo $row['room_no'];?></td>
	                      <td>  <?php echo $row['test'];?> </td>
	                      <td> <?php echo $row['caller'];?> </td>
	                      <td>  <?php echo $row['special_instruction'];?> </td>
	                      <td> <?php echo (isset($row['created_date']) && !empty($row['created_date']))?date("d-m-Y", strtotime($row['created_date'])):'';?></td>
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
			$.post(base_url+"client/getPatientListBydate",{from_date:from_date,to_date:to_date,mobile_number:mobile_number}, function(data){
				var oTable = $("#patient").dataTable();
				oTable.fnClearTable();
				$(data).each(function(index){
					var row = [];
						row.push(data[index].name);
						row.push(data[index].room_no);
						row.push(data[index].test);
						row.push(data[index].caller);
						row.push(data[index].special_instruction);
						row.push(data[index].created_date);
						oTable.fnAddData(row);
				});
				//alert(data.value);
			},'json');
		}
	}
    </script>