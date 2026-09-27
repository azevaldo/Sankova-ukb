<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //
    public function deletar($id){
     try{
        $usuario=User::findOrFail($id);
        $usuario->delete();
        return redirect()->back()->with('success','Usuario Deletado Com Sucesso');
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
}
