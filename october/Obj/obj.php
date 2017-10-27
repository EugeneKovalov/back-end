<?php

// 1
class Task1
{
    /** @var string */
    public $name;
    /** @var int */
    public $age;
    /** @var int */
    public $salary;
}

$ivanTask1 = new Task1();
$ivanTask1->name = "Иван";
$ivanTask1->age = 25;
$ivanTask1->salary = 1000;

$vasyaTask1 = new Task1();
$vasyaTask1->name = "Вася";
$vasyaTask1->age = 26;
$vasyaTask1->salary = 2000;

echo "Cумма зарплат Ивана и Васи = " . ($vasyaTask1->salary + $ivanTask1->salary) .PHP_EOL;
echo "Cумма возрастов Ивана и Васи = " . ($vasyaTask1->age + $ivanTask1->age) .PHP_EOL;

// 2
class Task2
{
    /** @var string */
    private $name;
    /** @var int */
    private $age;
    /** @var int */
    private $salary;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age)
    {
        if ($this->checkAge($age)) {
            $this->age = $age;
        }
    }

    /**
     * @return int
     */
    public function getSalary(): int
    {
        return $this->salary;
    }

    /**
     * @param int $salary
     */
    public function setSalary(int $salary)
    {
        $this->salary = $salary;
    }

    // 3.
    private function checkAge($age): bool
    {
        if ($age < 1 || $age >= 100)
        {
            echo "Некорректный возраст".PHP_EOL;
            return false;
        }
        return true;
    }
}

$ivanTask2 = new Task2();
$vasyaTask2 = new Task2();

$ivanTask2->setName('Иван');
$vasyaTask2->setName('Вася');

$ivanTask2->setAge(25);
$vasyaTask2->setAge(26);

$ivanTask2->setSalary(1000);
$vasyaTask2->setSalary(2000);

echo "Cумма зарплат Ивана и Васи = " . ($vasyaTask2->getSalary() + $ivanTask2->getSalary()) .PHP_EOL;
echo "Cумма возрастов Ивана и Васи = " . ($vasyaTask2->getAge() + $ivanTask2->getAge()) .PHP_EOL;

$oldestMan = new Task2();
$oldestMan->setAge(120);
$oldestMan->setAge(0);

//echo $oldestMan->getAge();

// 4
class Task4
{
    /** @var string */
    private $name;
    /** @var int */
    private $age;
    /** @var int */
    private $salary;

    public function __construct($name, $age, $salary)
    {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSalary(): int
    {
        return $this->salary;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }
}

$dimaTask4 = new Task4("Dima", 25, 1000);

echo "Произведение возраста и зарплаты Димы = " . ($dimaTask4->getAge() * $dimaTask4->getSalary()).PHP_EOL;

// 5
class User
{
    protected $name;
    protected $age;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }
}

class Worker extends User
{
    private $salary;

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }
}

$ivanWorker = new Worker();
$ivanWorker->setName("Иван");
$ivanWorker->setAge(25);
$ivanWorker->setSalary(1000);

$vasyaWorker = new Worker();
$vasyaWorker->setName("Вася");
$vasyaWorker->setAge(26);
$vasyaWorker->setSalary(2000);

echo "Cумма зарплат Ивана и Васи = " . ($vasyaWorker->getSalary() + $ivanWorker->getSalary()) .PHP_EOL;

class Student extends User
{
    private $stipend;
    private $course;

    /**
     * @return mixed
     */
    public function getStipend()
    {
        return $this->stipend;
    }

    /**
     * @param mixed $stipend
     */
    public function setStipend($stipend)
    {
        $this->stipend = $stipend;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }
}

// 6
class Driver extends Worker
{
    /** @var  int */
    private $drivingExperience;
    private $drivingCategory = ['A', 'B', 'C'];

    /**
     * @return int
     */
    public function getDrivingExperience(): int
    {
        return $this->drivingExperience;
    }

    /**
     * @param int $drivingExperience
     */
    public function setDrivingExperience(int $drivingExperience)
    {
        $this->drivingExperience = $drivingExperience;
    }

    /**
     * @return array
     */
    public function getDrivingCategory(): array
    {
        return $this->drivingCategory;
    }

    /**
     * @param array $drivingCategory
     */
    public function setDrivingCategory(array $drivingCategory)
    {
        $this->drivingCategory = $drivingCategory;
    }
}

// 7
class Form
{
    private function pushElement($attributes, $element)
    {

    }
    function input($attributes)
    {
        echo $this->pushElement($attributes, "<input type='{attr}'" . "value='{attr}'>".PHP_EOL);
    }

    function submit($attributes)
    {
        echo "<input type=\"$attributes[0]\" " . "value=\"$attributes[1]\">".PHP_EOL;
    }

    function password($attributes)
    {
        echo "<input type=\"$attributes[0]\" " . "value=\"$attributes[1]\">".PHP_EOL;
    }

    function textArea($attributes)
    {
        echo "<textarea placeholder=\"$attributes[0]\">$attributes[1]</textarea>".PHP_EOL;
    }

    function open($attributes)
    {
        echo "<form action=\"$attributes[0]\" " . "method=\"$attributes[1]\">".PHP_EOL;
    }

    function close()
    {
        echo "</form>".PHP_EOL;
    }
}

$form = new Form();
$form->open(["index.php", "POST"]);
$form->input(["text", "!!!"]);
$form->password(["password", "!!!"]);
$form->submit(["submit", "go"]);
$form->textArea(["123", "!!!"]);
$form->close();

// 8
class Cookie
{
    function set($name, $value)
    {
        setcookie($name, $value);
    }

    function get($name)
    {
        if(isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
        echo "No cookie with " . $name . " has been found".PHP_EOL;
    }

    function delete($name)
    {
        setcookie($name, "", time() - 3600);
    }
}

class Session
{
    public function __construct()
    {
        session_start();
    }

    function create($name)
    {
        $_SESSION[$name] = $name;
    }

    function get($name)
    {
        return $_SESSION[$name];
    }

    function delete($name)
    {
        unset($_SESSION[$name]);
    }

    function check($name) : bool
    {
        if (isset($_SESSION[$name]))
        {
            echo "Сессия существует".PHP_EOL;
            return true;
        }
        else {
            echo "Сессия не существует".PHP_EOL;
            return false;
        }
    }
}