<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GincanaParModel extends Model
{
    use HasFactory;

    protected $table = 'participante';

    protected $primaKey = 'parPk';

    protected $fillable = [
        'parCpf',
        'parNome'
    ];
}
