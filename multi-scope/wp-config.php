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
define('DB_NAME', 'oxfadxba_mltscpsite');

/** MySQL database username */
define('DB_USER', 'oxfadxba_mltscpwsite');

/** MySQL database password */
define('DB_PASSWORD', 'S@luti@n!1434');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '``U`<k/J&^gKjeN%5(6FO<DoV-Ib@v4(Ea770?1jc-rM%Kw^A`i+nCu.=#e4V^D~');
define('SECURE_AUTH_KEY',  'Q;v{<?{h#gv?kB>N%bU~!41K&t*HNN^#]/S0Xb]h^KlH}b8>`baBlouKf;rm)AhX');
define('LOGGED_IN_KEY',    'skVZSn1{aVw@Wf@gMt-tO|7545StX&PJ JmQ[=-V]I(Gg&7C)gmHA+?m5&ZP(mH9');
define('NONCE_KEY',        ')X2WXXL%Jy$74@UAWvD>A#q|&lNFVjV?w7|.W%6KMf6pQg[pWk16.dk..~j9GOy6');
define('AUTH_SALT',        'XIFOW~|cw@iEIL2/~dSa#AI@gST-D0Lq!^YJP:sLSy !f1URmN <ZV*C3kmGb P}');
define('SECURE_AUTH_SALT', 'k)vHz.u`(-^(BJVe0-/,==Q8bC@m:jE/KNFE3<RfbH 4>vw3|;03zU M}uh^e9A)');
define('LOGGED_IN_SALT',   'BB!H-*s{lIyAp~$Ai531~t9~ 3>Z&S<vx|ABdA)%M1+v#KQO,e5|>6Dm.-`h8Np|');
define('NONCE_SALT',       'O$/6*l=C@%x|7=DqRIbt8%3U2:[PYGC!Bs~=X^~{nR4tfAIrO{GAQQ;Rp!gv_[#5');

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
