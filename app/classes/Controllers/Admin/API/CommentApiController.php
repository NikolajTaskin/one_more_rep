<?php

namespace App\Controllers\Admin\API;

use App\App;
use App\Controllers\Base\API\AdminController;
use App\Views\Forms\Admin\Pizza\PizzaCreateForm;
use App\Views\Forms\Admin\Pizza\PizzaUpdateForm;
use Core\Api\Response;

class CommentApiController extends AdminController
{


    public function create(): string
    {

        // This is a helper class to make sure
        // we use the same API json response structure
        $response = new Response();
        $form = new PizzaCreateForm();

        if ($form->validate()) {
            $comment = $form->values();
            $comment['id'] = App::$db->insertRow('comments', $form->values());
            $response->setData($comment);
        } else {
            $response->setErrors($form->getErrors());
        }

        // Returns json-encoded response
        return $response->toJson();
    }

    public function edit(): string
    {
        // This is a helper class to make sure
        // we use the same API json response structure
        $response = new Response();

        $id = $_POST['id'] ?? null;

        if ($id === null) {
            $response->appendError('ApiController could not update, since ID is not provided! Check JS!');
        } else {
            $comment = App::$db->getRowById('comments', $id);
            $comment['id'] = $id;

            // Setting "what" to json-encode
            $response->setData($comment);
        }

        // Returns json-encoded response
        return $response->toJson();
    }

    /**
     * Updates pizza data
     * and returns array from which JS generates grid item
     *
     * @return string
     */
    public function update(): string
    {
        // This is a helper class to make sure
        // we use the same API json response structure
        $response = new Response();

        $id = $_POST['id'] ?? null;

        if ($id === null || $id == 'undefined') {
            $response->appendError('ApiController could not update, since ID is not provided! Check JS!');
        } else {
            $form = new PizzaUpdateForm();

            if ($form->validate()) {
                App::$db->updateRow('comments', $id, $form->values());

                $comment = $form->values();
                $comment['id'] = $id;
                $comment['buttons']['delete'] = 'Delete';
                $comment['buttons']['edit'] = 'Edit';

                $response->setData($comment);
            } else {
                $response->setErrors($form->getErrors());
            }
        }

        // Returns json-encoded response
        return $response->toJson();
    }

    public function delete(): string
    {
        // This is a helper class to make sure
        // we use the same API json response structure
        $response = new Response();

        $id = $_POST['id'] ?? null;

        if ($id === null || $id == 'undefined') {
            $response->appendError('ApiController could not delete, since ID is not provided! Check JS!');
        } else {
            $response->setData([
                'id' => $id
            ]);
            App::$db->deleteRow('comments', $id);
        }

        // Returns json-encoded response
        return $response->toJson();
    }
}






