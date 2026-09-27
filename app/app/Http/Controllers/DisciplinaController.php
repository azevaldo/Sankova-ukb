<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\Models\Faculdade;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Disciplina;
use App\Models\Curso;

use App\Http\Controllers\Controller;
 


class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($id)
    {
        //
try{
        $curso=Curso::findOrFail($id);
        $disciplinas = $curso->disciplinas()->paginate(10);
        // Listando todas as faculdades, paginando para exibir 5 por vez
        $nDisciplinas=$curso->disciplinas()->count();
        $consulta="Buca todas disciplinas";

        return view("app.office.disciplinas.index", compact("consulta","disciplinas","curso",'nDisciplinas'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function pesquisaNome(Request $request){
       try{
        $request->validate([
            'nome'=>'required',
            "curso_id"=>"required",
        ]);
        $curso=Curso::findOrFail($request->curso_id);
        $disciplinas=$curso->disciplinas()->where("disciplina","like","%".$request->nome."%")->paginate(10);
        $nDisciplinas=$curso->disciplinas()->where("disciplina","like","%".$request->nome."%")->count();
        $consulta="Buca por nome disciplina : ".$request->nome;
        $disciplinas ->appends(['nome' => $request->nome,'curso_id'=>$request->curso_id]);
        return view("app.office.disciplinas.index", compact("consulta","disciplinas","curso",'nDisciplinas'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            // Validação dos campos
            $request->validate([
                'disciplina' => 'required|string|min:3',
                'descricao' => 'nullable',
                 
                'curso_id' => 'required|exists:cursos,id',
                            ]);

            // Criação do novo curso
            Disciplina::create([
                'disciplina' => $request->disciplina,
                'descricao' => $request->descricao,
                 'curso_id' => $request->curso_id,
                            ]);

            // Redireciona para a listagem com sucesso
            return redirect()->back()->with('success', ' Disciplina criado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao criar disciplina: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function show(Disciplina $disciplina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function edit(Disciplina $disciplina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validação dos campos
            $request->validate([
                'disciplina' => 'required|string|min:3',
                'descricao' => 'nullable',
         
            ]);
    
            // Busca a disciplina pelo id
            $disciplina = Disciplina::findOrFail($id);
    
            // Atualiza a disciplina
            $disciplina->update([
                'disciplina' => $request->disciplina,
                'descricao' => $request->descricao,
     
            ]);
    
            // Redireciona para a listagem com sucesso
            return redirect()->back()
                ->with('success', 'Disciplina atualizada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao atualizar disciplina: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Busca a disciplina pelo ID
            $disciplina = Disciplina::findOrFail($id);
    
            // Deleta a disciplina
            $disciplina->delete();
    
            // Redireciona de volta com sucesso
            return redirect()->back()
                ->with('success', 'Disciplina deletada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao deletar disciplina: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao deletar a disciplina: ' . $e->getMessage());
        }
    }
    
}
