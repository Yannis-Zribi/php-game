<?php

require_once('Weapon.php');

class PhysicalWeapon extends Weapon{

    //Constructeur
    public function __construct(
        string $name,
        string $description,
        protected int $physicalDamages,
    ){
        parent::__construct($name, $description);
    }

    //Getter
    public function getPhysicalDamages(){
        return $this->physicalDamages;
    }

}