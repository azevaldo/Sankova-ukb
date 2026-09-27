<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Faculdade;
use App\Models\Universidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OfficeController extends Controller
{
    //
    public function dashboard()
    {
        try {
            $nUniversidades = Universidade::count();
            $nFaculdades = Faculdade::count();
            $nCursos = Curso::count();
            $nUsuarios = User::role("normal")->count();
    
            return view("app.office.dashboard", compact('nCursos', 'nUsuarios', 'nUniversidades', 'nFaculdades'));
        } catch (\Exception $e) {
            Log::error("Erro ao carregar o dashboard: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao carregar o painel: ' . $e->getMessage());
        }
    }
    
    public function dashboard2()
    {
        try {
            $entidade = Auth::user()->entidade_tipo;
            $entidade_id = Auth::user()->entidade_id;
    
            if ($entidade == Universidade::class) {
                $universidade = Universidade::with('faculdades')->findOrFail($entidade_id);
                $nFaculdades = $universidade->faculdades->count();
                $nCursos = $universidade->faculdades()->withCount('cursos')->get()->sum('cursos_count');
    
                $nDisciplinas = $universidade->faculdades()
                    ->with(['cursos' => function ($query) {
                        $query->withCount('disciplinas');
                    }])->get()->pluck('cursos')->flatten()->sum('disciplinas_count');
    
                $nTopicos = $universidade->faculdades()
                    ->with(['cursos' => function ($query) {
                        $query->with(['disciplinas' => function ($query) {
                            $query->withCount('topicos');
                        }]);
                    }])->get()->pluck('cursos')->flatten()->pluck('disciplinas')->flatten()->sum('topicos_count');
    
                $nMateriais = $universidade->faculdades()
                    ->with(['cursos' => function ($query) {
                        $query->with(['disciplinas' => function ($query) {
                            $query->with(['topicos' => function ($query) {
                                $query->withCount('materialEstudos');
                            }]);
                        }]);
                    }])->get()->pluck('cursos')->flatten()->pluck('disciplinas')->flatten()->pluck('topicos')->flatten()->sum('material_estudos_count');
    
                $user_universidade = "ola";
    
                return view("app.office.dashboard2", compact('nFaculdades', 'nCursos', 'nDisciplinas', 'nTopicos', 'nMateriais', 'user_universidade'));
    
            } elseif ($entidade == Faculdade::class) {
                $faculdade = Faculdade::with('cursos')->findOrFail($entidade_id);
                $nCursos = $faculdade->cursos->count();
                $nDisciplinas = $faculdade->cursos()->withCount('disciplinas')->get()->sum('disciplinas_count');
    
                $nTopicos = $faculdade->cursos()
                    ->with(['disciplinas' => function ($query) {
                        $query->withCount('topicos');
                    }])
                    ->get()->pluck('disciplinas')->flatten()->sum('topicos_count');
    
                $nMateriais = $faculdade->cursos()
                    ->with(['disciplinas.topicos' => function ($query) {
                        $query->withCount('materialEstudos');
                    }])
                    ->get()->pluck('disciplinas')->flatten()->pluck('topicos')->flatten()->sum('material_estudos_count');
    
                $user_faculdade = "ola";
    
                return view("app.office.dashboard2", compact('nCursos', 'nDisciplinas', 'nTopicos', 'nMateriais', 'user_faculdade'));
    
            } elseif ($entidade == Curso::class) {
                $curso = Curso::with('disciplinas')->findOrFail($entidade_id);
    
                $nDisciplinas = $curso->disciplinas->count();
                $nTopicos = $curso->disciplinas()->withCount('topicos')->get()->sum('topicos_count');
    
                $nMateriais = $curso->disciplinas()
                    ->with(['topicos' => function ($query) {
                        $query->withCount('materialEstudos');
                    }])
                    ->get()->pluck('topicos')->flatten()->sum('material_estudos_count');
    
                $user_curso = "ola";
    
                return view("app.office.dashboard2", compact('nDisciplinas', 'nTopicos', 'nMateriais', 'user_curso'));
            }
    
            return redirect()->back()->with('error', 'Tipo de entidade desconhecido.');
    
        } catch (\Exception $e) {
            Log::error("Erro ao carregar o dashboard2: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao carregar o painel: ' . $e->getMessage());
        }
    }
}
