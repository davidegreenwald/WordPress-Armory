<?php
/* ==========================================================================
   wp-config
   ========================================================================== */

/**
 * This is the primary wp-config file for version control and use in all
 * environments. It will call local and production files separately for
 * credentials. Put them in the right places then leave them out of your version
 * control or deployment process to avoid conflicts.
 *
 * The config-local.php and config-prod.php files have been placed one level
 * above the public web root directory. This adds security but mostly solves
 * common back-up, deployment, and version control problems.
 *
 * The PHP `open_basedir` function needs to reach these files in the /config
 * folder to enable this configuration. Do a search to see how to set this with
 * Apache or php.ini.
 *
 * See the debate on the security benefits of moving credentials on Stack
 * Exchange: @link https://goo.gl/ijds7a
 *
 * This configuration does not currently include staging but you can add it
 * in the same way.
 *
 * This is set up to support a WP Skeleton or Bedrock-style set-up where WP
 * core and content have their own root-level folders but you can easily edit it
 * for a normal WordPress install. It is also *not* ready to drop into a Bedrock
 * folder.
 *
 * WORKING WITH MAMP
 *
 * If using MAMP free, you will have issues with file paths with some of this
 * code with localhost/example.com set-ups if you run multiple sites.
 * You might have /Users/You/sites/ as your document root and not
 * /Users/You/sites/example.com, which creates an extra path level.
 * Switch to virtual hosts to solve this problem.
 *
 * @link https://www.taniarascia.com/setting-up-virtual-hosts/
 *
 * SPECIAL INSTRUCTIONS FOR MOVING WORDPRESS CORE
 *
 * This file sets a variable for the core location which needs to be matched
 * in the example.com root index.php file if you change it and the folder name.
 *
 * @link https://codex.wordpress.org/Giving_WordPress_Its_Own_Directory
 * @link https://github.com/markjaquith/WordPress-Skeleton
 * @link https://deliciousbrains.com/how-why-install-wordpress-core-subdirectory/
 *
 * @package WordPress
 */

/* Table of Contents
   ========================================================================== */

/**
  * cmd+f for the hashtags to navigate
  *
  * #variables
  * #credentials
  * #config
  * #database_prefix
  * #security
  * #post_management
  *
  * For developers:
  * #memory
  * #cron
  * #debug
  * #ABSPATH
  */

/**
 * TODO List:
 * Set variables
 * Set config-local.php credentials and salts
 * Set config-prod.php credentials and salts
 * Tweak any config stuff options, debugging, etc.
 */

/* #variables
   ========================================================================== */

/**
 * This assumes the domain ('google', 'nytimes') and database prefix should be
 * the same in all locations.
 *
 * 1. 'http://' or 'https://'
 *
 * 2. The domain name, with or without www, or the subdomain and domain:
 * 'google', 'www.google', 'mail.google'
 *
 * 3. The TLD of your production site, like '.com', '.org', '.xyz'
 *
 * 4. The TLD of your dev site.
 * Google owns .dev now and is forcing SSL with it so .test is safest.
 * DesktopServer owns .dev.cc and has also promised to keep it safe
 * @link https://en.wikipedia.org/wiki/.test
 *
 * 5. Database prefix: not 'wp_', please. 'notwp_' is O.K.!
 *
 * 6. The subfolder location of WordPress core.
 * If you change this here, you need to change the folder name and the
 * path in /index.php. Your current WP login page is example.com/core/wp-admin
 * or example.com/core/wp-login.php.
 *
 * You can also change this with a plugin like WPS Hide Login instead:
 * @link https://wordpress.org/plugins/wps-hide-login/
 *
 * 7. Rename wp-content folder
 *
 */

// TODO
$dgdev_local_protocol = 'http://'; // 1.
$dgdev_prod_protocol = 'http://'; // 1.
$dgdev_domain = ''; // 2.
$dgdev_prod_tld =  '.com'; // 3.
$dgdev_local_tld = '.test'; // 4.
$dgdev_db_prefix = ''; // 5.
$dgdev_core = '/core'; // 6.
$dgdev_content = '/content'; // 7.

/* #credentials
   ========================================================================== */

/**
 * Checks if local credentials exist, if not, uses production credentials file.
 *
 *  This repo places config-local.php and config-prod.php both in the /config
 * folder for convenience. Don't send the local file up to production by
 * accident.
 *
 * I'm using the filenames config-local.php and config-prod.php, but you may
 * change them, or set a new location, etc. Just do so below:
 */

/* Check for local credentials and use them if so */
if ( file_exists( __DIR__ . '../config/config-local.php' ) ) {
	include( __DIR__ . '../config/config-local.php' );
  define( 'WP_LOCAL_DEV', true );

/* Grab the production credentials if local file doesn't exist */
} else {
	include( __DIR__ . '../config/config-prod.php' );
}

/* #config
   ========================================================================== */

/**
 * Begin wp-config - ready for version control and all environments
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 * For more on debugging. php.ini, multi-site and other issues
 */

/**
  * Cache should start as early in the config as possible
  * This enables advancedcache.php and compatibility with cache plugins
  * @https://codex.wordpress.org/Editing_wp-config.php#Cache
  */

define( 'WP_CACHE', true );

 /* #database_prefix
    ========================================================================== */

