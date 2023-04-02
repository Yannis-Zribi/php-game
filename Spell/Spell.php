<?php


abstract Class Spell{


    public function __construct(
        private string $name,
        private string $description,
        private float $manaCost
    ){}
}