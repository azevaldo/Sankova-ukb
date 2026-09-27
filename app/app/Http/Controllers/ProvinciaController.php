<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use Illuminate\Support\Facades\Log;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listando todas as províncias, paginando para exibir 5 por vez
        $provincias = Provincia::paginate(10);
        $nprovincias=Provincia::count();
        $consulta="Todas Provincias";
        return view("app.office.provincias.index", compact("provincias","nprovincias","consulta"));
    }
    public function pesquisaNome(Request $request){
        try{
        $request->validate([
            'nome'=>'required',
        ]);
 
        $provincias=Provincia::where("provincia","like","%".$request->nome."%")->paginate(10);
             
        $nprovincias=Provincia::where("provincia","like","%".$request->nome."%")->count();
      
         $consulta="Buca por nome : ".$request->nome;
        session()->flash('nome_pesquisado', $request->nome);
        $provincias ->appends(['nome' => $request->nome]);
        return view("app.office.provincias.index",compact("provincias","nprovincias","consulta"));
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
            // Validação do campo 'provincia' para garantir que não haja duplicados
            $request->validate([
                'provincia' => 'required|unique:provincias,provincia',
            ]);

            // Criação da nova província
            Provincia::create([
                'provincia' => $request->provincia,
            ]);

            // Redireciona de volta com sucesso
            return redirect()->back()->with('success', 'Província criada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao criar província: " . $e->getMessage());
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
            // Validação do campo 'provincia' para garantir que não haja duplicados
            $request->validate([
                'provincia' => 'required|unique:provincias,provincia,' . $id,
            ]);

            // Atualização da província
            $provincia = Provincia::findOrFail($id);
            $provincia->update([
                'provincia' => $request->provincia,
            ]);

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Província atualizada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao atualizar província: " . $e->getMessage());
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
            // Deleta a província
            $provincia = Provincia::findOrFail($id);
            $provincia->delete();

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Província deletada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao deletar província: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }
}
