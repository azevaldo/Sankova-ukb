<?php

use App\Http\Controllers\ChatGptController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\FaculdadeController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UniversidadeController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\TopicoController;
use App\Http\Controllers\MaterialEstudoController;
use App\Http\Controllers\PermissoesController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\RefeController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\SimuladoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UsuarioController;
use App\Models\Disciplina;
use App\Models\Faculdade;
use App\Models\Municipio;

//$page = 1, $pageSize = 50
Route::get('/criarR', [RefeController::class, 'criar']);
Route::get('/detalhar/{id}', [RefeController::class, 'detalhar']);
Route::get('/detalhar/pagamento/{id}', [RefeController::class, 'detalharPagamento']);
Route::get('/listar/notificacoes/{page}/{pagesize}', [RefeController::class, 'listarNotificacoes']);

Route::get('/notificacoes/status/{id}', [RefeController::class, 'notificacaoEstado']);

//
Route::get('/listar/pagamentos/{page}/{pagesize}/{referencia?}', [RefeController::class, 'listarPagamentos']);

Route::get('/listar/referencias/{page}/{pagesize}/{estado?}', [RefeController::class, 'listarReferencias']);
Route::get('/referencia/cancelar/{id}', [RefeController::class, 'cancelarReferencia']);
Route::get('/referencia/historico/{id}', [RefeController::class, 'historico']);
Route::get('/referencia/verificar/{id}', [RefeController::class, 'verificarReferencia']);




Route::get('/recomendacao', [ChatGptController::class, 'recomendacao'])->name('recomendacao');
Route::get('/ajuda/simulado', [SiteController::class, 'ajudaSimulado'])->name('ajuda.simulado');

Route::post('/recomendar-curso', [ChatGptController::class, 'recomendarCurso'])->name('recomendar.curso');
Route::get('desempenho/{user_id}',[SiteController::class, 'desempenho'])->name('desempenho');
Route::get("universidade/nome",[SiteController::class,"pesquisaNome"])->name("pesquisa.nome");

Route::get("/",[SiteController::class,"index"])->name("home");
Route::get("curso/detalhes/{id}",[SiteController::class,"cursoDetalhes"])->name("curso.detalhes");
Route::get("faculdade/detalhes/{id}",[SiteController::class,"faculdadeDetalhes"])->name("faculdade.detalhes");
Route::get("universidade/detalhes/{id}",[SiteController::class,"detalhes"])->name("universidade.detalhes");
 Route::get("universidades/all/",[SiteController::class,"universidades"])->name("universidades.all");
 Route::get("/sobre",[SiteController::class,"sobre"])->name("sobre");
 Route::get("/contato",[SiteController::class,"contato"])->name("contato");
 Route::get("/getmunicipios/{id}",[MunicipioController::class,"getMunicipios"])->name("getMunicipios");


//pesquisa universidades 2
Route::get('/pesquisa/universidades/provincia',[SiteController::class,'pesquisaProvincia'])->name('pesquisa.provinciaUni2');
Route::get('/pesquisa/universidades/municipio',[SiteController::class,'pesquisaMunicipio'])->name('pesquisa.municipioUni2');
Route::get('/pesquisa/universidades/nome',[SiteController::class,'pesquisaNome'])->name('pesquisa.nomeUni2');

