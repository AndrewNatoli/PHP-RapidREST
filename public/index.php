<?php
# Load everything!
require '../config/loader.php';

$slim = new \Slim\Slim();       # Initialize the application. Custom logic goes below here.

# Set up RedBean
RapidRest::dbInit();            # It's just a configuration-friendly call to R::setup()

# Route our request
AppRouter::route();             # Add your custom routes to /lib/routes.php

$slim->run();                   # Run the program