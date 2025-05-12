<?php
// Secure session configuration
session_set_cookie_params([
    'lifetime' => 0, // Until the browser is closed
    'path' => '/',
    'domain' => 'yourdomain.com', // optional
    'secure' => true, // only if using HTTPS
    'httponly' => true,
    'samesite' => 'Strict'
]);

ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Only if HTTPS
ini_set('session.use_strict_mode', 1); // Prevents accepting uninitialized session IDs

session_start();
