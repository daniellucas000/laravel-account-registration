<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use App\Models\SituacaoConta;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContaController extends Controller
{
    // Listar contas
    public function index(Request $request)
    {
        //Recuperar os registros do banco
        $contas = Conta::when($request->has('search'), function ($whenQuery) use ($request) {
            $whenQuery->where('name', 'like', '%' . $request->search . '%');
        })
            ->when($request->filled('start_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('expiration', '>=', \Carbon\Carbon::parse($request->start_date)->format('Y-m-d'));
            })
            ->when($request->filled('end_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('expiration', '<=', \Carbon\Carbon::parse($request->end_date)->format('Y-m-d'));
            })
            ->with('situacaoConta')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        //Carrega a view
        return view('contas.index', [
            'contas' => $contas,
            'search' => $request->search,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }

    // Detalhes da conta
    public function show(Conta $conta)
    {
        return view('contas.show', ['conta' => $conta]);
    }

    // Carregar o formulário cadastrar nova conta
    public function create()
    {
        //Recuperar as situações do banco
        $situacoesContas = SituacaoConta::orderBy('name', 'asc')->get();

        return view('contas.create', ['situacoesContas' => $situacoesContas]);
    }

    // Cadastrar no banco de dados nova conta
    public function store(ContaRequest $request)
    {
        //Validar formulário
        $request->validated();

        try {

            //Cadastrar no banco de dados na tabela contas os valores de todos os campos
            $conta = Conta::create([
                'name' => $request->name,
                'value' => str_replace(',', '.', str_replace('.', '', $request->value)),
                'expiration' => $request->expiration,
                'situacao_conta_id' => $request->situacao_conta_id
            ]);

            //Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('conta.show', ['conta' => $conta->id])->with('success', 'Conta cadastrada com sucesso');
        } catch (Exception $e) {
            //Salvar log de erro
            Log::warning('Erro ao cadastrada conta', ['error' => $e->getMessage()]);
            //Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Conta não editada');
        }
    }

    // Carregar o formulário editar a conta
    public function edit(Conta $conta)
    {
        //Recuperar as situações do banco
        $situacoesContas = SituacaoConta::orderBy('name', 'asc')->get();

        return view('contas.edit', [
            'conta' => $conta,
            'situacoesContas' => $situacoesContas
        ]);
    }

    // Editar no banco de dados a conta
    public function update(ContaRequest $request, Conta $conta)
    {
        $request->validated();

        try {
            //Editar o regisro no banco
            $conta->update([
                'name' => $request->name,
                'value' => str_replace(',', '.', str_replace('.', '', $request->value,),),
                'expiration' => $request->expiration,
                'situacao_conta_id' => $request->situacao_conta_id,
            ]);

            //Salvar log de sucesso
            Log::info('Conta Editada com sucesso!', ['id' => $conta->id, 'conta' => $conta]);

            //Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('conta.show', ['conta' => $conta->id])->with('success', 'Conta editada com sucesso');
        } catch (Exception $e) {
            //Salvar log de erro
            Log::warning('Erro ao editar conta', ['error' => $e->getMessage()]);
            //Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Conta não editada');
        }
    }

    // Excluir a conta do banco de dados
    public function destroy(Conta $conta)
    {
        $conta->delete();

        //Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('conta.index')->with('success', 'Conta excluída com sucesso');
    }

    public function generatePdf(Request $request)
    {
        //Recuperar registros do banco
        $contas = Conta::when($request->has('search'), function ($whenQuery) use ($request) {
            $whenQuery->where('name', 'like', '%' . $request->search . '%');
        })
            ->when($request->filled('start_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('expiration', '>=', \Carbon\Carbon::parse($request->start_date)->format('Y-m-d'));
            })
            ->when($request->filled('end_date'), function ($whenQuery) use ($request) {
                $whenQuery->where('expiration', '<=', \Carbon\Carbon::parse($request->end_date)->format('Y-m-d'));
            })
            ->orderByDesc('created_at')
            ->get();

        //Calcular a soma total dos valores
        $totalValor = $contas->sum('value');

        $pdf = PDF::loadView('contas.generate-pdf', [
            'contas' => $contas,
            'totalValor' => $totalValor

        ])->setPaper('a4', 'portrait');

        return $pdf->download('listar_contas.pdf');
    }
}
