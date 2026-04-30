<?php

// BEGIN Solid Security - Ne modifiez pas ou ne supprimez pas cette ligne
// Solid Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Désactivez l’éditeur de code - Solid Security > Réglages > Ajustements WordPress > Éditeur de code
// END Solid Security - Ne modifiez pas ou ne supprimez pas cette ligne

define( 'ITSEC_ENCRYPTION_KEY', 'aENfOnBGTmg3dElpXiFjaTNzJGAjYkU+On4tISFbd2dubzB5JEVNZEFEdzwmMHdxJDU4YF0hSHpSQUw9W2RDJQ==' );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'agency' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'q5yDj+~AUe_9Bu%e:AXV?`;{Rs7G9(C7C@B(bc~&B^a40$i@~46i~p.XAR#zK#Ib' );
define( 'SECURE_AUTH_KEY',  'hXfj+r8~<+F.DO)&DJ=g&xMxO[rS?|yDIXt1|!25]0bz-{`}7QM@r`eNrj@0d6~6' );
define( 'LOGGED_IN_KEY',    '33zX(0ep_5^TX]B}=1WWs%</W/gUE1f/N{{?^5-{KBw o<a> 5_tp!/~4U:y-)<I' );
define( 'NONCE_KEY',        '^x101~9,+A#)r[(dXBXx$5MM7FknwPNyi)-&IBtr?Op~ HpfQ@A2pYTsH^LKPXmV' );
define( 'AUTH_SALT',        '1lRY,hz?Xi!Tgr@CXtn@Vk(C/-+J3#Rl|o}tnTCR.Y!ylWw#+GKjT6mie$MGUK&h' );
define( 'SECURE_AUTH_SALT', 'C}6nH#_IoAD]qbXjVk7bpyZ%,5c}LnY9SZk>h`NmXhfg>;UxYc24+:q;nM;`#~XS' );
define( 'LOGGED_IN_SALT',   'g; bTV3CU,0C1YAR<]-DLGeuQZumT/LCx6:BGF6EBj$(2v-&TrqAsSpcqB8b6^.k' );
define( 'NONCE_SALT',       'o#.?n:Dy:RK]GTP[(Zpqp:rO5.pz+5WKQ95oL7PpPGN%e%;tN|VKgBTx9dTnk=#-' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
