<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Candidato extends Model
{
    use HasFactory;

    protected $table = 'candidato';

    protected $primaryKey = 'canPk';


    protected $fillable = [
        'canCPF',
        'canCatFk',
        'canFot',
    ];

    public function categoria(){
        return $this->belongsto(Categoria::class, 'canCatFk', 'CatPk');
    }
}
