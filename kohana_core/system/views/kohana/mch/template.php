<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="google-site-verification" content="ZVy8D7AVVpaJ9DUI_Ve3r5Hyd5rCQJODyJxIURd0YE8" />
<meta name="msvalidate.01" content="766685CAD68FBF0B652B9829A11CA078" />
<link rel="canonical" href="http://mychocolatehearts.com"/>
<link rel="icon" href="/env/images/<?=My_Template_Controller::getViewPrefix()?>/favicon.ico" />

<?php if(!$metaDescription){$metaDescription='';} if(!$metaKeywords){$metaKeywords='';} ?>
<meta name="description" content="<?php echo html::specialchars($metaDescription) ?>" />
<meta name="keywords" content="<?php echo html::specialchars($metaKeywords) ?>">
<meta name="title" content="<?php echo html::specialchars($metaTitle) ?>" />
<title><?php echo html::specialchars($title) ?></title>
<link rel="canonical" href="http://mychocolatehearts.com/">
	<link rel="stylesheet" type="text/css" href="/env/css/<?=My_Template_Controller::getViewPrefix()?>/style.css" />
<link rel="stylesheet" href="/env/css/jquery-ui-css.css" />
<link rel="stylesheet" href="/env/css/highslide.css" />
<link rel="stylesheet" href="/env/css/imageScroller.css">
<script type="text/javascript" src="/env/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/env/js/slides.min.jquery.js"></script>
<script type="text/javascript" src="/env/js/tabs.js"></script>
<script type="text/javascript" src="/env/js/grid.locale-en.js"></script>
<script type="text/javascript" src="/env/js/jquery.jqGrid.min.js"></script>
<script type="text/javascript" src="/env/js/common.js"></script>
<script type="text/javascript" src="/env/js/ui.datepicker.js"></script>
<script type="text/javascript" src="/env/js/highslide.js"></script>
<script type="text/javascript" src="/env/js/jquery-ui-1.8.19.custom.min.js"></script>

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
<script>
	$(function(){
		$(".tabs").tabs();
	});
</script>
</head>

<body>

	<?php echo $header; ?>
	
	<?php echo $content; ?>

	<?php echo $footer; ?>
	
</body>
</html>