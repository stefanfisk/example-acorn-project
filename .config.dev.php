<?php

// Fix reverse proxy https.

if (! empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// Fix WP-CLI not defining HTTP_HOST.

if (defined( 'WP_CLI') && WP_CLI && ! isset($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = env('WP_HOME');
}

// Debugging

define('WP_DEBUG', true);
define('SCRIPT_DEBUG', true);
