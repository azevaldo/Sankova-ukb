<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Faculdade;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($id)
    {    
        // Listando todos os cursos, paginando para exibir 5 por vez
  try{
        $faculdade=Faculdade::findOrFail($id);
         $cursos=$faculdade->cursos()->paginate(10);
       
         
        $nCursos=$faculdade->cursos()->count();
        $consulta="Buca todos cursos ";
        return view("app.office.cursos.index", compact("consulta","faculdade","cursos",'nCursos'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function pesquisaNome(Request $request){
        try{
        $request->validate([
            'nome'=>'required',
            "fau_id"=>"required",
        ]);
        $faculdade=Faculdade::findOrFail($request->fau_id);
        $cursos=$faculdade->cursos()->where("nome","like","%".$request->nome."%")->paginate(10);
        
        $nCursos=$faculdade->cursos()->where("nome","like","%".$request->nome."%")->count();
        $consulta="Buca por nome : ".$request->nome;
        $cursos ->appends(['nome' => $request->nome,'fau_id'=>$request->fau_id]);
        return view("app.office.cursos.index", compact("consulta","faculdade","cursos",'nCursos'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
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
                'nome' => 'required|min:3|unique:cursos,nome',
                'descricao' => 'nullable',
                'duracao' => 'required|integer|min:1',
                'faculdade_id' => 'required|exists:faculdades,id',

            ]);

            // Criação do novo curso
            Curso::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'duracao' => $request->duracao,
                'faculdade_id' => $request->faculdade_id,

            ]);

            // Redireciona para a listagem com sucesso
            return redirect()->back()->with('success', 'Curso criado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao criar curso: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

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
                'nome' => 'required|min:3|unique:cursos,nome,' . $id,
                'descricao' => 'nullable',
                'duracao' => 'required|integer|min:1',
              
 
            ]);

            // Atualização do curso
            $curso = Curso::findOrFail($id);
            $curso->update([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'duracao' => $request->duracao,
            

            ]);

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Curso atualizado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao atualizar curso: " . $e->getMessage());
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
            // Deleta o curso
            $curso = Curso::findOrFail($id);
            $curso->delete();

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Curso deletado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao deletar curso: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }
}
