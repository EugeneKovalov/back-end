<?php

namespace App\Controllers;

use App\Core\App;
use App\Entity\User;

class UsersController extends Base
{
    /** @var User */
    private $usersModel;

    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->usersModel = new User(App::getConnection());
    }

    public function registerAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            // Init data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'login' => trim($_POST['login']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'password_confirm' => trim($_POST['password_confirm'])
            ];

            // Validate
            if (empty($data['login']))
            {
                App::getSession()->setFlash('Please enter name');
            }
            else if (empty($data['email']))
            {
                App::getSession()->setFlash('Please enter email');
            }
            else if ($this->usersModel->findUserByEmail($data['email']))
            {
                App::getSession()->setFlash('User with this email already exist');
            }
            else if (empty($data['password']))
            {
                App::getSession()->setFlash('Enter password');
            }
            else if (strlen($data['password']) < 6)
            {
                App::getSession()->setFlash('Password must be at least 6 characters');
            }
            else if (empty($data['password_confirm']))
            {
                App::getSession()->setFlash('Confirm password');
            }
            else if ($data['password_confirm'] !== $data['password'])
            {
                App::getSession()->setFlash('Passwords not match');
            }
            else
            {
                $this->usersModel->register($data);
                App::getSession()->setFlash('Register Success!');
                App::getRouter()->redirect('users.register');
            }
        }
    }
}