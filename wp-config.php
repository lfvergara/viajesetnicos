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
define('DB_NAME', 'viajesetnicos');

/** MySQL database username */
define('DB_USER', 'Naboo');

/** MySQL database password */
define('DB_PASSWORD', 'Dandoran.30');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Datos para la conexion al servidor ftp*/
define('FS_METHOD', 'direct');
define('FTP_USER', 'dharma');
define('FTP_PASS', 'Takodana.30');
define('FTP_HOST', '165.232.72.109:372');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xo3d14ysvnze0gqppbtyscyhyjttkvjecf16qp5jtz3kyrd32xylj6k1blezdgql');
define('SECURE_AUTH_KEY',  '9qlow17vjgreixwlxavvriqpoqyraybtudfh2xa0aq7brdhjmswecpanussbe1fb');
define('LOGGED_IN_KEY',    'mxwfn2s0fm0szm90zx9q5eivjg7pjwl7pkb3lap4bwixhgmrl3rnrodbbzahnjqx');
define('NONCE_KEY',        'ahtlr9xu6stnapuzjeegpiusor9aqx2kjvexvrjnv4zqktmkik05lkxqlyerwd3v');
define('AUTH_SALT',        '4srlb5by1jcjglwdqdxgk5qq22a34sevbgnv6ifnge3cw1nvjhjz9jkticpxxxh9');
define('SECURE_AUTH_SALT', 'l99eaw9ajgzrgus4lov0fuylpa8vuwmrw83ffcrm15z8oi4khj5ty95wzdqqzubk');
define('LOGGED_IN_SALT',   'csnxtsmx3nz2c4xmgyuukltym7lphf6iuogaqkped21pgibnyjdjvh1hmjcv4hpu');
define('NONCE_SALT',       'eos68nvy0wrblszw5fmozmurxygrnay1je9flbmt2mita0cchyovbr5hwes9xas7');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp3s_';

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
define( 'WP_MEMORY_LIMIT', '256M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
?>
