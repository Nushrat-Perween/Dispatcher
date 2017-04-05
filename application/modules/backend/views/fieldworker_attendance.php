
<style>
.table-bordered {
border: 1px solid #eceeef;
    border-left: 0px;
    border-right: 0px;
}
.table-bordered th, .table-bordered td {
    
    border-right: 0px;
    border-left: 0px;
}
.thead-inverse th {
color: #fff;
    background-color: #0275d8;
}
</style>
<div class="content-view">
<div class="card">
<div class="card-header no-bg b-a-0">
<div class="dropdown pull-left " style="padding:3px 5px 4px 5px">
<H2>Attendance Of Fieldworker</H2>
</div><br><br><br>
<center>

<div class="row">

<div class="col-md-3">
</div>

<div class="col-md-6">
<div class="card card-block p-b-0">

<div class="text-xs-center m-b-2">

<div id="attendance_list">
<table class="table table-bordered datatable" id="table_id1">
<thead class="thead-inverse">

</thead>
<tbody>

<tr>
<td style="text-align:left">
<b><h3><font style="color:blue">Fieldworker name</font></h3></b>
</td>

<td style="text-align:left">
<b><h3><font style="color:blue"> Present</font></h3></b>
</td>
</tr>
<?php foreach ($attendance_list as $row) {?>
<tr>
<td style="text-align:left">
<?php echo $row['worker_name'];?>
</td>
<td style="text-align:left">
<?php  echo $row['attendance'];?>
</td>

</tr>
<?php }?>

</tbody>
</table>
</div>
<br>
<br>



<br>
</div>

</div>
</div>


</div>
</center>
</div>
</div></div>

<script>
$(document).ready(function(){
                  display_c();
                  });

</script>
