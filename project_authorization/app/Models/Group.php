<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';

    public function user()
    {
        // 1 group có nhiều user
        return $this->hasMany(User::class);
    }

    public function createBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
