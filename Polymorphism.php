<?php
abstract class Animal
{
    abstract public function makeSound();
}

//class cow
class Cow extends Animal
{
    public function makeSound()
    {
        return "Hamba Hamba";
    }
}

//class cat
class Cat extends Animal {
    public function makeSound() {
        return "Meow Meow";
    }
}

//Class goat
class Goat extends Animal {
    public function makeSound() {
        return "Baa Baa";
    }
}


$animals = array(
    new Cow(),
    new Cat(),
    new Goat()
);

foreach ($animals as $animal) {
    printf("%s makes sound: %s\n",get_class($animal), $animal->makeSound());
}