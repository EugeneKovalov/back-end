<?php

namespace App\Entity;

class CategoryEntity extends Base
{
    public function getTableName(): string
    {
        return $GLOBALS['tablesMap']['category'];
    }

    public function getMap(): array
    {
        return ['title' => 'string', 'description' => 'string'];
    }
}