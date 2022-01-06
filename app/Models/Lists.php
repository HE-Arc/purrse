<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'image',
        'token',
    ];
}
