<?php

require_once('Weapon.php');

class PhysicalWeapon extends Weapon{

    public function __construct(
        string $name,
        string $description,
        protected int $physicalDamages,
    ){
        parent::__construct($name, $description);
    }

    public function getPhysicallDamages(){
        return $this->physicalDamages;
    }

}