<?php

require_once("./Spell.php");

Class AttackSpell extends Spell{


    public function __construct(
        string $name,
        string $description,
        float $manaCost,
        private float $physicalDamages,
        private float $magicalDamages,
    ){
        parent::__construct($name, $description, $manaCost);
    }
}