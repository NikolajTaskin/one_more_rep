<?php

namespace App\Controllers\Base;

use App\App;

class AdminController
{
    protected string $redirect =  '/admin/orders';

    public function __construct()
    {
        if (!App::$session->getUser() || App::$session->getUser()['role'] != 'admin') {
            header("Location: $this->redirect");
            exit();
        }
    }
}