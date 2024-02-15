<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\UpdateClienteFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function cliente(ClienteFormRequest $request){
        $cliente = Cliente::create([
            'name' => $request->name,
            'celular' => $request->celular,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'complemento' => $request->complemento,
            'password' => $request->password,
            
        ]);
        return response()->json([
            "sucess" => true,
            "message" => "Registro de cliente bem-sucedido",
            "data"=> $cliente
        ]);
    }
    public function clienteId($id){
        $cliente = Cliente::find($id);
        if($cliente == null){
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $cliente
        ]);
    }
    public function clienteNome(Request $request){
        $cliente = Cliente::where('name', 'like', '%' . $request->nome . '%')->get();
        if(count($cliente) > 0){
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->Json([
            'status' => false,
            'message' => "Não há resultados para pesquisa"
        ]);
    }
    public function clienteCpf(Request $request){
        $cliente = Cliente::where('cpf', 'like', '%' . $request->cpf . '%')->get();
        if(count($cliente) > 0){
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->Json([
            'status' => true,
            'message' => "Não há resultados para pesquisa"
        ]);
    }
    public function clienteCelular(Request $request){
        $cliente = Cliente::where('celular', 'like', '%' . $request->celular . '%')->get();
        if(count($cliente) > 0){
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->Json([
            'status' => true,
            'message' => "Não há resultados para pesquisa"
        ]);
    }
    public function clienteEmail(Request $request){
        $cliente = Cliente::where('email', 'like', '%' . $request->email . '%')->get();
        if(count($cliente) > 0){
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->Json([
            'status' => true,
            'message' => "Não há resultados para pesquisa"
        ]);
    }
    public function clienteRetornar(){
        $cliente = Cliente::All();
        return response()->json([
            'status' => true,
            'data' => $cliente
        ]);
    }
    public function clienteExcluir($id){
        $cliente = Cliente::find($id);
        if(!isset($cliente)){
            return response()->json([
                'status' => false,
                'message' => 'Cliente não encontrado'
            ]);
        }
        $cliente->delete();
        return response()->json([
            'status' => true,
            'message' => 'Cliente deletado com êxito'
        ]);
        }
        public function clienteRestaurar(Request $request)
        {
            $cliente = Cliente::where('email', '=', $request->email)->first();
            if ($cliente) {
                $novaSenha = $cliente->cpf;
                $cliente->update([
                    'password' => Hash::make ($novaSenha),
                    'updated_at' => now()
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Senha redefinida',
                    'nova_password' => Hash::make ($novaSenha)
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Cliente não encontrado'
                ]);
            }
        }
        public function clienteUpdate(UpdateClienteFormRequest $request){
            $cliente = Cliente::find($request->id);
            if(!isset($cliente)){
                return response()->json([
                    'status' => false,
                    'message' => "Cliente não encontrado"
                ]);
            }
            if(isset($request->name)){
                $cliente->name = $request->name;
            }
            if(isset($request->celular)){
                $cliente->celular = $request->celular;
            }
            if(isset($request->email)){
                $cliente->email = $request->email;
            }
            if(isset($request->cpf)){
                $cliente->cpf = $request->cpf;
            }
            if(isset($request->dataNascimento)){
                $cliente->dataNascimento = $request->dataNascimento;
            }
            if(isset($request->cidade)){
                $cliente->cidade = $request->cidade;
            }
            if(isset($request->estado)){
                $cliente->estado = $request->estado;
            }
            if(isset($request->pais)){
                $cliente->pais = $request->pais;
            }
            if(isset($request->rua)){
                $cliente->rua = $request->rua;
            }
            if(isset($request->numero)){
                $cliente->numero = $request->numero;
            }
            if(isset($request->bairro)){
                $cliente->bairro = $request->bairro;
            }
            if(isset($request->cep)){
                $cliente->cep = $request->cep;
            }
            if(isset($request->complemento)){
                $cliente->complemento = $request->complemento;
            }
            if(isset($request->password)){
                $cliente->password = $request->password;
            }
            $cliente->update();
            return response()->json([
                'status' => true,
                'message' => 'Cliente atualizado'
            ]);
    }
}
