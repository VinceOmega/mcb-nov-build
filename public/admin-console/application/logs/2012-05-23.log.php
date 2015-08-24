<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-05-23 23:18:08 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-05-23 23:18:18 -04:00 --- error: Uncaught PHP Error: Missing argument 1 for Occasion_info::find(), called in /var/www/mch/public/admin-console/application/controllers/occasions.php on line 190 and defined in file /var/www/mch/kohana_core/modules/cart/models/occasion.php on line 7
2012-05-23 23:22:51 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-05-23 23:23:00 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Column 'id' in where clause is ambiguous - SELECT `occasions`.*, `occasions_description`.`id` AS `occasions_description:id`, `occasions_description`.`description` AS `occasions_description:description`, `occasions_description`.`short_description` AS `occasions_description:short_description`, `occasions_description`.`meta_title` AS `occasions_description:meta_title`, `occasions_description`.`meta_description` AS `occasions_description:meta_description`, `occasions_description`.`meta_keywords` AS `occasions_description:meta_keywords`, `occasions_description`.`title_url` AS `occasions_description:title_url`, `occasions_description`.`image` AS `occasions_description:image`, `occasions_description`.`image_alt` AS `occasions_description:image_alt`
FROM (`occasions`)
LEFT JOIN `occasions_descriptions` AS `occasions_description` ON (`occasions_description`.`id` = `occasions`.`occasions_description_id`)
WHERE `id` = '23'
AND `occasions`.`id` = '23'
ORDER BY `occasions`.`id` ASC
LIMIT 0, 1 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-05-23 23:23:45 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-05-23 23:23:52 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
