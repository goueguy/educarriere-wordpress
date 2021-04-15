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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'educarriere' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'msh_B_f,YRe,_=-]N=H/V:#M.aGw:#A0FB4R>H3#`aK+iKJ,(/MU)OJ$dcYy=7~`' );
define( 'SECURE_AUTH_KEY',  ' ?tZs^Df4Pgmz52hAx$pW89QF~l)oj8A#aS~|pHr[UOgyVdOBSWm0[xr/,8Y<xaE' );
define( 'LOGGED_IN_KEY',    'f7y$:/)DX>et08$C>Lh$;FD`QOx(;8|dkD4YS#N_0,`{t9n0Y=#[a6}H|wwSuSx?' );
define( 'NONCE_KEY',        'd]Rule:2eNbHM7_Om(wjI_]`e/oHlyojrN<P:fu+p9(%w7cAq(tVH>K_v[3q;)7e' );
define( 'AUTH_SALT',        'qPk-(K;_Hw%+o%> XUk6<|<*j3z_?I`#_U_z>u/~Hu=ZR?*IzZ-M^{cDe>LoV$7u' );
define( 'SECURE_AUTH_SALT', '~c(5NjkWwA$B.RqlTAc[8UiC;`%uLS08/3K_}Q#c8A(.XK&N2g;9J@XCwpZE#Cb>' );
define( 'LOGGED_IN_SALT',   'Ru%{!#Xe{|W7f9UZm&fYgnwg]9g#*8fmIqSaK4Eh@>1bBZB1Hn:B&d^1Rvo G$$v' );
define( 'NONCE_SALT',       ' 4CP|F*L *<5AMT[ do]RA [1I!}o<yz;{H] Sc585x3G@u,0L[,$2$4+}*:REW0' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define("FS_METHOD","direct");