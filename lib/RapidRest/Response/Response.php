<?php
namespace API\Response;
use API\Exceptions\APIException;

/**
 * Abstract Class Response
 *
 * Basic response class.
 * Extend the showOutput() function to parse $this->data as JSON, XML, etc.
 * Extend __construct() to set the content type (or do it in showOutput()
 *
 * Check out the ResponseInterface documentation for suggestions on expanding
 * the functionality of this for your own purposes.
 *
 * @package API\Response
 */
abstract class Response implements  \ResponseInterface{

    /**
     * @var {array | object | String}
     *
     * Values to return. Usually an array or an object but it can be a string
     * to return status messages.
     */
    var $data;

    /**
     * Constructor.
     * @param array $data
     * As defined by the interface, our bean should be stored in $data['data']
     * @throws APIException If you don't properly include a bean.
     */
    function __construct(array $data) {
        # What's our object to return?
        /* Removed >= 1.0.1
        if(!empty($data['data'])) {
            $this->data = $data['data'];
        } else {
            # Throw an exception if there's an empty response
            throw new APIException("No response",500);
        }
        */
        $this->data = $data;

        # Display the output
        $this->showOutput();
    }

    /**
     * Override this to display output to the client.
     */
    function showOutput() {
        // Extend this for custom handlers.
    }

}