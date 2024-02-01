<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaFormRequest;
use App\Http\Requests\UpdateAgendaFormRequest;
use App\Models\Agenda;
use App\Models\Profissional;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function agenda(AgendaFormRequest $request)
    {
        $agenda = Agenda::create([
            'profissional_id' => $request->profissional_id,
            'cliente_id' => $request->cliente_id,
            'servico_id' => $request->servico_id,
            'data_hora' => $request->data_hora,
            'tipo_pagamento' => $request->tipo_pagamento,
            'valor' => $request->valor,
        ]);
        return response()->json([
            "status" => true,
            "message" => "Agenda registrada com sucesso",
            "data" => $agenda
        ], 200);
    }

    public function agendaFindData(Request $request)
    {
        $agenda = Agenda::where('data_hora', 'like', '%' . $request->data_hora . '%')->get();
        if (count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $agenda
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa'
        ]);
    }

    public function agendaFind(Request $request)
    {
        $agenda = Agenda::where('profissional', 'like', '%' . $request->profissional . '%')->get();

        if (count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'message' => $agenda
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa'
        ]);
    }

    public function agendaUpdate(UpdateAgendaFormRequest $request)
    {
        $agenda = Agenda::where('data_hora', '=', $request->data_hora)->where('profissional_id', '=', $request->profissional_id)->get();

        if (count($agenda) > 0) {
            return response()->json([
                "status" => false,
                "message" => "Horario ja cadastrado",
                "data" => $agenda
            ], 200);    
        } else {

        $agenda = Agenda::find($request->id);

        if (!isset($agenda)) {
            return response()->json([
                'status' => false,
                'message' => 'Não há resultados para a Agenda'
            ]);
        }
        if (isset($request->profissional_id)) {
            $agenda->profissional_id = $request->profissional_id;
        }
        if (isset($request->cliente_id)) {
            $agenda->cliente_id = $request->cliente_id;
        }
        if (isset($request->servico_id)) {
            $agenda->servico_id = $request->servico_id;
        }
        if (isset($request->data_hora)) {
            $agenda->data_hora = $request->data_hora;
        }
        if (isset($request->tipo_pagamento)) {
            $agenda->tipo_pagamento = $request->tipo_pagamento;
        }
        if (isset($request->valor)) {
            $agenda->valor = $request->valor;
        }
        $agenda->update();
        return response()->json([
            'status' => true,
            'message' => 'Agenda atualizada com sucesso'
        ]);
    }
}

    public function agendaExcluir($id)
    {
        $agenda = Agenda::find($id);

        if (!isset($agenda)) {
            return response()->json([
                'status' => false,
                'message' => 'Agenda não encontrada'
            ]);
        }
        $agenda->delete();
        return response()->json([
            'status' => true,
            'message' => 'Agenda excluída com sucesso'
        ]);
    }

    public function agendaRetornar()
    {
        $agenda = Agenda::all();

        return response()->json([
            'status' => true,
            'data' => $agenda
        ]);
    }
    public function agendaId($id)
    {
        $agenda = Agenda::find($id);
        if ($agenda == null) {
            return response()->json([
                "status" => false,
                "message" => "Agendamento não encontrado"
            ]);
        }
        return response()->json([
            "status" => true,
            "data" => $agenda
        ]);
    }

    public function agendaTimeProfissional(AgendaFormRequest $request)
    {
            $dataHoraAgendamento = new DateTime($request->data_hora);
            $dataAtual = Carbon::now('America/Sao_Paulo');
            if ($dataHoraAgendamento < $dataAtual) {
                return response()->json([
                    "status" => false,
                    "message" => "Não é possível cadastrar um horário antes do dia atual e horario atual"
                ], 400);
            }
        
            $horarioJaCadastrado = Agenda::where('data_hora', $request->data_hora)
                ->where('profissional_id', $request->profissional_id)
                ->exists();
            if ($horarioJaCadastrado) {
                return response()->json([
                    "status" => false,
                    "message" => "Horário já cadastrado"
                ], 400);
            }
        
            $profissional = Profissional::find($request->profissional_id);
            if (isset($profissional)) {
                $agendas = Agenda::create([
                    'profissional_id' => $request->profissional_id,
                    'data_hora' => $request->data_hora
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "Agendamento cadastrado com sucesso",
                    "data" => $agendas
                ], 200);
            }
            if (!isset($profissional)) {
                return response()->json([
                    "status" => false,
                    "message" => "Profissional não encontrado"
                ], 200);
            }
    }
    public function agendaFindTimeProfissional(Request $request)
    {
        if ($request->profissional_id == 0 || $request->profissional_id == '') {
            $agenda = Agenda::all();
        } else {
            $agenda = Agenda::where('profissional_id', $request->profissional_id);

            if (isset($request->data_hora)) {
                $agenda->whereDate('data_hora', '>=', $request->data_hora);
            }
            $agenda = $agenda->get();
        }

        if (count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $agenda
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa'
        ]);
    }
}