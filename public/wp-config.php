<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

require_once __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();

if (file_exists(__DIR__ . '/../.config.php')) {
    require_once __DIR__ . '/../.config.php';
}

/*
 * Environment.
 */

define('WP_ENVIRONMENT_TYPE', env('WP_ENVIRONMENT_TYPE') ?? 'production');

/*
 * URLs & Dirs
 */

define('WP_HOME', env('WP_HOME'));
define('WP_SITEURL', WP_HOME . '/wp');
define('WP_CONTENT_URL', WP_HOME . '/content');
define('WP_CONTENT_DIR', realpath(__DIR__ . '/content'));
define('ACORN_BASEPATH', realpath(__DIR__ . '/..'));

/*
 * DB
 */

define('DB_CHARSET', env('DB_CHARSET') ?? 'utf8');
define('DB_COLLATE', env('DB_COLLATE') ?? '');
define('DB_HOST', env('DB_HOST') ?? 'localhost');
define('DB_NAME', env('DB_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASSWORD', env('DB_PASSWORD'));
// phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable, WebimpressCodingStandard.NamingConventions.ValidVariableName.NotCamelCaps
$table_prefix = env('DB_TABLE_PREFIX') ?? 'wp_';

/*
 * Salts
 */

define('AUTH_KEY', env('AUTH_KEY'));
define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
define('NONCE_KEY', env('NONCE_KEY'));
define('AUTH_SALT', env('AUTH_SALT'));
define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
define('NONCE_SALT', env('NONCE_SALT'));

/*
 * Load WordPress
 */

if (! defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

require_once ABSPATH . 'wp-settings.php';
