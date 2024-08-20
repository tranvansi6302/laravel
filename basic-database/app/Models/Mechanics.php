<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanics extends Model
{
    use HasFactory;
    protected $table = 'mechanics';
    public function carOwner()
    {
        return $this->hasOneThrough(
            Owners::class, // model muốn liên kết tới
            Cars::class, // model trung gian
            'mechanic_id', // khóa ngoại của model trung gian
            'car_id', // khóa ngoại của table muốn liên kết tới (owner)
            'id', // khóa chính table model hiện tại
            'id' // khóa chính của table trung gian
        );
    }
}
