<?php


abstract Class Spell{


    public function __construct(
        private string $name,
        private string $description,
        private float $manaCost
    ){}

    public function getName(){
        return $this->name;
    }
    
    public function __toString()
    {
        return static::class;
    }
}