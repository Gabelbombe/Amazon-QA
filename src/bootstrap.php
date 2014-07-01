<?php
// Start the session
session_cache_limiter(0);
session_start();

// Composer autoloading
require APP_PATH . '/vendor/autoload.php';

// Include config
require APP_PATH . '/src/config/config.php';