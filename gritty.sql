-- --------------------------------------------------------

--
-- Table structure for table `admin`
--


CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `LastActivity` int(55) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `LastActiveDate` varchar(255) NOT NULL,
  `LastActiveTime` varchar(255) NOT NULL,
  `DateLastActivity` date NOT NULL,
  `Bookmarks` bigint(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `themetype` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `ip_address` double(11,2) NOT NULL,
  `browser_type` varchar(255) NOT NULL,
  `forgetid` int(55) NOT NULL,
  `forget_question` varchar(255) NOT NULL,
  `forget_answer` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` varchar(255) NOT NULL,
  `Mobile` bigint(15) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(50) NOT NULL UNIQUE,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `mobile` bigint(15) NOT NULL UNIQUE,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `lga` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accountStatus` varchar(255) NOT NULL,
  `otp` int(55) NOT NULL,
  `LastActiveDate` varchar(255) NOT NULL,
  `LastActiveTime` varchar(255) NOT NULL,
  `DateLastActivity` date NOT NULL,
  `LastActivity` int(55) NOT NULL,
  `Bookmarks` bigint(11) NOT NULL,
  `themetype` varchar(255) NOT NULL,
  `ip_address` double(11,2) NOT NULL,
  `browser_type` varchar(255) NOT NULL,
  `forget_question` varchar(255) NOT NULL,
  `forget_answer` varchar(255) NOT NULL,
  `reg_date` varchar(255) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------
--
-- Table structure for table `camp`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `order_id` int(11) NOT NULL ,
  `customers_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `customers_address` text NOT NULL,
  `state` varchar(255) NOT NULL,
  `cart_items` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `additional_info` text NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `transaction_ref` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
   `notify_status` varchar(255) NOT NULL,
   `notify_newpay` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL ,
  `updated_at` timestamp NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `password_reset` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `tokenable_type` varchar(255)  NOT NULL ,
  `token_id` bigint(20)  UNSIGNED  NOT NULL ,
  `name` varchar(255) NOT NULL,
  `token` varchar(64)  NOT NULL,
  `abilities` text NOT NULL,
  `last_used_at` timestamp  ,
  `expires_at` timestamp  ,
  `created_at` timestamp  ,
  `updated_at` timestamp  ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `user_id` int(11)  NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `product_picture` blob ,
  `available` varchar(255) NOT NULL,
  `discount_price` int(11) NOT NULL,
  `Last_updated_by` varchar(255) NOT NULL,
  `created_at` timestamp  ,
  `updated_at` timestamp  ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` varchar(255)  NOT NULL,
  `updated_at` timestamp  ,
  `Last_updated_by` varchar(255) NOT NULL,
  `created_at` timestamp  ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` varchar(255)  NOT NULL,
  `updated_at` timestamp  ,
  `Last_updated_by` varchar(255) NOT NULL,
  `created_at` timestamp  ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `currency`(
  `id` bigint(20) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` varchar(255)  NOT NULL,
  `creator_id` int(11) NOT NULL,
  `Last_updated_by` varchar(255) NOT NULL,
  `created_at` timestamp  ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sent_email` (
  `id` bigint(20) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `sent_by` varchar(255) NOT NULL,
  `sent_to` varchar(255)  NOT NULL,
  `subject` varchar(255)  NOT NULL,
  `email` varchar(255)  NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp  ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sent_text_msg` (
  `id` bigint(20) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `sent_by` varchar(255) NOT NULL,
  `sent_to` varchar(255)  NOT NULL,
  `subject` varchar(255)  NOT NULL,
  `phone` varchar(255)  NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp  ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint(20) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `subject` varchar(255)  NOT NULL,
  `email` varchar(255)  NOT NULL,
  `phone` varchar(255)  NOT NULL,
  `information` text  NOT NULL,
  `notify_status` varchar(255) NOT NULL,
  `created_at` timestamp  ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `website_name` varchar(250) DEFAULT NULL,
  `website_url` varchar(250) DEFAULT NULL,
  `website_email` varchar(250) DEFAULT NULL,
  `admin_mail` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings`(`id`, `website_name`, `website_url`, `website_email`, `admin_mail`) VALUES (1, 'bucuzzi', 'http://bucuzzi.dx.am', 'support@bucuzzi.com', 'admin@bucuzzi.com' );

 
 
--  ALTER TABLE `products`
 -- ADD `brand` varchar(255) NOT NULL AFTER `category`;
--  ADD `currency` varchar(255) NOT NULL AFTER `category`;

--  ALTER TABLE `categories`
-- CHANGE `product_picture` `category_picture` varchar(255),
-- ADD `creator_id` int(11) NOT NULL AFTER `id`;
-- ADD `category_picture` blob NOT NULL AFTER `creator_id *`;

-- ALTER TABLE `brands`
-- CHANGE `updated_at` `creator_id` int(11);


-- ALTER TABLE `products`
-- ADD `commission` varchar(255) NOT NULL AFTER `price`;
-- ADD `referral` varchar(255) NOT NULL AFTER `payment_status`;

 -- CHANGE `customers_name` `customers_firstname` varchar(255),
 -- ADD `customers_lastname` varchar(255) NOT NULL AFTER `customers_firstname`,
 -- ADD `customers_lga` varchar(255) NOT NULL AFTER `state`;

-- ALTER TABLE `reports`
-- ADD `notify_status` varchar(255) NOT NULL;

--  ADD `notify_newklump` varchar(255) NOT NULL;
--  ADD `notify_newflutterwave` varchar(255) NOT NULL;


-- ALTER TABLE `reports` DROP `status`;