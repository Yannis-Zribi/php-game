<?php

class Archer extends Character
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
        parent::__construct($name, $type, $lifePoints, $manaPoints, $physicalAttackPoints, $magicalAttackPoints, $defensePoints, $attackSpell, $defenseSpell, $healSpell, $weapon);
    }

    public function getDefensePoints()
    {
        //1 chance sur 10 d'esquiver une attaque
        if (rand(1,10) == 1) {
            print("{$this->getName()} a esquivé !".PHP_EOL);
            return 1;
        }
        return parent::getDefensePoints();
    }
}