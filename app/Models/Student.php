<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'name',
        'birth',
        'sex',
        'cpf',
        'address',
    ];

    // Configurando o campo 'birth' para ser tratado como uma data
    protected $dates = ['birth'];

    // Método accessor para formatar a data antes de retorná-la
    public function getBirthAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    // Método mutator para formatar a data antes de salvá-la
    public function setBirthAttribute($value)
    {
        $this->attributes['birth'] = Carbon::parse($value)->toDateString();
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
