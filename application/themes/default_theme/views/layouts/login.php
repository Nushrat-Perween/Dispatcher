<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title>Dispatcher Login</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="<?php echo asset_url();?>css/font-awesome.min.css">
<script src="<?php echo asset_url();?>script/jquery.js"></script>
  <link rel="stylesheet" href="<?php echo asset_url();?>js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css">
<script src="<?php echo asset_url();?>js/libs/bootstrap.min.js"></script>
    <!-- App CSS -->
  <link rel="stylesheet" href="<?php echo asset_url();?>css/target-admin.css">
  <link rel="stylesheet" href="<?php echo asset_url();?>css/custom.css">

<script type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
	var asset_url = '<?php echo asset_url();?>';
	var fbpage = '<?php echo $page;?>';
        
</script>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body class="account-bg">
   <?php echo $template['partials']['header']; ?>
 <?php echo $template['body']; ?>

  <script src="<?php echo asset_url();?>js/libs/jquery-ui-1.9.2.custom.min.js"></script>
  

  <!--[if lt IE 9]>
  <script src="./js/libs/excanvas.compiled.js"></script>
  <![endif]-->
  <!-- App JS -->
  <script src="<?php echo asset_url();?>js/target-admin.js"></script>
  
  <!-- Plugin JS -->
  <script src="<?php echo asset_url();?>js/target-account.js"></script>

</body>
</html>


