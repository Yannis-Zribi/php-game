<?php

require_once('Weapon.php');

class MagicalWeapon extends Weapon{

    //Constructeur
    public function __construct(
        string $name,
        string $description,
        public int $magicalDamages
    ){
        parent::__construct($name, $description);
    }


    //Getter
    public function getMagicalDamages(){
        return $this->magicalDamages;
    }

}