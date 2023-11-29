<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'classroom_id',
        'name',
        'birth',
        'sex',
        'cpf',
        'address',
    ];
    
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
