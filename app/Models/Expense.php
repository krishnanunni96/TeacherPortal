<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable=['date','amount','category_id','payment_mode','tax_included','tax_percentage'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id', 'id');
    }

}
