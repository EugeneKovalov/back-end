<?php

namespace App\Entity;

use Exception;

abstract class Base {

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
    abstract protected function checkFields(array $data): bool;

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
        global $connection;
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
        $result = mysqli_query(
            $connection, $query
        );

        return $result;
    }

    public function getCountItems()
    {
        global $connection;
        $tableName = $this->getTableName();

        $product_count = "SELECT * FROM $tableName";
        $find_count = mysqli_query($connection, $product_count);
        $count = mysqli_num_rows($find_count);

        return $count;
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
        global $connection;
        $tableName = $this->getTableName();

        if ($this->checkFields($data)) {
            foreach ($data as &$val) {
                $val = mysqli_escape_string($connection, $val);
            }

            $cols = implode(',', array_keys($data));
            $values = "'" . implode("','", $data) . "'";

            return mysqli_query(
                $connection,
                "INSERT INTO $tableName ($cols) VALUES ($values);"
            );
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
        global $connection;
        $tableName = $this->getTableName();
        $values = [];

        if ($this->checkFields($data)) {

            foreach ($data as $key => $val) {
                $val = mysqli_escape_string($connection, $val);
                $values[] = "$key = '$val'";
            }

            $values = implode(',', $values);

            return mysqli_query(
                $connection,
                "UPDATE $tableName SET $values WHERE id = $id;"
            );
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
        global $connection;

        $tableName = $this->getTableName();

        return mysqli_query(
            $connection,
            "DELETE FROM $tableName WHERE id = $id;"
        );
    }
}
