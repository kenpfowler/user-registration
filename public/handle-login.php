<?php
require __DIR__ . '/../src/config/init.php'; // contains session setup and other global configs

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit('Forbidden');
}

require_once __DIR__ . '/../src/handlers/login.php';
