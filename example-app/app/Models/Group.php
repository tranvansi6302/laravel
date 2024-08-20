<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';

    // quan hệ 1-n
    public function users()
    {
        return $this->hasMany(Users::class, 'group_id', 'id');
    }
}
