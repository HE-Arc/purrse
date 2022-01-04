<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable = [
        'list_id',
        'name',
        'description',
        'budget',
        'total',
        'to_pay',
    ];
}

?>
