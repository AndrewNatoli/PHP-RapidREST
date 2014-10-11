<?php

require_once 'Exceptions/APIException.php';
require_once 'Response/ResponseInterface.php';
require_once 'Response/Response.php';
require_once 'Response/JSON.php';

use API\Exceptions\APIException;
use API\Response\JSON;

class RapidRest {

    /**
     * Initializes RedBean.
     * Call this once in index.php (which I did by default...) and you're good to go!
     * If making changes check out the RedBeanPHP doc...
     * @url http://redbeanphp.com/connection
     */
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

    public static function getList($type) {
        $beans = R::find($type);
        $response = R::exportAll($beans);
        if(sizeof($response) > 0) {
            return new JSON(array("data"=>$response));
        } else {
            throw new APIException("No " . $type . " records found.",404);
        }

    }

    /**
     * Fetch a bean from the database and display its contents
     * @param $type
     * @param $id
     * @return JSON
     * @throws API\Exceptions\APIException
     */
    public static function getItem($type,$id) {
        $response = array();
        $$type = R::load($type, $id);
        $response = $$type->export(); # Exports the RedBean to an array

        if($response['id'] == 0) {  # RedBean returns ID 0 for new records.
            throw new APIException($type . " not found.", 404);
        } else {
            return new JSON(array("data"=>$response));
        }
    }

    public static function postItem($type) {

    }

    public static function putItem($type,$id) {

    }

    public static function deleteItem($type,$id) {

    }
}