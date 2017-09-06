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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', '4e80ee072c512edfc30c28f3c534f60e7ae8ba0e9a366262');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'b n`&I2%yus6LxpZ/JvJ+G7dY{$:|s=rouWp*q-nd~[_OrTVK2@g1&7Ni$yn4TYX');
define('SECURE_AUTH_KEY',  'k)efN}ABdiHvY~]ZV#!_6V=L,Yk}ihZw{jg)/CVF7RAVwr?%C2-@G2?X`EigwA4#');
define('LOGGED_IN_KEY',    '8 _(Hks{cU7w(<Yl+E]~ hjC0pmf8n#YcX:Z%X^[`%.tFMVSiy[@?jDJ]e n[.U#');
define('NONCE_KEY',        'LnfXS)AU~34N1X*Qj7$%^wk%Wr[YydDM28i(po{q$G;@B1P1(:SW33S7zofimBWp');
define('AUTH_SALT',        '.;$z}NWgJlN_*&&||owdOd6@i?X@55YWE=7c7F=Wj}-yv0uvb2T8ZCUK=nXH@!#%');
define('SECURE_AUTH_SALT', 'I/k+Vb.%.DyRc+tFqU/vnNJJ]W1Q4G:aija&Hh2Z^/$Z=OrUYBXY865%M|%%lR;D');
define('LOGGED_IN_SALT',   'uakFe{CfavPkw qKi+L?Zi2juW,0PpI/j1;v9VO7;fAzfL{>$cnU3s!8*pq+U^.:');
define('NONCE_SALT',       'FgW|(FGsyB(vwLew#aUg`FN8k42bepQ@>,OIoa*o]:0792(US$lZ|9cwL)RX^lK7');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
