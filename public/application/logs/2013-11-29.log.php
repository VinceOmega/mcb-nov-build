<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-11-29 02:34:52 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
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
2013-11-29 02:58:11 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1385107091 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-29 03:32:27 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
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
2013-11-29 04:31:15 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
								SELECT
									ob.designpath
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = 4 AND
									o.site_id = 1 AND
									o.statusID IN (2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 3 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-29 05:29:25 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
								SELECT
									ob.designpath
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = 55 AND
									o.site_id = 1 AND
									o.statusID IN (2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 3 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-29 20:14:33 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
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
2013-11-29 20:22:14 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - DELETE FROM orders WHERE date_modified < 1385169734 AND statusID = 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-29 21:20:30 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
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
2013-11-29 21:39:58 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
								SELECT
									ob.designpath
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = 4 AND
									o.site_id = 1 AND
									o.statusID IN (2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 3 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-11-29 22:12:56 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: File './mch/orders.MYD' not found (Errcode: 13) - 	
								SELECT
									ob.designpath
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = 55 AND
									o.site_id = 1 AND
									o.statusID IN (2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 3 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
