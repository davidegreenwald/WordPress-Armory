# WordPress Armory
_A WordPress boilerplate with a skeleton structure and built-in security._

## What this project does:
### Structure:
This project borrows from Mark Jaquith's WordPress Skeleton and techniques such as Roots.io's Bedrock. The goal is to provide easier organization, version control, and deployment by giving WordPress core its own folder separate from content files.

WordPress Armory splits local and production credentials into individual, separate config files, allowing `wp-config.php` to be version-controlled and safely deployed between sites. Make sure `config-local.php` stays on your local machine and you're all set.

### Security
WordPress Armory comes with built-in best practices for `wp-config` and Apache server `.htaccess` files. Check the files for the directives and documentation.

Some of the things this does:
* Prevent directory browsing
* Set a database prefix that isn't `wp_`
* Block access to xmlrpc.php to prevent login attempts
* Block web access to config, .htaccess, and other sensitive files
* Prevent `.php` execution in the uploads and cache folders
* Prevent plugin and theme editing from the WordPress dashboard
* Set good file and directory permissions

Some hosts may bake these security measures in by default. Check and see. Better safe than sorry. Naturally, you should move these directives up to the host config level if you have the access.

Changing the folder structure and names also creates "security through obscurity," reducing—but not preventing!—hacking attempts from bots and casual scanners looking for obvious, vulnerable WordPress websites.

This boilerplate is not hack-proof! Use it with good security practices:
* Long, unique passwords
* Two-factor authentication on your logins
* Limit login attempts
* Allow WordPress core background updates and update WordPress regularly
* Use trustworthy plugins and themes and update them regularly
* Use a WAF (Web Application Firewall)
* Regular site scanning and monitoring

## Set-Up

* Download WordPress files to `/core` manually or with WP-CLI.
* Remove `wp-content` and `license.txt`.
* Add your database credentials and site information to `wp-config.php`, `config-local.php`, and `config-prod.php`. Or just set the credentials you need for now.
* Install WordPress to add a site user. Don't use "admin."
* If your host and plugin usage allows, set `.htaccess` and config files' permissions to 400, 440, or 640.

Your login page will be at yourwebsite.com/core/wp-login.php or /wp-admin. If you want, you can move this with a plugin, or change `/core` to something else, like `/wp`.

## Recommended Security Tools

There are many great WordPress security tools. These are free and I have personally used them.

**All-in-one:**
* WordFence

**Single-use plugins:**
* Limit Login Attempts Reloaded
* Google Authenticator

**Monitoring:**
* Uptime Robot
* Gravity Scan

This project is a work in progress and these recommendations will grow and change. Nor is this a complete list of security precautions. I hope this project is a helpful start for you.
