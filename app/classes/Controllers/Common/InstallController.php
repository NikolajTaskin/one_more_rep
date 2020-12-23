<?php

namespace App\Controllers\Common;

use App\App;
use Core\FileDB;

class InstallController
{
    public function install()
    {
        App::$db = new FileDB(DB_FILE);

        App::$db->createTable('users');
        App::$db->insertRow('users', ['email' => 'first@first.lt', 'password' => 'first', 'user_name' => 'Pirmas', 'user_surname' => 'Pirmiausias', 'role' => 'admin']);
        App::$db->createTable('comments');
    }
}

