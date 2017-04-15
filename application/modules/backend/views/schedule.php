<!-- page stylesheets -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/datatables/media/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>

<!-- page stylesheets -->
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
.dataTables_wrapper {
    overflow-x: scroll;
}

.thead-inverse th {
color: #fff;
    background-color: #0275d8;
}
</style>
<script>
Pusher.log = function(message) {
    if (window.console && window.console.log) {
        window.console.log(message);
    }
};

var pusher = new Pusher('<?php echo $pusher_key;?>');
var channel = pusher.subscribe('test_channel');
channel.bind('my_event', function(data) {
             if(data.notification_type == 1 || data.notification_type == 2) {
             //			$.post("<?php echo base_url();?>admin/update_jobList_through_pusher",{},function(res) {
             // 				tableid="table_id1";
             // 				update_dataTable(res,tableid);
             // 			},'json');
             }
             });
</script>
<div class="content-view">
<div class="card">
<div class="card-header no-bg b-a-0">
<div class="row">
	<div class="col-md-12">
		<div class="dropdown pull-left " style="padding:3px 5px 4px 5px">
			<H2>Schedule</H2>
		</div>
		<div class="dropdown pull-right bg-purple" style="padding:3px 5px 4px 5px">
			<select class="bg-purple" style="border:0" id="cep">
			<option value="">Fieldworker</option>
			<?php foreach($fieldworker as $row) {?>
			<option value="<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?></option>
			<?php }?>
			</select>
		</div>
	</div>
</div>
<div class="dataTables_wrapper">
<table class="table table-bordered datatable" id="schedular">
<thead class="thead-inverse">
<tr>
	<th> Job Name </th>
	<th > Start Time </th>
	<th > End Time </th>
	<th > Last Action </th>
	<th>Current Location</th>
	<th>Status</th>
</tr>
</thead>
<tbody >
<tr>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>


<!-- page scripts -->
<script src="<?php echo asset_url();?>vendor/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo asset_url();?>vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo asset_url();?>vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#schedular").DataTable();
	$("#cep").on("change", update_dataTable);
	
function update_dataTable () {

	 $.get("<?php echo base_url();?>admin/getfieldworkerschedule/"+$('#cep').val(),{},function(data){
	    var oTable = $("#schedular").dataTable();
	   
	    oTable.fnClearTable();
	    var row = [];
	    $(data).each(function(index) {
	                 row.push(data[index].job_name);
	                 row.push(data[index].start_time);
	                 row.push(data[index].end_time);
	                 row.push(data[index].action);
	                 row.push(data[index].current_location);
	                 row.push(data[index].status);
	                 oTable.fnAddData(row);
	                 });

},'json');	
}
    
});



	




</script>