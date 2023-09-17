<!-- 
We have a Computer class that represents a computer with various components like CPU, RAM, storage, and a graphics card.

The ComputerBuilder interface defines methods for building each component and getting the final Computer object.

The GamingComputerBuilder class is a concrete builder responsible for building a gaming computer with specific components.

The ComputerDirector class acts as the director and orchestrates the construction process.

In the usage section, we create an instance of the GamingComputerBuilder, set it as the builder for the computer director, construct the computer, and describe it. -->
<?php
// Product: Computer
class Computer {
    private $cpu;
    private $ram;
    private $storage;
    private $graphicsCard;

    public function setCPU($cpu) {
        $this->cpu = $cpu;
    }

    public function setRAM($ram) {
        $this->ram = $ram;
    }

    public function setStorage($storage) {
        $this->storage = $storage;
    }

    public function setGraphicsCard($graphicsCard) {
        $this->graphicsCard = $graphicsCard;
    }

    public function describe() {
        $description = "Computer with CPU: {$this->cpu}, RAM: {$this->ram}, Storage: {$this->storage}, Graphics Card: {$this->graphicsCard}";
        echo $description . PHP_EOL;
    }
}

// Abstract Builder Interface
interface ComputerBuilder {
    public function buildCPU();
    public function buildRAM();
    public function buildStorage();
    public function buildGraphicsCard();
    public function getComputer();
}

// Concrete Builder: GamingComputerBuilder
class GamingComputerBuilder implements ComputerBuilder {
    private $computer;

    public function __construct() {
        $this->computer = new Computer();
    }

    public function buildCPU() {
        $this->computer->setCPU("High-End Gaming CPU");
    }

    public function buildRAM() {
        $this->computer->setRAM("16GB DDR4");
    }

    public function buildStorage() {
        $this->computer->setStorage("1TB SSD");
    }

    public function buildGraphicsCard() {
        $this->computer->setGraphicsCard("NVIDIA RTX 3080");
    }

    public function getComputer() {
        return $this->computer;
    }
}

// Director
class ComputerDirector {
    private $computerBuilder;

    public function setComputerBuilder(ComputerBuilder $builder) {
        $this->computerBuilder = $builder;
    }

    public function constructComputer() {
        $this->computerBuilder->buildCPU();
        $this->computerBuilder->buildRAM();
        $this->computerBuilder->buildStorage();
        $this->computerBuilder->buildGraphicsCard();
    }

    public function getComputer() {
        return $this->computerBuilder->getComputer();
    }
}

// Usage
$gamingComputerBuilder = new GamingComputerBuilder();
$computerDirector = new ComputerDirector();

$computerDirector->setComputerBuilder($gamingComputerBuilder);
$computerDirector->constructComputer();
$gamingComputer = $computerDirector->getComputer();
$gamingComputer->describe();


?>
