<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="google-site-verification" content="ZVy8D7AVVpaJ9DUI_Ve3r5Hyd5rCQJODyJxIURd0YE8" />
<meta name="msvalidate.01" content="766685CAD68FBF0B652B9829A11CA078" />
<link rel="canonical" href="http://mychocolatebars.com"/>
<link rel="icon" href="/env/images/<?=My_Template_Controller::getViewPrefix()?>/favicon.ico" />

<?php if(!$metaDescription){$metaDescription='';} if(!$metaKeywords){$metaKeywords='';} ?>
<meta name="description" content="<?php echo html::specialchars($metaDescription) ?>" />
<meta name="keywords" content="<?php echo html::specialchars($metaKeywords) ?>">
<meta name="title" content="<?php echo html::specialchars($metaTitle) ?>" />
<meta http-equiv="pragma" content="no-cache" /> 
<title><?php echo html::specialchars($title) ?></title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

<link rel="canonical" href="http://mychocolatebars.com/">
<link rel="stylesheet" href="/env/css/<?=My_Template_Controller::getViewPrefix()?>/normalize.css"/>
<link rel="stylesheet" href="/env/css/<?=My_Template_Controller::getViewPrefix()?>/bootstrap-theme.min.css"/>
<link rel="stylesheet" href="/env/css/<?=My_Template_Controller::getViewPrefix()?>/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="/env/css/<?=My_Template_Controller::getViewPrefix()?>/style.css" />
<link rel="stylesheet" href="/env/css/jquery-ui-css.css" />
<link rel="stylesheet" href="/env/css/highslide.css" />
<link rel="stylesheet" href="/env/css/imageScroller.css">
<link rel="stylesheet" href="/env/css/vendor/responsiveslides.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33965822-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script src="/env/js/AC_RunActiveContent.js"></script>

</head>

<body>

	<?php echo $header; ?>
	
	<?php echo $content; ?>

	<?php echo $footer; ?>

<script type="text/javascript" src="/env/js/slides.min.jquery.js"></script>
<script type="text/javascript" src="/env/js/tabs.js"></script>
<script type="text/javascript" src="/env/js/grid.locale-en.js"></script>
<script type="text/javascript" src="/env/js/jquery.jqGrid.min.js"></script>
<script type="text/javascript" src="/env/js/common.js"></script>
<script type="text/javascript" src="/env/js/ui.datepicker.js"></script>
<script type="text/javascript" src="/env/js/highslide.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-placeholder/2.0.8/jquery.placeholder.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
<srcipt src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></srcipt>
<script src="/env/html5_configurator/jquery-fileupload.min.js"></script>
<script src="/env/html5_configurator/jquery.bxslider.min.js"></script>
<script src="/env/js/draggable_background.js"></script>
<script src="/env/js/vendor/responsiveslides.js"></script>
<script src="/env/js/script.js"></script>
</body>
<script>
	$('body').load(function(){
		$(".tabs").tabs();
	});
</script>
</html>