<?php

namespace Database\Seeders;

use App\Models\ExpensesCategoryModel;
use App\Models\ExpenseTypeModel;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpensesCategoryModel::create([
            'name' => 'Ongoing Expenses',
        ]);
        ExpensesCategoryModel::create([
            'name' => 'Capital Expenses',
        ]);
    }
}
