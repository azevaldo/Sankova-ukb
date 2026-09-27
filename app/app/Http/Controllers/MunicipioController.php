<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Http\Controllers\Controller;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($id)
    {
        try {
            $provincia = Provincia::findOrFail($id);
            
            // Listando todas as faculdades, paginando para exibir 10 por vez
            $municipios = $provincia->municipios()->paginate(10);
            $nmunicipios = $provincia->municipios()->count();
            $consulta = "Busca por todas";
    
            return view("app.office.provincias.municipios", compact("consulta", "provincia", "municipios", "nmunicipios"));
        } catch (\Exception $e) {
            Log::error("Erro : " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao carregar os dados: ' . $e->getMessage());
        }
    }
    public function getMunicipios($provincia_id){

        
        $municipios=Municipio::where("provincia_id",$provincia_id)->get();
        return response()->json($municipios);
    }

    public function pesquisaNome(Request $request){
        try{
        $request->validate([
            'nome'=>'required',
            "provincia_id"=>"required",
        ]);
 

        $provincia = Provincia::findOrFail($request->provincia_id);
        $municipios = $provincia->municipios()
            ->where("municipio", "like", "%" . $request->nome . "%")
            ->paginate(10);
            $nmunicipios = $provincia->municipios()
            ->where("municipio", "like", "%" . $request->nome . "%")
            ->count();
         $consulta="Buca por nome : ".$request->nome;
        session()->flash('nome_pesquisado', $request->nome);
        $municipios ->appends(['nome' => $request->nome,"provincia_id"=>$request->provincia_id]);
        return view("app.office.provincias.municipios",compact("municipios","provincia","nmunicipios","consulta"));
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
                'municipio' => 'required|string|min:3|unique:municipios,municipio',
                'provincia_id'=> 'required|unique:municipios,municipio',
            ]);

            // Criação da nova província
            Municipio::create([
                'municipio' => $request->municipio,
                'provincia_id' => $request->provincia_id,
            ]);

            // Redireciona de volta com sucesso
            return redirect()->back()->with('success', 'Municipio criado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao criar municipio: " . $e->getMessage());
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
                'municipio' => 'required|string|min:3|unique:municipios,municipio',

            ]);

            // Atualização da província
            $municipio = Municipio::findOrFail($id);
            $municipio->update([
                'municipio' => $request->municipio,
            ]);

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Municipio atualizado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao atualizar municipio: " . $e->getMessage());
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
            $municipio = Municipio::findOrFail($id);
            $municipio->delete();

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Municipio deletado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao deletar municipio: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
}
