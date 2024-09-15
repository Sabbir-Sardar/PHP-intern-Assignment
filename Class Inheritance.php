<?php
//Class Shape
abstract class shape
{
    abstract public function area();
}

//Class Circle
class Circle extends Shape{
private $radius;
public function __construct($radius)
{
$this->radius = $radius;
}
public function area() {
//return 3.1416 * pow($this->radius, 2);
return 3.1416*($this->radius * $this->radius);
}
}

//class rectangle
class Rectangle extends Shape {
 private $width;
 private $height;

public function __construct($width, $height)
{
$this->width = $width;
$this->height = $height;
}

public function area() {
return $this->width * $this->height;
}
}

//Circle example
$circle = new Circle(10);
printf("Circle: %s\n", $circle->area());

//Rectangle example
$rectangle = new Rectangle(10, 20);
printf("Rectangle: %s\n", $rectangle->area());
