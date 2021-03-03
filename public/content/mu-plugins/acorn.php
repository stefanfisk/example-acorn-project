<?php

// Plugins are not loaded when installing, and this can mess with the app code.
if (wp_installing()) {
    return;
}

new Roots\Acorn\Bootloader();
