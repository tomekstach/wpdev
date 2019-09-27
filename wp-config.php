<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/wapro/www/wpdev.wapro.pl/htdocs/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'wapro_new1');

/** MySQL database username */
define('DB_USER', 'wapro');

/** MySQL database password */
define('DB_PASSWORD', 'wOR6Tp1W7URLKR6L');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'b8[!Z#X.3vx;bT}b{KgXDS*5&KaNwu0oHWOlxI^5H$Q~Ul8dc^a+<,7UWprFu0MB');
define('SECURE_AUTH_KEY',  '0V]UU%f*@Y?!Aj._xM~):88$_.2Ouc@I*l{zKz0$SMcu+$@Ti5]{joD(zU3ymh=(');
define('LOGGED_IN_KEY',    'N;Z;8!sA`e,lZ=:ielM*r[cMGDb/B)8]v]ku./_7lYd>Se=$AJ3`cF>%}(t`=mzH');
define('NONCE_KEY',        'ex-er`U|8;1jrrAc>{uAKlWXOp-:,g8=w/}hp8(7Vx;sgqLrs|&VpuFtq|2w{mFZ');
define('AUTH_SALT',        'X^1$pDLaOP**mR@ `8o@{bRz,OP[pli|$6Tbwe8NDM&DQKf.QZmd(LxTgY>73`Z]');
define('SECURE_AUTH_SALT', 'Wv?FYxV6>Xc9(`o;&s[94l$2?|c.NS&mU9mG|H#m>7}_1+};vQIM+ )1<V:s?&z3');
define('LOGGED_IN_SALT',   'W2>A@-}<XQ)vPs)t@W$sUOJpT$B_Km[FZ,!n>v6H[]Dj^u+(wCIV=Sm,F 8[[X!O');
define('NONCE_SALT',       'iuN-;2>T,wsfw8y#<:Cl&52<q[Ao}k}p1SUDJ<}v`:t=v!dQL45X{RO&3M<^PS]0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
### AUTOUPDATE


### AUTOUPDATE
### DEBUG
define( 'WP_DEBUG', true ); // Or false
if ( WP_DEBUG ) {
    define( 'WP_DEBUG_LOG', true );
    define( 'WP_DEBUG_DISPLAY', false );
}
### DEBUG
### WP_HTTP_BLOCK_EXTERNAL
define( 'WP_HTTP_BLOCK_EXTERNAL', false );
### WP_HTTP_BLOCK_EXTERNAL
### MULTISITE
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'wpdev.wapro.pl');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
define('SUNRISE', 'on' );
### MULTISITE
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
//Disable File Edits
define('DISALLOW_FILE_EDIT', true);
//Disable Mod Security
define('FL_BUILDER_MODSEC_FIX', true );
//Allow uploads all type of files
define('ALLOW_UNFILTERED_UPLOADS',true);
