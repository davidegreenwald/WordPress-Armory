<?php
/**
 * Production site credentials, salts, and configuration
 * @package WordPress
 */

/**
 * TODO list:
 * Set database credentials
 * Add salts
 * You're done!
 */

/* #credentials
   ========================================================================== */

$dg_db_name= ''; // TODO
$dg_db_user = ''; // TODO
$dg_db_pw = ''; // TODO

define('DB_NAME', $dg_db_name);
define('DB_USER', $dg_db_user);
define('DB_PASSWORD', $dg_db_pw);
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4'); // use utf8mb4 with WordPress 4.4+
define('DB_COLLATE', ''); // let the database pick the collation

/* #salts
   ========================================================================== */

/**
 * TODO
 * Add salts for security.
 * Copy and paste from the link below.
 * Change the salts to (temporarily) log out all users, including hackers.
 * @link https://api.wordpress.org/secret-key/1.1/salt/
 */

/* #domains_and_paths
   ========================================================================== */

 /**
 * Set site and WordPress URL for the production website
 *
 * Your site might be example.com and WordPress might be installed under
 * example.com/blog
 *
 * Setting these here reduces database calls and improves performance
 *
 * You can use $_SERVER['SERVER_NAME'] to get 'example.com' from the server
 * if you would like to set this automatically instead of setting it in the
 * variables section.
 *
 * 1. TODO: Remove $dgdev_core if NOT moving WordPress core to its own folder
 * The default of this project is to move it, so leave this alone.
 */

define( 'WP_SITEURL', $dgdev_protocol . $dgdev_domain . $dgdev_prod_tld );
define( 'WP_HOME', $dgdev_protocol . $dgdev_domain . $dgdev_prod_tld . $dgdev_core ); // 1.

 /**
  * Change the wp-content folder name and location
  * A good idea to avoid some hacker bot scans
  *
  * Having trouble?
  * WP_CONTENT_URL should resolve to a URL like https://www.example.com/content
  */

define( 'WP_CONTENT_DIR', dirname(__FILE__) . $dgdev_content );
define( 'WP_CONTENT_URL', $dgdev_protocol . $dgdev_domain . $dgdev_prod_tld . $dgdev_content );
