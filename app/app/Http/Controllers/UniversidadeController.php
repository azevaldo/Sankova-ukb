<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Universidade;
use App\Models\User;
use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Support\Facades\Log;

class UniversidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesquisaProvincia(Request $request){
        try{
        $request->validate([
            'provincia_id2'=>'required|exists:provincias,id',
        ]);

        $provincia_id=$request->provincia_id2;
      
        $prov=Provincia::find( $provincia_id);
        $universidades=Universidade::with('municipio')->whereHas('municipio',function ($query) use($provincia_id){
            $query->where('provincia_id',$provincia_id);
        })->paginate(10);
        $provincias = Provincia::all();       
        $municipios = Municipio::all(); 
        $nUniversidades=Universidade::with('municipio')->whereHas('municipio',function ($query) use($provincia_id){
            $query->where('provincia_id',$provincia_id);
        })->count();
        $consulta="Buca por provincia : ".$prov->provincia;
        $universidades ->appends(['provincia_id2' => $request->provincia_id2]);
        return view("app.office.universidades.index", compact('consulta',"provincias","universidades","municipios",'nUniversidades'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function pesquisaMunicipio(Request $request){
        try{
        $request->validate([
            'municipio_id'=>'required|exists:municipios,id',
        ]);
        $muni=Municipio::find($request->municipio_id);
        $universidades=$muni->universidades()->paginate(10);

        $provincias = Provincia::all();       
        $municipios = Municipio::all(); 
        $nUniversidades=$muni->universidades()->count();
        $consulta="Buca por municpio : ".$muni->municipio." da provincia : ".$muni -> provincia->provincia;
        $universidades ->appends(['municipio_id' => $request->municipio_id]);
        return view("app.office.universidades.index", compact('consulta',"provincias","universidades","municipios",'nUniversidades'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }

    public function pesquisaNome(Request $request){
        try{
        $request->validate([
            'nome'=>'required',
        ]);
 
        $universidades=Universidade::with('municipio')->where("nome","like","%".$request->nome."%")->orWhere('sigla',"like","%".$request->nome."%")->paginate(10);
        $provincias = Provincia::all();       
        $municipios = Municipio::all(); 
        $nUniversidades=Universidade::with('municipio')->where("nome","like","%".$request->nome."%")->orWhere('sigla',"like","%".$request->nome."%")->count();
        $consulta="Buca por nome : ".$request->nome;
        $universidades ->appends(['nome' => $request->nome]);
        return view("app.office.universidades.index", compact('consulta',"provincias","universidades","municipios",'nUniversidades'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function index()
    {
        try{
        // Listando todas as universidades, paginando para exibir 5 por vez
        $universidades = Universidade::paginate(10);
       
        $provincias = Provincia::all();       
        $municipios = Municipio::all(); 
        $nUniversidades=Universidade::count();
        $consulta="Buca por todas universidades ";
        return view("app.office.universidades.index", compact('consulta',"provincias","universidades","municipios",'nUniversidades'));
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
        // Retorna a view para criação de uma nova universidade
        // Carrega usuários e municípios para o formulário de criação
        $users = User::all();
        $municipios = Municipio::all();
        return view("app.office.universidades.create", compact('users', 'municipios'));
    }

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
                'nome' => 'required|min:3|unique:universidades,nome',
                'endereco' => 'required',
                'descricao' => 'nullable',
                'sigla'=>'required|string|min:2|max:10',
                'site'=>'nullable|string',
                'email'=>'required|email|unique:universidades,email',
                'municipio_id' => 'required|exists:municipios,id',
            ]);

         
            Universidade::create([
                'nome' => $request->nome,
                'endereco' => $request->endereco,
                'descricao' => $request->descricao,
                'sigla'=>$request->sigla,
                'site'=>$request->site,
                'email'=>$request->email,
                'municipio_id' => $request->municipio_id,
            ]);

            // Redireciona para a listagem com sucesso
            return redirect()->back()->with('success', 'Universidade criada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao criar universidade: " . $e->getMessage());
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
        // Mostra uma universidade específica
        $universidade = Universidade::findOrFail($id);
        return view('app.office.universidades.show', compact('universidade'));
    }

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
            // verificar bem o email Email
            $request->validate([
                'nome' => 'required|min:3|unique:universidades,nome,' . $id,
                'endereco' => 'required',
                'descricao' => 'nullable',
                'sigla'=>'required|string|min:2|max:10',
                'site'=>'nullable|string',
                'email'=>'required|email|unique:universidades,email,'.$id,
                'municipio_id' => 'required|exists:municipios,id',
            ]);

            // Atualização da universidade
            $universidade = Universidade::findOrFail($id);
            $universidade->update([
                'nome' => $request->nome,
                'endereco' => $request->endereco,
                'descricao' => $request->descricao,
                'sigla'=>$request->sigla,
                'site'=>$request->site,
                'email'=>$request->email,
                'municipio_id' => $request->municipio_id,
            ]);

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Universidade atualizada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao atualizar universidade: " . $e->getMessage());
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
            // Deleta a universidade
            $universidade = Universidade::findOrFail($id);
            $universidade->delete();

            // Redireciona com sucesso
            return redirect()->route('universidades.index')->with('success', 'Universidade deletada com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao deletar universidade: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }
}
