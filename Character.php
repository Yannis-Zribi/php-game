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

    public function setLifePoints(float $lifePoints)
    {
        if ($lifePoints < 0) {
            $this->lifePoints = 0;
        } else {
            $this->lifePoints = round($lifePoints, 2);
        }
    }

    public function attacks(Character $character)
    {
        // echo "{$this} attaque {$character}";
        if ($this->hasWeapon()) {
        //     echo " avec {$this->weapon}";
        }
        // echo " !".PHP_EOL;

        $character->takesDamagesFrom($this);
    }
    
    public function takesDamagesFrom(Character $character)
    {
        $damages = $this->takesPhysicalDamagesFrom($character) + $this->takesMagicalDamagesFrom($character);
        $this->setLifePoints(
            $this->getLifePoints() - ($damages * (1 - $this->getDefensePoints()))
        );
    }

    protected function takesPhysicalDamagesFrom(Character $character)
    {
        return $character->getAttackDamages();
    }

    protected function takesMagicalDamagesFrom(Character $character)
    {
        return $character->getMagicDamages();
    }

    public function __toString()
    {
        return static::class;
    }












}