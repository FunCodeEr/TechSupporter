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
define( 'DB_NAME', 'TechSupporter' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Admin@123' );

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
define( 'AUTH_KEY',         'dz9cQ[M_mG4kL66$C=rk7,![}k$ZB#3D[6,*/-,6{.`3mhsR/ O;R:7GBWrc%T[e' );
define( 'SECURE_AUTH_KEY',  'b;S>5GMBTiW]g|]>Lv H#!@)GIb0M-bEhG>N2}=[QJf6V 6v!S0:l|,9Q|&PfN[l' );
define( 'LOGGED_IN_KEY',    'ac^/8($l3o/{`qOKiIh@Ku$^;^9,PG l1]:[z.2Hp@v4xy_IgWw|Rq`,$Y&/M*0O' );
define( 'NONCE_KEY',        'Uzi#sgBx3As4 ^i tLMcaz5z+<`{D`Qcp_K0Eh<)fV1t|%pd]S5meLa{kGW}AWT/' );
define( 'AUTH_SALT',        ',6rjtjpbk*plBq-{,uLn/q &L`}IkYR@eCBBAnT* =W9+c4=RaaZR>5)5B2y.=1u' );
define( 'SECURE_AUTH_SALT', 'j mLF$lKm{@JI,I]s? b9eKNI9>b](|PW<-3dWG*E16DXQ$Pv-L((m&G[7Rv_DWY' );
define( 'LOGGED_IN_SALT',   'YNnZ%*V~yo`} `C]D#Wg(H8ZV%c!<VXDP{DiIgUEah1RJjU=5lM1_}a8VpgVUOiu' );
define( 'NONCE_SALT',       'SbNU_)jgV:$DVvB~eCzbm$JUiM[JG+(q!ZJNgJEt/9cq,O4JR9Cu~qr{>AXI<ij<' );

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
