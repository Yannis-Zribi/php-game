<?php


require_once("./Character/Character.php");
require_once("./Character/Archer.php");
require_once("./Character/Soldier.php");
require_once("./Character/Wizard.php");
require_once("./Spell/Spell.php");
require_once("./Spell/AttackSpell.php");
require_once("./Spell/HealSpell.php");
require_once("./Spell/DefenseSpell.php");
require_once("./Weapon/Weapon.php");
require_once("./Weapon/MagicalWeapon.php");
require_once("./Weapon/PhysicalWeapon.php");




//Fonctions





//Création des spell
$thunderstorm = new AttackSpell("Thunderstrom", "This is a thunderstorm.", 8, 16, 14);
$fireBall = new AttackSpell("Fire ball", "This is a fire ball.", 6, 12, 15);

$attackSpells = [$thunderstorm, $fireBall];


$healingWave = new HealSpell("Healing Wave", "This is a Healing Wave", 8, 15);
$rapidRegeneration = new HealSpell("Rapid Regeneration", "This is a rapid regeneration", 15, 30);

$healSpells = [$healingWave, $rapidRegeneration];


$protectiveShield = new DefenseSpell("Protective Shield", "This is a Protective Shield", 10, 4);
$lightningReflexes = new DefenseSpell("Lightning Reflexes", "This is a Lightning Reflexes", 5, 2);

$defenseSpells = [$protectiveShield, $lightningReflexes];


$types = ["Feu", "Eau", "Plante"];

//Création des armes
$baton = new PhysicalWeapon("le Baton", "c'est un baton en bois", 10);
$baguetteMagique = new MagicalWeapon("la Baguette", "c'est la baguette de merlin l'enchanteur", 10);

$weapons = [$baton, $baguetteMagique];

//Création des Personnages
$archer = new Archer("Miguel", "Feu", 80, 100, 10, 10, 0.2, $fireBall, $protectiveShield, $rapidRegeneration, $baton);
// $soldier = new Character("Hervé", "Eau", 100, 100, 8, 10, 0.3, $thunderstorm, $lightningReflexes, $healingWave, $baton);
// $wizard = new Wizard("Damien","Plante",100,100,6,10,0.2, $thunderstorm, $protectiveShield, $healingWave, $baguetteMagique);


//#####  Choix du personnage  #####

//choix du nom
print(PHP_EOL."Veuillez choisir votre nom :  ".PHP_EOL.PHP_EOL);

$name = (readline());


//choix du type
print(PHP_EOL."Veuillez choisir un type :  ".PHP_EOL.PHP_EOL);
print("[1] - \e[31mFeu\e[39m".PHP_EOL);
print("[2] - \e[34mEau\e[39m".PHP_EOL);
print("[3] - \e[32mPlante\e[39m".PHP_EOL.PHP_EOL);


do {

    $type = (int)(readline());

    if (($type < 1 || $type > 3)) {
        echo(PHP_EOL."Ce type n'existe pas !".PHP_EOL);
    }
} while ($type < 1 || $type > 3);





//choix de l'arme
print(PHP_EOL."Veuillez choisir votre \e[93marme\e[39m : ".PHP_EOL.PHP_EOL);
print("[1] - le Baton".PHP_EOL);
print("[2] - la Baguette".PHP_EOL.PHP_EOL);

do {

    $weapon = (int)(readline());

    if (($weapon < 1 || $weapon > 2)) {
        echo(PHP_EOL."Cette arme n'existe pas !".PHP_EOL);
    }
} while ($weapon < 1 || $weapon > 2);




//choix du character
print(PHP_EOL."Veuillez choisir votre \e[93mpersonnage\e[39m : ".PHP_EOL.PHP_EOL);
print("[1] - Archer".PHP_EOL);
print("[2] - Soldat".PHP_EOL);
print("[3] - Sorcier".PHP_EOL.PHP_EOL);

$choosed = 0;

do {

    $player = (int)(readline());
    
    switch ($player) {
        case '1': //archer
            $player = new Archer($name, $types[$type], 100, 100, 5, 5, (rand(10, 30) / 100), $attackSpells[rand(0,1)], $defenseSpells[rand(0,1)], $healSpells[rand(0,1)], $weapons[$weapon - 1]);
            $choosed = 1;
            break;
        
        case '2': //soldat
            $player = new Soldier($name, $types[$type], 100, 100, 10, 0, (rand(10, 30) / 100), $attackSpells[rand(0,1)], $defenseSpells[rand(0,1)], $healSpells[rand(0,1)], $weapons[$weapon - 1]);
            $choosed = 1;
            break;
    
        case '3': //sorcier
            $player = new Wizard($name, $types[$type], 100, 100, 0, 10, (rand(10, 30) / 100), $attackSpells[rand(0,1)], $defenseSpells[rand(0,1)], $healSpells[rand(0,1)], $weapons[$weapon - 1]);
            $choosed = 1;
            break;
            
        default:
            print(PHP_EOL."Ce personnage n'existe pas ! Merci de rentrer une valeur existante".PHP_EOL);
            break;
    }
} while ($choosed == 0);




//création du bot
switch (rand(1,3)) {
    case '1': //archer
        $bot = new Archer("BOT", $types[rand(0,2)], 100, 100, 5, 5, (rand(10, 30) / 100), $attackSpells[rand(0,1)], $defenseSpells[rand(0,1)], $healSpells[rand(0,1)], $weapons[rand(0,1)]);
        $choosed = 1;
        break;
    
    case '2': //soldat
        $bot = new Soldier("BOT", $types[rand(0,2)], 100, 100, 10, 0, (rand(10, 30) / 100), $attackSpells[rand(0,1)], $defenseSpells[rand(0,1)], $healSpells[rand(0,1)], $weapons[rand(0,1)]);
        $choosed = 1;
        break;

    case '3': //sorcier
        $bot = new Wizard("BOT", $types[rand(0,2)], 100, 100, 0, 10, (rand(10, 30) / 100), $attackSpells[rand(0,1)], $defenseSpells[rand(0,1)], $healSpells[rand(0,1)], $weapons[rand(0,1)]);
        $choosed = 1;
        break;
        
    default:
        # code...
        break;
}

$player->drawStats();
$bot->drawStats();

$player->attacks($bot);


$player->drawStats();
$bot->drawStats();

