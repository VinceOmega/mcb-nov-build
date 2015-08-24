<!doctype html>
<html>
	<head><title>JSON result from configurator</title></head>
	<body style="margin: 0; padding:0;">
		<div style="margin: 0 auto;">
			<code>
				<?php echo str_replace('\\"', '"', $_POST['data']); ?>
			</code>
		</div>
	</body>
</html>

