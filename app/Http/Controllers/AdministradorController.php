<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministradorFormRequest;
use App\Http\Requests\UpdateAdministradorFormRequest;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function administrador(AdministradorFormRequest $request)
    {
        $administrador = Administrador::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'senha' => $request->senha,

        ]);
        return response()->json([
            "sucess" => true,
            "message" => "Registro de administrador bem-sucedido",
            "data" => $administrador
        ]);
    }
    public function administradorCpf(Request $request)
    {
        $administrador = Administrador::where('cpf', 'like', '%' . $request->cpf . '%')->get();
        if (count($administrador) > 0) {
            return response()->json([
                'status' => true,
                'data' => $administrador
            ]);
        }
        return response()->Json([
            'status' => true,
            'message' => "Não há resultados para pesquisa"
        ]);
    }
    public function administradorExcluir($id)
    {
        $administrador = Administrador::find($id);
        if (!isset($administrador)) {
            return response()->json([
                'status' => false,
                'message' => 'Administrador não encontrado'
            ]);
        }
        $administrador->delete();
        return response()->json([
            'status' => true,
            'message' => 'Administrador deletado com êxito'
        ]);
    }
    public function administradorRetornar()
    {
        $administrador = Administrador::all();

        return response()->json([
            'status' => true,
            'data' => $administrador
        ]);
    }
    public function administradorRestaurar(Request $request){
        $administrador = Administrador::where('email', 'like', $request->email)->first();
        if ($administrador) {
            $novaSenha = $administrador->cpf;
            $administrador->update([
                'senha' => Hash::make($novaSenha),
                'updated_at' => now()
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Senha redefinida',
                'nova_senha' => Hash::make($novaSenha)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Administrador não encontrado'
            ]);
        }
    }
    public function administradorUpdate(UpdateAdministradorFormRequest $request)
    {
        $administrador = Administrador::find($request->id);
        if (!isset($administrador)) {
            return response()->json([
                'status' => false,
                'message' => "Administrador não encontrado"
            ]);
        }
        if (isset($request->nome)) {
            $administrador->nome = $request->nome;
        }
        if (isset($request->cpf)) {
            $administrador->cpf = $request->cpf;
        }
        if (isset($request->email)) {
            $administrador->email = $request->email;
        }
        if (isset($request->senha)) {
            $administrador->senha = $request->senha;
        }
        $administrador->update();
        return response()->json([
            'status' => true,
            'message' => 'Administrador atualizado'
        ]);
    }
}
