<?php

namespace App\Entity;

use App\DB\IConnection;
use App\Main\IConfig;

class ProductEntity extends Base
{
    private $configuration;

    public function __construct(IConnection $connection, IConfig $configuration)
    {
        parent::__construct($connection);
        $this->configuration = $configuration;
    }

    public function getTableName(): string
    {
        return $this->configuration::get('tablesMap')['product'];
    }

    public function getMap(): array
    {
        return ['title' => 'string', 'price' => 'string', 'description' => 'string', 'category_id' => 'string'];
    }
}