<?php
# Composer dependencies...
require '../vendor/autoload.php';

# Our own dependencies...
require '../lib/loader.php';

$slim = new \Slim\Slim();       # Initialize the application. Custom logic goes below here.

# Route our request
AppRouter::route();             # Add your custom routes to /lib/routes.php

$slim->run();                   # Run the program