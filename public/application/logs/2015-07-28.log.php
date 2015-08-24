<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-07-28 01:24:28 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')
                            AND products.kind != 'MCH_GNG'' at line 5 - SELECT products_descriptions.*,products.* 
                            FROM products 
                            LEFT JOIN products_descriptions 
                            ON products.products_description_id = products_descriptions.id 
                            WHERE products.id IN ()
                            AND products.kind != 'MCH_GNG' in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-07-28 06:15:59 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  AND products.homepage = 1  ORDER BY products.id ASC' at line 1 - SELECT products.name, products.price, products_descriptions.*, products.id, products.unit, products.coins_per_bag, products.bars_per_box FROM products LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id WHERE products.id IN ()  AND products.homepage = 1  ORDER BY products.id ASC in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-07-28 06:32:03 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')
                            AND products.kind != 'MCH_GNG'' at line 5 - SELECT products_descriptions.*,products.* 
                            FROM products 
                            LEFT JOIN products_descriptions 
                            ON products.products_description_id = products_descriptions.id 
                            WHERE products.id IN ()
                            AND products.kind != 'MCH_GNG' in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-07-28 09:36:00 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')
                            AND products.kind != 'MCH_GNG'' at line 5 - SELECT products_descriptions.*,products.* 
                            FROM products 
                            LEFT JOIN products_descriptions 
                            ON products.products_description_id = products_descriptions.id 
                            WHERE products.id IN ()
                            AND products.kind != 'MCH_GNG' in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 374
2015-07-28 14:34:10 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, favicon.ico, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-07-28 21:30:18 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, info.php, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-07-28 21:30:18 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, favicon.ico, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2015-07-28 23:41:23 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, favicon.ico, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