Route::middleware('auth')->group(function () {
    Route::get('/pesquisa/provincia/nome',[ProvinciaController::class,'pesquisaNome'])->name('pesquisa.nomeProvincia')->middleware('roles:admin');
    
    Route::get('/pesquisa/municipio/nome',[MunicipioController::class,'pesquisaNome'])->name('pesquisa.nomeMunicipio')->middleware('roles:admin');

    Route::get("/municipios/geral/{provincia_id}",[MunicipioController::class,"index2"])->name('municipio.geral')->middleware('roles:admin');
Route::resource("provincias",ProvinciaController::class)->middleware('roles:admin');
Route::resource("municipios",MunicipioController::class)->middleware('roles:admin');

Route::get("/simulado/create/{curso_id}",[SimuladoController::class,"create"])->name('simulado.create');
Route::get("/simulado/detalhar/{simulado_id}",[SimuladoController::class,"detalhar"])->name('simulado.detalhar');
Route::get("/simulado/chave/{simulado_id}",[SimuladoController::class,"chave"])->name('simulado.chave');
Route::get("/simulado/ponto/{valor}",[SimuladoController::class,"pontos"])->name('simulado.ponto');
Route::get("/simulado/gerar/{curso_id}",[SimuladoController::class,"gerar"])->name('simulado.gerar');

Route::get("/simulado/listar/{curso_id}",[SimuladoController::class,"listar"])->name('simulado.listar');
Route::post("/simulado/store",[SimuladoController::class,"store"])->name('simulado.store');
Route::get("/simulado/edit/{id}",[SimuladoController::class,"edit"])->name('simulado.edit');
Route::put("/simulado/update/{id}",[SimuladoController::class,"update"])->name('simulado.update');
Route::delete("/simulado/delete/{id}",[SimuladoController::class,"destroy"])->name('simulado.destroy');

    Route::get('/universidades2/pesquisa/provincia',[UniversidadeController::class,'pesquisaProvincia'])->name('pesquisa.provinciaUni');
    Route::get('/universidades2/pesquisa/municipio',[UniversidadeController::class,'pesquisaMunicipio'])->name('pesquisa.municipioUni');
    Route::get('/universidades2/pesquisa/nome',[UniversidadeController::class,'pesquisaNome'])->name('pesquisa.nomeUni');


    //fau
    Route::get('/faculdades/pesquisa/nome',[FaculdadeController::class,'pesquisaNome'])->name('pesquisa.nomeFau');

    Route::get('/cursos/pesquisa/nome',[CursoController::class,'pesquisaNome'])->name('pesquisa.nomeCurso');
    Route::get('/disciplinas/pesquisa/nome',[DisciplinaController::class,'pesquisaNome'])->name('pesquisa.nomeDisciplina');
    Route::get('/topicos/pesquisa/nome',[TopicoController::class,'pesquisaNome'])->name('pesquisa.nomeTopico');

    Route::get('/materiais/pesquisa/nome',[MaterialEstudoController::class,'pesquisaNome'])->name('pesquisa.nomeMaterial');

    //algumas definições
    Route::get("/faculdade/{id}",[FaculdadeController::class,"index2"])->middleware('roles:admin,admin_universidade')->name("faculdade.index2");
Route::get("/curso/{id}",[CursoController::class,"index2"])->middleware('roles:admin,admin_universidade,admin_faculdade')->name("curso.index2");
Route::get("/disciplina/{id}",[DisciplinaController::class,"index2"])->middleware('roles:admin,admin_universidade,admin_faculdade,admin_curso')->name("disciplina.index2");
Route::get("/topicos/{id}",[TopicoController::class,"index2"])->middleware('roles:admin,admin_universidade,admin_faculdade,admin_curso')->name("topico.index2");
Route::get("/material_estudo/{id}",[MaterialEstudoController::class,"index2"])->middleware('roles:admin,admin_universidade,admin_faculdade,admin_curso')->name("materialEstudo.index2");
    //
    Route::resource("materialEstudos",MaterialEstudoController::class);
    Route::resource("topicos",TopicoController::class);
    Route::resource("cursos",CursoController::class)->middleware('roles:admin,admin_universidade,admin_faculdade');
    Route::resource("universidades",UniversidadeController::class)->middleware('roles:admin');
    Route::resource("faculdades",FaculdadeController::class)->middleware('roles:admin,admin_universidade');
    Route::resource("disciplinas",DisciplinaController::class)->middleware('roles:admin,admin_universidade,admin_faculdade,admin_curso');
    Route::get("/dashboard/main",[OfficeController::class,"dashboard"])->middleware('roles:admin')->name("dashboard.main");
    Route::get("/dashboard/gestores",[OfficeController::class,"dashboard2"])->name("dashboard.gestores");
    //permissoes
    //cursos
    Route::get('/permissoes/universidade/faculdade/cursos/{id}',[PermissoesController::class,'cursos'])->middleware('roles:admin,admin_universidade,admin_faculdade')->name('permissoes.universidade.faculdade.cursos');
    Route::post('/permissoes/universidade/faculdade/curso/papel/usuario',[PermissoesController::class,'cursoPapel'])->middleware('roles:admin,admin_universidade,admin_faculdade')->name('papelCurso');
    Route::get('/permissoes/universidade/faculdade/curso/usuarios/{id}',[PermissoesController::class,'cursoUsuarios'])->middleware('roles:admin,admin_universidade,admin_faculdade')->name('permissoes.curso.usuarios');
    Route::get('/permissoes/universidade/faculdade/curso/busca/usuarios/',[PermissoesController::class,'cursoBuscaEmail'])->middleware('roles:admin,admin_universidade,admin_faculdade')->name('permissoes.curso.usuario.email');
    Route::post('/permissoes/universidade/faculdade/curso/papel/desfazer/usuario',[PermissoesController::class,'cursoPapelTirar'])->middleware('roles:admin,admin_universidade,admin_faculdade')->name('papelCursoDesfazer');
    
    
    //faculdade
    Route::get('/permissoes/universidade/faculdades/{id}',[PermissoesController::class,'faculdades'])->middleware('roles:admin,admin_universidade')->name('permissoes.universidade.faculdades');
    
    Route::post('/permissoes/universidade/faculdade/papel/usuario',[PermissoesController::class,'facuPapel'])->middleware('roles:admin,admin_universidade')->name('papelFaculdade');
    Route::get('/permissoes/universidade/faculdade/usuarios/{id}',[PermissoesController::class,'facuUsuarios'])->middleware('roles:admin,admin_universidade')->name('permissoes.faculdade.usuarios');
    Route::get('/permissoes/universidade/faculdade/busca/usuarios/',[PermissoesController::class,'facuBuscaEmail'])->middleware('roles:admin,admin_universidade')->name('permissoes.faculdade.usuario.email');
    Route::post('/permissoes/universidade/faculdade/papel/desfazer/usuario',[PermissoesController::class,'facuPapelTirar'])->middleware('roles:admin,admin_universidade')->name('papelFaculdadeDesfazer');
    
    //universidade
    Route::get('/permissoes/universidades',[PermissoesController::class,'universidades'])->middleware('roles:admin')->name('permissoes.universidades');
    Route::get('/permissoes/universidades/usuarios/{id}',[PermissoesController::class,'uniUsuarios'])->middleware('roles:admin')->name('permissoes.universidade.usuarios');
    Route::get('/permissoes/universidades/busca/usuarios/',[PermissoesController::class,'uniBuscaEmail'])->middleware('roles:admin')->name('permissoes.universidade.usuario.email');
    Route::post('/permissoes/universidades/papel/usuario',[PermissoesController::class,'uniPapel'])->middleware('roles:admin')->name('papelUniversidade');
    Route::post('/permissoes/universidades/papel/desfazer/usuario',[PermissoesController::class,'uniPapelTirar'])->middleware('roles:admin')->name('papelUniversidadeDesfazer');
    
    //adm permissões
    Route::get('/permissoes/adm',[PermissoesController::class,'adm'])->middleware('roles:admin')->name('permissoes.adm');
    Route::get('/permissoes/busca/usuarios/adm',[PermissoesController::class,'buscaAdm'])->middleware('roles:admin')->name('permissoes.adm.usuario.email');
    Route::post('/permissoes/adm/papel/usuario',[PermissoesController::class,'admPapel'])->middleware('roles:admin')->name('papelAdm');
    Route::delete('usuario/deletar/{id}',[UsuarioController::class,"deletar"])->name('usuario.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
