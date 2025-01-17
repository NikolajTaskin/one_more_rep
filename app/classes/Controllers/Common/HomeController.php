<?php

namespace App\Controllers\Common;

use App\App;
use App\Views\BasePage;
use App\Views\Forms\Admin\Pizza\PizzaCreateForm;
use App\Views\Forms\Admin\Pizza\PizzaUpdateForm;
use Core\View;
use Core\Views\Link;

class HomeController
{
    protected $page;

    /**
     * Controller constructor.
     *
     * We can write logic common for all
     * other methods
     *
     * For example, create $page object,
     * set it's header/navigation
     * or check if user has a proper role
     *
     * Goal is to prepare $page
     */
    public function __construct()
    {
        $this->page = new BasePage([
            'title' => 'Komentarai',
            'js' => ['/media/js/home.js']
        ]);
    }

    /**
     * Home Controller Index
     *
     * @return string|null
     * @throws \Exception
     */
    public function index(): ?string
    {
        $user = App::$session->getUser();

        if ($user) {
            if ($user['role'] == 'admin') {
                $forms = [
                    'create' => (new PizzaCreateForm())->render(),
                    'update' => (new PizzaUpdateForm())->render()
                ];
            }

            $heading = "Oppa, čia juk {$user['user_name']} {$user['user_surname']}, pagaliau sugrįžai.";
            $links = [
                'login' => (new Link([
                    'url' => App::$router::getUrl('logout'),
                    'text' => 'Atsijungti'
                ]))->render()
            ];
        } else {
            $heading = 'Jus neprisijunges';
            $links = [
                'login' => (new Link([
                    'url' => App::$router::getUrl('login'),
                    'text' => 'Norite parašyti komentarą? Užsiregistruokite'
                ]))->render()
            ];
        }

        $content = (new View([
            'title' => 'SPORTO KLUBAS',
            'heading' => $heading,
            'forms' => $forms ?? [],
            'links' => $links ?? []
        ]))->render(ROOT . '/app/templates/content/index.tpl.php');

        $this->page->setContent($content);

        return $this->page->render();
    }
}

