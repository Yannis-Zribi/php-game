<?php

require_once("./Spell/Spell.php");

Class AttackSpell extends Spell{

    //Constructeur
    public function __construct(
        private string $name,
        private string $description,
        private float $manaCost,
        private float $physicalDamages,
        private float $magicalDamages,
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

    public function getPhysicalDamages(){
        return $this->physicalDamages;
    }

    public function getMagicalDamages(){
        return $this->magicalDamages;
    }
}