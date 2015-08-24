<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-10-24 18:53:52 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'mch.order_ids' doesn't exist - SELECT `orders`.*, `order_statuses`.`status_name`, `users`.`firstname`, `users`.`lastname`, `order_ids`.`id` AS `order_id`
FROM (`orders`)
LEFT JOIN `order_statuses` ON (`orders`.`statusID` = `order_statuses`.`id`)
LEFT JOIN `order_ids` ON (`orders`.`id` = `order_ids`.`order_id`)
LEFT JOIN `users` ON (`orders`.`userID` = `users`.`id`)
ORDER BY `date_created` DESC
LIMIT 0, 20 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
