<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-02-05 18:00:19 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:00:20 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:04:11 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:04:11 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:27:32 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:27:32 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:27:39 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:27:40 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:27:42 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:27:43 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:27:45 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:27:45 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:28:03 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:28:04 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:28:04 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'FROM (`orders`)
LEFT JOIN `order_statuses` ON (`orders`.`statusID` = `order_stat' at line 2 - SELECT `orders`.*, `order_statuses`.`status_name`, `sites`.`shortname`, `users`.`firstname`, `users`.`lastname`, CONCAT(sites.shortname, `1000+order_ids`.`id` AS `order_id`
FROM (`orders`)
LEFT JOIN `order_statuses` ON (`orders`.`statusID` = `order_statuses`.`id`)
LEFT JOIN `sites` ON (`orders`.`site_id` = `sites`.`id`)
LEFT JOIN `order_ids` ON (`orders`.`id` = `order_ids`.`order_id`)
LEFT JOIN `users` ON (`orders`.`user_id` = `users`.`id`)
ORDER BY `date_created` DESC
LIMIT 0, 20 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-02-05 18:28:11 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:28:12 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:28:13 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'FROM (`orders`)
LEFT JOIN `order_statuses` ON (`orders`.`statusID` = `order_stat' at line 2 - SELECT `orders`.*, `order_statuses`.`status_name`, `sites`.`shortname`, `users`.`firstname`, `users`.`lastname`, CONCAT(sites.shortname, `1000+order_ids`.`id` AS `order_id`
FROM (`orders`)
LEFT JOIN `order_statuses` ON (`orders`.`statusID` = `order_statuses`.`id`)
LEFT JOIN `sites` ON (`orders`.`site_id` = `sites`.`id`)
LEFT JOIN `order_ids` ON (`orders`.`id` = `order_ids`.`order_id`)
LEFT JOIN `users` ON (`orders`.`user_id` = `users`.`id`)
ORDER BY `date_created` DESC
LIMIT 0, 20 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-02-05 18:28:39 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:28:41 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:28:42 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'FROM (`orders`)
LEFT JOIN `order_statuses` ON (`orders`.`statusID` = `order_stat' at line 2 - SELECT `orders`.*, `order_statuses`.`status_name`, `sites`.`shortname`, `users`.`firstname`, `users`.`lastname`, CONCAT(sites.shortname, `1000+order_ids`.`id)` AS `order_id`
FROM (`orders`)
LEFT JOIN `order_statuses` ON (`orders`.`statusID` = `order_statuses`.`id`)
LEFT JOIN `sites` ON (`orders`.`site_id` = `sites`.`id`)
LEFT JOIN `order_ids` ON (`orders`.`id` = `order_ids`.`order_id`)
LEFT JOIN `users` ON (`orders`.`user_id` = `users`.`id`)
ORDER BY `date_created` DESC
LIMIT 0, 20 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-02-05 18:32:50 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-02-05 18:32:52 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
