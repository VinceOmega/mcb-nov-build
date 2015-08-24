<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>


<ul>
<?php foreach ($links as $title => $url): ?>
	<li><?php echo ($title === 'License') ? html::file_anchor($url, html::specialchars($title)) : html::anchor($url, html::specialchars($title)) ?></li>
<?php endforeach ?>


<?php 

$c = new Welcome_Controller;

$c->listusers(); ?>
</ul>