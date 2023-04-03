<?php

require_once("./Spell/Spell.php");

Class HealSpell extends Spell{


    public function __construct(
        string $name,
        string $description,
        float $manaCost,
        private float $healPoints
    ){
        parent::__construct($name, $description, $manaCost);
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