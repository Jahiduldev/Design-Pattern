<?php
/**
 *
 */
interface IAnimal
{
    /**
     * @return string
     */
    public function speak(): string;
}

/**
 *
 */
class Dog implements IAnimal
{
    /**
     * @return string
     */
    public function speak(): string
    {
        return "barking";
    }
}

/**
 *
 */
class Cat implements IAnimal
{
    /**
     * @return string
     */
    public function speak(): string
    {
        return "Mou Mou";
    }
}

/**
 *
 */
class Cow implements IAnimal
{
    /**
     * @return string
     */
    public function speak(): string
    {
        return "Hamba Hamba";
    }
}

/**
 *
 */
class AnimalFactory
{
    /**
     * @param IAnimal $animal
     * @return string
     */
    public function createAnimal(IAnimal $animal)
    {
        return $animal->speak();
    }
}
//we can pass any object here that implement IAnimal
$animal =  (new AnimalFactory())->createAnimal(new Dog());
echo $animal;
