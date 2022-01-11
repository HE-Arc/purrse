<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseToUser extends Model
{
    public $timestamps = false;
    protected $table = 'expense_to_user';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'expense_id',
    ];
}
