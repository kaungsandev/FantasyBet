<?php
namespace App\Http\Traits;
trait PlayerType{
    public function playerType($player_type){
        switch ($player_type) {
            case 1:
                return 'GKP';
                break;
                case 2:
                    return 'DEF';
                    break;
                    case 3:
                        return 'MID';
                        break;
                        case 4:
                            return 'FWD';
                            break;
                            default:
                            return 'Unknown';
                            break;
                        }
                    }
                }