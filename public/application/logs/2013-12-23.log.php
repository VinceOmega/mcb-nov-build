<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-12-23 01:57:14 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1387177034 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-12-23 01:57:45 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1387177065 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-12-23 07:15:06 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1387196106 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-12-23 08:06:25 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
								SELECT
									ob.designpath
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = 2 AND
									o.site_id = 1 AND
									o.statusID IN (2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 3 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-12-23 13:56:52 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1387220212 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-12-23 13:57:21 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1387220241 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
