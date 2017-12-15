<?php

namespace App\Entity;

use App\DB\IConnection;
use App\Main\IConfig;

class CategoryEntity extends Base
{
    public function getTableName(): string
    {
        return $this->configuration::get('tablesMap')['category'];
    }

    public function getMap(): array
    {
        return ['title' => 'string', 'description' => 'string'];
    }
}