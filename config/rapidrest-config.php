<?php
/**
 * RapidREST Configuration
 * If you don't need to define any custom routes and functions then this is the only file you need to touch!
 * Otherwise you'll want to check out /lib/routes.php for customizing this application.
 */

$DB_CONFIG = array();

$DB_CONFIG['engine']= "sqlite";          # Supported and tested: mysql. SHOULD work: pdsql & sqlite (Enter their names as such!)

/* Non-SQLite settings. */
$DB_CONFIG['host']  = "localhost"; # Host
$DB_CONFIG['db']    = "rapidrest";      # Database
$DB_CONFIG['user']  = "root";           # Username
$DB_CONFIG['pass']  = "pass";           # Password

/* SQLite Configuration */
$DB_CONFIG['SQLiteDB']  = "my_database.db";
