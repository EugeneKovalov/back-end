<?php

namespace App\Controllers\Admin;

use App\Core\App;
use App\Entity\Page;

class PagesController extends \App\Controllers\Base
{
    /** @var Page */
    private $pageModel;

    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->pageModel = new Page(App::getConnection());
    }

    public function indexAction()
    {
        $this->data = $this->pageModel->list();
    }

    public function editAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
                $id = isset($this->params[0]) ? $this->params[0] : null;
                $this->data = [
                    'title' => $_POST['title'],
                    'content' => $_POST['content'],
                    'active' => $_POST['active'],
                    'new' => true,
                ];
                $this->pageModel->save($this->data, $id);
                App::getRouter()->redirect('index');
        }
        if (isset($this->params[0]) && $this->params[0] > 0) {
            $this->data = $this->pageModel->getById($this->params[0]);
        }
    }

    public function deleteAction()
    {
        $id = isset($this->params[0]) ? $this->params[0] : null;
        if (!$id)
        {
            App::getSession()->setFlash('page id not found');
        }
        else if ($this->pageModel->delete($id))
        {
            App::getSession()->setFlash('page deleted');
        }
        App::getRouter()->redirect('index');
    }
}