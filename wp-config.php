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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_crowfunding' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'y>YZNs/d|`w[HJ`;u7hjWap032=}NkkiXf__&AVp#P$Ea$$$aAo@3ASAfXQxZRA!' );
define( 'SECURE_AUTH_KEY',  '<*gqug{t4at9q{CZ/UV&(.aVt5*^|k}_lXi8!qJ&[GLIc>JHH/W|gL{_Vg/^Tyrf' );
define( 'LOGGED_IN_KEY',    '0IB:E@4@zdPk;HG/Eo@Vs=F}}_?t2@n$S:t n9%2]KzuYTyB)~T&D$v*uNCZ6/pw' );
define( 'NONCE_KEY',        '#uh1DZR4<mKxw#N+5VwkbBk1@3d1b$*?]i/:M2C!&`KjM_FRJFAAZW}oe<T,$x#9' );
define( 'AUTH_SALT',        '@AVV>)+TASGRmp>;j>F$AL}a^vu}K=&7=1zt;W>[m!LRptaSS_B2=^CO/a>_:WfM' );
define( 'SECURE_AUTH_SALT', 'W7q22gZfF|n(::0vh1bosG]weLWUfT{|B:PYbRg)j`5]rQi>^2ZD:f?9@Zv`EdHc' );
define( 'LOGGED_IN_SALT',   ':-benE26wP?_L#m@ UOQOb5!; uiZd_eTh%I,#&c+jPH?5 m<?n{7S/sH$]}s]bB' );
define( 'NONCE_SALT',       '^Ew4p)z5&%cmGhGLs=$7Aic!Dp!}ZFLR_njSiN17N0rqWj#K6&DY1!3$W=)p>}a<' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
