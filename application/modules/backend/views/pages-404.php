<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content=""/>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
<meta name="msapplication-tap-highlight" content="no">

<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="Milestone">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="Milestone">

<meta name="theme-color" content="#4C7FF0">


<!-- page stylesheets -->
<!-- end page stylesheets -->

<!-- build:css({.tmp,app}) styles/app.min.css -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/pace/themes/blue/pace-theme-minimal.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/font-awesome/css/font-awesome.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/animate.css/animate.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>styles/app.css" id="load_styles_before"/>
<link rel="stylesheet" href="<?php echo asset_url();?>styles/app.skins.css"/>
<!-- endbuild -->
</head>
<body>

<div class="app error-page no-padding no-footer layout-static">
<div class="session-panel">
<div class="session bg-success">
<div class="session-content text-xs-center">
<div>
<img src="<?php echo asset_url();?>images/sad face.svg" style="height:100px;width:100px">
<div class="error-number">

<strong>Sorry !</strong>
</div>
<div class="m-x-1 m-y-1">
<h6 class="text-uppercase">
<strong>Page is under construction!</strong>
</h6>
</div>
<a href="<?php echo base_url();?>admin/dashboard" class="btn btn-secondary btn-sm b-a-0">
Return to homepage
</a>
</div>
</div>
</div>
</div>
</div>



<!-- build:js({.tmp,app}) scripts/app.min.js -->
<script src="<?php echo asset_url();?>vendor/jquery/dist/jquery.js"></script>
<script src="<?php echo asset_url();?>vendor/pace/pace.js"></script>
<script src="<?php echo asset_url();?>vendor/tether/dist/js/tether.js"></script>
<script src="<?php echo asset_url();?>vendor/bootstrap/dist/js/bootstrap.js"></script>
<script src="<?php echo asset_url();?>vendor/fastclick/lib/fastclick.js"></script>
<script src="<?php echo asset_url();?>scripts/constants.js"></script>
<!-- endbuild -->

<!-- page scripts -->
<!-- end page scripts -->

<!-- initialize page scripts -->
<!-- end initialize page scripts -->

</body>
</html>
