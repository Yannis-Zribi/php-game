<?php

require_once('Weapon.php');

class MagicalWeapon extends Weapon{

    public function __construct(
        string $name,
        string $description,
        public int $magicalDamages
    ){
        parent::__construct($name, $description);
    }

    public function getMagicalDamages(){
        return $this->magicalDamages;
    }

}