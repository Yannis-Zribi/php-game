<?php

require_once("./Spell/Spell.php");

Class DefenseSpell extends Spell{

    //Constructeur
    public function __construct(
        private string $name,
        private string $description,
        private float $manaCost,
        private float $defensePoints
    ){}

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

    public function getDefensePoints(){
        return $this->defensePoints;
    }
}