<?php


abstract class Weapon{

    //Constructeur
    public function __construct(
        protected string $name,
        protected string $description,
    ){

    }

    //Getters
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