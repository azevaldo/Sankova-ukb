<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topico;
use App\Models\Disciplina;
use App\Models\Material_estudo;
use Illuminate\Support\Facades\Log;

class TopicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($id)

    {
        try{
        $disciplina=Disciplina::findOrFail($id);
        // Listando todos os tópicos, paginando para exibir 5 por vez
        $topicos = $disciplina->topicos()->paginate(10);
        $nTopicos=Topico::count();
        $consulta="Buca por todos temas ";
        return view("app.office.topicos.index", compact("consulta","topicos","disciplina",'nTopicos'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }

    public function pesquisaNome(Request $request){
        try{
        $request->validate([
            'nome'=>'required',
            "disciplina_id"=>"required",
        ]);
        $disciplina=Disciplina::findOrFail($request->disciplina_id);
        $topicos=$disciplina->topicos()->where("tema","like","%".$request->nome."%")->paginate(10);
        $nTopicos=$disciplina->topicos()->where("tema","like","%".$request->nome."%")->count();

        $consulta="Buca por tema : ".$request->nome;
        $topicos ->appends(['nome' => $request->nome,'disciplina_id'=>$request->disciplina_id]);
        return view("app.office.topicos.index", compact("consulta","topicos","disciplina",'nTopicos'));
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
                'tema' => 'required|string|min:3|unique:topicos,tema',
                'descricao' => 'nullable',
                'disciplina_id' => 'required|exists:disciplinas,id',
            ]);

            // Criação do novo tópico
            Topico::create([
                'tema' => $request->tema,
                'descricao' => $request->descricao,
                'disciplina_id' => $request->disciplina_id,
            ]);

            // Redireciona para a listagem com sucesso
            return redirect()->back()->with('success', 'Tópico criado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao criar tópico: " . $e->getMessage());
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
                'tema' => 'required|string|min:3|unique:topicos,tema,' . $id,
                'descricao' => 'nullable',
      
            ]);

            // Atualização do tópico
            $topico = Topico::findOrFail($id);
            $topico->update([
                'tema' => $request->tema,
                'descricao' => $request->descricao,
      
            ]);

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Tópico atualizado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao atualizar tópico: " . $e->getMessage());
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
            // Deleta o tópico
            $topico = Topico::findOrFail($id);
            $topico->delete();

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Tópico deletado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao deletar tópico: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }
}
