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
        $comments = App::$db->getRowsWhere('comments');

        foreach ($comments as $row_id => &$comment) {
            // We must add this, so JS can assign the id
            $comment['id'] = $row_id;


        }

        // Setting "what" to json-encode
        $response->setData($comments);

        // Returns json-encoded response
        return $response->toJson();
    }

}






