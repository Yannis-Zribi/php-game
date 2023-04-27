<?php

require_once __DIR__ . "/../Type.php";
require_once __DIR__ . "/../Weapon/HasWeapon.php";
require_once __DIR__ . "/../Weapon/Weapon.php";
require_once __DIR__ . "/../Spell/AttackSpell.php";
require_once __DIR__ . "/../Spell/DefenseSpell.php";
require_once __DIR__ . "/../Spell/HealSpell.php";



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

    public function getType(){
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
        print("\e[39m]".$this->getManaPoints().PHP_EOL.PHP_EOL);
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
    
    public function setManaPoints(float $manaPoints)
    {
        if ($manaPoints < 0) {
            $this->manaPoints = 0;
        } else {
            $this->manaPoints = round($manaPoints, 2);
        }
    }

    public function manaRegen(){
        $this->manaPoints += 10;
    }

    public function attacks(Character $character)
    {
        if($this->getLifePoints() <= 15 && $this->getManaPoints() > $this->getHealSpell()->getManaCost()){
            
            print($this->getName()." se régénère avec ".$this->getHealSpell()->getName().PHP_EOL.PHP_EOL);
            
            //ajout des points de vie
            $this->setLifePoints($this->getLifePoints() + $this->getHealSpell()->getHealPoints());
            
            //soustraction du cout en mana
            $this->setManaPoints($this->getManaPoints() - $this->getHealSpell()->getManaCost());
            
        }elseif($this->getManaPoints() > $this->getAttackSpell()->getManaCost()){
            
            print($this->getName()." attaque ".$character->getName()." avec ".$this->getAttackSpell()->getName().PHP_EOL.PHP_EOL);

            $character->takesDamagesFrom($this, true);
            
            //soustraction du cout en mana

            // print(PHP_EOL.PHP_EOL.PHP_EOL.$this->getAttackSpell()->getManaCost().PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL);
            $this->setManaPoints($this->getManaPoints() - $this->getAttackSpell()->getManaCost());
            
        }else{
            print($this->getName()." attaque ".$character->getName()." avec ".$this->getWeapon()->getName().PHP_EOL);

            $character->takesDamagesFrom($this, false);

            
        }
    }
    
    public function takesDamagesFrom(Character $character, bool $attackWithSpell)
    {
        
        if($attackWithSpell && !is_null($character->getAttackSpell())){
            //il attaque avec son spell

            $damages =  (($character->getPhysicalAttackPoints() + $character->getAttackSpell()->getPhysicalDamages()) +
                        ($character->getMagicalAttackPoints() + $character->getAttackSpell()->getMagicalDamages())) *
                        $this->advantage($this->getType(), $character->getType());

        }elseif(!$attackWithSpell && !is_null($character->getWeapon())){
            //sinon il attaque avec son arme

            if($character->getWeapon() == "PhysicalWeapon"){
                $damages =  (($character->getPhysicalAttackPoints() + $character->getWeapon()->getPhysicalDamages()) +
                            ($character->getMagicalAttackPoints())) *
                            $this->advantage($this->getType(), $character->getType());

            }else{
                $damages =  (($character->getPhysicalAttackPoints()) +
                            ($character->getMagicalAttackPoints() + $character->getWeapon()->getMagicalDamages())) *
                            $this->advantage($this->getType(), $character->getType());
            }
        }else{
            print($character->getName()." attaque avec ses points".PHP_EOL);

            $damages =  ($character->getPhysicalAttackPoints() + ($character->getMagicalAttackPoints())) *
                        $this->advantage($this->getType(), $character->getType());
        }
        

        if($this->getManaPoints() > $this->getDefenseSpell()->getManaCost()){
            //si le personnage a assez de mana pour se défendre avec un spell
            $this->setLifePoints(
                $this->getLifePoints() - ($damages * (1 - ($this->getDefensePoints() + $this->getDefenseSpell()->getDefensePoints())))
            );
    
            $this->setManaPoints($this->getManaPoints() - $this->getDefenseSpell()->getManaCost());
    
            print($this->getName()." utilise ".$this->getDefenseSpell()->getName(). " pour se défendre !".PHP_EOL);

        }else{
            $this->setLifePoints(
                $this->getLifePoints() - ($damages * (1 - $this->getDefensePoints()))
            );
        }

    }


    public function __toString()
    {
        return static::class;
    }
}