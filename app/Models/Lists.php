<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $fillable = [
        'name',
        'image',
        'token',
    ];
}

?>
