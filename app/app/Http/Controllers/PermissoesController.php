<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Faculdade;
use App\Models\Universidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissoesController extends Controller
{
    
    //cursos
    
    public function adm(){
    try{

        return view('app.office.permissoes.usuarios.admpermissoes');
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }

    }
    public function buscaAdm( Request $request){
        try{
          
            $usuario = User::where('email', $request->email)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->with('entidade')
            ->first();
        
         
          $requestEmail=$request->email;
            $pesquisa="";
          return view("app.office.permissoes.usuarios.admpermissoes", compact("pesquisa","usuario",'requestEmail'));
      } catch (\Exception $e) {
          return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
      }
      }
      public function admPapel(Request $request){
        try{
           $request->validate([
                'usuario_id' =>'required|exists:users,id',
           ]);
          // $universidade=Universidade::find($request->universidade_id);
           $usuario=User::find($request->usuario_id);
           if($usuario){
               $usuario->desvincular();
               $user=Auth::user();
               $user->desvincular();
               $user->syncRoles('normal');    
                $usuario->syncRoles('admin');
                
                 return redirect('/')->with('success','Novo Administrator Adicionado Com Sucesso');
            }
            return redirect()->back()->with('error','Usuario Não Existe');
           
       } catch (\Exception $e) {
           return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
       }
       }
    public function cursoBuscaEmail( Request $request){
      try{
        $curso=Curso::find($request->curso_id);   
        $faculdade=$curso->faculdade;
        $usuario2 = User::with(['entidade'])->whereHas('roles', function ($query) {
            $query->where('name', 'normal');
        })->where('email', $request->email)->first();
    $curs=Curso::class;
        // Se não encontrar, buscar usuários que tenham entidade_id igual à faculdade e o mesmo email
        if (!$usuario2) {
            $usuario2 = User::with(['entidade'])->where('entidade_tipo',$curs )->where('entidade_id', $curso->id)
                            ->where('email', $request->email)
                            ->first();
        }
        $requestEmail=$request->email;
   
        return view("app.office.permissoes.usuarios.cursoUsuarios", compact('faculdade','curso',"usuario2",'requestEmail'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function cursoUsuarios($cursoId){
try{
        $curso= Curso::find($cursoId);
        $faculdade=$curso->faculdade;
       $usuarios=$curso->usuarios()->whereHas('roles', function($query){
        $query->where('name','admin_curso');
       })->paginate(10); 
       $usuarios ->appends(['cursoId' => $cursoId]);
                 return view("app.office.permissoes.usuarios.cursoUsuarios", compact('curso','faculdade',"usuarios"));
                } catch (\Exception $e) {
                    return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
                }
                }
    public function cursoPapelTirar(Request $request){
     try{
        $request->validate([
             'usuario_id' =>'required|exists:users,id',
        ]);
       // $universidade=Universidade::find($request->universidade_id);
        $usuario=User::find($request->usuario_id);
        if($usuario){
            $usuario->desvincular();
            $usuario->syncRoles('normal');    
        }
        return redirect()->back()->with('success','Papel Tirado  Com Sucesso');
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function cursoPapel(Request $request){
       try{
        $request->validate([
            'curso_id' =>'required|exists:cursos,id',
            'usuario_id' =>'required|exists:users,id',
        ]);
       
        $curso=Curso::find($request->curso_id);
        $usuario=User::find($request->usuario_id);
        $usuario->syncRoles('admin_curso');
        $curso->usuarios()->save($usuario);

        return redirect()->back()->with('success','Papel Atribuido Com Sucesso');
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }

    //
    public function cursos($id){
        try{
        $faculdade=Faculdade::findOrFail($id);
        $cursos=$faculdade->cursos()->paginate(10);
        return view("app.office.permissoes.areas.cursos", compact("faculdade","cursos"));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function faculdades($id){
       try{
        $universidade=Universidade::findOrFail($id);
        $faculdades=$universidade->faculdades()->paginate(10);
        return view("app.office.permissoes.areas.faculdades", compact("faculdades","universidade"));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function facuPapelTirar(Request $request){
        try{
        $request->validate([
             'usuario_id' =>'required|exists:users,id',
        ]);
       // $universidade=Universidade::find($request->universidade_id);
        $usuario=User::find($request->usuario_id);
        if($usuario){
            $usuario->desvincular();
            $usuario->syncRoles('normal');    
        }
        return redirect()->back()->with('success','Papel Tirado  Com Sucesso');
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function facuPapel(Request $request){
       try{
        $request->validate([
            'faculdade_id' =>'required|exists:faculdades,id',
            'usuario_id' =>'required|exists:users,id',
        ]);
       
        $faculdade=Faculdade::find($request->faculdade_id);
        $usuario=User::find($request->usuario_id);
        $usuario->syncRoles('admin_faculdade');
        $faculdade->usuarios()->save($usuario);

        return redirect()->back()->with('success','Papel Atribuido Com Sucesso');
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
   
    public function uniPapel(Request $request){
try{
        $request->validate([
            'universidade_id' =>'required|exists:universidades,id',
            'usuario_id' =>'required|exists:users,id',
        ]);
        $universidade=Universidade::find($request->universidade_id);
        $usuario=User::find($request->usuario_id);
        $usuario->syncRoles('admin_universidade');
        $universidade->usuarios()->save($usuario);

        return redirect()->back()->with('success','Papel Atribuido Com Sucesso');
    
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function uniPapelTirar(Request $request){
        try{
        $request->validate([
             'usuario_id' =>'required|exists:users,id',
        ]);
       // $universidade=Universidade::find($request->universidade_id);
        $usuario=User::find($request->usuario_id);
        if($usuario){
            $usuario->desvincular();
            $usuario->syncRoles('normal');    
        }
        return redirect()->back()->with('success','Papel Tirado  Com Sucesso');
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    public function universidades(){
       try{
        $universidades = Universidade::paginate(10);
        
                 return view("app.office.permissoes.areas.universidades", compact("universidades"));
                } catch (\Exception $e) {
                    return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
                }
                }
    public function facuUsuarios($facuId){
        try{
        $faculdade= Faculdade::find($facuId);
        $universidade=$faculdade->universidade;
       $usuarios=$faculdade->usuarios()->whereHas('roles', function($query){
        $query->where('name','admin_faculdade');
       })->paginate(10); 
       $usuarios ->appends(['facuId' => $facuId]);
                 return view("app.office.permissoes.usuarios.facuUsuarios", compact('faculdade',"usuarios",'universidade'));
                } catch (\Exception $e) {
                    return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
                }
                }
    public function uniUsuarios($uniId){
try{
        $universidade = Universidade::find($uniId);
       $usuarios=$universidade->usuarios()->paginate(10); 
                 return view("app.office.permissoes.usuarios.uniUsuarios", compact("usuarios",'universidade'));
                } catch (\Exception $e) {
                    return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
                }
                }
         
    public function uniBuscaEmail( Request $request){
      try{
        $universidade=Universidade::find($request->universidade_id);   
        $usuario2=User::with('entidade')->where('email',$request->email)->first();
       
        $requestEmail=$request->email;
   
        return view("app.office.permissoes.usuarios.uniUsuarios", compact('universidade',"usuario2",'requestEmail'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }

    public function facuBuscaEmail( Request $request){
       try{
        $faculdade=Faculdade::find($request->faculdade_id);   
        $universidade=$faculdade->universidade;
        $usuario2 = User::with(['entidade'])->whereHas('roles', function ($query) {
            $query->where('name', 'normal');
        })->where('email', $request->email)->first();
    $facu=Faculdade::class;
        // Se não encontrar, buscar usuários que tenham entidade_id igual à faculdade e o mesmo email
        if (!$usuario2) {
            $usuario2 = User::with(['entidade'])->where('entidade_tipo',$facu )->where('entidade_id', $faculdade->id)
                            ->where('email', $request->email)
                            ->first();
                            if (!$usuario2)  {
                                $faculdadeId=$request->faculdade_id;
                                $faculdade2 = Faculdade::with('cursos.usuarios')->find($faculdadeId);
                            
                                $usuario2 = User::where('email', $request->email)
                                ->whereHas('entidade', function ($query) use ($faculdade2) {
                                    $query->whereIn('id', $faculdade2->cursos->pluck('id'))
                                          ->where('entidade_tipo', Curso::class);
                                })
                                ->first();
                            }  
        }
        $requestEmail=$request->email;
   
        return view("app.office.permissoes.usuarios.facuUsuarios", compact('faculdade','universidade',"usuario2",'requestEmail'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
}
