<?php
namespace API\Exceptions;
use Exception;

/**
 * Class APIException
 * A nice little one-size-fits-all exception to send errors to our API clients! :)
 * Simply give it a message and status code. It stops execution and doesn't even use
 * components from the SlimFramework for maximum safety!
 *
 * @usage throw new APIException("Record not found...",404);
 * @package API\Exceptions
 */
class APIException extends Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 500, Exception $previous = null) {
        Header('Content-Type: application/json');
        $data['message'] = $message;
        $data['statuscode'] = $code;
        echo json_encode($data);
        die();
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}