<?php


require_once("./Character/Character.php");
require_once("./Character/Archer.php");
require_once("./Character/Soldier.php");
require_once("./Spell/Spell.php");
require_once("./Spell/AttackSpell.php");
require_once("./Spell/HealSpell.php");
require_once("./Spell/DefenseSpell.php");
require_once("./Weapon/Weapon.php");
require_once("./Weapon/MagicalWeapon.php");
require_once("./Weapon/PhysicalWeapon.php");


//Création des spell
$thunderstorm = new AttackSpell("Thunderstrom", "This is a thunderstorm.", 8, 16, 14);
$fireBall = new AttackSpell("Fire ball", "This is a fire ball.", 6, 12, 15);
$healingWave = new HealSpell("Healing Wave", "This is a Healing Wave", 8, 15);
$rapidRegeneration = new HealSpell("Rapid Regeneration", "This is a rapid regeneration", 15, 30);
$protectiveShield = new DefenseSpell("Protective Shield", "This is a Protective Shield", 10, 4);
$lightningReflexes = new DefenseSpell("Lightning Reflexes", "This is a Lightning Reflexes", 5, 2);

//Création des armes
$baton = new PhysicalWeapon("baton", "c'est un baton en bois", 10);

//Création des Personnages
$archer = new Character("miguel", "Feu", 100, 100, 10, 10, 0.2, $fireBall, $protectiveShield, $rapidRegeneration, $baton);
$soldier = new Character("Hervé","Eau",100,100,8,10,0.3,$thunderstorm,$lightningReflexes,$healingWave, $baton);



$queue = [$archer, $soldier];

while (count($queue) > 1) {
    
    shuffle($queue);
    $attacker = $queue[0];
    $attackee = $queue[1];


    $attacker->attacks($attackee);

    if($attackee->isDead()){
        unset($queue[1]);

        print("{$queue[0]->getName()} a gagné !");
    }



}