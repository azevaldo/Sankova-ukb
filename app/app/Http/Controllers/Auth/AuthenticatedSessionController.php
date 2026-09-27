<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
    {
    public function create(): View
    {
        return view('app.geral.usuario.login');
    }
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user=Auth::user();
        if($user->hasRole('admin')){
            return redirect('/dashboard/main')->with('success','Login Feito Com Sucesso');
        }else if($user->hasRole('normal')) {
            return redirect('/')->with('success','Login Feito Com Sucesso');

        }else{
                    return redirect('/dashboard/gestores')->with('success','Login Feito Com Sucesso');

        }
        
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success','Saida Feita Com Sucesso');
    }
}