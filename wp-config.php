<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache




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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'u1szxxRM' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'bC/C_Y?yFNwf5?Q!Pt >})i|`.YHFwp~hW3H7Kx96zFqhk`+`| :-x_?m?FEzh9d' );
define( 'SECURE_AUTH_KEY',   'tT/IsNf`? Lv_!=gV1iH2Y>8Yw+2z iS9r IhGgqce0`TS#D9nX6A[=uJ*%uk4V3' );
define( 'LOGGED_IN_KEY',     'GkvrXb^XGWl<n1lOrV^-,jpnktHJp0Z=4_&a~okKut<uNX~#rxC:@rb0?JzU2,gg' );
define( 'NONCE_KEY',         'lp)?+H:/CI_K15wr9qv4Xddu@H30W/P;1<VNPf!Ha8;oQ!<{f1PVJ/0igrJ|JZt`' );
define( 'AUTH_SALT',         '}y=vQJPs;V@#F$`C7/>O![JBHN{B%r33f~*LoAL(0=P6;ec[,C_E7J(!9FNeJyF6' );
define( 'SECURE_AUTH_SALT',  'Od5OdR/8A/oC.A.%zFW/(jFVrhx[}|*hhHya|N&ufD(+m|-@W71K*:<UEhkzb)^h' );
define( 'LOGGED_IN_SALT',    'D@U-#lZKD#:OF^Y{G4]b@cr%=/^Tc520EkrN0jzf((gO6T)jCNGMNX$jsy0^y&Eo' );
define( 'NONCE_SALT',        'Rxch^B*OfcovYGotI21JTRG}?l]YYPBVY$!1@!;gs{=k`VN0`GL5%|[#.FyU};GD' );
define( 'WP_CACHE_KEY_SALT', '.*Axscx{u 1tskzFX!i`/!{uWeu9Hy5],jYC#8py_!y@GnfnEN80)@e0Z},I+>YO' );
@ini_set( 'upload_max_filesize' , '500M' );
@ini_set( 'post_max_size', '500M');
@ini_set( 'memory_limit', '500M' );
@ini_set( 'max_execution_time', '500' );
@ini_set( 'max_input_time', '500' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
define('FS_METHOD','direct');
