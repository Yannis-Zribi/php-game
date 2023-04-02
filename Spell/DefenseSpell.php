<?php

require_once("./Spell.php");

Class DefenseSpell extends Spell{


    public function __construct(
        string $name,
        string $description,
        float $manaCost,
        private float $defensePoints
    ){
        parent::__construct($name, $description, $manaCost);
    }
}