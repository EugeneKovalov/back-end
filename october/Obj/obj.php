<?php

class CarOwner
{
    public $owner = '';
}
//
//$toyota = new Car();
//
//$toyota -> price = 22;
//
//echo $toyota -> price.PHP_EOL;
//
//class Human
//{
//    /** @var  int */
//    private $age = 20;
//    /** @var  string */
//    private $name;
//
//    /**
//     * @param int $age
//     * @return void|bool
//     */
//    public function setAge(int $age) {
//        if ($age < 18) {
//            echo "u too young".PHP_EOL;
//            return;
//        }
//        $this->age = $age;
//    }
//
//    /**
//     * @return int
//     */
//    public function getAge($formatted = false) {
//        if ($formatted) {
//            return "Мне {$this->age} лет";
//        }
//        return $this->age;
//    }
//
//    public function setName(string $name) {
//        $this->name = $name;
//    }
//    public function getName() {
//        return $this->name;
//    }
//
//    private function doubleAge(int $age) {
//        echo "Через 20 лет мне будет. " . ($this->age + 20).PHP_EOL;
//    }
//
//    function showName() {
//        echo "{$this->name}, I am {$this->age} old.".PHP_EOL;
//        $this->doubleAge(21);
//        return;
//    }
//}
//
//$human1 = new Human();
//$human1 -> setName('Bill');
//$human1 -> setAge(13);
//
//$human2 = new Human();
//$human2 -> setName('David');
//$human2 -> setAge(30);
//$human2 -> getAge(true);
//
//$human3 = $human2;
//$human3->setName('Jack');
//$human3->showName();
//
//$human2->showName();
//
//$human4 = clone($human2);
//$human4->setName('Stas');
//$human2->showName();
//
///** @var Human $human5 */
//$human5 = serialize($human2);
//$human5 = unserialize($human2);


class Car {
    private $price;
    private $color;
    protected $brand;

    function __construct($brand, $color, $price) {

        $this->brand = $brand;
        $this->color = $color;
        $this->price = $price;

        echo "New Car".PHP_EOL;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo 'Destructed!'.PHP_EOL;
    }
}

$ford = new Car('Ford', 'Red', '15000');

var_dump($ford);

//$ford = null;


class Truck extends Car {
    private $weight;

    function setWeight(int $weight) {
        $this->weight = $weight;
    }

    function __construct($brand, $color, $price, $weight)
    {
        parent::__construct($brand, $color, $price);
        $this->setWeight($weight);
    }

    public function displayParams() {
        echo "Brand: {$this->brand}";
    }
}

$kraz = new Truck('Kraz', 'Black', '20000', 4000);
$kraz->setWeight(3000);
$kraz->displayParams();

var_dump($kraz);