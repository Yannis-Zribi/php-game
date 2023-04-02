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
        if ($magicDamages > $attackDamages) {
            throw new Exception("The archer cannot have more magic damages than physical damages.");
        }
        parent::__construct($health, $defenseRatio, $attackDamages, $magicDamages);
    }

    public function getAttackDamages(): float
    {
        if (chance(20)) {
            // echo "Coup critique !".PHP_EOL;
            return $this->attackDamages*1.2;
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