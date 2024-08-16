<?php

 function getCategoryType($value){
        switch($value){
            case 1:
                return 'Asset';
                break;
            case 2:
                return 'Liability';
                break;
            default:
                return 'invalid value';
                break;
        }
    }