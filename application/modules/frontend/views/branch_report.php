    <!-- page stylesheets -->
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<div class="content-view">
<?php //print_r($report);?>
	<div class="card card-block">
	<div>
			<div class="dropdown pull-right bg-purple" style="padding:3px 5px 4px 5px">
<select class="bg-purple" style="border:0" id="period" onchange="period_filter ();">
	<option value="">Period</option>
	<option value="1">Today</option>
	<option value="2">This week</option>
	<option value="3">This month</option>
	<option value="4">This year</option>
</select>
</div>



<div class="dropdown pull-right bg-warning" style="padding:3px 5px 4px 5px">
<select class="bg-warning" style="border:0" id="branch" onchange="branch_filter ();">
	<option value="<?php echo $global_branch_id;?>">Branch</option>
	<?php foreach($branch_list as $row) {?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['branch_name']; ?></option>
	<?php }?>
	<option value="">All Branch</option>
</select>
</div>

	</div>

	<h2>Line Chart</h2>
	<div id="mylinechart" style="height: 250px;"></div>
	<h2>Bar chart</h2>
	<div id="mybarchart" style="height: 250px;"></div>
	
	</div>
</div>
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo asset_url();?>vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script type="text/javascript">
new Morris.Line({
	  element: 'mylinechart',
	 data: 
	       <?php echo $report; ?>,
	  xkey: 'created_date',
	  ykeys: ['branch1','branch2','branch3'],
	  labels: ['branch1','branch2','branch3']
	});
new Morris.Bar({
	  element: 'mybarchart',
	 data: 
	       <?php echo $report; ?>,
	  xkey: 'created_date',
	  ykeys: ['branch1','branch2','branch3'],
	  labels: ['branch1','branch2','branch3']
	});

	function branch_filter () {
		$("#mylinechart").empty();
		$("#mybarchart").empty();
		$.post("<?php echo base_url();?>report/filter_jobs_by_branch",{"branch_id": $('#branch').val(),"company_id":'<?php echo $global_company_id;?>'},function(graph_data){
			if($('#branch').val() != "") {
			new Morris.Line({
				  element: 'mylinechart',
				 data: graph_data,
				  xkey: 'created_date',
				  ykeys: ['jobs'],
				  labels: ['No. of Jobs']
				});

			new Morris.Bar({
				  element: 'mybarchart',
				  data: graph_data,
				  xkey: 'created_date',
				  ykeys: ['jobs'],
				  labels: ['No. of Jobs']
				});
			} else {
				new Morris.Line({
					  element: 'mylinechart',
					 data: 
					       <?php echo $report; ?>,
					  xkey: 'created_date',
					  ykeys: ['branch1','branch2','branch3'],
					  labels: ['branch1','branch2','branch3']
					});
				new Morris.Bar({
					  element: 'mybarchart',
					 data: 
					       <?php echo $report; ?>,
					  xkey: 'created_date',
					  ykeys: ['branch1','branch2','branch3'],
					  labels: ['branch1','branch2','branch3']
					});
			}
							
		},'json');
			
	}
	
	function period_filter () {
		$("#mylinechart").empty();
		$("#mybarchart").empty();
		$.post("<?php echo base_url();?>report/filter_jobs_by_branch",{"branch_id": $('#branch').val(),"duration": $('#period').val(),"company_id":'<?php echo $global_company_id;?>'},function(graph_data){
			if($('#branch').val() != "") {
				alert("hi");
				new Morris.Line({
					  element: 'mylinechart',
					 data: graph_data,
					  xkey: 'created_date',
					  ykeys: ['jobs'],
					  labels: ['No. of Jobs']
					});

				new Morris.Bar({
					  element: 'mybarchart',
					  data: graph_data,
					  xkey: 'created_date',
					  ykeys: ['jobs'],
					  labels: ['No. of Jobs']
					});
				} else {
					new Morris.Line({
						  element: 'mylinechart',
						 data: 
						       <?php echo $report; ?>,
						  xkey: 'created_date',
						  ykeys: ['branch1','branch2','branch3'],
						  labels: ['branch1','branch2','branch3']
						});
					new Morris.Bar({
						  element: 'mybarchart',
						 data: 
						       <?php echo $report; ?>,
						  xkey: 'created_date',
						  ykeys: ['branch1','branch2','branch3'],
						  labels: ['branch1','branch2','branch3']
						});
				}
							
		},'json');
			
	}
</script>