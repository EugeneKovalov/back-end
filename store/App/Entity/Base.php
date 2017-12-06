<?php

namespace App\Entity;

use App\DB\IConnection;
use Exception;

abstract class Base
{
    protected $connection;

    public function __construct(IConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return string
     */
    abstract public function getTableName(): string;

    /**
     * Метод должен вовращать поля текущей таблицы (кроме id)
     * в формате:
     * [
     *      'fieldName' => 'fieldType',
     *      'fieldName2' => 'fieldType',
     *      ...
     * ]
     *
     * @return array
     */
    abstract public function getMap(): array;


    /**
     * Этот метод вызываем перед каждым обновлением/добавлением,
     * здесь проверяем каждый элемент массива на соответствие типу из массива
     * полученного в getMap, если тип не соответствует - выбрасываем исключение.
     *
     * @param array $data
     * @return bool
     * @throws Exception
     */
    private function checkFields(array $data)
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

    /**
     * В этом методе получаем список элементов таблицы
     * полученной из метода getTableName
     *
     * @param int|null $id
     * @param string|null $from
     * @param null $count
     * @return bool|\mysqli_result
     */
    public function get(int $id = null, string $from = null, $count = null)
    {
        $tableName = $this->getTableName();
        $where = '';


        if ($id > 0) {
            $where = ' WHERE ID = ' . $id;
        }
        if (isset($from)) {
            if (isset($count)) {
                $query = "SELECT * FROM $tableName LIMIT $from, $count;";
            } else {
                $query = "SELECT * FROM $tableName LIMIT $from;";
            }
        } else {
            $query = "SELECT * FROM $tableName $where;";
        }
        $result = $this->connection->query($query);

        return $result;
    }

    public function getCountItems()
    {
        $tableName = $this->getTableName();

        $productCount = "SELECT COUNT(id) AS CNT FROM $tableName";
        $find_count = $this->connection->query($productCount);
        $count = mysqli_fetch_assoc($find_count);

        return isset($count['CNT']) ? $count['CNT'] : 0;
    }

    /**
     * В этом методе создаем новую запись в таблице getTableName.
     * Перед созданием проверяем корректность данных вызовом метода checkFields.
     *
     * @param array $data
     * @return bool|mysqli_result
     */
    public function create(array $data)
    {
        $tableName = $this->getTableName();

        if ($this->checkFields($data)) {
            foreach ($data as &$val) {
                $val = mysqli_escape_string($this->connection->get(), $val);
            }

            $cols = implode(',', array_keys($data));
            $values = "'" . implode("','", $data) . "'";

            return $this->connection->query("INSERT INTO $tableName ($cols) VALUES ($values);");
        }

        return false;
    }

    /**
     * В этом методе обновляем запись в таблице getTableName.
     * Перед обновлением проверяем корректность данных вызовом метода checkFields.
     *
     * @param int $id
     * @param array $data
     * @return bool|mysqli_result
     */
    public function update(int $id, array $data)
    {
        $tableName = $this->getTableName();
        $values = [];

        if ($this->checkFields($data))
        {
            foreach ($data as $key => $val)
            {
                $val = mysqli_escape_string($this->connection->get(), $val);
                $values[] = "$key = '$val'";
            }

            $values = implode(',', $values);

            return $this->connection->query("UPDATE $tableName SET $values WHERE id = $id;");
        }

        return false;
    }

    /**
     * В этом методе удаляем запись в таблице getTableName по id.
     *
     * @param int $id
     * @return bool|\mysqli_result
     */
    public function delete(int $id)
    {
        $tableName = $this->getTableName();

        return $this->connection->query("DELETE FROM $tableName WHERE id = $id;");
    }
}
