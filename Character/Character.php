<?php

require_once("./Type.php");
require_once("./Weapon/HasWeapon.php");
require_once("./Weapon/Weapon.php");
require_once("./Spell/AttackSpell.php");
require_once("./Spell/DefenseSpell.php");
require_once("./Spell/HealSpell.php");

class Character{

    use Type;
    use HasWeapon;

    public function __construct(
        protected string $name,
        protected string $type,
        protected float $lifePoints,
        protected float $manaPoints,
        protected float $physicalAttackPoints,
        protected float $magicalAttackPoints,
        protected float $defensePoints,
        protected AttackSpell $attackSpell,
        protected DefenseSpell $defenseSpell,
        protected HealSpell $healSpell,
        protected ?Weapon $weapon = NULL,

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
    public function isDead(){
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

    public function attacks(Character $character, ?Weapon $attackerWeapon = null, ?AttackSpell $attackerSpell = null)
    {
        print("{$this->getName()} attaque {$character->getName()}");
        if ($this->hasWeapon()) {
            print(" avec {$this->weapon->getName()}");
        }
        print(" !".PHP_EOL);

        //attaque avec un spell
        if (is_null($attackerWeapon) && !is_null($attackerSpell)) {
            $character->takesDamagesFrom($this, $attackerSpell);

        //attaque avec une arme
        }elseif(!is_null($attackerWeapon) && is_null($attackerSpell)){
            $character->takesDamagesFrom($this, $attackerWeapon);

        //attaque a la mano
        }else{
            $character->takesDamagesFrom($this);
        }
    }
    
    public function takesDamagesFrom(Character $character, ?Weapon $attackerWeapon = null, ?AttackSpell $attackerSpell = null)
    {
        $damages = $this->takesPhysicalDamagesFrom($character) + $this->takesMagicalDamagesFrom($character);
        $this->setLifePoints(
            $this->getLifePoints() - ($damages * (1 - $this->getDefensePoints()))
        );
    }

    protected function takesPhysicalDamagesFrom(Character $character)
    {
        return ($character->getPhysicalAttackPoints());
    }

    protected function takesMagicalDamagesFrom(Character $character)
    {
        return $character->getMagicalAttackPoints();
    }

    public function __toString()
    {
        return static::class;
    }
}