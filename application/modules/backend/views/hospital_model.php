<div class="alert alert-success" style="display:none" id="saveuserinfo">
<b>Updated Sucessfully.</b>
</div>
<div class="alert alert-warning" style="display:none" id="notsaveuserinfo">
<strong>Warning!</strong> <b>Please Check Your Data.</b>
</div>
<?php
if(isset($hospital_assignment)) {
	?>
	<div class="row">
		<div class="col-md-offset-2 col-md-7">
			<div class="form-group">
			<br><br>
		
				<label for="inputBirthday" style="color:black" class="control-label"></label>
				<select name="hospital_id[]"  multiple="multiple"  id="hospital_id" class="form-control required" >
					<option value="">Select Client</option>
					<?php foreach ($hospital as $row) {
						$selecthospital = "";
						foreach ($assigned_hospital as $assignedHospital) {
							if($assignedHospital['id'] == $row['id'] )
							{
								$selecthospital = "selected";
							}
						}
						?>
					<option value="<?php echo $row['id'];?>" <?php echo $selecthospital;?>><?php echo $row['hospital_name'];?></option>
					<?php }?>	
				</select>
				<br>
			</div>
        </div>
	</div>
	 <div class="form-actions pal">
		
		<div class="form-group mbn">

			<div class="col-md-offset-4 col-md-8"> 
				<button type="submit" onclick="assign_hospital (`<?php echo $field_worker_id;?>`);" class="btn btn-primary" >Assign hospital</button>
				<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary" class="close">Close</button>

			</div>

		</div>
		
	</div>
	<?php 
		}
	?>
	<br><br><br><br><br><br><br><br><br>