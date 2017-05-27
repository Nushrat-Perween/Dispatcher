<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title>Dispatcher</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="<?php echo asset_url();?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo asset_url();?>js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css">

  <!-- Plugin CSS -->


  <link rel="stylesheet" href="<?php echo asset_url();?>js/plugins/fullcalendar/fullcalendar.css">
  	<script type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
	var asset_url = '<?php echo asset_url();?>';
	var fbpage = '<?php echo $page;?>';
        
</script>
<script src="<?php echo asset_url();?>script/jquery.js"></script>
  <script src="<?php echo asset_url();?>js/libs/bootstrap.min.js"></script>
  <!-- App CSS -->
  <link rel="stylesheet" href="<?php echo asset_url();?>css/target-admin.css">
  <link rel="stylesheet" href="<?php echo asset_url();?>css/custom.css">


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body>
 <?php echo $template['partials']['header']; ?>

<?php echo $template['partials']['side_menu']; ?>
   <?php echo $template['body']; ?>
	          <!-- bottom footer -->
	        <?php echo $template['partials']['footer']; ?>



  
  <script src="<?php echo asset_url();?>js/libs/jquery-ui-1.9.2.custom.min.js"></script>


  <!--[if lt IE 9]>
  <script src="./js/libs/excanvas.compiled.js"></script>
  <![endif]-->

  <script src="<?php echo asset_url();?>js/plugins/fullcalendar/fullcalendar.min.js"></script>

  <!-- App JS -->
  <script src="<?php echo asset_url();?>js/target-admin.js"></script>
     <script>
   function ajaxindicatorstart(text)
   {
   	if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
   	jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="'+base_url+'assets/images/loading.gif"><div  id="loader_div">'+text+'</div></div><div class="bg"></div></div>');
   	}

   	jQuery('#resultLoading').css({
   		'width':'100%',
   		'height':'100%',
   		'position':'fixed',
   		'z-index':'10000000',
   		'top':'0',
   		'left':'0',
   		'right':'0',
   		'bottom':'0',
   		'margin':'auto'
   	});

   	jQuery('#resultLoading .bg').css({
   		'background':'#000000',
   		'opacity':'0.7',
   		'width':'100%',
   		'height':'100%',
   		'position':'absolute',
   		'top':'0'
   	});

   	jQuery('#resultLoading>div:first').css({
   		'width': '250px',
   		'height':'75px',
   		'text-align': 'center',
   		'position': 'fixed',
   		'top':'0',	
   		'left':'0',
   		'right':'0',
   		'bottom':'0',
   		'margin':'auto',
   		'font-size':'16px',
   		'z-index':'10',
   		'color':'#ffffff'

   	});

       jQuery('#resultLoading .bg').height('100%');
          jQuery('#resultLoading').fadeIn(300);
       jQuery('body').css('cursor', 'wait');
   }
   function ajaxindicatorstop()
   {
       jQuery('#resultLoading .bg').height('100%');
          jQuery('#resultLoading').fadeOut(300);
       jQuery('body').css('cursor', 'default');
   }


</script>
  </body>
</html>
