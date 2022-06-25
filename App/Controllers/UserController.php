<?php

namespace App\Controllers;

use App\Concerns\FormManager;
use App\Concerns\ViewManager;
use App\Models\Entities\User;
use App\Models\Manager\UserManager;

class UserController extends BaseController
{
    private const IS_ONLINE = false;
    use ViewManager;
    use FormManager;

    public function login($params): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->formCheck($params, $this->errors);

            $user = new User();


            if ($this->isSubmitted && $this->isValidated) {
                    session_start();
                    dd($user->getAll());
                    $this->redirect('/', 'flashMessage', 'Successful connection');
                $this->redirect('/login', 'flashMessage', 'Error connection');
            }
        }
        $this->renderView('forms/login', ['errors' => $this->errors]);
    }

    public function register($params): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->formCheck($params, $this->errors);
            if ($this->isSubmitted && $this->isValidated) {
                $user = new UserManager();
                $params['password'] = password_hash($params['password'], PASSWORD_BCRYPT);
                $user->create(User::class, $params);
            }
        }
        $this->renderView('forms/register', ['errors' => $this->errors]);
    }
}