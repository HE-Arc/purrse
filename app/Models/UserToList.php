<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToList extends Model
{
    public $timestamps = false;
    protected $table = 'user_to_list';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'list_id',
    ];
}
