<?php


require_once("./Character/Character.php");


Class Soldier extends Character{



    public function __construct(
        string $name,
        string $type,
        float $lifePoints,
        float $manaPoints,
        float $physicalAttackPoints,
        float $magicalAttackPoints,
        float $defensePoints,
        Spell $attackSpell,
        Spell $defenseSpell,
        Spell $healSpell,
        ?Weapon $weapon = NULL,

   )
   {

       if ($magicalAttackPoints > $physicalAttackPoints) {
           throw new Exception("The Soldier cannot have more magical damages than physical damages.");
       }
       parent::__construct($name, $type, $lifePoints, $manaPoints, $physicalAttackPoints, $magicalAttackPoints, $defensePoints, $attackSpell, $defenseSpell, $healSpell, $weapon);
   }


    public function getPhysicalAttackPoints(): float
    {
        //1 chance sur 5 de faire un coup critique
        if (rand(1,10) <= 2) {
            print("Coup Critique (Physique) de {$this->getName()} ! ".PHP_EOL);
            return $this->physicalAttackPoints * 1.2;
        }
        return parent::getPhysicalAttackPoints();
    }
}