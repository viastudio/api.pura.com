<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// MySQL settings
/** The name of the database for WordPress */
define('DB_NAME', 'api_pura_dev');

/** MySQL database username */
define('DB_USER', 'db');

/** MySQL database password */
define('DB_PASSWORD', 'dbpass');

/** MySQL hostname */
define('DB_HOST', 'sqldata');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/**
 * Set Jetpack Local Development to true to enable it.
 */
define('JETPACK_DEV_DEBUG', true);

// used to override the wp_options and dynamically set the site for this environment
// http://codex.wordpress.org/Editing_wp-config.php#WordPress_address_.28URL.29
if (isset($_SERVER['SERVER_NAME'])) {
    define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME']);
    define('WP_HOME', 'http://' . $_SERVER['SERVER_NAME']);
}


// used to determine environment from easily accessible constant
define('VIA_ENVIRONMENT', 'dev');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@-*/

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
// https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         '33-cJ}K-}p3 j_45XB:&cI!NbDi;|4$L-bfE+%k^tt|mPaiblU6 IoZkc4|WC6DA');
define('SECURE_AUTH_KEY',  ',3+|k{:>>L0akp/*o.,du~UtzshcN_{e^+2``z J8#S;!+o h`YkTxeXR#w1`_a8');
define('LOGGED_IN_KEY',    'Z&JyKyf8]v!Cmf]-?O=]i]xGH/j]:Wnug`J<{h-5)R~Js q+l+kQ(tE<Pff9&pBe');
define('NONCE_KEY',        'gfG+6!3SUdw@a#~8-B4g1HL[`G9$G6VC@Wv2Phg@g>SwPKdKO(pP`U&m04c/2g%8');
define('AUTH_SALT',        '~E*j>.+=1/+VB9wH2gt[9llulT%@r39F$>D5 ,:[4TF>$-IX/@X-9WS?zys=_SCb');
define('SECURE_AUTH_SALT', ',PQgNvJ|[19O=8Erk-IzRV!cm^p<K-m]2t+kq[.e</f|O$p%H0^XI4=+OR>m>-P(');
define('LOGGED_IN_SALT',   'QbcWG/LWi+.x*D+Y-<rjT_IJF+~AI7wn[+h-^B9ma7?8FzC,#~lhz$hr73HA55DR');
define('NONCE_SALT',       '{-P+;(10A$-$#Kf;Rk^Y+Bp:R5)X^^Z_Y{m?z)/teJRV),kg*n1Uh{9&T%NG&<Sb');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

// auto save every 5 minutes (default is 60)
define('AUTOSAVE_INTERVAL', 300);
// only save latest 10 revisions (default is infinite)
define('WP_POST_REVISIONS', 10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if(!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');