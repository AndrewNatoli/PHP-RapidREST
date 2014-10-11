<?php
/**
 * RapidREST Application Loader
 */

# Load SlimFramework and RedBeanPHP
require_once '../vendor/autoload.php';

# Configuration...
require_once 'rapidrest-config.php';

# Load RapidREST
require_once '../lib/RapidRest/RapidRest.php';

# Load our AppRouter
require_once 'routes.php';

/* Load your own additional files below */