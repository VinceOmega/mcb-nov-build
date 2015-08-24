<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-04-10 12:44:53 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 12:58:14 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 13:06:53 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 13:28:15 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Illegal mix of collations (latin1_swedish_ci,IMPLICIT) and (utf8_general_ci,COERCIBLE) for operation 'like' - SELECT `products`.`id`, `products`.`name`, `products`.`status`, `products`.`kind`, GROUP_CONCAT(DISTINCT categories.name) as categories
FROM (`products`)
LEFT JOIN `categories_products` ON (`categories_products`.`product_id` = `products`.`id`)
LEFT JOIN `categories` ON (`categories`.`id` = `categories_products`.`category_id`)
WHERE kind LIKE "МСС%"
GROUP BY `products`.`id`
ORDER BY `id` DESC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2013-04-10 14:11:09 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 14:13:51 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 14:14:01 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 14:14:31 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 14:23:47 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 14:23:52 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 14:31:57 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 14:45:00 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 17:15:49 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 17:21:54 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 17:23:12 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 17:25:35 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 17:25:50 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2013-04-10 17:34:40 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
