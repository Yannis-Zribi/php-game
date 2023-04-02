<?php

require_once("./Spell.php");

Class HealSpell extends Spell{


    public function __construct(
        string $name,
        string $description,
        float $manaCost,
        private float $healPoints
    ){
        parent::__construct($name, $description, $manaCost);
    }
}