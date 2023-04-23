<?php


Trait Type{
    
    public function advantage(string $attackeeType, string $attackerType){
        switch ($attackerType) {
            case 'Feu':
                switch ($attackeeType) {
                    case 'Feu':
                        return 1;
                        break;
                
                    case 'Eau':
                        return 0.75;
                        break;
                
                    case 'Plante':
                        return 1.25;
                        break;
                        
                    default:
                        print("le type passé en paramètre \$attackerType->({$attackerType}) à advantage() ne semble pas existé".PHP_EOL);
                        return 0;
                        break;
                }
                break;
        
            case 'Eau':
                switch ($attackeeType) {
                    case 'Feu':
                        return 1.3;
                        break;
                
                    case 'Eau':
                        return 1;
                        break;
                
                    case 'Plante':
                        return 0.7;
                        break;
                        
                    default:
                        print("le type passé en paramètre \$attackerType->({$attackerType}) à advantage() ne semble pas existé".PHP_EOL);
                        return 0;
                        break;
                }
                break;
        
            case 'Plante':
                switch ($attackeeType) {
                    case 'Feu':
                        return 0.8;
                        break;
                
                    case 'Eau':
                        return 1.2;
                        break;
                
                    case 'Plante':
                        return 1;
                        break;
                        
                    default:
                        print("le type passé en paramètre \$attackerType->({$attackerType}) à advantage() ne semble pas existé".PHP_EOL);
                        return 0;
                        break;
                }
                break;
                
            default:
                print("le type passé en paramètre \$attackerType->({$attackerType}) à advantage() ne semble pas existé".PHP_EOL);
                return 0;
                break;
        }
    }
}