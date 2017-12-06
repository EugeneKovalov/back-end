<?php

namespace App\Entity;

use App\DB\IConnection;
use App\Main\IConfig;

class CategoryEntity extends Base
{
    private $configuration;

    public function __construct(IConnection $connection, IConfig $configuration)
    {
        parent::__construct($connection);
        $this->configuration = $configuration;
    }

    public function getTableName(): string
    {
        return $this->configuration::get('tablesMap')['category'];
    }

    public function getMap(): array
    {
        return ['title' => 'string', 'description' => 'string'];
    }
}