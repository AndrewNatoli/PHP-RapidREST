<?php
namespace API\Response;

/**
 * Class JSON
 *
 * Extends the Response class for the sake of custom output.
 * Sets the header type to JSON and json_encode()s the data.
 *
 * Friendly reminder that we implement the ResponseInterface through the Response class.
 *
 * @package API\Response
 */
class JSON extends Response {

    /**
     * Set our content-type to JSON and then run our parent constructor
     * @param array $data
     */
    function __construct(array $data) {
        global $slim;
        $slim->response->headers->set('Content-Type', 'application/json');
        parent::__construct($data);
    }

    /**
     * json_encode our output and send it to the client
     */
    function showOutput() {
        $output = json_encode($this->data);
        echo $output;
    }
}