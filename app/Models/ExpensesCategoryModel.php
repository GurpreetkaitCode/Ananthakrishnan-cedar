<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'expensecategory';

    protected $fillable = ['name'];

    public function getExpensesCategory()
    {
        return $this->hasMany('App\Models\ExpensesModel', 'expensecategory_id');
    }
}
