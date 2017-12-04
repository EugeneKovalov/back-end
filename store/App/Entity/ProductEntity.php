<?php

namespace App\Entity;

class ProductEntity extends Base
{
    public function getTableName(): string
    {
        return $GLOBALS['tablesMap']['product'];
    }

    public function getMap(): array
    {
        return ['title' => 'string', 'price' => 'string', 'description' => 'string', 'category_id' => 'string'];
    }
}