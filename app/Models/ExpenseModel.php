<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseModel extends Model
{
    use HasFactory;

    protected $table = 'expenses';

    protected $fillable = ['amount', 'expense_id', 'expensecategory_id', 'receipt', 'date'];

    public function getExpenseType()
    {
        return $this->belongsTo(ExpenseTypeModel::class, 'expense_id');
    }
}
