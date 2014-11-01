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

        $slim->any('/example/', function () {
            echo "This is a custom route example!";
        });

        $slim->any('/example/:id/', function ($id) {
            echo "This is a custom route example! You picked ID " . $id;
        });

        /* Put your custom routes above this line! */

        # GET list
        $slim->any('/get/:type/', function ($type) {
            RapidRest::getList($type);
        });

        # GET item
        $slim->any('/get/:type/:id/', function ($type, $id) {
            RapidRest::getItem($type, $id);
        });

        # POST item
        $slim->any('/post/:type/', function ($type) {
            RapidRest::postItem($type);
        });

        # PUT item
        $slim->any('/put/:type/:id/', function ($type, $id) {
            RapidRest::putItem($type, $id);
        });

        # DELETE item
        $slim->any('/delete/:type/:id/', function ($type, $id) {
            RapidRest::deleteItem($type, $id);
        });
    }
}