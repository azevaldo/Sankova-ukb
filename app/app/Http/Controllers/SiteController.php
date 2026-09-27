<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Universidade;
use App\Models\Faculdade;
use App\Models\Curso;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SiteController extends Controller
{
    //



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
        $consulta="Buca por provincia : ".$prov->provincia;
        session()->flash('nome_pesquisado', $request->nome);
        $universidades ->appends(['provincia_id2' => $request->provincia_id2]);
        return view("app.geral.cliente.universidades",compact("universidades",'provincias','consulta','municipios'));
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
 
        $consulta="Buca por municpio : ".$muni->municipio." da provincia : ".$muni -> provincia->provincia;
        session()->flash('nome_pesquisado', $request->nome);
        $universidades ->appends(['municipio_id' => $request->municipio_id]);
        return view("app.geral.cliente.universidades",compact("universidades",'provincias','consulta','municipios'));
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
             
        $municipios = Municipio::all(); 
      
        $provincias=Provincia::all();
        $consulta="Buca por nome : ".$request->nome;
        session()->flash('nome_pesquisado', $request->nome);
        $universidades ->appends(['nome' => $request->nome]);
        return view("app.geral.cliente.universidades",compact("universidades",'provincias','consulta','municipios'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }  
    }
    public function desempenho($user_id){
        try{
        $user=User::find($user_id);
        
        return view('app.geral.cliente.desempenho',compact("user"));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
 
    public function sobre(){
        return view("app.geral.cliente.sobre");
    }
    public function ajudaSimulado(){
        return view("app.geral.cliente.ajudaSimulado");
    }
    public function contato(){
        return view("app.geral.cliente.contato");
    }
    public function index(){
        try{
        $nUniversidades=Universidade::count();
        $nFaculdades=Faculdade::count();
        $nCursos=Curso::count();
         
        $nUsuarios=User::Role('normal')->count();
        $universidades=Universidade::with(["municipio","faculdades"])->take(4)->get();
        return view('app.geral.index',compact("universidades",'nUniversidades','nCursos','nFaculdades','nUsuarios'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function universidades(){
        try{
        $universidades=Universidade::with(["municipio","faculdades"])->paginate(10);
        $provincias=Provincia::all();
        $consulta="Todas Universidades";
        return view("app.geral.cliente.universidades",compact("consulta","universidades",'provincias'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function detalhes($id){
        try{
        $universidade=Universidade::with(["municipio","faculdades"])->findOrFail($id);
       $faculdades=$universidade->faculdades()->paginate(6);
        return view("app.geral.cliente.detalhes",compact("faculdades","universidade"));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function cursoDetalhes($id){
    try{
        $curso=Curso::with(["faculdade","disciplinas"])->findOrFail($id);
        $faculdade=$curso->faculdade;
 
        return view("app.geral.cliente.curso",compact("curso","faculdade"));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function faculdadeDetalhes($id){
    try{
        $faculdade=Faculdade::with(["universidade","cursos"])->findOrFail($id);
        $universidade=$faculdade->universidade;
        $cursos=$faculdade->cursos()->paginate(8);
        return view("app.geral.cliente.faculdade",compact("cursos","universidade","faculdade"));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
}
