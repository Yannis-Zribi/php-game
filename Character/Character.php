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

    public function getDescription(){

        print(PHP_EOL.$this->name." est de type {$this->type}, il a {$this->lifePoints} points de vie et {$this->manaPoints} points de mana.".PHP_EOL);
        print("Il a {$this->physicalAttackPoints} de dégâts physiques et {$this->magicalAttackPoints} de dégâts magiques. Son arme est {$this->weapon->getName()}".PHP_EOL);
        print("Ses spells sont : ".PHP_EOL);
        print("[\e[31m*\e[39m] - {$this->attackSpell->getName()}".PHP_EOL."[\e[34m*\e[39m] - {$this->defenseSpell->getName()}".PHP_EOL."[\e[32m*\e[39m] - {$this->healSpell->getName()}".PHP_EOL.PHP_EOL);

    }


    function drawStats(){

        //affichage de son nom
        print($this->getName().PHP_EOL);

        //affichage de la vie
        $life = (int)($this->getLifePoints() / 10) + 1;

        print("LIFE : [");
        for ($i = 0; $i < 10; $i++) {
            if ($life > 0) {
                print("\e[31m=");
            }else {
                print(" ");
            }
            $life -= 1;
        }
        print("\e[39m]".$this->getLifePoints().PHP_EOL);


        //affichage de la mana
        $mana = (int)($this->getManaPoints() / 10) + 1;

        print("MANA : [");
        for ($i = 0; $i < 10; $i++) {
            if ($mana > 0) {
                print("\e[34m=");
            }else {
                print(" ");
            }
            $mana -= 1;
        }
        print("\e[39m]".$this->getManaPoints().PHP_EOL);
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