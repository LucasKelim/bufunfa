<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $fillable = ['value', 'salary_id', 'category_id'];

    public function salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);    
    }
}
