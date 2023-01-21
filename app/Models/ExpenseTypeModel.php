<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTypeModel extends Model
{
    use HasFactory;

    protected $table = 'expense_type';

    protected $fillable = ['type', 'category_id'];
}
