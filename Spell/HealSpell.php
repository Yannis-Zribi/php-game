<?php

require_once("./Spell/Spell.php");

Class HealSpell extends Spell{

    //Constructeur
    public function __construct(
        private string $name,
        private string $description,
        private float $manaCost,
        private float $healPoints
    ){
        parent::__construct($name, $description, $manaCost);
    }

    //Getters
    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }
    
    public function getManaCost(){
        return $this->manaCost;
    }

    public function getHealPoints(){
        return $this->healPoints;
    }
}