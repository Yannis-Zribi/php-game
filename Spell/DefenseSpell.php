<?php

require_once("./Spell/Spell.php");

Class DefenseSpell extends Spell{


    public function __construct(
        string $name,
        string $description,
        float $manaCost,
        private float $defensePoints
    ){
        parent::__construct($name, $description, $manaCost);
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }
    
    public function getManaCost(){
        return $this->manaCost;
    }

    public function getDefensePoints(){
        return $this->defensePoints;
    }

    

    

}