<?php

namespace App\Entity;

use Exception;

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

    /**
     * Этот метод вызываем перед каждым обновлением/добавлением,
     * здесь проверяем каждый элемент массива на соответствие типу из массива
     * полученного в getMap, если тип не соответствует - выбрасываем исключение.
     *
     * @param array $data
     * @return bool
     * @throws Exception
     */
    protected function checkFields(array $data): bool
    {
        $tableName = $this->getTableName();
        $map = $this->getMap();

        foreach ($data as $key => $val)
        {
            if ($map[$key] != gettype($val))
            {
                throw new Exception($key . ' type not identical to type in ' . $tableName);
            }
        }
        return true;
    }
}