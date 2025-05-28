<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'departamento_id', 'id');
    }
}