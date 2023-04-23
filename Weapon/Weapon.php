<?php


abstract class Weapon{

    public function __construct(
        protected string $name,
        protected string $description,
    ){

    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function __toString()
    {
        return static::class;
    }
}