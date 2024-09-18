<?php

namespace App\Http\Controllers;
use App\Models\GincanaParModel;

use Illuminate\Http\Request;

class GincanaParController extends Controller
{
   private $participante;
   
   public function __construct(GincanaParModel $participante){
        
    $this->participante = $participante;

   }  

   public function index(){

    $participantes = $this->participante->all();

    return view ('Gincana.ginParticipante', compact('participante'));
   } 
}
