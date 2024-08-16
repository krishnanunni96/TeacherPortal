<?php

use App\Models\MasterSetting;

function getUnit($value)
{
    switch ($value) {
        case 1:
            return 'NOS';
            break;
        case 2:
            return 'Pkt';
            break;
        case 3:
            return 'Box';
            break;
        case 4:
            return 'Bag';
            break;
        case 5:
            return 'Ltr';
            break;
        case 6:
            return 'Ml';
            break;
        case 7:
            return 'Kg';
            break;
        case 8:
            return 'Gm';
            break;
        case 9:
            return 'Tonne';
            break;
        case 10:
            return 'Dzn';
            break;
        default:
            return 'Invalid input';
            break;
    }
}

function master(){
    $master=MasterSetting::find(1);        
    return $master;                         
}