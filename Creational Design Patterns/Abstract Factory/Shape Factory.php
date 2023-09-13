<!-- Abstract Factory Pattern in the context of a "Shape" abstraction with different concrete shape factories representing
various materials for producing shapes (e.g., Wood and Metal). -->

<?php
// Abstract Factory for creating shapes
interface ShapeFactory {
    public function createCircle();
    public function createSquare();
}

// Concrete Factory for Wood Shapes
class WoodShapeFactory implements ShapeFactory {
    public function createCircle() {
        return new WoodCircle();
    }

    public function createSquare() {
        return new WoodSquare();
    }
}

// Concrete Factory for Metal Shapes
class MetalShapeFactory implements ShapeFactory {
    public function createCircle() {
        return new MetalCircle();
    }

    public function createSquare() {
        return new MetalSquare();
    }
}

// Abstract Product - Shape
interface Shape {
    public function display();
}

// Concrete Products for Wood Shapes
class WoodCircle implements Shape {
    public function display() {
        echo "Displaying a wooden circle.\n";
    }
}

class WoodSquare implements Shape {
    public function display() {
        echo "Displaying a wooden square.\n";
    }
}

// Concrete Products for Metal Shapes
class MetalCircle implements Shape {
    public function display() {
        echo "Displaying a metal circle.\n";
    }
}

class MetalSquare implements Shape {
    public function display() {
        echo "Displaying a metal square.\n";
    }
}

// Client code
$material = 'wood'; // You can change this to 'metal' to switch materials.
if ($material === 'wood') {
    $factory = new WoodShapeFactory();
} else {
    $factory = new MetalShapeFactory();
}

$circle = $factory->createCircle();
$square = $factory->createSquare();

$circle->display(); // Displays a wooden or metal circle depending on the factory.
$square->display(); // Displays a wooden or metal square depending on the factory.


?>