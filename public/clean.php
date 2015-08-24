<?php
// clean up old orders that are a week or older and are 'Pending'
		$dat = time();
		$lastweek = $dat - 604800;
		$result = $db->query('DELETE FROM orders WHERE date_modified < '.$lastweek.' AND statusID = 1');


		?>