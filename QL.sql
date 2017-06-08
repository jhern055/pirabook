-- -- Nuevas promociones:
-- -- AXS TV: $150 x mes
-- -- PrepaidTV: $150 x mes
-- -- Roku TV: $150 x mes
-- -- Pix: $200 x mes
-- -- Pix: $500 x 3 meses
-- -- Mach TV: $200 x mes
-- -- Mach TV: $500 x 3 meses
-- -- 1Prime: $150 x mes
-- -- Roku NEW: $150 x mes
-- -- CloudTV: $350 x mes
-- -- CloudTV: $1800 x 6 meses
-- -- Undermedia: $1800 x 6 meses
-- -- Freedom: $150 x mes
-- -- LigaMX: (solo deportes) $100 x mes
-- -- En cualquier canal x $50 pesos mas llévate Liga MX

-- INSERT INTO `pirabook_pirabook`.`publications_categories` (`id`, `photo`, `name`, `registred_by`, `registred_on`, `updated_by`, `updated_on`) VALUES (NULL, 'streaming.png', 'Streaming', '0', '2015-02-02 00:00:00', '0', '0000-00-00 00:00:00');
-- ALTER TABLE  `modules` ADD  `enabled` TINYINT NOT NULL AFTER  `parentid` ;

-- CREATE TABLE `cinepixi_file` (
--   `id` int(11) NOT NULL,
--   `file_name` text NOT NULL,
--   `resolution` int(11) NOT NULL,
--   `pathFile_id` int(11) NOT NULL
-- ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- CREATE TABLE `cinepixi_movie` (
--   `id` int(11) NOT NULL,
--   `name` char(128) NOT NULL,
--   `pathFile_id` int(11) NOT NULL,
--   `category_id` int(11) NOT NULL,
--   `registred_by` int(11) NOT NULL,
--   `registred_on` datetime NOT NULL,
--   `updated_by` int(11) NOT NULL,
--   `updated_on` datetime NOT NULL
-- ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- CREATE TABLE `cinepixi_movie_category` (
--   `id` int(11) NOT NULL,
--   `name` char(128) NOT NULL,
--   `parentid` int(11) NOT NULL,
--   `registred_by` int(11) NOT NULL,
--   `registred_on` datetime NOT NULL,
--   `updated_by` int(11) NOT NULL,
--   `updated_on` datetime NOT NULL
-- ) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- CREATE TABLE `cinepixi_pathFile` (
--   `id` int(11) NOT NULL,
--   `name` text COLLATE utf8_unicode_ci NOT NULL,
--   `link` text COLLATE utf8_unicode_ci NOT NULL,
--   `real_path` text COLLATE utf8_unicode_ci NOT NULL,
--   `file` int(11) NOT NULL,
--   `parentid` int(11) NOT NULL,
--   `registred_by` int(11) NOT NULL,
--   `registred_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
--   `updated_by` int(11) NOT NULL,
--   `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
-- ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ALTER TABLE `cinepixi_file`
--   ADD PRIMARY KEY (`id`);

-- ALTER TABLE `cinepixi_movie`
--   ADD PRIMARY KEY (`id`);

-- ALTER TABLE `cinepixi_movie_category`
--   ADD PRIMARY KEY (`id`);

-- ALTER TABLE `cinepixi_pathFile`
--   ADD PRIMARY KEY (`id`);


-- INSERT INTO `modules` (`id`, `class`, `name`, `link`, `parentid`, `enabled`, `registred_by`, `registred_on`, `updated_by`, `updated_on`) VALUES
-- (null, '', 'Cinevelo', 'cinepixi/', 0, 0, 0, '2015-10-08 00:00:00', 0, '0000-00-00 00:00:00'),
-- (null, 'movie', 'Peliculas', 'cinepixi/movie/', 26, 0, 0, '2015-10-08 00:00:00', 0, '0000-00-00 00:00:00'),
-- (null, '', 'Categorias', 'cinepixi/movie/category/', 27, 0, 0, '2016-06-26 00:00:00', 0, '0000-00-00 00:00:00'),
-- (null, '', 'Paths Files', 'cinepixi/pathFile/', 26, 0, 0, '2016-06-22 00:00:00', 0, '0000-00-00 00:00:00');

-- UPDATE `users` SET `rights` = 'pirabook/read,publication/read,read,publication/update,publication/link/update,publication/insert,publication/delete,cinepixi/read,cinepixi/movie/delete,cinepixi/movie/insert,cinepixi/movie/update,cinepixi/movie/read,cinepixi/movie/category/read,cinepixi/movie/category/insert,cinepixi/movie/category/update,cinepixi/movie/category/delete,cinepixi/pathFile/read,cinepixi/pathFile/insert,cinepixi/pathFile/delete,cinepixi/pathFile/update,' WHERE `users`.`id` = 2;
-- ALTER TABLE `publications` ADD `like_sure` TINYINT NOT NULL AFTER `gif`;
-- ALTER TABLE `publications` CHANGE `like_sure` `like_sure` TINYINT(1) NOT NULL
-- ALTER TABLE `publications` ADD `is_sale` TINYINT(1) NOT NULL AFTER `url_facebook`;

-- ALTER TABLE `publications` ADD `stockMty` INT NOT NULL AFTER `description`;


-- -- local
-- -- ALTER TABLE `publications_hosting_server_link` ADD `hosting_servers_id` INT NOT NULL AFTER `publications_hosting_server_id`;
-- -- UPDATE `publications_hosting_server_link` SET `hosting_servers_id` = '6';
-- -- DELETE FROM `publications_hosting_server_link` WHERE `publications_hosting_server_link`.`publication` = 0;
-- -- ALTER TABLE `publications` ADD `status` TINYINT(1) NOT NULL AFTER `like_sure`;
-- INSERT INTO `_vars_system` (`id`, `category`, `type`, `name`, `value`, `description`, `status`, `registred_by`, `registred_on`, `updated_by`, `updated_on`) VALUES (NULL, 'basic', 'array', 'forms_fields/publication_status', 'array(0=>"No activa",1=>"Activa",2=>"Faltan links")', '', '1', '0', '2017-01-29 10:00:00', '0', '0000-00-00 00:00:00');


-- -- 

-- LOCAL
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `parentid` int(11) NOT NULL,
  `enabled` tinyint(4) NOT NULL,
  `registred_by` int(11) NOT NULL,
  `registred_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `model` varchar(64) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `stock_status_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `viewed` int(5) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `product_to_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

  
CREATE TABLE `category_multiparent` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `category_multiparent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_id` (`category_id`,`parent_id`) USING BTREE;

ALTER TABLE `category_multiparent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;