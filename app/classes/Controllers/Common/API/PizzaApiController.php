<?php

namespace App\Controllers\Common\API;

use App\App;
use App\Controller;
use App\Views\Forms\Admin\Pizza\PizzaCreateForm;
use App\Views\Forms\Admin\Pizza\PizzaUpdateForm;
use Core\Api\Response;

class PizzaApiController
{

    public function index(): string
    {
        // This is a helper class to make sure
        // we use the same API json response structure
        $response = new Response();

        $role = App::$session->getUser() ? App::$session->getUser()['role'] : null;
        $pizzas = App::$db->getRowsWhere('pizzas');

        foreach ($pizzas as $row_id => &$pizza) {
            // We must add this, so JS can assign the id
            $pizza['id'] = $row_id;


        }

        // Setting "what" to json-encode
        $response->setData($pizzas);

        // Returns json-encoded response
        return $response->toJson();
    }

}






