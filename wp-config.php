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

// ** added by rcn: 08/10/16** //
// ** Heroku Postgres settings - from Heroku Environment ** //
$db = parse_url($_ENV["DATABASE_URL"] ? $_ENV["DATABASE_URL"] : "postgres://wordpress:wordpress@localhost:5432/wordpress");

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'liLpSN2qz-hKSgSw%+b*Y{xr;>}QUB-#dw2$BhcJB(&62J3)vfzQ(=LJ<DWUFHL3');
define('SECURE_AUTH_KEY',  '@gOL4*?mr/=HO^3m`MoLsdu/vg7fmg^=*mM3 BLr)~cUxf|dY.Tzi1F2d5h_C7)|');
define('LOGGED_IN_KEY',    's=_<[:14F vYc[O@j/Hz[PD#.8r(qM >hrrF`|2@,o%1fIbxixwKx>t1q/2h8*,v');
define('NONCE_KEY',        'ZB!mi?_xG/hv$Bnk$U&=OifYYjH-D<<6F]jw}TFRkQ5n$e^-akFc)99?6Jm NI&!');
define('AUTH_SALT',        'm;Qa%(iAr@kT5M|saj2$<wZu+yYYQJ~x6ui!!vG]K,=WkNGX=$INWn$_7+5_&W/M');
define('SECURE_AUTH_SALT', 'tY$Q!sQpd6Qm%)S(mWbKln%Lb$ydw;>E9xz[lTfEgMIEuO?~30&$aFkKQWe/K)<@');
define('LOGGED_IN_SALT',   '*9:S=4VqPPP@:,s+PRd[meqy/:X}{&o*OYfI6HQGj6GxtcuIX/HjIxxEC.@QZ_,r');
define('NONCE_SALT',       'Ge(Z{#N~EmITLad]cOoL2YIX0nKFOWy*O*En(ymZG3qNV9+L<Li5D+bxknu;vaUG');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
