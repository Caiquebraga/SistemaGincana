<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'participante';

    protected $primaryKey = 'parPk';

    protected $fillable = [
        'parNome',
        'parCPF',
        'parEquFk'
    ];

    public function equipe(){
        return $this->belongsTo(Equipe::class, 'parEquFk', 'equPk');
    } 
}
