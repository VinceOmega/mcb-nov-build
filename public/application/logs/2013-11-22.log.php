<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-11-22 03:00:21 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - SHOW COLUMNS FROM `orders` in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 04:23:17 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
								SELECT
									ob.designpath
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = 49 AND
									o.site_id = 1 AND
									o.statusID IN (2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 3 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 05:21:29 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - SHOW COLUMNS FROM `orders` in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 05:21:40 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1384510900 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 11:54:28 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1384534468 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 11:54:37 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1384534477 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 13:19:50 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1384539590 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 16:08:18 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
								SELECT
									ob.designpath
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = 3 AND
									o.site_id = 1 AND
									o.statusID IN (2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 3 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 16:38:40 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1384551520 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 20:56:58 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1384567018 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 21:50:51 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1384570251 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-22 21:51:00 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1384570260 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
