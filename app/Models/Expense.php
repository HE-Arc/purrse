<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'space_id',
        'name',
        'cost',
        'date',
        'is_paid',
    ];
}

?>
