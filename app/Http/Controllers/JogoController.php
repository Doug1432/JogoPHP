<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jogo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class JogoController extends Controller
{
    public function index()
    {
        $dadosJogos = jogo::All();

        return 'Jogo Encontrado: ' .$dadosJogos;
    }

    public function store(Request $request)
    {
        $dadosJogos = $request->All();
        $valida = validator::make($dadosJogos,[
            'Nome'=> 'required',
            'Data'=> 'required',
            'Idade' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados incompletos' .$valida->erroes(true). 500;
        }

        $RegristosJogos = jogo::create($dadosJogos);
        if($RegristosJogos){
            return 'Dados cadastros com Sucesso.';
        }else{
            return 'Dados não cadastrados no banco de Dados.';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dadosJogos = jogo::find($id);
        $contador = $dadosJogos->count();

        if($dadosJogos){
            return 'Jogos encontradas: '.$contador. ' - ' .$dadosJogos.response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Jogos Não localizadas.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosJogos = $request->All();

        $valida = validator::make($dadosJogos,[
            'Nome' => 'required',
            'Data' => 'required',
            'Idade' => 'required'
            
        ]);

        if($valida->fails()){
            return "ERRO!!". valida->$erroes();
        }
        $dadosJogosBanco = jogo::find($id);
        $dadosJogosBanco-> Nome = $dadosJogos['Nome'];
        $dadosJogosBanco-> Data = $dadosJogos['Data'];
        $dadosJogosBanco-> Data = $dadosJogos['Idade'];

        $enviarJogos = $dadosJogosBanco->save();

        if($enviarJogos){
            return 'A Jogo foi alterada cm sucesso.' .response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'A Jogo não foi alterada.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }                                   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dadosJogos = jogo::find($id);
        if($dadosJogos){
            $dadosJogos->delete();
            return 'A Jogo foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'A Jogo não foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }
}
