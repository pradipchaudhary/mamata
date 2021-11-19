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
define( 'DB_NAME', 'nexusolution' );

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
define( 'AUTH_KEY',         'FVC_5z2|V<<a_@E(qW9 E>Y~5vxQy!O@]c.p=3BCc`Pn7@xr={WVTZ ev| -mfKe' );
define( 'SECURE_AUTH_KEY',  '<BhK5i/77Xdutt9FdS~[Obm)V(L~&F=a(rYx~.,=]p5}q.^Qt,6h!T^h!.!b&!*x' );
define( 'LOGGED_IN_KEY',    '17c={k/Zf?rr92,n*Ls>|OGMj>|W~nrk6^^oRQ=>Y#Z_5B GXcbR+}WOC8(dRZ/=' );
define( 'NONCE_KEY',        'ug_tMqP*TdoEe6/iWjK1*DTK0W# M_Il= kY`D>byrZ`COAF WQI]F<>LlKN0M j' );
define( 'AUTH_SALT',        'Gi1f9yU>7]NAqgv.%ND[CkX}qCdO|>fO$F>kI0ME8sC(q0@h%`rCeG+pkhQB4j{Y' );
define( 'SECURE_AUTH_SALT', 'zPo,82?8Jg.7@`ezd}7{2<#c!z.hFNQR2Y(W67V[vO`z9<g@4<V0GBnCF_KGmUhH' );
define( 'LOGGED_IN_SALT',   'b0K@K9}w^~s|:O.&?}# E2rqe>1Pdy~Pw18Vj-9V5~xDh6B>@SZWKX2~Y_RpCS+s' );
define( 'NONCE_SALT',       't=aX+CH!S%#^l%AJ:A!`nN/|=GZ|^pq_!-naN5L$S 0);f#CabPL2ZyCIF69uX*g' );

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
