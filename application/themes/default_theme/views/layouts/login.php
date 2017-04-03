
<!doctype html>
<html lang="en">
  <head>
    <title><?php echo $template['title']; ?></title>
<meta charset="utf-8">
<meta name="google" content="Dispatcher management" />
<meta name="description" content="Fast & easy way to manage job.">
<meta name="keywords" content="dispatcher,job management">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-age=0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta itemprop="name" content="Dispatcher management | India's Most Reliable and Cost-Effective Job Mangement Solution">
<meta itemprop="description" content="Dispatcher management is easy and fast way to manage job.">
<meta itemprop="image" content="">
<meta property="og:title" content="Dispatcher management | India's Most Reliable and Cost-Effective Job Mangement Solution" />
<meta property="og:url" content="<?php echo current_url();?>" />
<meta property="og:type" content="website" />
<meta property="og:description" content="Dispatcher management is easy and fast way to manage job." />
<meta property="og:image" content="" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="Dispatcher management | India's Most Reliable and Cost-Effective Job Mangement Solution" />
<meta name="twitter:description" content="Dispatcher management is easy and fast way to manage job." />
<meta name="twitter:url" content="<?php echo current_url();?>" />
<link rel="stylesheet" href="<?php echo asset_url();?>styles/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>styles/app.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>styles/font-awesome/css/font-awesome.css"/>
<script type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
	var asset_url = '<?php echo asset_url();?>';
	var fbpage = '<?php echo $page;?>';
        
</script>
	<script src="<?php echo asset_url();?>script/jquery.js"></script>
	<script src="<?php echo asset_url();?>script/bootstrap.js"></script>
	<!-- <script src="<?php echo asset_url();?>script/main.js"></script> -->
  </head>
  <body>
    <div class="app">
      
      <!-- content panel -->
      <div class="main-panel">
        <!-- top header -->
      <?php echo $template['partials']['header']; ?>
        <!-- /top header -->

        <!-- main area -->
        <div class="main-content">
         <?php echo $template['body']; ?>
          <!-- bottom footer -->
          <?php //echo $template['partials']['footer']; ?>
          <!-- /bottom footer -->
        </div>
        <!-- /main area -->
      </div>
      <!-- /content panel -->

      
    </div>

   <script>
function ajaxindicatorstart(text)
{
	if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
	jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="<?php echo base_url();?>assets/images/icons/loading.gif" alt="Loading truck availability"><div>'+text+'</div></div><div class="bg"></div></div>');
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