/* MySQL database table prefix. */
$table_prefix = $dgdev_db_prefix;

/* #security
   ========================================================================== */

/**
 * Set good file permissions for files and directories.
 *
 * wp-config and .htaccess are special files that should set stronger
 * permissions.
 *
 * OWASP guidelines:
 *
 * .htaccess files
 * Desired: 400
 * Fallback: 440, 444, 600, 640
 *
 * wp-config.php (and config-local.php and config-prod.php)
 * Desired: 400
 * Fallback: 440, 600, 640
 *
 * Strong permissions will prevent WP plugins from writing to your .htaccess
 * and config files, but you shouldn't need to edit these files regularly.
 * See what will function with your hosting.
 *
 * @link https://www.owasp.org/index.php/OWASP_Wordpress_Security_Implementation_Guideline
 * @link https://codex.wordpress.org/Editing_wp-config.php#Override_of_default_file_permissions
 */

define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );

/**
 * Prevent theme and plugin editing from the dashboard
 * Good for both error prevention and a hacking safeguard
 *
 * @https://codex.wordpress.org/Editing_wp-config.php#Disable_the_Plugin_and_Theme_Editor
 */

define( 'DISALLOW_FILE_EDIT', true );

/**
 * Force SSL on the login page
 * Set up SSL first, naturally
 *
 * https://codex.wordpress.org/Editing_wp-config.php#Require_SSL_for_Admin_and_Logins
 * @https://codex.wordpress.org/Administration_Over_SSL
 */

// define( 'FORCE_SSL_ADMIN', true );

/**
 * Prevent login cookies from passing to subdomains on local and production
 * sites.
 */

if ( 'WP_LOCAL_DEV' == true ) ) {

  define( 'COOKIE_DOMAIN', $dgdev_domain . $dgdev_local_tld ); // 'example.com'

} else {

  define( 'COOKIE_DOMAIN', $dgdev_domain . $dgdev_prod_tld ); // 'example.com'

}

/**
 * https://codex.wordpress.org/Editing_wp-config.php#Block_External_URL_Requests
 *
 */

/* block the site from web access except localhost */
// define( 'WP_HTTP_BLOCK_EXTERNAL', true );

/* allow certain sites to access, may use wildcards and regex */
// define( 'WP_ACCESSIBLE_HOSTS', 'api.wordpress.org,*.github.com' );


/* #post_management
  ========================================================================== */

/**
 * Set the autosave frequency: default is every 60 seconds
 * Set to a higher number to improve performance
 */

define( 'AUTOSAVE_INTERVAL', 90 );

/**
 * Set the max number of post revisions (save points) to avoid database clutter
 * For safety purposes, I would clean out the revisions database a couple times
 * a year rather than disable this, use a plugin like wp-optimize.
 */

define( 'WP_POST_REVISIONS', 5 );

/**
 * The trash bin default is 30 days
 * Set to 0 to disable the trash and make deletions permanent
 * @link https://codex.wordpress.org/Editing_wp-config.php#Empty_Trash
 */

define( 'EMPTY_TRASH_DAYS', 2 );

/**
 * Reset post by email default check for performance
 * If you post by email... go back to the default
 * Default is 5 minutes
 */

define('WP_MAIL_INTERVAL', 86400); // 1 day in seconds

/* non-developers should stop here for safety */


/* #memory
   ========================================================================== */

/**
 * PHP memory default is 40M, 64M for multisite
 * WordPress will try to use as much as possible until hitting this limit
 * You can give it more memory if you need or have it
 * On shared hosting, you probably don't have extra
 *
 * If you aren't sure, the WordFence security plugin can test what you have
 */

// define( 'WP_MEMORY_LIMIT', '40M' );

/**
 * The admin dashboard can use more memory than the site frontend
 * Give WP_MAX_MEMORY_LIMIT a higher number if need be
 * Default is 256M
 */

// define( 'WP_MAX_MEMORY_LIMIT', '256M' );

/* #cron
   ========================================================================== */

/**
 * Turning off wp_cron can be a performance improvement but you should replace
 * it with a real cronjob. WordPress uses cron for automatic security updates
 * to core, as well as scheduled posts and other tasks.
 *
 * (Most users should leave this alone.)
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php#Disable_Cron_and_Cron_Timeout
 *
 */

/* set to true to turn off */
// define( 'DISABLE_WP_CRON', true );

// limit cron to attempting 1 task once per 60 seconds to avoid timeout issues
define( 'WP_CRON_LOCK_TIMEOUT', 60 );


/* #debug
   ========================================================================== */

/**
 * Developers only: leave false on production sites
 * See many options for debugging here:
 * @link https://codex.wordpress.org/Editing_wp-config.php#Debug
 */

if ( 'WP_LOCAL_DEV' == true ) ) {

  define( 'WP_DEBUG', true );

} else {

  define( 'WP_DEBUG', false );

}

/* #ABSPATH
   ========================================================================== */

/**
 * Leave this alone. If setting a new WordPress core location, do so with the
 * $dgdev_core variable above.
 *
 * WordPress uses `dirname(__FILE__)` by default for backwards compatibility but
 * `__DIR__` is potentially faster and should be used with PHP 5.3+.
 */

/* Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . $dgdev_core . '/');

/* Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');