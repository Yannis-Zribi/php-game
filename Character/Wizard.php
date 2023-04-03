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
        if ($magicalAttackPoints > $physicalAttackPoints) {
            throw new Exception("The Wizard cannot have more magic damages than physical damages.");
        }
        parent::__construct($name, $type, $lifePoints, $manaPoints, $physicalAttackPoints, $magicalAttackPoints, $defensePoints, $attackSpell, $defenseSpell, $healSpell, $weapon);
    }

    public function getAttackDamages(): float
    {
        if (chance(20)) {
            // echo "Coup critique !".PHP_EOL;
            return $this->physicalAttackPoints*1.2;
        }
        return parent::getAttackDamages();
    }

    public function getDefenseRatio()
    {
        if (chance(10)) {
            // echo "Esquive !".PHP_EOL;
            return 1;
        }
        return parent::getDefenseRatio();
    }
}