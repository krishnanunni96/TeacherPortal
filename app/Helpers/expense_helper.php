<?php

function getTaxIncluded($value){
    switch($value){
        case 0:
            return 'No';
            break;
        case 1:
            return 'Yes';
            break;
        default:
            return 'Invalid input';
            break;
    }
}

function getPaymentMode($value){
    switch($value){
        case 1:
            return 'CASH';
            break;
        case 2:
            return 'UPI';
            break;
        case 3:
            return 'CARD';
            break;
        case 4:
            return 'CHEQUE';
            break;
        case 5:
            return 'BANK TRANSFER';
            break;
        default:
            return 'Invalid input';
            break;
    }
}