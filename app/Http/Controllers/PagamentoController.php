<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagamentoFormRequest;
use App\Http\Requests\UpdateClienteFormRequest;
use App\Http\Requests\UpdatePagamentoFormRequest;
use App\Models\Cliente;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function pagamento(PagamentoFormRequest $request)
    {
        $pagamento = Pagamento::create([
            'nome' => $request->nome,
            'taxa' => $request->taxa,
            'status' => $request->status,
        ]);
        return response()->json([
            "status" => true,
            "message" => "Pagamento registrado",
            "data" => $pagamento
        ]);
    }

    public function pagamentoRetornar()
    {
        $pagamento = Pagamento::All();
        return response()->json([
            'status' => true,
            'data' => $pagamento
        ]);
    }
    public function pagamentoNome(Request $request)
    {
        $pagamento = Pagamento::where('nome', 'like', '%' . $request->nome . '%')->get();
        if (count($pagamento) > 0) {
            return response()->json([
                'status' => true,
                'data' => $pagamento
            ]);
        }
        return response()->Json([
            'status' => false,
            'message' => "Não há resultados para pesquisa"
        ]);
    }
    public function pagamentoExcluir($id)
    {
        $pagamento = Pagamento::find($id);
        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => 'Pagamento não encontrado'
            ]);
        }
        $pagamento->delete();
        return response()->json([
            'status' => true,
            'message' => 'Pagamento deletado com êxito'
        ]);
    }
    public function pagamentoUpdate(UpdatePagamentoFormRequest $request)
    {
        $pagamento = pagamento::find($request->id);
        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "Pagamento não encontrado"
            ]);
        }
        if (isset($request->nome)) {
            $pagamento->nome = $request->nome;
        }
        if (isset($request->taxa)) {
            $pagamento->taxa = $request->taxa;
        }
        if (isset($request->status)) {
            $pagamento->status = $request->status;
        }
        $pagamento->update();
        return response()->json([
            'status' => true,
            'message' => 'Pagamento atualizado'
        ]);
    }
        public function pagamentoRetornarAtivos()
        {
            $pagamento = Pagamento::where('status', 'ativo')->get();
            return response()->json([
                'status' => true,
                'data' => $pagamento
            ]);
        }
        public function pagamentoRetornarInativos()
        {
            $pagamento = Pagamento::where('status', 'inativo')->get();
            return response()->json([
                'status' => true,
                'data' => $pagamento
            ]);
    }
}
