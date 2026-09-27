<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculdade;
use App\Models\Universidade;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class FaculdadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($id)
    {
        try {
            $universidade = Universidade::findOrFail($id);
            
            // Listando todas as faculdades, paginando para exibir 10 por vez
            $faculdades = $universidade->faculdades()->paginate(10);
            $nFaculdades = $universidade->faculdades()->count();
            $consulta = "Busca por todas";
    
            return view("app.office.faculdades.index", compact("consulta", "universidade", "faculdades", "nFaculdades"));
        } catch (\Exception $e) {
            Log::error("Erro ao buscar faculdades da universidade: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao carregar os dados: ' . $e->getMessage());
        }
    }
    public function pesquisaNome(Request $request)
{
    try {
        $request->validate([
            'nome' => 'required',
            'uni_id' => 'required|exists:universidades,id',
        ]);

        $universidade = Universidade::findOrFail($request->uni_id);
        $faculdades = $universidade->faculdades()
            ->where("nome", "like", "%" . $request->nome . "%")
            ->paginate(10);

        $nFaculdades = $universidade->faculdades()
            ->where("nome", "like", "%" . $request->nome . "%")
            ->count();

        $consulta = "Busca por nome: " . $request->nome;
        $faculdades ->appends(['nome' => $request->nome,"uni_id" => $request->uni_id]);
        return view("app.office.faculdades.index", compact("consulta", "universidade", "faculdades", "nFaculdades"));
    } catch (\Exception $e) {
        Log::error("Erro ao pesquisar faculdade por nome: " . $e->getMessage());
        return redirect()->back()->with('error', 'Ocorreu um erro ao buscar faculdades: ' . $e->getMessage());
    }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validação dos campos
            $request->validate([
                'nome' => 'required|min:3|unique:faculdades,nome',
                'descricao' => 'nullable',
                'universidade_id' => 'required|exists:universidades,id',

            ]);

            // Criação da nova faculdade
            Faculdade::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'universidade_id' => $request->universidade_id,

            ]);
     
            // Redireciona para a listagem com sucesso
            return redirect()->route('faculdade.index2',$request->universidade_id)->with('success', 'Faculdade criada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao criar faculdade: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mostra uma faculdade específica
        $faculdade = Faculdade::findOrFail($id);
        return view('app.office.faculdades.show', compact('faculdade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Encontra a faculdade a ser editada
        $faculdade = Faculdade::findOrFail($id);
        $universidades = Universidade::all();
        $users = User::all();
        return view('app.office.faculdades.edit', compact('faculdade', 'universidades', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validação dos campos
            $request->validate([
                'nome' => 'required|min:3|unique:faculdades,nome,' . $id,
                'descricao' => 'nullable',
 
            ]);

            // Atualização da faculdade
            $faculdade = Faculdade::findOrFail($id);
            $faculdade->update([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
            ]);

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Faculdade atualizada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao atualizar faculdade: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Deleta a faculdade
            $faculdade = Faculdade::findOrFail($id);
            $faculdade->delete();

            // Redireciona com sucesso
            return redirect()->route('faculdades.index')->with('success', 'Faculdade deletada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao deletar faculdade: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }
}
