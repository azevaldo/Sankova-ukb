<?php

namespace App\Http\Controllers;

use App\Models\simulado;
use App\Http\Controllers\Controller;
use App\Models\Alternativa;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Questao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimuladoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gerar($curso_id)
    {
        try {
            $curso = Curso::with(['simulados.questoes.alternativas', 'disciplinas.questoes'])->findOrFail($curso_id);
    
            // Filtrar apenas os simulados que têm questões vinculadas às disciplinas do curso
            $simuladosValidos = $curso->simulados->filter(function ($simulado) use ($curso) {
                return $simulado->questoes->whereIn('disciplina_id', $curso->disciplinas->pluck('id'))->isNotEmpty();
            });
    
            if ($simuladosValidos->isEmpty()) {
                return back()->with('error', 'Nenhum simulado válido encontrado para este curso.');
            }
    
            // Escolher um simulado aleatório entre os filtrados
            $simulado = $simuladosValidos->random();
    
            return view('app.office.simulado.detalhar', compact('simulado','curso'));
    
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao gerar o simulado: ' . $e->getMessage());
        }
    }
    public function pontos($valor){
        try {
        $valores=explode(' ',$valor);
        $correta=$valores[0];
        $incorreta=$valores[1];
        $user=Auth::user();
    
        $user->desempenho->update([
            'corretas'=>$user->desempenho->corretas+$correta,
            'incorretas'=>$user->desempenho->incorretas+$incorreta,
            'nsimulados'=>$user->desempenho->nsimulados+1,
            ]
        );
        return redirect()->route('desempenho',$user->id)->with("success","Pontos Guardados Com Sucesso");
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro ao salvar os pontos: ' . $e->getMessage());
    }   
 }
    /*public function pontos($valor)
    {
        try {
            $valores = explode(' ', $valor);
           
            if (count($valores) < 2) {
                return back()->with('error', 'Formato de valor inválido.');
            }
    
            $correta = (int)$valores[0];
            $incorreta = (int)$valores[1];
            $user = Auth::user();
    
            // Verificar se o usuário tem um desempenho cadastrado
            if (!$user->desempenho) {
                return back()->with('error', 'Nenhum registro de desempenho encontrado.');
            }
    
            $user->desempenho->update([
                'corretas' => $user->desempenho->corretas + $correta,
                'incorretas' => $user->desempenho->incorretas + $incorreta,
                'nsimulados' => $user->desempenho->nsimulados + 1,
            ]);
    
            return redirect()->route('desempenho', $user->id)->with("success", "Pontos Guardados Com Sucesso");
    
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao salvar os pontos: ' . $e->getMessage());
        }
    }
    */
    public function index()
    {
        //
    }
    public function detalhar($simulado_id)
    {
        try{
     
        $simulado=simulado::findOrFail($simulado_id);
        $curso=  $simulado->curso;  
    return view('app.office.simulado.detalhar',compact('curso','simulado'));
} catch (\Exception $e) {
    return back()->with('error', 'Ocorreu um erro : ' . $e->getMessage());
}
    }
    public function chave($simulado_id)
    {
        try{
        $simulado = Simulado::with(['curso.disciplinas.questoes.alternativas'])->findOrFail($simulado_id);
    
        // Filtrar apenas disciplinas que possuem questões associadas a este simulado
        $disciplinasValidas = $simulado->curso->disciplinas->filter(function ($disciplina) use ($simulado) {
            return $disciplina->questoes->where('simulado_id', $simulado->id)->isNotEmpty();
        });
    
        return view('app.office.simulado.chave', compact('simulado', 'disciplinasValidas'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro : ' . $e->getMessage());
    }
    }
    
    public function listar($curso_id){
        try{
        $curso=Curso::findOrFail($curso_id);
        $simulados=$curso->simulados()->paginate(10);
        $nSimulados=$curso->simulados->count();
        $simulados ->appends(['curso_id' => $curso_id]);
        return view('app.office.simulado.listar',compact('curso','simulados','nSimulados'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Controller - Adicionar os métodos edit e update
    public function edit($id)
    {
        try{
        $simulado = Simulado::with(['questoes.alternativas'])->findOrFail($id);
        $disciplinas = Disciplina::whereIn('id', $simulado->questoes->pluck('disciplina_id'))->get();
    $curso=$simulado->curso;
        // Organizando as questões corretamente
        $questoesFormatadas = [];
        foreach ($simulado->questoes as $questao) {
            $questoesFormatadas[$questao->disciplina_id][] = [
                'id' => $questao->id,
                'text' => $questao->texto,
                'options' => $questao->alternativas->pluck('texto')->toArray(),
                'correct' => optional($questao->alternativas->firstWhere('correta', true))->texto ?? null
            ];
        }
    
        return view('app.office.simulado.edit', compact('curso','simulado', 'disciplinas', 'questoesFormatadas'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    
    
    public function create($curso_id)
    {
        try{
        //
        $curso=Curso::findOrFail($curso_id);
        $disciplinas=$curso->disciplinas;
        $nSimulados=Simulado::count();
        return view('app.office.simulado.create',compact('disciplinas','curso','nSimulados'));
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
        try{
     
        
        $dados = json_decode($request->dados, true);
        

 // Verificar se todas as disciplinas têm pelo menos uma pergunta
 $disciplinasSemPerguntas = [];
 foreach ($request->disciplinas as $disciplinaId) {
     if (!isset($dados[$disciplinaId]) || empty($dados[$disciplinaId])) {
         $disciplinasSemPerguntas[] = $disciplinaId;
     }
 }
 
 if (!empty($disciplinasSemPerguntas)) {
     return redirect()->back()->withInput()->with('error', 'Todas as disciplinas devem ter pelo menos uma pergunta.');
 }
 
 foreach ($dados as $disciplinaId => $questoes) {
     foreach ($questoes as $questaoData) {
         
         // Verificar se a pergunta está vazia
         if (empty(trim($questaoData['text']))) {
             return redirect()->back()->withInput()->with('error', 'Nenhuma pergunta pode estar vazia.');
         }
         
         // Verificar se há pelo menos duas opções preenchidas
         $opcoesPreenchidas = array_filter($questaoData['options'], fn($opt) => !empty(trim($opt)));
         if (count($opcoesPreenchidas) < 2) {
             return redirect()->back()->withInput()->with('error', 'Cada pergunta deve ter pelo menos duas opções preenchidas.');
         }
     }
 }
 
 $simulado = Simulado::create([
    'nome' => 'Simulado Gerado',
    'tipo' => 'Automático',
    'curso_id' => $request->curso_id
]);
        foreach ($dados as $disciplinaId => $questoes) {
            foreach ($questoes as $questaoData) {
                $questao = Questao::create([
                    'texto' => $questaoData['text'],
                    'simulado_id' => $simulado->id,
                    'disciplina_id' => $disciplinaId
                ]);
                
                foreach ($questaoData['options'] as $index => $optionText) {
            
                    if($optionText!=""){
                    Alternativa::create([
                        'texto' => $optionText,
                        'correta' => ($index == $questaoData['correct']) ? 1 : 0,
                        'questao_id' => $questao->id
                    ]);
                }
                    

                }
            }
        }
        
        return redirect()->back()->with('success', 'Simulado criado com sucesso!');

    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\simulado  $simulado
     * @return \Illuminate\Http\Response
     */
    public function show(simulado $simulado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\simulado  $simulado
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\simulado  $simulado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    try{
    $request->validate([
        'curso_id' => 'required|exists:cursos,id',
        'dados' => 'required',
    ]);






    $dados = json_decode($request->dados, true);


     // Verificar se todas as disciplinas têm pelo menos uma pergunta
 $disciplinasSemPerguntas = [];
 foreach ($request->disciplinas as $disciplinaId) {
     if (!isset($dados[$disciplinaId]) || empty($dados[$disciplinaId])) {
         $disciplinasSemPerguntas[] = $disciplinaId;
     }
 }
 
 if (!empty($disciplinasSemPerguntas)) {
     return redirect()->back()->withInput()->with('error', 'Todas as disciplinas devem ter pelo menos uma pergunta.');
 }
 
 foreach ($dados as $disciplinaId => $questoes) {
     foreach ($questoes as $questaoData) {
         
         // Verificar se a pergunta está vazia
         if (empty(trim($questaoData['text']))) {
             return redirect()->back()->withInput()->with('error', 'Nenhuma pergunta pode estar vazia.');
         }
         
         // Verificar se há pelo menos duas opções preenchidas
         $opcoesPreenchidas = array_filter($questaoData['options'], fn($opt) => !empty(trim($opt)));
         if (count($opcoesPreenchidas) < 2) {
             return redirect()->back()->withInput()->with('error', 'Cada pergunta deve ter pelo menos duas opções preenchidas.');
         }
     }
 }
    $simulado = Simulado::findOrFail($id);
    $simulado->curso_id = $request->curso_id;
    $simulado->save();

  
    $questaoIds = [];

    foreach ($dados as $disciplinaId => $questoes) {
        foreach ($questoes as $questaoData) {
            // Se a questão tem ID e existe no banco, busca; senão, cria nova
            $questao = isset($questaoData['id']) ? Questao::find($questaoData['id']) : null;
            
            if (!$questao) {
                $questao = new Questao();
            }
            
            $questao->simulado_id = $simulado->id;
            $questao->disciplina_id = $disciplinaId;
            $questao->texto = $questaoData['text'];
            $questao->save();

            $questaoIds[] = $questao->id;

            $alternativaIds = [];
            foreach ($questaoData['options'] as $opcaoTexto) {
                $alternativa = Alternativa::updateOrCreate(
                    ['questao_id' => $questao->id, 'texto' => $opcaoTexto],
                    ['correta' => ($opcaoTexto === $questaoData['correct'])]
                );
                $alternativaIds[] = $alternativa->id;
            }

            // Remove alternativas que não estão mais no conjunto atualizado
            Alternativa::where('questao_id', $questao->id)->whereNotIn('id', $alternativaIds)->delete();
        }
    }

    // Remover questões que não estão mais no conjunto atualizado
    Questao::where('simulado_id', $simulado->id)->whereNotIn('id', $questaoIds)->delete();

    return redirect()->back()->with('success', 'Simulado atualizado com sucesso!');
} catch (\Exception $e) {
    return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
}
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\simulado  $simulado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        $simulado = Simulado::findOrFail($id);
        $simulado->delete();
        return redirect()->back()->with("success","Simulado eliminado com sucesso");
        //
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
}
