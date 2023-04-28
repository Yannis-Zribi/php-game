<?php

class Wizard extends Character
{
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

        if ($magicalAttackPoints < $physicalAttackPoints) {
            throw new Exception("The Wizard cannot have more physical damages than magical damages.");
        }
        parent::__construct($name, $type, $lifePoints, $manaPoints, $physicalAttackPoints, $magicalAttackPoints, $defensePoints, $attackSpell, $defenseSpell, $healSpell, $weapon);
    }

    public function getMagicalAttackPoints(): float
    {
        //1 chance sur 5 de faire un coup critique
        if (rand(1,10) <= 2) {
            print("Coup Critique  (Magique) de {$this->getName()} !".PHP_EOL);
            return $this->magicalAttackPoints * 1.1;
        }
        return parent::getMagicalAttackPoints();
    }

    public function getDefenseRatio()
    {
        //1 chance sur 20 d'esquiver une attaque
        if (rand(1,20) == 1) {
            print("{$this->getName()} a esquivé !".PHP_EOL);
            return 1;
        }
        return parent::getDefenseRatio();
    }
}