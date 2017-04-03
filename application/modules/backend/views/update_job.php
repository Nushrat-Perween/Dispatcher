<div class="alert alert-success" style="display:none" id="update_job_alert">
<b>Updated Sucessfully.</b>
</div>
<div class="alert alert-warning" style="display:none" id="not_update_job_alert">
<strong>Warning!</strong> <b>Please Check Your Data.</b>
</div>
<?php
    if(isset($field_worker)) {
        ?>
<div class="row">
<div class="">
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $job_id;?>">
<label for="inputBirthday" style="color:black" class="control-label"></label>
<select name="field_worker_id" id="field_worker_id" class="form-control">
<option value="">Select Field Worker</option>
<?php foreach ($field_worker as $row) {?>
<option value="<?php echo $row['id'];?>" <?php if($field_worker_id == $row['id']) echo "selected";?>><?php echo $row['first_name']. " ".  $row['last_name'];?></option>
<?php }?>
</select>
</div>
</div>
</div>

<div class="form-actions pal">

<div class="form-group mbn">

<div class="">
<center>
<button type="submit" name="update_category" onclick="update_assign_job_to_fieldworker ('<?php echo $job_id;?>');" class="btn btn-primary" >Update</button>
<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary" class="close">Close</button>
</center>
</div>

</div>

</div>
<?php
    }
    ?>
<?php
    if(isset($action)) {
        ?>
<div class="row">
<div class="">
<div class="form-group">
<br><br>
<input type="hidden" name="id" value="<?php echo $id;?>">
<label for="inputBirthday" style="color:black" class="control-label"></label>
<select name="action_id" id="action_id" class="form-control">
<option value="">Select action</option>

<?php foreach ($action as $row) {?>
<option value="<?php echo $row['id'];?>" <?php if($action_id == $row['id']) echo "selected";?>><?php echo $row['action'];?></option>
<?php }?>
</select>
<br>
</div>
</div>
</div>

<div class="form-actions pal">

<div class="form-group mbn">

<div class="">
<center>
<button type="submit" name="update_job_action" onclick="update_job_action ('<?php echo $id;?>');" class="btn btn-primary" >Update</button>
<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary" class="close">Close</button>
</center>
</div>

</div>

</div>
<?php
    }
    ?>
<?php
    if(isset($priority)) {
        ?>
<div class="row">
<div class=" col-md-7">
<div class="form-group">
<br><br>
<input type="hidden" name="uid" value="<?php echo $id;?>">
<input type="hidden" name="cust_type" value="<?php echo $cust_type;?>">
<label for="inputBirthday" style="color:black" class="control-label"></label>
<select name="priority" id="priority" class="form-control">
<option value="">Select any one priority</option>
<option value="3" <?php if($priority == 3) echo "selected";?> >High</option>
<option value="2" <?php if($priority == 2) echo "selected";?> >Medium</option>
<option value="1" <?php if($priority == 1) echo "selected";?> >Low</option>
</select>
<br>
</div>
</div>
</div>
<div class="form-actions pal">

<div class="form-group mbn">

<div class="col-md-8">
<button type="submit" name="update_priority" onclick="update_priority(<?php echo $id;?>,<?php echo $cust_type;?>);" class="btn btn-primary" >Update</button>
<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary" class="close">Close</button>

</div>

</div>

</div>
<?php
    }
    ?>
<br> <br> <br> <br> <br>
