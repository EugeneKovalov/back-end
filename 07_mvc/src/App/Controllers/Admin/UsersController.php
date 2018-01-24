<?php

namespace App\Controllers\Admin;

use App\Controllers\Base;
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

    public function indexAction()
    {
        $this->data = $this->usersModel->list();
    }

    public function editAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
                $id = isset($this->params[0]) ? $this->params[0] : null;
                $this->data = [
                    'login' => $_POST['login'],
                    'email' => $_POST['email'],
                    'role' => $_POST['role'],
                    'password' => $_POST['password'],
                    'active' => !$_POST['active'],
                ];
                $this->usersModel->save($this->data, $id);
                App::getRouter()->redirect('index');
        }

        if (isset($this->params[0]) && $this->params[0] > 0)
        {
            $this->data = $this->usersModel->getById($this->params[0]);
        }
    }

    public function deleteAction()
    {
        $id = isset($this->params[0]) ? $this->params[0] : null;
        if (!$id)
        {
            App::getSession()->setFlash('user id not found');
        }
        else if ($this->usersModel->delete($id))
        {
            App::getSession()->setFlash('user deleted');
        }
        App::getRouter()->redirect('index');
    }
}