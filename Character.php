<?php

class Character{

    public function __construct(
        protected string $name,
        protected string $type,
        protected float $lifePoints,
        protected float $manaPoints,
        protected float $physicalAttackPoints,
        protected float $magicalAttackPoints,
        protected float $defensePoints,
        protected ?Weapon $weapon = NULL,
        protected Spell $attackSpell,
        protected Spell $defenseSpell,
        protected Spell $healSpell,

    ){}

    //Getters

    public function getName(){
        return $this->name;
    }

    public function gettype(){
        return $this->type;
    }

    public function getLifePoints(){
        return $this->lifePoints;
    }

    public function getManaPoints(){
        return $this->manaPoints;
    }

    public function getPhysicalAttackPoints(){
        return $this->physicalAttackPoints;
    }

    public function getMagicalAttackPoints(){
        return $this->magicalAttackPoints;
    }

    public function getDefensePoints(){
        return $this->defensePoints;
    }

    public function getWeapon(){
        return $this->weapon;
    }

    public function getAttackSpell(){
        return $this->attackSpell;
    }

    public function getDefenseSpell(){
        return $this->defenseSpell;
    }

    public function getHealSpell(){
        return $this->healSpell;
    }

    //Setters
    public function isDead()
    {
        return $this->lifePoints == 0;
    }

    public function isDamaged(int $physicalAttackPoints, int $magicalAttackPoints)
    {
        $damages = $physicalAttackPoints + $magicalAttackPoints;
        $this->setLifePoints(
            $this->getLifePoints() - ($damages - $damages * $this->getDefensePoints())
        );
    }

    public function __toString()
    {
        return static::class;
    }












}