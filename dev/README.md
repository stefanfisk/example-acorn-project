# Dev Environment

The dev environment is based on `docker-compose`.

All scripts in `bin/` support being called from arbitrary working directories.

To build and start the environment, simply run `bin/up`. All logging is done to the console, and the environment stops when killing the script.

The default hostname for the site is `wordpress.test`.

## MailHog

All emails sent by PHP are captured by MailHog, which can be accessed on <http://mailhog.test>.

## Xdebug

Xdebug is installed and configured to start for every request, but the extension is not enabled by default. The `enable-xdebug` and `disable-xdebug` scripts can be used for toggling Xdebug. Be aware that Xdebug can have a very large performance impact when the extension is loaded even if Xdebug is not enabled.

Xdebug will connect to port 9003 on the host, and a VSCode config for starting a debug session is included.

Traces and profiles are saved in `/storage/logs`, and all files in this directory except `.gitignore` can be safely deleted.

The `php` service inhering the host's `XDEBUG_CONFIG` environment variable, so the Xdebug config can be overridden by doing stuff like `XDEBUG_CONFIG='profiler_enable=1 profiler_aggregate=1' ./dev/bin/up` to enable the profiler..
