<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'gP}uW;g.GM6Le]_EEeNF),LH>YV;Bpz8FW}>7Lg_<dV mk1Dj9b4,J23,Ihj~Qe~' );
define( 'SECURE_AUTH_KEY',   'g)DNI8y5]G+dA!--=dEUNGP:@jRx#JaxMsiiNRWyer%_)CB^f>dh4O&>(p&v9ZMD' );
define( 'LOGGED_IN_KEY',     'Wv[G7 d7RG$75MqI*<&yl]1Sk#/QAp88rlx!s,TRP8B)+(MBY9G<(4Pyf $C5mk(' );
define( 'NONCE_KEY',         'liR(`-kzR.vdRz9q^I]FgPPWnExYq[:u%e5T[($TaaT?}2pBX|aL2h*z)KOJ@L6&' );
define( 'AUTH_SALT',         '9B^kM{8Mv-<_A.wziNiWurqb9yVH?H;%~:WMEMuG=:%fZLT+LzP7i3_S^;~lU-]E' );
define( 'SECURE_AUTH_SALT',  'vl|4RIV>rvn#{90K%kMjt-T:uN#6jY@Y1PM.b2sjIFf)XF|9#Pu?.)[K`UQ|C#9V' );
define( 'LOGGED_IN_SALT',    'vba9S&A;zA2ED.-cev<fCny_*%+#qZh y3_5GU*oLl,MJ8v9Iz/AQCJkg-GkJJ4x' );
define( 'NONCE_SALT',        ':30$C<K^^rX@R|QDRJZ4^gSG+(@aOo67p%_:=be+XyI}eTxsT+ZsVlbO(I>oxc {' );
define( 'WP_CACHE_KEY_SALT', 'i(bdt,/#JDJCAo0r74_e~{9!pO*`=Z(lv#n3485u%StCw^u{Yz$GK@z 9Czrb*Re' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_MEMORY_LIMIT', '512M');
define('DISABLE_WP_CRON', true);
define('WP_DISABLE_FATAL_ERROR_HANDLER', true);

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
