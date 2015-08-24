<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<ul>
<?php foreach ($links as $title => $url): ?>
	<li><?php echo html::anchor($url, html::specialchars($title)) ?></li>
<?php endforeach ?>
	<li><a href="http://logout@<?=$_SERVER['SERVER_NAME']?>/admin-console">Logout</a></li>
</ul>