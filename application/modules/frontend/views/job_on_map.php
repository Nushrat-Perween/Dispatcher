<div class="row" style="padding:10px;background-color:#fff">
	<div class="col-md-6">
		<a class="btn btn-success" href="<?php echo base_url();?>job/job_direction"> Direction</a>
		<a class="btn btn-success" href="<?php echo base_url();?>job/job_street"> Street</a>
		<a class="btn btn-success" href="<?php echo base_url();?>job/job_location"> Location</a>
	</div>
</div>
<div class="row" style="padding:10px;background-color:#fff">
	<div class="col-md-3">
		<?php echo "Job Name :"; ?>
	</div>
	<div class="col-md-3">
		<?php echo "Field Worker  Name :" ;?>
	</div>
	<div class="col-md-3">
		<?php echo "Start Date Time :" ;?>
	</div>
	<div class="col-md-3">
	<?php echo "End Date Time :" ;?>
	</div>
</div>
<?php echo $map['map']['js'] ;?>
<?php echo $map['map']['html'] ;?>



