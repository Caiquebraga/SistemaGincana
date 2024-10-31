<?php

namespace App\Http\Controllers;
use App\Models\Participante;
use App\Models\Equipe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ParticipanteController extends Controller
{
    public function PartEquipes(Request $request)
    {
        $data = [
            'idEqupar' => $request->idEqupar,
        ];


     $equpar = Equipe::with('Participantes')->find($data['idEqupar']);

    //  dd($equpar);
     if(!$equpar){
        return response()->json(['mensagem'=> 'Equipe Não Encontrada']);
     }

     return response()->json($equpar->Participantes);

    }

    public function create(Request $request)
    {
        if($this->VarCpf($request->CPF))
        {
            return response()->json(['message' => 'CPF  já cadastrado'], 400);
        }

        $data = [
            'parEquFk' => $request->equiId,
            'parNome' => $request->nomeParticipante,
            'parCPF' => $request->CPF,
        ];
        //  dd( $data);

        $newPar = Participante::create($data);

        return response()->json(['message' => 'Participante cadastrado!', 'Participante' => $newPar], 200);
    }

    public function VarCpf($cpf)
    {
        return Participante::where('parCPF', $cpf)->exists();
    }    

    public function editshow (Request $request)
    {
     
          if (empty($request->idParticipante)) {
            return response()->json(['sem ID na requisição'], 400);
        }
    
        $editarPar = Participante::where('parPk', $request->idParticipante)->first();
        if(!$editarPar){
            return response()->json(['ID do participante não fornecido!'], 400);
        };


        return response()->json(['participante' => $editarPar]);

    }

    public function update (Request $request){ 
        if(empty($request->idParticipante) || empty($request->nomeParticipante) || empty($request->cpfParticipante)) {
            
            return response()->json(['error' => 'campos obrigatorios sem dados' ], 400);
        };

        $participante = Participante::find($request->idParticipante);

        if(!$participante)
        {
            return response()->json(['Error', 'Participante não encontrado'], 404);
        };

        $participante->parNome = $request->input('nomeParticipante');
        $participante->parCPF = $request->cpfParticipante;

        // dd($participante);

        $participante->save();

        return response()->json(['Success' => 'Participante atualizado com sucesso' ], 200);
    } 

    public function delete (Request $request){

        if(empty($request->idPar)){
            return response()->json(['error' => 'Id não encontrado'], 400);
        };

        $deletePar = Participante::find($request->idPar);

        if(!$deletePar){
            return response()->json(['Erro' => 'Usuário não encontrado']);
        };

        $deletePar->delete();

        return response()->json(['Success' => 'Usuário deletado com sucesso!']);

    }

}
