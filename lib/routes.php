<?php
/**
 * RapidREST Route File
 */

/**
 * Class AppRouter
 */
class AppRouter {
    /**
     * Called in public/index.php to route our application.
     * Define your custom routes at the beginning of the function otherwise the stock routes will override them!
     */
    public static function route() {
        global $slim;

        /* Define your custom routes here */

        $slim->get('/example/', function () {
            echo "This is a custom route example!";
        });

        $slim->get('/example/:id/', function ($id) {
            echo "This is a custom route example! You picked ID " . $id;
        });

        /* Put your custom routes above this line! */

        # GET list
        $slim->get('/:item/', function ($item) {
            echo "This is a list of " . $item . "!";
        });

        # GET item
        $slim->get('/:item/:id/', function ($item, $id) {
            echo "This is " . $item . " id " . $id;
        });

        # POST item
        $slim->post('/:item/', function ($item) {
            echo "Creating " . $item;
        });

        # PUT item
        $slim->put('/:item/:id/', function ($item, $id) {
            echo "Updating " . $item . " id " . $id;
        });

        # DELETE item
        $slim->put('/:item/:id/', function ($item, $id) {
            echo "Deleting " . $item . " id " . $id;
        });
    }
}