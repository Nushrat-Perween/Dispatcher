<div class="row" style="padding:10px;background-color:#fff">
	<div class="col-md-2 pull-right">
		<a class="" href="<?php echo base_url();?>job/job_direction"> <img src="<?php echo base_url();?>assets/images/direction.png"/></a>
		<a class="" href="<?php echo base_url();?>job/job_street"> <img src="<?php echo base_url();?>assets/images/street.png"/></a>
		<a class="" href="<?php echo base_url();?>job/job_location"><img src="<?php echo base_url();?>assets/images/location.png"/> </a>
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
<div class="row">
<div class="col-md-8"><?php echo $map['map']['html'] ;?></div>
<div class="col-md-4" style="background-color:#fff"><div id="directionsDiv"></div></div>
</div>