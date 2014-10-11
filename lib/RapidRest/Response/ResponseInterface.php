<?php
use API\Exceptions\APIException;

interface ResponseInterface {
    /**
     * Using an array will enable you to extend this however you'd like.
     * The returned bean (RedBean terminology) should be stored in $data['data']
     * If you want to add things like status codes, white lists, etc. feel free to put
     * them into $data['statusCodes'] or whatever.
     *
     * @param array $data
     */
    function __construct(array $data);

    /**
     * Override this function to create your own formatting
     * @return mixed JSON, XML, etc.
     */
    function showOutput();
}