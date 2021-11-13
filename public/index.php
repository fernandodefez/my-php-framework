<?php

// Aplying Front Controller Pattern

// __DIR__ allows to access from the root directory (routes)
require __DIR__ . '/../vendor/autoload.php';

$request = new App\Http\Request();
$request->send();
