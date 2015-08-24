<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-03-04 12:53:59 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'Robot Programming,
							address1 = 7106 Rising Sun Ave 2nd FL,
							address2' at line 5 - INSERT into user_billing_infos
							SET user_id = 0, 
							firstname = Larry,
							lastname = Stanfield,
							company = Red Robot Programming,
							address1 = 7106 Rising Sun Ave 2nd FL,
							address2 = ,
							city = Philadelphia,
							state = PA,
							zip = 19111,
							country = 1,
							phone1 = 2158475012,
							phone2 = 2158475012
							 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-03-04 13:05:33 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'Robot Programming,
							address1 = 7106 Rising Sun Ave 2nd FL,
							address2' at line 5 - INSERT into user_billing_infos
							SET user_id = 0, 
							firstname = Larry,
							lastname = Stanfield,
							company = Red Robot Programming,
							address1 = 7106 Rising Sun Ave 2nd FL,
							address2 = none,
							city = Philadelphia,
							state = PA,
							zip = 19111,
							country = 1,
							phone1 = 2158475012,
							phone2 = none
							 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-03-04 13:10:12 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Duplicate entry 'vince.omega@gmail.com' for key 'uniq_email' - INSERT INTO `users` (`email`, `password`, `firstname`, `lastname`, `company`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone1`, `phone2`) VALUES ('vince.omega@gmail.com', '948390a65949d661b771895c66e5fc3e', 'Larry', 'Stanfield', 'Red Robot Programming', '7106 Rising Sun Ave 2nd FL', '', 'Philadelphia', 'PA', '19111', '1', '2158475012', '') in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-03-04 13:17:35 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Duplicate entry 'vince.omega@gmail.com' for key 'uniq_email' - INSERT INTO `users` (`email`, `password`, `firstname`, `lastname`, `company`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone1`, `phone2`) VALUES ('vince.omega@gmail.com', '948390a65949d661b771895c66e5fc3e', 'Larry', 'Stanfield', 'Red Robot Programming', '7106 Rising Sun Ave 2nd FL', '', 'Philadelphia', 'PA', '19111', '1', '2158475012', '') in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-03-04 13:39:16 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'mch.user' doesn't exist - SELECT id
								  FROM user
								  WHERE email = 'Vince.Omega@gmail.com' in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-03-04 13:40:26 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'mch.user' doesn't exist - SELECT id
								  FROM user
								  WHERE email = 'Vince.Omega@gmail.com' in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-03-04 13:40:54 -05:00 --- error: Uncaught PHP Error: Object of class Mysql_Result could not be converted to string in file application/controllers/customers.php on line 396
2015-03-04 13:42:55 -05:00 --- error: Uncaught PHP Error: Object of class Mysql_Result could not be converted to string in file application/controllers/customers.php on line 396
2015-03-04 14:05:50 -05:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Duplicate entry 'Vince.Omega@gmail.com' for key 'uniq_email' - INSERT INTO `users` (`email`, `password`, `firstname`, `lastname`, `company`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone1`, `phone2`) VALUES ('Vince.Omega@gmail.com', '948390a65949d661b771895c66e5fc3e', 'Larry', 'Stanfield', 'We R Wireless - August', '7106 Rising Sun Ave 2nd FL', '', 'Philadelphia', 'PA', '19111', '1', '2158475012', '2158475012') in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-03-04 14:10:14 -05:00 --- error: Uncaught PHP Error: Object of class stdClass could not be converted to string in file application/controllers/customers.php on line 398
2015-03-04 14:12:29 -05:00 --- error: Uncaught PHP Error: Object of class stdClass could not be converted to string in file application/controllers/customers.php on line 398
2015-03-04 14:13:04 -05:00 --- error: Uncaught PHP Error: Object of class stdClass could not be converted to string in file application/controllers/customers.php on line 385
2015-03-04 14:13:25 -05:00 --- error: Uncaught PHP Error: Object of class stdClass could not be converted to string in file application/controllers/customers.php on line 385
2015-03-04 14:15:25 -05:00 --- error: Uncaught PHP Error: mysql_fetch_row() expects parameter 1 to be resource, object given in file application/controllers/customers.php on line 385
2015-03-04 14:15:48 -05:00 --- error: Uncaught PHP Error: mysql_fetch_row() expects parameter 1 to be resource, object given in file application/controllers/customers.php on line 385
2015-03-04 14:17:00 -05:00 --- error: Uncaught PHP Error: Object of class stdClass could not be converted to string in file application/controllers/customers.php on line 387
2015-03-04 14:19:20 -05:00 --- error: Uncaught PHP Error: Object of class stdClass could not be converted to string in file application/controllers/customers.php on line 387
2015-03-04 14:19:51 -05:00 --- error: Uncaught Kohana_Exception: The requested view, mch/kohana_profiler, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2015-03-04 14:31:48 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, customer/login, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 14:43:25 -05:00 --- error: Uncaught Kohana_Exception: Invalid method hash_password called in User_Model in file /var/www/mch/kohana_core/system/libraries/ORM.php on line 257
2015-03-04 14:57:53 -05:00 --- error: Uncaught Kohana_Exception: The requested config file, auth, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2015-03-04 17:00:28 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/tea-n-bars-sm.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:00:29 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/basket.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:44 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/basket.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:44 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/tea-n-bars-sm.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:53 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/tea-n-bars-sm.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:53 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/basket.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:53 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/tea-n-bars-sm.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:53 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/basket.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:59 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/tea-n-bars-sm.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:59 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/basket.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:59 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/tea-n-bars-sm.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 17:20:59 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/basket.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 19:54:01 -05:00 --- error: Uncaught Kohana_Exception: The requested view, mch/kohana_profiler, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2015-03-04 20:35:06 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/basket.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 20:35:07 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, img/tea-n-bars-sm.png, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 20:45:02 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, favicon.ico, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-03-04 23:58:39 -05:00 --- error: Uncaught Kohana_404_Exception: The page you requested, favicon.ico, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
