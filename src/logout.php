<?php
// TODO: better understand what the session library is doing
session_start();
$_SESSION = [];
session_destroy();
header('Location: index.php');
exit;
