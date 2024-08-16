<?php

use Carbon\Carbon;

function getOrderStatus($value)
{
    switch ($value) {
        case 1:
            return 'Pending';
            break;
        case 2:
            return 'Processing';
            break;
        case 3:
            return 'Ready to Deliver';
            break;
        case 4:
            return 'Delivered';
            break;
        case 5:
            return 'Returned';
            break;
        case 6:
            return 'Cancelled';
            break;
        default:
            return 'Invalid input';
            break;
    }
}

function getStatus($value){
    switch ($value) {
        case 1:
            return 'pending';
            break;
        case 2:
            return 'processing';
            break;
        case 3:
            return 'ready';
            break;
        case 4:
            return 'delivered';
            break;
        case 5:
            return 'returned';
            break;
        case 6:
            return 'cancelled';
            break;
        default:
            return 'Invalid input';
            break;
    }
}

function statusColor($value){
    switch ($value) {
        case 1:
            return 'secondary';
            break;
        case 2:
            return 'warning';
            break;
        case 3:
            return 'success';
            break;
        case 4:
            return 'primary';
            break;
        case 5:
            return 'danger';
            break;
        default:
            return 'Invalid input';
            break;
    }
}

function dateHelper($value)
{
    return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
}

function dateHelper2($value)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');
}

function status($value){
    if($value==1){
        return "scrum-task-pending";
    }
    elseif($value==2){
        return "scrum-task-processing";
    }
    else{
        return "scrum-task-ready";
    }
}

function isActive($value){
    if($value==0){
        return "scrum-task-pending";
    }
    else{
        return "scrum-task-ready";
    }
}
