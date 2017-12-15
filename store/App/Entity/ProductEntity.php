<?php

namespace App\Entity;

use App\DB\IConnection;
use App\Main\IConfig;

class ProductEntity extends Base
{
    public function getTableName(): string
    {
        return $this->configuration::get('tablesMap')['product'];
    }

    public function getMap(): array
    {
        return ['title' => 'string', 'price' => 'string', 'description' => 'string', 'category_id' => 'string'];
    }
}