<?php

namespace App\Entity;

class User extends Base
{
    public function getTableName()
    {
        return 'users';
    }

    public function checkFields($data)
    {
        if (!isset($data['login']) ||
            !isset($data['email']) ||
            !isset($data['password']))
        {
            throw new \Exception('Please fill all fields');
        }
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            'id',
            'login',
            'email',
            'role',
            'password',
            'active',
        ];
    }

    public function register($data)
    {
        $data['password'] = md5('d41d8cd98f00b204e9800998ecf8427e' . $data['password']);
        $data['role'] = 'user';

        return $this->save($data);
    }

    public function findUserByEmail($email)
    {
        $exists = $this->conn->query(
            'SELECT * FROM '. $this->getTableName(). ' WHERE email = ' . $this->conn->escape($email) . ' LIMIT 1');

        if (empty($exists))
        {
            return false;
        }
        return true;
    }
}