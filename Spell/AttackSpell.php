<?php

require_once("./Spell/Spell.php");

Class AttackSpell extends Spell{


    public function __construct(
        string $name,
        string $description,
        float $manaCost,
        private float $physicalDamages,
        private float $magicalDamages,
    ){
        parent::__construct($name, $description, $manaCost);
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->Description;
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