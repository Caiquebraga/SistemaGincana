<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    protected $table = 'equipes';

    protected $primaryKey = 'equPk';

    protected $fillable = [
        'equCPF',
        'equNome',
        'equDatCriacao',
        'equFot',
        'equParFk'

    ];

    public function Participantes(){
        return $this->hasMany(Participante::class, 'parEquFk', 'equPk');
    }
}
