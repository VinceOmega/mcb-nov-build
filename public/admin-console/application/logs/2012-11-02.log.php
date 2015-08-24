<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-11-02 22:28:24 -04:00 --- error: Uncaught Kohana_Exception: The requested view, mcc/kohana/backend-template, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2012-11-02 22:32:08 -04:00 --- error: Uncaught Kohana_Exception: The requested view, mcc/header, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2012-11-02 22:34:26 -04:00 --- error: Uncaught Kohana_Exception: The requested view, mcc/header, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2012-11-02 22:34:28 -04:00 --- error: Uncaught Kohana_Exception: The requested view, mcc/header, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2012-11-02 22:34:29 -04:00 --- error: Uncaught Kohana_Exception: The requested view, mcc/kohana/backend-template, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2012-11-02 22:34:33 -04:00 --- error: Uncaught Kohana_Exception: The requested view, mcc/kohana/backend-template, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2012-11-02 22:35:02 -04:00 --- error: Uncaught Kohana_Exception: The requested view, mcc/kohana/backend-template, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2012-11-02 22:37:27 -04:00 --- error: Uncaught Kohana_Exception: The requested view, mcc/kohana/backend-template, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2012-11-02 22:38:07 -04:00 --- error: Uncaught PHP Error: strpos() [<a href='function.strpos'>function.strpos</a>]: Empty delimiter in file /var/www/mch/kohana_core/system/libraries/View.php on line 47
2012-11-02 22:38:58 -04:00 --- error: Uncaught Kohana_Exception: The requested view, kohana/backend-template, could not be found in file /var/www/mch/kohana_core/system/core/Kohana.php on line 1162
2012-11-02 22:40:03 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 22:40:03 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 22:40:09 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 22:40:10 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 22:41:43 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:10:30 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:10:34 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:10:53 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:10:57 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:11:03 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:11:06 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:11:19 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'sites_product.site_id' in 'where clause' - SELECT `products`.`id`, `products`.`name`, `products`.`price`, `products`.`status`, GROUP_CONCAT(DISTINCT categories.name) as categories, GROUP_CONCAT(DISTINCT s.shortname) as sites
FROM (`products`)
LEFT JOIN `categories_products` ON (`categories_products`.`product_id` = `products`.`id`)
LEFT JOIN `categories` ON (`categories`.`id` = `categories_products`.`category_id`)
LEFT JOIN `sites_product` AS `sp` ON (`sp`.`product_id` = `products`.`id`)
LEFT JOIN `sites` AS `s` ON (`s`.`id` = `sp`.`site_id`)
WHERE sites_product.site_id = "1"
GROUP BY `products`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:11:42 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'sites_product.site_id' in 'where clause' - SELECT `products`.`id`, `products`.`name`, `products`.`price`, `products`.`status`, GROUP_CONCAT(DISTINCT categories.name) as categories, GROUP_CONCAT(DISTINCT s.shortname) as sites
FROM (`products`)
LEFT JOIN `categories_products` ON (`categories_products`.`product_id` = `products`.`id`)
LEFT JOIN `categories` ON (`categories`.`id` = `categories_products`.`category_id`)
LEFT JOIN `sites_product` AS `sp` ON (`sp`.`product_id` = `products`.`id`)
LEFT JOIN `sites` AS `s` ON (`s`.`id` = `sp`.`site_id`)
WHERE sites_product.site_id = "1"
GROUP BY `products`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:11:57 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'sites_product.site_id' in 'where clause' - SELECT `products`.`id`, `products`.`name`, `products`.`price`, `products`.`status`, GROUP_CONCAT(DISTINCT categories.name) as categories, GROUP_CONCAT(DISTINCT s.shortname) as sites
FROM (`products`)
LEFT JOIN `categories_products` ON (`categories_products`.`product_id` = `products`.`id`)
LEFT JOIN `categories` ON (`categories`.`id` = `categories_products`.`category_id`)
LEFT JOIN `sites_product` AS `sp` ON (`sp`.`product_id` = `products`.`id`)
LEFT JOIN `sites` AS `s` ON (`s`.`id` = `sp`.`site_id`)
WHERE sites_product.site_id = "1"
GROUP BY `products`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:12:07 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'sites_product.site_id' in 'where clause' - SELECT `products`.`id`, `products`.`name`, `products`.`price`, `products`.`status`, GROUP_CONCAT(DISTINCT categories.name) as categories, GROUP_CONCAT(DISTINCT s.shortname) as sites
FROM (`products`)
LEFT JOIN `categories_products` ON (`categories_products`.`product_id` = `products`.`id`)
LEFT JOIN `categories` ON (`categories`.`id` = `categories_products`.`category_id`)
LEFT JOIN `sites_product` AS `sp` ON (`sp`.`product_id` = `products`.`id`)
LEFT JOIN `sites` AS `s` ON (`s`.`id` = `sp`.`site_id`)
WHERE sites_product.site_id = "1"
GROUP BY `products`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:14:03 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'sites_product.site_id' in 'where clause' - SELECT `products`.`id`, `products`.`name`, `products`.`price`, `products`.`status`, GROUP_CONCAT(DISTINCT categories.name) as categories, GROUP_CONCAT(DISTINCT s.shortname) as sites
FROM (`products`)
LEFT JOIN `categories_products` ON (`categories_products`.`product_id` = `products`.`id`)
LEFT JOIN `categories` ON (`categories`.`id` = `categories_products`.`category_id`)
LEFT JOIN `sites_product` AS `sp` ON (`sp`.`product_id` = `products`.`id`)
LEFT JOIN `sites` AS `s` ON (`s`.`id` = `sp`.`site_id`)
WHERE categories_products.category_id = "1" AND sites_product.site_id = "1"
GROUP BY `products`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:14:13 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'sites_product.site_id' in 'where clause' - SELECT `products`.`id`, `products`.`name`, `products`.`price`, `products`.`status`, GROUP_CONCAT(DISTINCT categories.name) as categories, GROUP_CONCAT(DISTINCT s.shortname) as sites
FROM (`products`)
LEFT JOIN `categories_products` ON (`categories_products`.`product_id` = `products`.`id`)
LEFT JOIN `categories` ON (`categories`.`id` = `categories_products`.`category_id`)
LEFT JOIN `sites_product` AS `sp` ON (`sp`.`product_id` = `products`.`id`)
LEFT JOIN `sites` AS `s` ON (`s`.`id` = `sp`.`site_id`)
WHERE categories_products.category_id = "1" AND sites_product.site_id = "1"
GROUP BY `products`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:17:08 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:17:09 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:18:51 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:18:59 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Column 'name' in where clause is ambiguous - SELECT `occasions`.`id`, `occasions`.`name`, `occasions`.`headline`, `occasions_descriptions`.`description`, `occasions_descriptions`.`short_description`, GROUP_CONCAT(sites.shortname) as sites
FROM (`occasions`)
JOIN `occasions_descriptions` ON (`occasions`.`occasions_description_id` = `occasions_descriptions`.`id`)
LEFT JOIN `sites_occasions` ON (`sites_occasions`.`occasion_id` = `occasions`.`id`)
LEFT JOIN `sites` ON (`sites`.`id` = `sites_occasions`.`site_id`)
WHERE name LIKE "we%"
GROUP BY `occasions`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:19:02 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Column 'name' in where clause is ambiguous - SELECT `occasions`.`id`, `occasions`.`name`, `occasions`.`headline`, `occasions_descriptions`.`description`, `occasions_descriptions`.`short_description`, GROUP_CONCAT(sites.shortname) as sites
FROM (`occasions`)
JOIN `occasions_descriptions` ON (`occasions`.`occasions_description_id` = `occasions_descriptions`.`id`)
LEFT JOIN `sites_occasions` ON (`sites_occasions`.`occasion_id` = `occasions`.`id`)
LEFT JOIN `sites` ON (`sites`.`id` = `sites_occasions`.`site_id`)
WHERE name LIKE "we%"
GROUP BY `occasions`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:19:06 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Column 'name' in where clause is ambiguous - SELECT `occasions`.`id`, `occasions`.`name`, `occasions`.`headline`, `occasions_descriptions`.`description`, `occasions_descriptions`.`short_description`, GROUP_CONCAT(sites.shortname) as sites
FROM (`occasions`)
JOIN `occasions_descriptions` ON (`occasions`.`occasions_description_id` = `occasions_descriptions`.`id`)
LEFT JOIN `sites_occasions` ON (`sites_occasions`.`occasion_id` = `occasions`.`id`)
LEFT JOIN `sites` ON (`sites`.`id` = `sites_occasions`.`site_id`)
WHERE name LIKE "we%"
GROUP BY `occasions`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:20:36 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Column 'name' in where clause is ambiguous - SELECT `occasions`.`id`, `occasions`.`name`, `occasions`.`headline`, `occasions_descriptions`.`description`, `occasions_descriptions`.`short_description`, GROUP_CONCAT(sites.shortname) as sites
FROM (`occasions`)
JOIN `occasions_descriptions` ON (`occasions`.`occasions_description_id` = `occasions_descriptions`.`id`)
LEFT JOIN `sites_occasions` ON (`sites_occasions`.`occasion_id` = `occasions`.`id`)
LEFT JOIN `sites` ON (`sites`.`id` = `sites_occasions`.`site_id`)
WHERE name LIKE "we%"
GROUP BY `occasions`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:20:46 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Column 'name' in where clause is ambiguous - SELECT `occasions`.`id`, `occasions`.`name`, `occasions`.`headline`, `occasions_descriptions`.`description`, `occasions_descriptions`.`short_description`, GROUP_CONCAT(sites.shortname) as sites
FROM (`occasions`)
JOIN `occasions_descriptions` ON (`occasions`.`occasions_description_id` = `occasions_descriptions`.`id`)
LEFT JOIN `sites_occasions` ON (`sites_occasions`.`occasion_id` = `occasions`.`id`)
LEFT JOIN `sites` ON (`sites`.`id` = `sites_occasions`.`site_id`)
WHERE name LIKE "we%"
GROUP BY `occasions`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:23:12 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:23:13 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:23:25 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:23:28 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'sites_testimonials.site_id' in 'where clause' - SELECT `t`.`id`, `t`.`name`, `t`.`location`, `t`.`headline`, `t`.`description`, GROUP_CONCAT(s.shortname) as sites
FROM (`testimonials` AS `t`)
LEFT JOIN `sites_testimonials` AS `st` ON (`st`.`testimonial_id` = `t`.`id`)
LEFT JOIN `sites` AS `s` ON (`s`.`id` = `st`.`site_id`)
WHERE sites_testimonials.site_id = "1"
GROUP BY `t`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:23:34 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'sites_testimonials.site_id' in 'where clause' - SELECT `t`.`id`, `t`.`name`, `t`.`location`, `t`.`headline`, `t`.`description`, GROUP_CONCAT(s.shortname) as sites
FROM (`testimonials` AS `t`)
LEFT JOIN `sites_testimonials` AS `st` ON (`st`.`testimonial_id` = `t`.`id`)
LEFT JOIN `sites` AS `s` ON (`s`.`id` = `st`.`site_id`)
WHERE sites_testimonials.site_id = "1"
GROUP BY `t`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:24:49 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'testimonials' in 'where clause' - SELECT `testimonials`.`id`, `testimonials`.`name`, `testimonials`.`location`, `testimonials`.`headline`, `testimonials`.`description`, GROUP_CONCAT(sites.shortname) as sites
FROM (`testimonials`)
LEFT JOIN `sites_testimonials` ON (`sites_testimonials`.`testimonial_id` = `testimonials`.`id`)
LEFT JOIN `sites` ON (`sites`.`id` = `sites_testimonials`.`site_id`)
WHERE testimonials LIKE "pa%" AND sites_testimonials.site_id = "1"
GROUP BY `testimonials`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:24:52 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:24:53 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:24:58 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'testimonials' in 'where clause' - SELECT `testimonials`.`id`, `testimonials`.`name`, `testimonials`.`location`, `testimonials`.`headline`, `testimonials`.`description`, GROUP_CONCAT(sites.shortname) as sites
FROM (`testimonials`)
LEFT JOIN `sites_testimonials` ON (`sites_testimonials`.`testimonial_id` = `testimonials`.`id`)
LEFT JOIN `sites` ON (`sites`.`id` = `sites_testimonials`.`site_id`)
WHERE testimonials LIKE "bar%" AND sites_testimonials.site_id = "1"
GROUP BY `testimonials`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:25:06 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'testimonials' in 'where clause' - SELECT `testimonials`.`id`, `testimonials`.`name`, `testimonials`.`location`, `testimonials`.`headline`, `testimonials`.`description`, GROUP_CONCAT(sites.shortname) as sites
FROM (`testimonials`)
LEFT JOIN `sites_testimonials` ON (`sites_testimonials`.`testimonial_id` = `testimonials`.`id`)
LEFT JOIN `sites` ON (`sites`.`id` = `sites_testimonials`.`site_id`)
WHERE testimonials LIKE "bar%" AND sites_testimonials.site_id = "1"
GROUP BY `testimonials`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:25:40 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:25:42 -04:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'sites_types.site_id' in 'where clause' - SELECT `products_types`.`id`, `products_types`.`name`, `products_types`.`products_types_description_id`, `categories`.`name` AS `category`, GROUP_CONCAT(s.shortname) as sites
FROM (`products_types`)
LEFT JOIN `categories` ON (`categories`.`id` = `products_types`.`category_id`)
LEFT JOIN `sites_types` AS `spt` ON (`spt`.`type_id` = `products_types`.`id`)
LEFT JOIN `sites` AS `s` ON (`s`.`id` = `spt`.`site_id`)
WHERE sites_types.site_id = "1"
GROUP BY `products_types`.`id`
ORDER BY `id` ASC
LIMIT 0, 10 in file /var/www/mch/kohana_core/system/libraries/drivers/Database/Mysql.php on line 371
2012-11-02 23:36:31 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:36:32 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:36:34 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:37:18 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:37:19 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:37:32 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:37:32 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
2012-11-02 23:37:40 -04:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/js/grid.locale.js, could not be found. in file /var/www/mch/kohana_core/system/core/Kohana.php on line 841
