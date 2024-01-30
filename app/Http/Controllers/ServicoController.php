<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoFormRequest;
use App\Http\Requests\UpdateServicoFormRequest;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function servico(ServicoFormRequest $request){
        $servico = Servico::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'duracao' => $request->duracao,
            'preco' => str_replace(',', '.', $request->preco),
        ]);
        return response()->json([
            "sucess" => true,
            "message" => "Registro de serviço bem-sucedido",
            "data"=> $servico
        ]);
    }
    public function servicoId($id){
        $servico = Servico::find($id);
        if($servico == null){
            return response()->json([
                'status' => false,
                'message' => "Serviço não encontrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $servico
        ]);
    }
    public function servicoNome(Request $request){
        $servico = Servico::where('nome', 'like', '%' . $request->nome . '%')->get();
        if(count($servico) > 0){
            return response()->json([
                'status' => true,
                'data' => $servico
            ]);
        }
        return response()->Json([
            'status' => true,
            'message' => "Não há resultados para pesquisa"
        ]);
    }
    public function servicoDescricao(Request $request){
        $servico = Servico::where('descricao', 'like', '%' . $request->descricao . '%')->get();
        if(count($servico) > 0){
            return response()->json([
                'status' => true,
                'data' => $servico
            ]);
        }
        return response()->Json([
            'status' => true,
            'message' => "Não há resultados para pesquisa"
        ]);
    }
    public function servicoRetornar(){
        $servico = Servico::All();
        return response()->json([
            'status' => true,
            'data' => $servico
        ]);
    }
    public function servicoExcluir($id){
        $servico = Servico::find($id);
        if(!isset($servico)){
            return response()->json([
                'status' => false,
                'message' => 'Serviço não encontrado'
            ]);
        }
        $servico->delete();
        return response()->json([
            'status' => true,
            'message' => 'Serviço deletado com êxito'
        ]);
        }
        public function servicoUpdate(UpdateServicoFormRequest $request){
            $servico = Servico::find($request->id);
            if(!isset($servico)){
                return response()->json([
                    'status' => false,
                    'message' => "Serviço não encontrado"
                ]);
            }
            if(isset($request->nome)){
                $servico->nome = $request->nome;
            }
            if(isset($request->descricao)){
                $servico->descricao = $request->descricao;
            }
            if(isset($request->duracao)){
                $servico->duracao = $request->duracao;
            }
            if(isset($request->preco)){
                $servico->preco = $request->preco;
            }
            $servico->update();
            return response()->json([
                'status' => true,
                'message' => 'Serviço atualizado'
            ]);
    }
}