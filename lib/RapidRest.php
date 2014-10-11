<?php

class RapidRest {

    public static function dbInit() {
        global $DB_CONFIG;
        switch (strtolower($DB_CONFIG['engine'])) {
            /*
             * SQLite Connection
             */
            case "sqlite":
                R::setup('sqlite:'.$DB_CONFIG['SQLiteDB']);
                break;

            /*
             * PostgreSQL & MySQL Connections
             */
            case "postgresql": # In case you didn't follow the instructions ;)
            default:
                R::setup($DB_CONFIG['engine'] . ':host='.$DB_CONFIG['host'].';dbname='.$DB_CONFIG['db'],$DB_CONFIG['user'],$DB_CONFIG['pass']);
                break;
        }
    }
}