<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<html>
  <head>
		
	<?php
	echo html::stylesheet(array	('media/css/style',
								'media/css/tabs',
								'media/css/ui-lightness/jquery.ui.all',
								'media/css/ui.jqgrid.css'),
						  array ('screen',
								'screen',
								'screen',
								'screen')
						, FALSE);
											 	
	echo html::script(array ('http://code.jquery.com/jquery-1.4.2.js', 'media/js/tabs'), FALSE);
	echo html::script(array (url::base().'media/js/grid.locale-en.js', 'media/js/grid.locale'), FALSE);		
	echo html::script(array (url::base().'media/js/jquery.jqGrid.min.js'), FALSE);
	echo html::script(array (url::base().'media/js/common.js'), FALSE);	
	?>

	<title><?php  echo $title; echo $this->uri->segment(1); ?></title>
  </head>
  	<h1>Welcome to Our Online Store&#039;s back end!</h1>
	
<ul class="menu">
	<li><a href="<?php echo url::base()?>">Dashboard</a></li>
	<li><a href="<?php echo url::base()?>products">Products</a></li>
	<li><a href="<?php echo url::base()?>packagings">Packagings</a></li>
	<li><a href="<?php echo url::base()?>categories">Categories</a></li>
	<li><a href="<?php echo url::base()?>occasions">Occasions</a></li>
	<li><a href="<?php echo url::base()?>testimonials">Testimonials</a></li>
	<li><a href="<?php echo url::base()?>types">Product types</a></li>
	<li><a href="<?php echo url::base()?>orders">Orders</a></li>
	<li><a href="<?php echo url::base()?>customers">Customers</a></li>
	<li><a href="<?php echo url::base()?>events">Events</a></li>	
	<li><a href="<?php echo url::base()?>customer_designs">Customer Designs</a></li>	
	<li><a href="<?php echo url::base()?>reports/sales">Sales report</a></li>	
	<li><a href="<?php echo url::base()?>sites">Sites</a></li>
	<li><a href="<?php echo url::base()?>slides">Slider</a></li>
<!-- 	<li><a href="<?php echo url::base()?>slider">MCB Slideshow</a></li>
 -->
<?	if ($_SERVER['PHP_AUTH_USER'] == 'mch_superadmin') { ?>
	<li><a href="<?php echo url::base()?>articles">Articles</a></li>
<?	} ?>
	<li><a href="http://logout@<?=$_SERVER['SERVER_NAME']?>/admin-console">Logout</a></li>
</ul>

