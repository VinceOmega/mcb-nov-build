<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-11-28 03:16:50 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
								SELECT
									ob.designpath
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = 52 AND
									o.site_id = 1 AND
									o.statusID IN (2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 3 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-28 07:57:57 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1385038677 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-28 07:58:35 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1385038715 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-28 12:59:38 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
								SELECT
									ob.designpath
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = 23 AND
									o.site_id = 1 AND
									o.statusID IN (2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 3 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-28 13:40:30 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1385059230 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-28 13:55:30 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1385060130 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-28 14:10:30 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1385061030 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-28 23:53:03 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1385095983 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-28 23:53:28 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1385096008 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
