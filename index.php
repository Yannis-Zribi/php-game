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
$thunderstorm = new AttackSpell("Thunderstrom", "This is a thunderstorm.", 65, 6, 4);
$fireBall = new AttackSpell("Fire ball", "This is a fire ball.", 55, 2, 5);

$attackSpells = [$thunderstorm, $fireBall];


$healingWave = new HealSpell("Healing Wave", "This is a Healing Wave", 35, 15);
$rapidRegeneration = new HealSpell("Rapid Regeneration", "This is a rapid regeneration", 71, 30);

$healSpells = [$healingWave, $rapidRegeneration];


$protectiveShield = new DefenseSpell("Protective Shield", "This is a Protective Shield", 25, 0.15);
$lightningReflexes = new DefenseSpell("Lightning Reflexes", "This is a Lightning Reflexes", 12.5, 0.1);

$defenseSpells = [$protectiveShield, $lightningReflexes];


$types = ["Feu", "Eau", "Plante"];

//Création des armes
$baton = new PhysicalWeapon("le Baton", "c'est un baton en bois", 6);
$baguetteMagique = new MagicalWeapon("la Baguette", "c'est la baguette de merlin l'enchanteur", 6);

$weapons = [$baton, $baguetteMagique];




//#####  Choix du personnage  #####

//choix du nom
do{
    print(PHP_EOL."Veuillez choisir votre nom :  ".PHP_EOL.PHP_EOL);
    
    $name = (readline());

}while($name == "");


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
            $player = new Archer($name, $types[$type - 1], 100, 100, 5, 5, (rand(10, 30) / 100), $attackSpells[rand(0,1)], $defenseSpells[rand(0,1)], $healSpells[rand(0,1)], $weapons[$weapon - 1]);
            $choosed = 1;
            break;
        
        case '2': //soldat
            $player = new Soldier($name, $types[$type - 1], 100, 100, 10, 0, (rand(10, 30) / 100), $attackSpells[rand(0,1)], $defenseSpells[rand(0,1)], $healSpells[rand(0,1)], $weapons[$weapon - 1]);
            $choosed = 1;
            break;
    
        case '3': //sorcier
            $player = new Wizard($name, $types[$type - 1], 100, 100, 0, 10, (rand(10, 30) / 100), $attackSpells[rand(0,1)], $defenseSpells[rand(0,1)], $healSpells[rand(0,1)], $weapons[$weapon - 1]);
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


//boucle de jeu
$characters = [$player, $bot];

$play = 1;
$winner = -1;
$nTour = 1;

while ($play) {
    print(PHP_EOL."TOUR N°{$nTour} ====================================================".PHP_EOL);
    $nTour++;

    //affichage des stats
    $player->drawStats();
    $bot->drawStats();

    //choix du perso qui attaque en premier
    $attacker = rand(0,1);
    $attackee = 1 - $attacker;

    //attaques lancées
    $characters[$attacker]->attacks($characters[$attackee]);

    if($characters[$attackee]->isDead()){
        $play = 0;
        $winner = $attacker;
    }else{

        $characters[$attackee]->attacks($characters[$attacker]);
    }

    if($characters[$attacker]->isDead()){
        $play = 0;
        $winner = $attackee;
    }

    //regen de la mana
    foreach ($characters as $key => $character) {
        $character->manaRegen();
       
    }
}

//fin de partie
print(PHP_EOL.PHP_EOL."PARTIE TERMINÉE ====================================================".PHP_EOL);
$player->drawStats();
$bot->drawStats();

print("le gagnant est : ".$characters[$winner]->getName().PHP_EOL);


