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

    /**
     * Return all records for a type
     * @param string $type Database table
     * @return string JSON All of the records and their contents
     * @throws API\Exceptions\APIException No records found, 404
     */
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
     * @param string $type Database Table
     * @param int $id Record ID
     * @return string JSON Item contents
     * @throws API\Exceptions\APIException Record not found, 404.
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

    /**
     * Create a bean using post data and store it in the database
     * @param string $type Table
     * @return string JSON {"data":{"id":new_id}}
     * @throws API\Exceptions\APIException No data received, 400
     */
    public static function postItem($type) {
        $bean = R::dispense($type);
        if(sizeof($_REQUEST) > 0) {
            $bean->import($_REQUEST);
            $id = R::store($bean);
            return new JSON(array("data"=>array("id"=>$id)));
        } else {
            throw new APIException("No data received.",400);
        }


    }

    /**
     * PUT request to update an existing bean
     * @param string $type Table
     * @param int $id ID
     * @return string JSON {"data":{"id":$id}}
     * @throws API\Exceptions\APIException { Not found, 404 | No $_POST data received, 400 }
     */
    public static function putItem($type,$id) {
        $bean = R::load($type,$id);
        # Make sure we have a result
        $id = $bean->export(); # Exports the RedBean to an array
        if($id['id'] == 0) {
            throw new APIException("Record not found.",404);
        } else {
            if(sizeof($_REQUEST) > 0) {
                $bean->import($_REQUEST);
                R::store($bean);
                return new JSON(array("data"=>array("id"=>$id['id'])));
            } else {
                throw new APIException("No data received.", 400);
            }
        }
    }

    /**
     * DELETE request to delete an existing record
     * @param string $type Table
     * @param int $id Record ID
     * @return string JSON {"data":"ok"}
     * @throws API\Exceptions\APIException { Record not found, 404 }
     */
    public static function deleteItem($type,$id) {
        $bean = R::load($type,$id);
        # Make sure we have a result
        $id = $bean->export(); # Exports the RedBean to an array
        if($id['id'] == 0) {
            throw new APIException("Record not found.",404);
        } else {
            R::trash($bean);
            return new JSON(array("data"=>"ok"));
        }
    }
}